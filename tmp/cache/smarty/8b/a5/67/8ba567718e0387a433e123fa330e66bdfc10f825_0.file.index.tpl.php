<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 02:03:29
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/view/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dc1c190ad68_97059740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ba567718e0387a433e123fa330e66bdfc10f825' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/view/index.tpl',
      1 => 1697941292,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dc1c190ad68_97059740 (Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>
        function preventBack() {
            window.history.forward();
        }

        setTimeout("preventBack()", 0);
        window.onunload = function () {
            null;
        };
    <?php echo '</script'; ?>
>

<div class="container py-7">
    <div class="row justify-content-center auth-page">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-center"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_title');?>
</h5>
                </div>
                <form id="loginForm" role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
login/auth">
                    <div class="card-body">
                        <?php if ($_smarty_tpl->tpl_vars['message']->value) {?>
                            <div class="alert alert-success" role="alert"><i class="icon-md lh-1 align-middle mdi mdi-check-circle-outline"></i> <?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
                            <div class="alert alert-danger" role="alert"><i class="icon-md lh-1 align-middle mdi mdi-alert-circle-outline"></i> <?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
                        <?php }?>
                        <div class="mb-3">
                            <label class="form-label" for="login_email"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_email');?>
</label>
                            <input id="login_email" type="email" name="email" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_email');?>
" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="login_password"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_password');?>
</label>
                            <div class="input-group">
                                <input id="login_password" type="password" name="password" class="form-control" autocomplete="current-password" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_password');?>
" required>
                                <button class="btn btn-outline-primary btn-icon showPass" tabindex="-1" type="button"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto mb-3">
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="keep_in" value="1" checked>
                                        <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_remember');?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-auto mb-3">
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" href="#modalReset"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_forgot');?>
</button>
                            </div>
                        </div>
                        <button type="submit" class="btn w-100 btn-primary btn-icon-text"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_button');?>
</button>
                        <p class="mt-4 text-center"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_register_text');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
registration"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_register_link');?>
</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalReset" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="resetForm" role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
login/reset_request">
                <div class="modal-header">
                    <h6 class="modal-title"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_reset');?>
</h6>
                    <button aria-label="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_close');?>
" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label" for="reset_email"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_reset_email');?>
 <span class="text-danger">*</span></label>
                    <input id="reset_email" type="email" name="email" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_email');?>
" required>
                    <p class="form-text"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_reset_message');?>
</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_close');?>
</button>
                    <button class="btn btn-primary" type="submit"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_send');?>
</button>
                </div>
            </form>
        </div>
    </div>
</div><?php }
}
