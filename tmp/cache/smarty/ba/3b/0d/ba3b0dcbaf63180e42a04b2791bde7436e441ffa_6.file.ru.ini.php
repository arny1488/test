<?php /* Smarty version 3.1.32-dev-25, created on 2024-07-10 01:33:25
         compiled from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/i18n/ru.ini" */ ?>
<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 01:33:25
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/i18n/ru.ini" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dbab5571307_49230689',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba3b0dcbaf63180e42a04b2791bde7436e441ffa' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/i18n/ru.ini',
      1 => 1694430526,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dbab5571307_49230689 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigVars($_smarty_tpl, array (
  'sections' => 
  array (
    'module' => 
    array (
      'vars' => 
      array (
        'login_menu_name' => 'Вход в личный кабинет',
      ),
    ),
    'meta' => 
    array (
      'vars' => 
      array (
        'login_page_title' => 'Вход в личный кабинет',
        'login_page_header' => 'Вход в личный кабинет',
      ),
    ),
    'content' => 
    array (
      'vars' => 
      array (
        'login_title' => 'Вход',
        'login_email' => 'E-mail',
        'login_password' => 'Пароль',
        'login_remember' => 'Запомнить меня',
        'login_button' => 'Войти',
        'login_logout' => 'Выход',
        'login_forgot' => 'Забыли пароль?',
        'login_change' => 'Сменить пароль',
        'login_new_password' => 'Новый пароль',
        'login_new_password_confirm' => 'Подтвердите новый пароль',
        'login_reset' => 'Сбросить пароль',
        'login_reset_email' => 'Введите Ваш email адрес.',
        'login_reset_message' => 'На email будет отправлено письмо с инструкцией по сбросу пароля.',
        'login_reset_mail_sent' => 'Письмо с инструкцией по сбросу пароля отправлено.',
        'login_reset_mail_title' => 'Восстановление доступа.',
        'login_reset_mail_body' => '<p>Для Вашего адреса электронной почты осуществлен запрос на восстановление пароля с IP адреса %s</p><p>Для восстановления пароля пройдите по ссылке: <a href=\'%s%slogin/change/%s\'>%s%slogin/change/%s</a></p><p>Ссылка действительна до: %s</p><hr><p>Если Вы не запрашивали восстановление пароля, просто проигнорируйте это письмо.</p>',
        'login_reset_success' => 'Пароль успешно изменен.',
        'login_wrong_email' => 'Неверный email.',
        'login_wrong_pass' => 'Неверный email или пароль.',
        'login_user_inactive' => 'Пользователь заблокирован.',
        'login_blacklisted' => 'Доступ заблокирован. Обратитесь в службу поддержки для восстановления доступа.',
        'login_registered_text' => 'Уже есть аккаунт?',
        'login_registered_link' => 'Войти',
        'login_register_text' => 'Нет аккаунта?',
        'login_register_link' => 'Зарегистрироваться',
        'logout_title' => 'Выход',
        'logout_message' => 'Выход из личного кабинета.<br>Нажмите «Продолжить», если страница не перезагрузилась автоматически.',
        'wrong_email' => 'Неверный email.',
        'wrong_pass' => 'Неверный логин или пароль.',
        'user_inactive' => 'Пользователь заблокирован.',
        'registration_page_title' => 'Регистрация',
        'registration_title' => 'Регистрация',
        'registration_form_firstname' => 'Ваше имя',
        'registration_form_lastname' => 'Ваша фамилия',
        'registration_form_phone' => 'Мобильный телефон',
        'registration_form_email' => 'Ваш Email',
        'registration_form_email_tip' => 'Ваш Email будет использоваться в качестве логина для авторизации в личном кабинете',
        'registration_form_pass' => 'Пароль для входа в личный кабинет',
        'registration_form_pass_short' => 'Пароль',
        'registration_form_pass_confirm' => 'Пароль еще раз',
        'registration_form_inn' => 'ИНН организации',
        'registration_form_agreement' => 'Соглашаюсь с',
        'registration_form_tof' => 'Пользовательским соглашением',
        'registration_form_pp' => 'Политикой конфиденциальности',
        'registration_form_pdp' => 'Поручением на обработку персональных данных',
        'registration_already_registered' => 'У меня уже есть аккаунт',
        'button_register' => 'Зарегистрироваться',
        'button_link_login' => 'В личный кабинет',
        'registration_success_title' => 'Поздравляем!',
        'registration_success_message' => 'Вы успешно зарегистрировались в Метролог24',
        'email_verified_title' => 'Email подтвержден',
        'email_verified_message' => 'Спасибо!<br>Ваш email успешно подтвержден.',
      ),
    ),
    'email' => 
    array (
      'vars' => 
      array (
        'registration_confirm_email_subject' => 'Подтверждение Email',
        'registration_confirm_email_title' => 'Вы успешно зарегистрировались в Метролог24',
        'registration_confirm_email_description' => 'Для подтверждения Вашего email адреса перейдите по ссылке:',
        'registration_confirm_email_button' => 'ПОДТВЕРДИТЬ',
        'login_reset_mail_title' => 'Восстановление доступа.',
        'login_reset_mail_body_1' => 'Для Вашего адреса электронной почты осуществлен запрос на восстановление пароля с IP адреса',
        'login_reset_mail_body_2' => 'Для восстановления пароля пройдите',
        'login_reset_mail_body_3' => 'Ссылка действительна до:',
        'login_reset_mail_body_4' => 'Если Вы не запрашивали восстановление пароля, просто проигнорируйте это письмо.',
        'login_reset_mail_link_text' => 'ПО ССЫЛКЕ',
        'login_reset_mail_link' => '%s%slogin/change/%s',
        'mail_max_attempts_subject' => 'Введен неверный пароль более %s раз',
        'mail_max_attempts_message_1' => 'Кто то пытается войти в Ваш личный кабинет Метролог24 с IP адреса %s, используя Ваш логин, и более %s раз не верно указал пароль.',
        'mail_max_attempts_message_2' => 'Мы заблокировали доступ в Ваш личный кабинет для этого IP адреса на 24 часа. Если это были Вы и необходимо разблокировать доступ, обратитесь в службу поддержки.',
        'mail_max_attempts_message_3' => 'Напоминаем, что для надежной защиты своего аккаунта необходимо установить уникальный сложный пароль.',
      ),
    ),
  ),
  'vars' => 
  array (
  ),
));
}
}
