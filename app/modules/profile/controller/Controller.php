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
 * @version    3.0
 * @link       https://dashboard.rgbvision.net
 * @since      File available since Release 1.0
 */

class ProfileController extends Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        // Parent
        parent::__construct();

        // Check if user has permission
        if (!Permissions::has('profile_view')) {
            Router::response(false, '', ABS_PATH);
        }
    }

    /**
     * Profile page
     */
    public function index(): void
    {

        // Add JS dependencies
        $files = [
            ABS_PATH . 'assets/vendors/libphonenumber/libphonenumber-max.js',
            ABS_PATH . 'assets/vendors/jquery.serializejson/jquery.serializejson.min.js',
            ABS_PATH . 'assets/vendors/jquery-json-form-binding/jquery-json-form-binding.js',
            ABS_PATH . 'assets/vendors/cropperjs/cropper.min.css',
            ABS_PATH . 'assets/vendors/cropperjs/cropper.min.js',
            ABS_PATH . 'assets/vendors/sortablejs/Sortable.min.js',
            $this->module->uri . 'js/profile.js',
        ];

        foreach ($files as $i => $file) {
            Dependencies::add(
                $file,
                $i + 100
            );
        }

        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'profile',

            // Page Title
            'page_title' => $Template->_get('profile_page_title'),

            // Page Header
            'header' => $Template->_get('profile_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => '/',
                    'page' => 'dashboard',
                    'push' => 'true',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('profile_breadcrumb'),
                    'href' => '',
                    'page' => '',
                    'push' => '',
                    'active' => true,
                ],
            ],
        ];

        // Get user data
        if ($_user = TM4RENT\User::get(USERID)) {
            $user = $_user->toArray();
        } else {
            $user = User::get(USERID);
        }

        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        // Push data to template engine
        $Template
            ->assign('data', $data)
            ->assign('countries', Valid::getAllCountries())
            ->assign('user', $user)
            ->assign('cropper_tpl', $Template->fetch($this->module->path . '/view/cropper.tpl'))
            ->assign('add_org1_tpl', $Template->fetch($this->module->path . '/view/add_org_type_1.tpl'))
            ->assign('add_org2_tpl', $Template->fetch($this->module->path . '/view/add_org_type_2.tpl'))
            ->assign('add_org3_tpl', $Template->fetch($this->module->path . '/view/add_org_type_3.tpl'))
            ->assign('add_org4_tpl', $Template->fetch($this->module->path . '/view/add_org_type_4.tpl'))
            ->assign('pdf_tpl', $Template->fetch($this->module->path . '/view/pdf.tpl'))
            ->assign('content', $Template->fetch($this->module->path . '/view/index.tpl'));
    }

    public function favorites(): void
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'favorites',

            // Page Title
            'page_title' => $Template->_get('favorites_page_title'),

            // Page Header
            'header' => $Template->_get('favorites_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'home',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('profile_menu_name'),
                    'href' => ABS_PATH . 'profile',
                    'page' => 'profile',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('favorites_breadcrumb'),
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
            ->assign('content', $Template->fetch($this->module->path . '/view/favorites.tpl'));
    }

    /**
     * Set user settings
     *
     * @param string $key
     * @param string $val
     */
    public function settings_set(string $key, string $val): void
    {
        if (
            ($_key = Secure::sanitize($key)) &&
            ($_val = Secure::sanitize($val))
        ) {
            if (defined('USERID')) {
                Settings::set('user_settings', $_key, $_val);
                Settings::saveUserSettings(USERID);
            } else {
                if (in_array($_key, ['user_lang', 'current_language'])) {
                    Session::setvar('current_language', $_val);
                }
            }
        }

        Request::redirect(Request::referrer());
    }
}