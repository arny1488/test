<?php /* Smarty version 3.1.32-dev-25, created on 2024-07-10 01:33:25
         compiled from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/roles/i18n/ru.ini" */ ?>
<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 01:33:25
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/roles/i18n/ru.ini" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dbab558ae27_38763676',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '838a143ebfd686accbc31ea39d339cf11dd2965a' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/roles/i18n/ru.ini',
      1 => 1668959622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dbab558ae27_38763676 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigVars($_smarty_tpl, array (
  'sections' => 
  array (
    'module' => 
    array (
      'vars' => 
      array (
        'roles_menu_name' => 'Роли',
      ),
    ),
    'permissions' => 
    array (
      'vars' => 
      array (
        'perm_header_roles' => 'Роли пользователей',
        'perm_roles_view' => 'Доступ к просмотру списка ролей пользователей',
        'perm_roles_edit' => 'Доступ для Редактирование/Добавление ролей пользователей',
        'perm_roles_delete' => 'Доступ для Удаления ролей пользователей',
      ),
    ),
    'meta' => 
    array (
      'vars' => 
      array (
        'roles_page_title' => 'Роли пользователей',
        'roles_page_header' => 'Роли пользователей',
        'roles_breadcrumb' => 'Роли пользователей',
        'roles_page_edit_title' => 'Редактирование роли пользователей',
        'roles_page_edit_header' => 'Редактирование роли пользователей',
        'roles_breadcrumb_edit' => 'Редактирование роли',
        'roles_page_add_title' => 'Добавление группы пользователей',
        'roles_page_add_header' => 'Добавление группы пользователей',
        'roles_breadcrumb_add' => 'Добавление роли',
      ),
    ),
    'content' => 
    array (
      'vars' => 
      array (
        'roles_help_header' => 'Управление ролями пользователей',
        'roles_help_descr' => 'В данном разделе приведен список всех ролей пользователей в системе. Для каждой роли Вы можете назначить персональные права, которые разрешат или ограничат действия пользователей как в Панели управления, так и в Публичной части сайта.',
        'roles_help_warning_header' => 'Внимание!',
        'roles_help_warning_descr' => 'Будьте предельно внимательны, при назначении тех или иных прав для данной группы пользователей. Помните, что разрешая доступ к некоторым разделам, Вы можете сделать систему уязвимой.',
        'roles_help_danger_header' => 'Ошибка!',
        'roles_help_danger_descr' => 'Извините, но запрашиваемой Вами группы пользователей не существует.',
        'roles_add_button' => 'Добавить группу',
        'roles_table_name' => 'Наименование',
        'roles_table_users' => 'Пользователей',
        'roles_input_name' => 'Наименование роли',
        'roles_message_edit_success' => 'Права для группы пользователей успешно сохранены',
        'roles_message_edit_error' => 'Не удалось сохранить права для группы.<br />Попробуйте еще раз.',
        'roles_message_del_success' => 'Группа пользователей была успешно удалена.',
        'roles_message_del_id_error' => 'Невозможно удалить группу без идентификатора группы',
        'roles_message_del_perm_error' => 'У вас недостаточно прав для удаления данной группы пользователей, либо группа содержит пользователей.',
      ),
    ),
  ),
  'vars' => 
  array (
  ),
));
}
}
