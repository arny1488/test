<?php


class ExampleModule extends Module
{

    /**
     * Module ID
     */
    const ID = 'example';

    /**
     * Module version
     */
    const VERSION = '1.0';

    /**
     * Module release date
     */
    const DATE = ':date:';

    /**
     * Module icon
     */
    const ICON = 'mdi mdi-adjust';

    /**
     * Module permissions
     */
    const PERMISSIONS = ['example_view', 'example_edit'];

    /**
     * Constructor
     */
    public function __construct()
    {
        // Parent
        parent::__construct();

        // Module permissions
        Permissions::add(static::ID, static::PERMISSIONS, static::ICON, 1050);

        if (Permissions::has('example_view')) {
            // Template engine instance
            $Template = Template::getInstance();

            // Load i18n variables
            $Template->_load($this->path . '/i18n/' . Session::getvar('current_language') . '.ini', 'module');

            // Add navigation entry
            Navigation::add(
                10,
                $Template->_get('example_menu_name'),
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