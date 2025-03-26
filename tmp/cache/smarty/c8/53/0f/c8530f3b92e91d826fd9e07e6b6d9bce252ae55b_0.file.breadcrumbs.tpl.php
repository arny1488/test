<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 01:33:25
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/breadcrumbs.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dbab56036a0_60747570',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8530f3b92e91d826fd9e07e6b6d9bce252ae55b' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/breadcrumbs.tpl',
      1 => 1694355096,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dbab56036a0_60747570 (Smarty_Internal_Template $_smarty_tpl) {
if (is_array($_smarty_tpl->tpl_vars['data']->value['breadcrumbs']) && count($_smarty_tpl->tpl_vars['data']->value['breadcrumbs']) > 1) {?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dot">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['breadcrumbs'], 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['href']) {?>
                    <li class="breadcrumb-item"><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>
</a></li>
                <?php } else { ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>
</li>
                <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

        </ol>
    </nav>
<?php }
}
}
