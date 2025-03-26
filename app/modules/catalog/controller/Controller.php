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

class CatalogController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $files = [
            ABS_PATH . 'assets/vendors/jquery.serializejson/jquery.serializejson.min.js',
            ABS_PATH . 'assets/vendors/jquery-json-form-binding/jquery-json-form-binding.js',
            ABS_PATH . 'assets/vendors/hover-slider/hover-slider.min.js',
            ABS_PATH . 'assets/vendors/screenfull/screenfull.min.js',
            ABS_PATH . 'assets/vendors/peaks/peaks.min.js',
            $this->module->uri . 'js/catalog.js',
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
            'page' => 'catalog',

            // Page Title
            'page_title' => $Template->_get('catalog_page_title'),

            // Page Header
            'header' => $Template->_get('catalog_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'dashboard',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_breadcrumb'),
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
            ->assign('content', $Template->fetch($this->module->path . '/view/index.tpl'));
    }

    public function offers()
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'catalog_offers',

            // Page Title
            'page_title' => $Template->_get('catalog_offers_page_title'),

            // Page Header
            'header' => $Template->_get('catalog_offers_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'dashboard',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_breadcrumb'),
                    'href' => ABS_PATH . $this->module::ID,
                    'page' => 'catalog',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_offers_breadcrumb'),
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
            ->assign('_filters', [])
            ->assign('groups', $groups)
            ->assign('filters_categories', TM4RENT\ContentTypes::getRaw())
            ->assign('filters_notoriety', TM4RENT\Filters::getNotoriety())
            ->assign('filters_application', TM4RENT\Filters::getApplication())
            ->assign('filters_placement', TM4RENT\Filters::getPlacement())
            ->assign('filters_countries', Countries::getList())
            ->assign('filters_regions', Countries::getRegionList())
            ->assign('filters_tpl', $Template->fetch($this->module->path . '/view/filters.tpl'))
            ->assign('content', $Template->fetch($this->module->path . '/view/offers.tpl'));
    }

    public function categories()
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'catalog_categories',

            // Page Title
            'page_title' => $Template->_get('catalog_categories_page_title'),

            // Page Header
            'header' => $Template->_get('catalog_categories_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'dashboard',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_breadcrumb'),
                    'href' => ABS_PATH . $this->module::ID,
                    'page' => 'catalog',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_categories_breadcrumb'),
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
            ->assign('content', $Template->fetch($this->module->path . '/view/categories.tpl'));
    }

    public function brands()
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'catalog_brands',

            // Page Title
            'page_title' => $Template->_get('catalog_brands_page_title'),

            // Page Header
            'header' => $Template->_get('catalog_brands_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'dashboard',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_breadcrumb'),
                    'href' => ABS_PATH . $this->module::ID,
                    'page' => 'catalog',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_brands_breadcrumb'),
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
            ->assign('content', $Template->fetch($this->module->path . '/view/brands.tpl'));
    }

    public function holders()
    {
        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'catalog_holders',

            // Page Title
            'page_title' => $Template->_get('catalog_holders_page_title'),

            // Page Header
            'header' => $Template->_get('catalog_holders_page_header'),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'dashboard',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_breadcrumb'),
                    'href' => ABS_PATH . $this->module::ID,
                    'page' => 'catalog',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_holders_breadcrumb'),
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
            ->assign('content', $Template->fetch($this->module->path . '/view/holders.tpl'));
    }

    public function offer(string $id): void
    {
        if (!$offer = TM4RENT\Offer::get($id)) {
            Request::redirect(ABS_PATH . "errors");
        }

        Dependencies::add($this->module->uri . 'js/player.js', 500);

        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'catalog_offer_' . $id,

            // Page Title
            'page_title' => $offer->content->getName(),

            // Page Header
            'header' => $offer->content->getName(),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'dashboard',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_breadcrumb'),
                    'href' => ABS_PATH . $this->module::ID,
                    'page' => 'catalog',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_offers_breadcrumb'),
                    'href' => ABS_PATH . $this->module::ID . '/offers',
                    'page' => 'offers',
                    'active' => false,
                ],
                [
                    'text' => $offer->content->getName(),
                    'href' => '',
                    'page' => 'offer_' . $id,
                    'active' => true,
                ],
            ],
        ];

        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        $groups = [
            1 => 'Юридическое лицо',
            2 => 'Индивидуальный предприниматель',
            3 => 'Самозанятый гражданин',
            4 => 'Физическое лицо',
        ];

        // Push data to template engine
        $Template
            ->assign('data', $data)
            ->assign('groups', $groups)
            ->assign('filters_categories', TM4RENT\ContentTypes::getRaw())
            ->assign('filters_notoriety', TM4RENT\Filters::getNotoriety())
            ->assign('filters_application', TM4RENT\Filters::getApplication())
            ->assign('filters_placement', TM4RENT\Filters::getPlacement())
            ->assign('filters_countries', Countries::getList())
            ->assign('filters_regions', Countries::getRegionList())
            ->assign('offer', $offer->toArray())
            ->assign('brand_offers', TM4RENT\Offers::get('o.created', 'DESC', 6, 0, null, ['brand_id' => $offer->content->brand->getId(), 'exclude_ids' => [$offer->getId()]]))
            ->assign('player_tpl', $Template->fetch($this->module->path . '/view/player.tpl'))
            ->assign('content', $Template->fetch($this->module->path . '/view/offer.tpl'));
    }

    public function gallery(string $id): void
    {
        if (!$offer = TM4RENT\Offer::get($id)) {
            Request::redirect(ABS_PATH . "errors");
        }

        define('CONTENT_ONLY', true);

        // Template engine instance
        $Template = Template::getInstance();

        // Push data to template engine
        $Template
            ->assign('offer', $offer->toArray())
            ->assign('content', $Template->fetch($this->module->path . '/view/gallery.tpl'));
    }

    public function brand(string $id): void
    {
        if (!$brand = TM4RENT\Brand::get($id)) {
            Request::redirect(ABS_PATH . "errors");
        }

        // Template engine instance
        $Template = Template::getInstance();

        // Load i18n variables
        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'meta');

        $data = [

            // Page ID
            'page' => 'catalog_offer_' . $id,

            // Page Title
            'page_title' => $brand->getName(),

            // Page Header
            'header' => $brand->getName(),

            // Breadcrumbs
            'breadcrumbs' => [
                [
                    'text' => $Template->_get('main_page'),
                    'href' => ABS_PATH,
                    'page' => 'dashboard',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_breadcrumb'),
                    'href' => ABS_PATH . $this->module::ID,
                    'page' => 'catalog',
                    'active' => false,
                ],
                [
                    'text' => $Template->_get('catalog_brands_breadcrumb'),
                    'href' => ABS_PATH . $this->module::ID . '/brands',
                    'page' => 'offers',
                    'active' => false,
                ],
                [
                    'text' => $brand->getName(),
                    'href' => '',
                    'page' => 'brand_' . $id,
                    'active' => true,
                ],
            ],
        ];

        $Template->_load($this->module->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'content');

        // Push data to template engine
        $Template
            ->assign('data', $data)
            ->assign('filters_notoriety', TM4RENT\Filters::getNotoriety())
            ->assign('filters_countries', Countries::getList())
            ->assign('brand', $brand->toArray())
            ->assign('brand_offers', TM4RENT\Offers::get('o.created', 'DESC', 6, 0, null, ['brand_id' => $brand->getId()]))
            ->assign('content', $Template->fetch($this->module->path . '/view/brand.tpl'));
    }

}
