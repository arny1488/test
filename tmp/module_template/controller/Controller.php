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
 * @version    1.0
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 1.0
 */

class ExampleController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        // Check if user has permission
        if (!Permissions::has('example_view')) {
            Router::response(false, '', ABS_PATH, [], 403);
        }

        define('TEMPLATE', 'dashboard');

        $files = [
            ABS_PATH . 'assets/vendors/datatables.net/jquery.dataTables.js',
            ABS_PATH . 'assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css',
            ABS_PATH . 'assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js',
            $this->module->uri . 'js/example.js',
        ];

        foreach ($files as $i => $file) {
            Dependencies::add(
                $file,
                $i + 100
            );
        }
    }

    public function index()
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'example',

            // Page Title
            'page_title' => $Template->_get('example_page_title'),

            // Page Header
            'header' => $Template->_get('example_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'dashboard',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('example_breadcrumb'),
                    'href' => '',
                    'page' => '',
                    'active' => true,
                ],
            ],
        ];

        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        // Push data to template engine
        $Template
            ->assign('data', $data)
            ->assign('add_modal_tpl', $Template->fetch($this->module->path . '/view/add.tpl'))
            ->assign('content', $Template->fetch($this->module->path . '/view/index.tpl'));
    }

    public function get(): void
    {
        $_order_column_id = (int)Request::post('order.0.column');

        $example = App\Example::get(Request::post("columns.$_order_column_id.data"), Request::post('order.0.dir'), (int)Request::post('length'), (int)Request::post('start'), Request::post('search.value'));

        $res = [
            'draw' => (int)Request::post('draw'),
            'recordsTotal' => App\Example::total(),
            'recordsFiltered' => App\Example::total(Request::post('search.value')),
            'search_value' => Request::post('search.value'),
            'data' => $example,
        ];

        Json::output($res, true);
    }

}