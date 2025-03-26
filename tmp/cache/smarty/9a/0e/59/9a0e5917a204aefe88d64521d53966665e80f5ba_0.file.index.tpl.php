<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:19:28
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab4510dc1718_76397925',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a0e5917a204aefe88d64521d53966665e80f5ba' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/index.tpl',
      1 => 1698466440,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab4510dc1718_76397925 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid">
    <div class="row g-xxl-5">
        <div class="col-12 col-xxl-6 mb-5">
            <h3 class="mb-3">Аккаунт</h3>
            <form class="row justify-content-center" id="profileForm" action="<?php echo $_smarty_tpl->tpl_vars['API_PATH']->value;?>
/profile">
                <input type="hidden" name="id" value="<?php echo @constant('USERID');?>
">
                <div class="col-md-auto grid-margin stretch-card d-flex flex-column justify-content-center pe-md-5">
                    <div class="text-center" style="min-width: 250px">
                        <a id="profilePhotoBtn" href="#." data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_change');?>
" class="d-inline-block position-relative">
                            <img id="profilePhoto" class="rounded-circle" style="width: 150px" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['user']->value['photo'])===null||$tmp==='' ? "/uploads/avatars/default.jpg" : $tmp);?>
" alt="profile">
                            <i class="mdi mdi-camera-iris mdi-24px position-absolute" style="bottom: -5px; right: 0"></i>
                        </a>
                        <input type="hidden" name="photo" value="">
                        <input type="file" accept="image/*" class="d-none" id="cropperImageUpload">
                    </div>
                    <div class="text-center mt-2"><span class="h4"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['user']->value['firstname'])===null||$tmp==='' ? '' : $tmp);?>
 <?php echo (($tmp = @$_smarty_tpl->tpl_vars['user']->value['lastname'])===null||$tmp==='' ? '' : $tmp);?>
</span></div>
                </div>
                <div class="col-12 col-md">
                    <div class="mb-3">
                        <label class="form-label" for="lastname"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_lastname');?>
</label>
                        <input id="lastname" name="lastname" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['lastname'];?>
" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_lastname');?>
" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="firstname"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_firstname');?>
</label>
                        <input id="firstname" name="firstname" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['firstname'];?>
" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_firstname');?>
" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="patronymic"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_patronymic');?>
</label>
                        <input id="patronymic" name="patronymic" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['patronymic'];?>
" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_patronymic');?>
" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_email');
if ($_smarty_tpl->tpl_vars['user']->value['email_verified']) {?><i class="mdi mdi-check-circle text-success ms-2" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_email_verified');?>
"
                                                                                                                data-bs-title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_email_verified');?>
" data-bs-toggle="tooltip" data-bs-placement="top"></i><?php }?></label>
                        <input id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
" type="email" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_email');?>
">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_phone');
if ($_smarty_tpl->tpl_vars['user']->value['phone_verified']) {?><i class="mdi mdi-check-circle text-success ms-2" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_phone_verified');?>
"
                                                                                                                data-bs-title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_phone_verified');?>
" data-bs-toggle="tooltip" data-bs-placement="top"></i><?php }?></label>
                        <div class="row">
                            <div class="col-3 col-sm-auto">
                                <div style="max-width: 5rem">
                                    <input value="+7" type="tel" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'user_country_code');?>
" readonly data-readonly>
                                    <input id="country_code" name="country_code" value="RU" data-default-value="RU" type="hidden" required>
                                    
                                </div>
                            </div>
                            <div class="col">
                                <input id="phone" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['phone'];?>
" type="tel" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_phone');?>
" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_pass_change');?>
</label>
                        <div class="input-group">
                            <input id="password" name="password" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_pass');?>
">
                            <button type="button" class="btn btn-outline-primary btn-icon genPass" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_generate');?>
" data-bs-title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_generate');?>
" data-bs-toggle="tooltip" data-bs-placement="top"><i class="mdi icon-lg mdi-lock-reset"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary rounded-pill"><i class="mdi mdi-check"></i> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_save');?>
</button>
                </div>
            </form>
        </div>
        <div class="col-12 col-xxl-6 mb-5">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto mb-3">
                    <h3>Мои организации</h3>
                </div>
                <div class="col-auto mb-3">
                    <button type="button" href="#" class="btn btn-outline-primary rounded-pill border-style-dashed" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-plus"></i> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_add');?>
</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item addOrgBtn" href="#" data-type="1">Юридическое лицо</a></li>
                        <li><a class="dropdown-item addOrgBtn" href="#" data-type="2">Индивидуальный предприниматель</a></li>
                        <li><a class="dropdown-item addOrgBtn" href="#" data-type="3">Самозанятый гражданин</a></li>
                        <li><a class="dropdown-item addOrgBtn" href="#" data-type="4">Физическое лицо</a></li>
                    </ul>
                </div>
            </div>
            <div id="orgList" class="row g-3">
                <div class="col-12 text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<template id="orgTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xxl-6">
        <div class="card hover h-100" role="button" data-action="edit" data-href="<?php echo $_smarty_tpl->tpl_vars['API_PATH']->value;?>
/profile/organization/:id" data-type=":type">
            <div class="card-body">
                <h4>:name</h4>
                <p class="small text-muted mb-1">:kind</p>
                <p class="mb-0">ИНН: :inn</p>
            </div>
        </div>
    </div>
</template>

<template id="bankTpl">
    <div class="card mb-3 bankCard">
        <div class="card-body pt-3 pb-1">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6>Банк</h6>
                <button type="button" class="btn btn-link text-danger p-0" data-action="delete-bank"><i class="mdi mdi-trash-can-outline"></i></button>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="bank_:index_account_bik"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_account_bik');?>
</label>
                        <input id="bank_:index_account_bik" name="banks[:index][bik]" value="" type="number" class="form-control typeahead bik no-arrows" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_account_bik');?>
">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="bank_:index_account_id"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_account_id');?>
</label>
                        <input id="bank_:index_account_id" name="banks[:index][account_id]" value="" type="number" class="form-control no-arrows" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_account_id');?>
">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="bank_:index_name"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_name');?>
</label>
                        <input id="bank_:index_name" name="banks[:index][name]" value="" type="text" class="form-control bank" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_name');?>
">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="bank_:index_corr_id"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_corr_id');?>
</label>
                        <input id="bank_:index_corr_id" name="banks[:index][corr_id]" value="" type="number" class="form-control corr no-arrows" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_corr_id');?>
">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input"
                               name="details[default_bank]"
                               value=":index"
                               id="defaultBank:index"
                               required>
                        <label class="form-check-label" for="defaultBank:index">
                            Основной банк
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="docItemTpl">
    <div class="card border-1 border-secondary border-opacity-25 shadow-sm mb-auto" style="position: relative">
        <img class="card-img" src="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
assets/images/thumb_file.jpg" role="button" data-dz-thumbnail/>
        <input type="hidden" name="documents[]" value="">
        <div class="position-absolute" style="width: 150px; height: auto; inset: 0 0 auto;">
            <div class="m-2 px-2 rounded bg-warning shadow-sm dz-error-message">
                <p class="small text-dark" style="width: 100%;" data-dz-errormessage></p>
            </div>
        </div>
        <div class="position-absolute rounded-bottom dz-progress">
            <span class="d-block bg-success" data-dz-uploadprogress></span>
        </div>
        <div class="position-absolute dz-complete-show" style="inset: .25rem .25rem auto auto;">
            <button class="btn btn-icon btn-outline-danger" style="cursor: pointer !important;" type="button">
                <i class="mdi mdi-18px mdi-trash-can-outline" style="cursor: pointer !important;" data-dz-remove></i>
            </button>
        </div>
    </div>
</template>

<?php echo $_smarty_tpl->tpl_vars['cropper_tpl']->value;?>

<?php echo $_smarty_tpl->tpl_vars['add_org1_tpl']->value;?>

<?php echo $_smarty_tpl->tpl_vars['add_org2_tpl']->value;?>

<?php echo $_smarty_tpl->tpl_vars['add_org3_tpl']->value;?>

<?php echo $_smarty_tpl->tpl_vars['add_org4_tpl']->value;?>

<?php echo $_smarty_tpl->tpl_vars['pdf_tpl']->value;
}
}
