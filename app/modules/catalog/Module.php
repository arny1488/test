<?php


class CatalogModule extends Module
{

    /**
     * Module ID
     */
    const ID = 'catalog';

    /**
     * Module version
     */
    const VERSION = '1.0';

    /**
     * Module release date
     */
    const DATE = '29.09.2023';

    /**
     * Module icon
     */
    const ICON = 'mdi mdi-adjust';

    /**
     * Module permissions
     */
    const PERMISSIONS = ['catalog_view', 'catalog_edit'];

    /**
     * Constructor
     */
    public function __construct()
    {
        // Parent
        parent::__construct();

        // Router aliases
        Router::addAlias(ABS_PATH . static::ID . 'offer/(.*)', static::ID, 'offer');
        Router::addAlias(ABS_PATH . static::ID . 'gallery/(.*)', static::ID, 'gallery');
        Router::addAlias(ABS_PATH . static::ID . 'brand/(.*)', static::ID, 'brand');

        // Module permissions
        Permissions::add(static::ID, static::PERMISSIONS, static::ICON, 1050);

        if (Permissions::has('catalog_view')) {
            // Template engine instance
            $Template = Template::getInstance();

            // Load i18n variables
            $Template->_load($this->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'module');

            // Add navigation entry
            Navigation::add(
                10,
                $Template->_get('catalog_menu_name'),
                static::ICON,
                ABS_PATH . static::ID,
                '',
                static::ID,
                Navigation::SIDEBAR,
                Navigation::SIDEBAR_CONTROL,
                '',
                '',
                false
            );
        }
    }

}