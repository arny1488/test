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

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $files = [
            ABS_PATH . 'assets/vendors/hover-slider/hover-slider.min.js',
            $this->module->uri . 'js/home.js',
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
            'page' => 'home',

            // Page Title
            'page_title' => $Template->_get('home_page_title'),

            // Page Header
            'header' => $Template->_get('home_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [],
        ];

        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        // Push data to template engine
        $Template
            ->assign('data', $data)
            ->assign('content', $Template->fetch($this->module->path . '/view/index.tpl'));
    }

}