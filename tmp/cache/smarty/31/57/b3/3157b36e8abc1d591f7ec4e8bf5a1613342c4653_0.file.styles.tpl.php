<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 01:33:25
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/styles.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dbab55e7f14_49846498',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3157b36e8abc1d591f7ec4e8bf5a1613342c4653' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/styles.tpl',
      1 => 1696016834,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dbab55e7f14_49846498 (Smarty_Internal_Template $_smarty_tpl) {
?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700;900&display=swap" rel="stylesheet">

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dependencies']->value, 'file');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['file']->value) {
?>
    <?php if (pathinfo($_smarty_tpl->tpl_vars['file']->value['file'],@constant('PATHINFO_EXTENSION')) == 'css') {?>
        <link href="<?php echo $_smarty_tpl->tpl_vars['file']->value['file'];?>
?v=<?php echo $_smarty_tpl->tpl_vars['APP_BUILD']->value;?>
" rel="stylesheet" <?php echo $_smarty_tpl->tpl_vars['file']->value['params'];?>
>
    <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


<link rel="stylesheet" id="themeCSS" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
assets/core/core.css?v=<?php echo $_smarty_tpl->tpl_vars['APP_BUILD']->value;?>
">
<?php }
}
