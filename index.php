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

define('START_CP', microtime());
define('START_MEMORY', memory_get_usage());

// System initialisation
require_once __DIR__ . '/system/init.php';

// All dashboard pages should not be cached
if (!defined('NO_CACHE')) {
    define("NO_CACHE", true);
}

// Load user settings if authorized
if (defined('USERID')) {
    Settings::loadUserSettings(USERID);
}

// Run hook after system initialised
Hooks::action('system_after_init');

// API call handler
if (str_starts_with(Request::getPath(), ABS_PATH . API_URI_PREFIX . '/')) {
    ApiRouter::init('API', DASHBOARD_DIR . API_DIR . '/API.php', str_replace(ABS_PATH . API_URI_PREFIX . '/', '', Request::getPath()));
    ApiRouter::execute();
    ApiRouter::response(500);
}

// Template engine instance
$Template = Template::getInstance();

// Execute router
Router::execute(Request::getPath());

// Display «No permission» page if user has no permission to access requested URL
if (defined('NO_PERMISSION')) {
    Request::redirect('/errors/denied');
}

// Run hook before render
Hooks::action('system_pre_render');

// Define default template directory if not set
if (!defined('TEMPLATE')) {
    define('TEMPLATE', 'default');
}

// Set template directory
$Template->__set('template_dir', DASHBOARD_DIR . '/app/templates/' . TEMPLATE . '/');

// Set base template file
$base_template = defined('CONTENT_ONLY') ? 'content_only.tpl' : 'index.tpl';

// Push all data to template engine
$Template

    ->assign('dependencies', Dependencies::get())
    ->assign('injections', Injections::get())

    ->assign('accept_lang', Session::getvar('accept_langs'))
    ->assign('current_language', Session::getvar('current_language'))
    ->assign('sidebar_rubrics', Navigation::RUBRICS)
    ->assign('sidebar_menu_items', Navigation::get(Navigation::SIDEBAR))
    ->assign('top_menu_items', Navigation::get(Navigation::TOP))
    ->assign('user_menu_items', Navigation::get(Navigation::USER))

    ->assign('styles_tpl', $Template->fetch('styles.tpl'))
    ->assign('main_menu_tpl', $Template->fetch('main_menu.tpl'))
    ->assign('sidebar_tpl', $Template->fetch('sidebar.tpl'))
    ->assign('user_tpl', $Template->fetch('user.tpl'))
    ->assign('header_tpl', $Template->fetch('header.tpl'))
    ->assign('header_addons_tpl', $Template->fetch('header_addons.tpl'))
    ->assign('breadcrumbs_tpl', $Template->fetch('breadcrumbs.tpl'))
    ->assign('footer_tpl', $Template->fetch('footer.tpl'))
    ->assign('scripts_tpl', $Template->fetch('scripts.tpl'));

// Render
$render = $Template->fetch($base_template);

// Run hook after render
Hooks::action('system_post_render');

// Display result
Html::output($render);