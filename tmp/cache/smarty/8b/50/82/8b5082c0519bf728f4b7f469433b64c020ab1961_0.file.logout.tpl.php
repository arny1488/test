<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 12:08:26
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/view/logout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab508a7e6dc6_45361055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b5082c0519bf728f4b7f469433b64c020ab1961' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/view/logout.tpl',
      1 => 1694354634,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab508a7e6dc6_45361055 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    window.history.forward();
    document.addEventListener("DOMContentLoaded", event => { setTimeout(() => { document.location.href = '<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
after_logout'; }, 2500); });
<?php echo '</script'; ?>
>
<div class="container py-7">
    <div class="row justify-content-center auth-page">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-center"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'logout_title');?>
</h5>
                </div>
                <div class="card-body">
                    <p class="text-center mb-4"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'logout_message');?>
</p>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
after_logout" class="btn w-100 btn-primary btn-icon-text"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_continue');?>
</a>
                </div>
            </div>
        </div>
    </div>
</div><?php }
}
