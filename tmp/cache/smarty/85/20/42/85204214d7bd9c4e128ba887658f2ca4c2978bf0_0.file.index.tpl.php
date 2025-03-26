<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 02:01:56
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/errors/view/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dc164dba808_56177355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85204214d7bd9c4e128ba887658f2ca4c2978bf0' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/errors/view/index.tpl',
      1 => 1694509926,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dc164dba808_56177355 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="row justify-content-center auth-page">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border-danger">
                <div class="card-header">
                    <h5 class="text-center text-danger"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'error_page_title');?>
: <?php echo $_smarty_tpl->tpl_vars['_header']->value;?>
</h5>
                </div>
                <div class="card-body">
                    <p class="mb-4 text-center" style="text-wrap: balance;"><?php echo $_smarty_tpl->tpl_vars['_message']->value;?>
</p>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
" class="btn w-100 btn-primary btn-icon-text"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'goto_home_page');?>
</a>
                </div>
            </div>
        </div>
    </div>
</div><?php }
}
