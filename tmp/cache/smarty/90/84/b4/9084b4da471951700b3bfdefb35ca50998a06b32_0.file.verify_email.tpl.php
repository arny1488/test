<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-25 19:14:35
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/email/verify_email.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66a279eb652eb5_12185043',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9084b4da471951700b3bfdefb35ca50998a06b32' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/email/verify_email.tpl',
      1 => 1641286576,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a279eb652eb5_12185043 (Smarty_Internal_Template $_smarty_tpl) {
?>
<p>Вы успешно зарегистрировались на TM4RENT.COM</p>
<p>Для подтверждения Вашего email адреса перейдите по ссылке:</p>
<a href="https://tm4rent.com/profile/verify_email/<?php echo $_smarty_tpl->tpl_vars['verify_link_email']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['verify_link_hash']->value;?>
">ПОДТВЕРДИТЬ</a><?php }
}
