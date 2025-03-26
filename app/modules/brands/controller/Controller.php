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

class BrandsController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $files = [
            ABS_PATH . 'assets/vendors/jquery.serializejson/jquery.serializejson.min.js',
            ABS_PATH . 'assets/vendors/jquery-json-form-binding/jquery-json-form-binding.js',
            ABS_PATH . 'assets/vendors/cropperjs/cropper.min.css',
            ABS_PATH . 'assets/vendors/cropperjs/cropper.min.js',
            ABS_PATH . 'assets/vendors/sortablejs/Sortable.min.js',
            $this->module->uri . 'js/brands.js',
        ];

        foreach ($files as $i => $file) {
            Dependencies::add(
                $file,
                $i + 100
            );
        }
    }

    public function profile()
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'brands',

            // Page Title
            'page_title' => $Template->_get('brands_page_title'),

            // Page Header
            'header' => $Template->_get('brands_page_header'),

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
                    'text' => $Template->_get('brands_breadcrumb'),
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
            ->assign('organizations', defined('USERID') ? TM4RENT\Organizations::get('name', 'ASC', null, null, null, USERID) : null)
            ->assign('countries', Countries::getList())
            ->assign('notoriety', TM4RENT\Filters::getNotoriety())
            ->assign('modal_tpl', $Template->fetch($this->module->path . '/view/modal.tpl'))
            ->assign('cropper_tpl', $Template->fetch($this->module->path . '/view/cropper.tpl'))
            ->assign('pdf_tpl', $Template->fetch($this->module->path . '/view/pdf.tpl'))
            ->assign('content', $Template->fetch($this->module->path . '/view/index.tpl'));
    }

}