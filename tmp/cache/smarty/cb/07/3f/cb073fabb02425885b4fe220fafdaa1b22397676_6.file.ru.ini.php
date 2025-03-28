<?php /* Smarty version 3.1.32-dev-25, created on 2024-07-10 01:33:25
         compiled from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/settings/i18n/ru.ini" */ ?>
<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 01:33:25
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/settings/i18n/ru.ini" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dbab557e1c8_08798080',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb073fabb02425885b4fe220fafdaa1b22397676' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/settings/i18n/ru.ini',
      1 => 1668959622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dbab557e1c8_08798080 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigVars($_smarty_tpl, array (
  'sections' => 
  array (
    'module' => 
    array (
      'vars' => 
      array (
        'settings_menu_name' => 'Система',
      ),
    ),
    'permissions' => 
    array (
      'vars' => 
      array (
        'perm_header_settings' => 'Настройки системы',
        'perm_settings_view' => 'Доступ к просмотру списка доступных настроек',
        'perm_settings_edit' => 'Доступ к редактированию значений настроек',
      ),
    ),
    'meta' => 
    array (
      'vars' => 
      array (
        'settings_page_title' => 'Настройки системы',
        'settings_page_header' => 'Настройки системы',
        'settings_breadcrumb' => 'Настройки системы',
      ),
    ),
    'content' => 
    array (
      'vars' => 
      array (
        'settings_help_header' => 'Внимание!',
        'settings_help_descr' => 'В данном разделе вы можете отредактировать глобальные параметры системы.<br>Пожалуйста, будьте предельно внимательны и помните, что неверные параметры могут сделать систему неработоспособной.',
        'settings_message_edit_success' => 'Сохранение значений успешно выполнено.',
        'settings_message_edit_danger' => 'Не удалось сохранить значения констант.<br />Попробуйте еще раз.',
        'settings_message_perm_danger' => 'У вас недостаточно прав для редактирования значений констант.',
        'settings_title_timezone' => 'Часовой пояс по умолчанию',
        'settings_title_system_environment' => 'Режим работы системы',
        'settings_title_login_user_ip' => 'Использовать IP для автоматического входа',
        'settings_title_pwd_pepper' => '«Перец» для шифрования пароля',
        'settings_title_temp_dir' => 'Директория для временных файлов',
        'settings_title_attach_dir' => 'Директория для хранения вложений',
        'settings_title_upload_dir' => 'Директория для загрузки пользовательских файлов',
        'settings_title_session_dir' => 'Папка для хранения сессий',
        'settings_title_session_save_handler' => 'Обработчик хранения сессии',
        'settings_title_session_lifetime' => 'Время жизни сессии (сек.)',
        'settings_title_cookie_domain' => 'Домен для cookie. По умолчанию пусто',
        'settings_title_cookie_lifetime' => 'Время жизни cookie (сек.)',
        'settings_title_smarty_compile_check' => 'Контролировать изменения tpl файлов<br><small class=\'text-muted\'>После настройки системы установить - false</small>',
        'settings_title_smarty_use_sub_dirs' => 'Создание папок для кэширования<br><small class=\'text-muted\'>Установите это в false если ваше окружение PHP не разрешает создание директорий от имени Smarty</small>',
        'settings_title_cache_doc_tpl' => 'Кэширование скомпилированных шаблонов документов',
        'settings_title_cache_lifetime' => 'Время жизни кеша (сек.)',
        'settings_title_system_cache_lifetime' => 'Время жизни кеша системных запросов (сек.)',
        'settings_title_php_debugging' => 'Включить стандартную обработку ошибок PHP',
        'settings_title_self_error' => 'Включить обработку ошибок PHP через обработчик системы',
        'settings_title_smarty_debugging' => 'Консоль отладки Smarty',
        'settings_title_sql_debugging' => 'Включить вывод статистики запросов',
        'settings_title_sql_errors_stop' => 'Останавливать систему, если произошла ошибка в MySQL запросе',
        'settings_title_send_sql_error' => 'Отправка писем с ошибками MySQL',
        'settings_title_sql_profiling' => 'Вывод статистики выполненных запросов',
        'settings_title_profiling' => 'Вывод статистики',
        'settings_title_html_compression' => 'Включить html компрессию',
        'settings_title_gzip_compression' => 'Включить gzip компрессию',
        'settings_title_output_expire' => 'Отдавать заголовок на кеширование страницы',
        'settings_title_output_expire_offset' => 'Время жизни кеширования страницы (сек.)',
        'settings_title_check_version' => 'Проверка наличия новых версий системы',
      ),
    ),
  ),
  'vars' => 
  array (
  ),
));
}
}
