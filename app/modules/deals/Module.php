<?php


class DealsModule extends Module
{

    /**
     * Module ID
     */
    const ID = 'deals';

    /**
     * Module version
     */
    const VERSION = '1.0';

    /**
     * Module release date
     */
    const DATE = '12.09.2023';

    /**
     * Module icon
     */
    const ICON = 'mdi mdi-adjust';

    /**
     * Module permissions
     */
    const PERMISSIONS = ['deals_view', 'deals_edit'];

    /**
     * Constructor
     */
    public function __construct()
    {
        // Parent
        parent::__construct();

        // Module permissions
        Permissions::add(static::ID, static::PERMISSIONS, static::ICON, 1050);

        // Router aliases
        Router::addAlias(ABS_PATH . 'profile/deals', static::ID, 'profile');

        if (Permissions::has('deals_view')) {
            // Template engine instance
            $Template = Template::getInstance();

            // Load i18n variables
            $Template->_load($this->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'module');

            // Add navigation entry
            Navigation::add(
                10,
                $Template->_get('deals_menu_name'),
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