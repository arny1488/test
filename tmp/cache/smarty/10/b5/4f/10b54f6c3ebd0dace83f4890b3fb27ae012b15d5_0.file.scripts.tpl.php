<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 01:33:25
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/scripts.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dbab56131f2_33690675',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10b54f6c3ebd0dace83f4890b3fb27ae012b15d5' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/scripts.tpl',
      1 => 1694350592,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dbab56131f2_33690675 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    var ABS_PATH = '<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
';
    var API_PATH = '<?php echo $_smarty_tpl->tpl_vars['API_PATH']->value;?>
';
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
assets/i18n/<?php echo Session::getvar('current_language');?>
.js?v=<?php echo $_smarty_tpl->tpl_vars['APP_BUILD']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
assets/core/core.js?v=<?php echo $_smarty_tpl->tpl_vars['APP_BUILD']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
app/js/common.js?v=<?php echo $_smarty_tpl->tpl_vars['APP_BUILD']->value;?>
"><?php echo '</script'; ?>
>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dependencies']->value, 'file');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['file']->value) {
?>
    <?php if (pathinfo($_smarty_tpl->tpl_vars['file']->value['file'],@constant('PATHINFO_EXTENSION')) == 'js') {?>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['file']->value['file'];?>
?v=<?php echo $_smarty_tpl->tpl_vars['APP_BUILD']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['file']->value['params'];?>
 defer><?php echo '</script'; ?>
>
    <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

<?php }
}
