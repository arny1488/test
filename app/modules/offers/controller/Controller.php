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

class OffersController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $files = [
            ABS_PATH . 'assets/vendors/jquery.serializejson/jquery.serializejson.min.js',
            ABS_PATH . 'assets/vendors/jquery-json-form-binding/jquery-json-form-binding.js',
            ABS_PATH . 'assets/vendors/bootstrap-slider/bootstrap-slider.css',
            ABS_PATH . 'assets/vendors/bootstrap-slider/bootstrap-slider.min.js',
            $this->module->uri . 'js/offers.js',
        ];

        foreach ($files as $i => $file) {
            Dependencies::add(
                $file,
                $i + 100
            );
        }
    }

    public function profile(): void
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'offers',

            // Page Title
            'page_title' => $Template->_get('offers_page_title'),

            // Page Header
            'header' => $Template->_get('offers_page_header'),

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
                    'text' => $Template->_get('offers_breadcrumb'),
                    'href' => '',
                    'page' => '',
                    'active' => true,
                ],
            ],
        ];

        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        $groups = [
            ['id' => 1, 'name' => 'Юридическое лицо'],
            ['id' => 2, 'name' => 'Индивидуальный предприниматель'],
            ['id' => 3, 'name' => 'Самозанятый гражданин'],
            ['id' => 4, 'name' => 'Физическое лицо'],
        ];

        // Push data to template engine
        $Template
            ->assign('data', $data)
            ->assign('contents', TM4RENT\Contents::get('name', 'ASC', null, null, null, USERID))
            ->assign('notoriety', TM4RENT\Filters::getNotoriety() ?? [])
            ->assign('application', TM4RENT\Filters::getApplication() ?? [])
            ->assign('countries', Countries::getList() ?? [])
            ->assign('regions', Countries::getRegionList() ?? [])
            ->assign('placement', TM4RENT\Filters::getPlacement() ?? [])
            ->assign('groups', $groups)
            ->assign('funds', /*$funds ??*/ [])
            ->assign('modal_tpl', $Template->fetch($this->module->path . '/view/modal.tpl'))
            ->assign('content', $Template->fetch($this->module->path . '/view/index.tpl'));
    }

}