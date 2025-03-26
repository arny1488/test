<?php

/**
 * This file is part of the dashboard.rgbvision.net package.
 *
 * (c) Alex Graham <contact@rgbvision.net>
 *
 * @package    dashboard.rgbvision.net
 * @author     Alex Graham <contact@rgbvision.net>
 * @copyright  Copyright 2017-2022, Alex Graham
 * @license    https://dashboard.rgbvision.net/license.txt MIT License
 * @version    4.0
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 1.0
 */

class ApiRouter
{

    private static string $method;
    private static ?array $params;
    private static object $controller;
    protected static ?ApiRouter $instance = null;

    /**
     * @throws ReflectionException
     */
    public static function init(string $controller, string $file, string $route): ?ApiRouter
    {
        if (!isset(self::$instance)) {
            self::$instance = new ApiRouter($controller, $file, $route);
        }

        return self::$instance;
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function __construct(string $controller, string $file, string $route)
    {
        if (is_file($file)) {
            Loader::addClass($controller, $file);
            self::$controller = new $controller();
        } else {
            throw new Exception(i18n::_('router.error.controller'));
        }

        self::$method = strtolower($_SERVER['REQUEST_METHOD']) . '_' . str_replace(['/', '\\'], '_', trim($route, '/'));

        $class = new ReflectionClass($controller);

        $_params = [];

        foreach ($class->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if (
                (str_starts_with($method->name, strtolower($_SERVER['REQUEST_METHOD']) . '_')) &&
                (strpos($method->name, '_ARG')) &&
                (preg_match(
                        '#^' . preg_replace('/(\/ARG([a-z][a-zA-Z0-9+-]*))/', '/([a-zA-Z_0-9+-]+)', str_replace('_', '/', preg_replace('/^' . strtolower($_SERVER['REQUEST_METHOD']) . '_/', '', $method->name))) . '$#',
                        $route,
                        $matches_route
                    ) === 1) &&
                (preg_match_all('/_ARG([a-z][a-zA-Z0-9]*)/', $method->name, $matches) === (count($matches_route) - 1)) &&
                ($args = $matches[1]) &&
                is_array($args)
            ) {
                self::$method = $method->name;
                foreach ($args as $index => $arg) {
                    $_params[$arg] = $matches_route[$index + 1];
                }
            }
        }

        $body_params = [];

        if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'GET') {
            if (str_contains(strtolower($_SERVER['CONTENT_TYPE'] ?? ''), 'application/json')) {
                $body_params = Json::decode(file_get_contents('php://input'));
            } else {
                parse_str(file_get_contents('php://input'), $body_params);
                $body_params = [...$_POST, ...$body_params];
            }
        }

        static::$params = array_replace_recursive(((strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') ? $_GET : [...$_GET, ...(is_array($body_params) ? $body_params : [])]) ?: [], $_params);
    }

    public static function execute(): void
    {
        if (str_starts_with(self::$method, '__')) {
            self::response(400, ['message' => i18n::_('router.error.magic_method')]);
            return;
        }

        try {
            $reflection = new ReflectionClass(self::$controller);

            if ($reflection->hasMethod(self::$method)) {
                $arguments = [];

                $reflectionMethod = new ReflectionMethod(self::$controller, self::$method);

                foreach ($reflectionMethod->getParameters() as $parameter) {
                    $_parameter = is_array(static::$params) ? Arrays::get(static::$params, $parameter->name) : null;

                    if ($_parameter !== null) {
                        if ($parameter->hasType()) {
                            $parameterType = $parameter->getType();
                            assert($parameterType instanceof ReflectionNamedType);

                            if ($parameterType->isBuiltin()) {
                                if (in_array($parameterType->getName(), ['int', 'integer'])) {
                                    $strictInt = filter_var($_parameter, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                                    if ($strictInt === null) {
                                        self::response(400, ['message' => sprintf(i18n::_('router.error.parameter_type'), $parameter->name, $parameterType->getName())]);
                                        return;
                                    }
                                    $_parameter = $strictInt;
                                }

                                if (in_array($parameterType->getName(), ['float', 'double'])) {
                                    $strictFloat = filter_var($_parameter, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
                                    if ($strictFloat === null) {
                                        self::response(400, ['message' => sprintf(i18n::_('router.error.parameter_type'), $parameter->name, $parameterType->getName())]);
                                        return;
                                    }
                                    $_parameter = $strictFloat;
                                }

                                if (in_array($parameterType->getName(), ['bool', 'boolean'])) {
                                    $strictBool = filter_var($_parameter, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                                    if ($strictBool === null) {
                                        self::response(400, ['message' => sprintf(i18n::_('router.error.parameter_type'), $parameter->name, $parameterType->getName())]);
                                        return;
                                    }
                                    $_parameter = $strictBool;
                                }

                                if (!is_array($_parameter) && $parameterType->getName() === 'array') {
                                    self::response(400, ['message' => sprintf(i18n::_('router.error.parameter_type'), $parameter->name, $parameterType->getName())]);
                                    return;
                                }

                                settype($_parameter, $parameterType->getName());
                            }
                        }

                        $arguments[$parameter->name] = $_parameter;
                    } else {
                        if (!$parameter->isOptional()) {
                            self::response(400, ['message' => sprintf(i18n::_('router.error.required_parameter'), $parameter->name)]);
                            return;
                        }
                    }

                    unset($_parameter);
                }

                call_user_func_array([self::$controller, self::$method], $arguments);
                return;
            }
        } catch (ReflectionException $e) {
            self::response(500, ['message' => sprintf(i18n::_('router.error.runtime'), $e->getMessage())]);
            return;
        }

        self::response(404, ['message' => i18n::_('router.error.method')]);
    }
    
    public static function param(string $key): mixed
    {
        return Arrays::get(static::$params, $key);
    }

    public static function response(int $response_code = 204, array|string|null $data = null): void
    {
        Json::output($data, true, $response_code);
    }
}
