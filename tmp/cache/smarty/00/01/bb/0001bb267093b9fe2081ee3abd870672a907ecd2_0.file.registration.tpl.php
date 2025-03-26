<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 08:28:32
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/view/registration.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668e1c002b7c59_80939692',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0001bb267093b9fe2081ee3abd870672a907ecd2' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/login/view/registration.tpl',
      1 => 1694495424,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668e1c002b7c59_80939692 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container py-7">
    <div class="row justify-content-center auth-page">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-center"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_title');?>
</h5>
                </div>
                <div class="card-body">
                    <form id="registrationForm" class="text-start" role="form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
login/register">
                        <input type="hidden" class="captcha-response" name="captcha_response">
                        
                        <div class="mb-3">
                            <label class="form-label" for="registration_email"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_email');?>
 <span class="text-danger">*</span></label>
                            <input id="registration_email" type="email" autocomplete="email" name="email" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_email');?>
" required>
                            <p class="form-text"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_email_tip');?>
</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="registration_phone"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_phone');?>
 <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-3">
                                    <input id="registration_code_number" value="+7" type="tel" name="code_number" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_phone');?>
" readonly>
                                    <input id="registration_code" name="code" value="RU" type="hidden" required>
                                    
                                </div>
                                <div class="col">
                                    <input id="registration_phone" name="phone" value="" type="tel" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_phone');?>
" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="registration_password"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_pass');?>
 <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input id="registration_password" type="password" autocomplete="new-password" name="password" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_pass_short');?>
" required>
                                <button class="btn btn-outline-primary btn-icon showPass" tabindex="-1" type="button"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="registration_password_confirm"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_pass_confirm');?>
 <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input id="registration_password_confirm" type="password" autocomplete="new-password" name="password_confirm" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'registration_form_pass_confirm');?>
" required>
                                <button class="btn btn-outline-primary btn-icon showPass" tabindex="-1" type="button"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        
                        
                        <p class="small text-muted mb-3">Регистрируясь, вы подтверждаете, что принимаете <a href="/agreement" target="_blank">Условиями использования</a> и даете
                            <a href="/privacy-policy" target="_blank">Согласие</a> на обработку персональных данных.</p>
                        <button type="submit" class="btn w-100 btn-primary btn-icon-text"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_register');?>
</button>
                        <p class="mt-4 text-center"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_registered_text');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
login"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'login_registered_link');?>
</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><?php }
}
