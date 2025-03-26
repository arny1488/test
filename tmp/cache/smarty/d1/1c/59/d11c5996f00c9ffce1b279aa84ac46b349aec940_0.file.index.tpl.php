<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-10-11 13:04:35
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/dashboard/view/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_6708f833d0d6b2_91892643',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd11c5996f00c9ffce1b279aa84ac46b349aec940' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/dashboard/view/index.tpl',
      1 => 1728640987,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6708f833d0d6b2_91892643 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['user']->value && !$_smarty_tpl->tpl_vars['user']->value->isEmailVerified() && (time() > strtotime($_smarty_tpl->tpl_vars['user']->value->getVerificationCodeExpire()))) {?>
    <div id="verifyEmailAlert" class="alert alert-warning grid-margin">
        <div class="row align-items-center">
            <div class="col-md mb-3 mb-md-0">
                <p class="fw-bolder">Ваш адрес электронной почты не подтвержден.</p>
                <p>Для подтверждения адреса электронной почты пройдите по ссылке из письма, отправленного после регистрации на адрес электронной почты <span class="text-nowrap">«<?php echo $_smarty_tpl->tpl_vars['user']->value->getEmail();?>
».</span></p>
            </div>
            <div class="col-12 col-sm-auto ms-sm-auto">
                <button class="btn btn-inverse-warning w-100 verifyEmail">Отправить письмо еще раз</button>
            </div>
        </div>
    </div>
<?php }?>



<?php if ($_smarty_tpl->tpl_vars['user']->value && (!$_smarty_tpl->tpl_vars['user']->value->getFirstname() || !$_smarty_tpl->tpl_vars['user']->value->getLastname() || !$_smarty_tpl->tpl_vars['user']->value->getPatronymic())) {?>
    <div id="verifyEmailAlert" class="alert alert-warning grid-margin">
        <div class="row align-items-center">
            <div class="col-md mb-3 mb-md-0">
                <p class="fw-bolder">Ваш профиль не заполнен.</p>
                <p>Для верификации профиля необходимо корректно заполнить ФИО.</p>
            </div>
            <div class="col-12 col-sm-auto ms-sm-auto">
                <a class="btn btn-inverse-warning w-100" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile">Перейти в профиль</a>
            </div>
        </div>
    </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['organization']->value && (!$_smarty_tpl->tpl_vars['organization']->value->getCertificate() || !$_smarty_tpl->tpl_vars['organization']->value->getFgisToken() || empty($_smarty_tpl->tpl_vars['organization']->value->getAutoPublishIds()))) {?>
    <div id="verifyEmailAlert" class="alert alert-warning grid-margin">
        <div class="row align-items-center">
            <div class="col-md mb-3 mb-md-0">
                <p class="fw-bolder">Автоматическая публикация данных о поверке не настроена.</p>
                <p>Для автоматической публикации данных о поверке во ФГИС «Аршин» необходимо выбрать сертификат ЭЦП, ввести токен API и указать метрологов, чьи результаты поверок будут публиковаться автоматически.</p>
            </div>
            <div class="col-12 col-sm-auto ms-sm-auto">
                <a class="btn btn-inverse-warning w-100" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
publication">Перейти в настройки</a>
            </div>
        </div>
    </div>
<?php }?>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Доступность сервисов Аршин <span id="fgisStatus"><?php if ($_smarty_tpl->tpl_vars['fgis_available']->value) {?><i class="mdi mdi-check-circle text-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                              data-bs-title="Доступен"></i><?php } else { ?><i class="mdi mdi-close-circle text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                                                                    data-bs-title="Не доступен"></i><?php }?></span></h6>
            </div>
            <div class="card-body pt-0">
                <div id="fgisHeatmap"></div>
            </div>
        </div>
    </div>
</div>

<?php if (@constant('USERID') == '00000000-0000-0000-0000-000000000000') {?>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_title_visits');?>
</h6>
                </div>
                <div class="card-body">
                    <div id="dailyVisitsChart" data-chart='<?php echo $_smarty_tpl->tpl_vars['visits']->value;?>
' data-series="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_title_visits');?>
"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_title_storage');?>
</h6>
                </div>
                <div class="card-body">
                    <div id="storageChart" class="mx-auto position-relative" style="width: 200px; height: 200px;" data-usage="<?php echo $_smarty_tpl->tpl_vars['storage_usage']->value['usage'];?>
"></div>
                    <div class="row mt-4 mb-3">
                        <div class="col-6 d-flex justify-content-end">
                            <div>
                                <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-normal"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_storage_size');?>
 <span class="p-1 ms-1 rounded-circle bg-primary"></span></label>
                                <h5 class="fw-bold mb-0 text-end"><?php echo Number::formatSize($_smarty_tpl->tpl_vars['storage_size']->value);?>
</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="d-flex align-items-center tx-10 text-uppercase fw-normal"><span class="p-1 me-1 rounded-circle bg-danger"></span> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_storage_used');?>
</label>
                                <h5 class="fw-bold mb-0"><?php echo Number::formatSize($_smarty_tpl->tpl_vars['storage_usage']->value['size']);?>
</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_title_storage_details');?>
</h6>
                </div>
                <div class="card-body">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['storage_usage']->value['details'], 'item', false, 'key', 'foo', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['total'];
?>
                        <div class="row py-2 bg-highlight-hover <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] : null)) {?> border-bottom <?php }?>">
                            <div class="col"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, $_smarty_tpl->tpl_vars['key']->value);?>
</div>
                            <div class="col text-end"><?php echo Number::formatSize($_smarty_tpl->tpl_vars['item']->value);?>
</div>
                        </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                </div>
                <div class="card-footer text-center pb-1">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <a id="backupDB"
                               <?php if (Permissions::has('dashboard_backup_db')) {?>href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
dashboard/backup_db"<?php }?>
                               class="btn w-100 btn-outline-success mb-2 <?php if (!Permissions::has('dashboard_backup_db')) {?>disabled<?php }?>"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_make_db_backup');?>
</a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a id="clearCache"
                               <?php if (Permissions::has('dashboard_clear_cache')) {?>href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
dashboard/clear_cache"<?php }?>
                               class="btn w-100 btn-outline-danger mb-2 <?php if (!Permissions::has('dashboard_clear_cache')) {?>disabled<?php }?>"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_clear_cache');?>
</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
dashboard/generate">
                    <div class="card-header">
                        <h6 class="card-title mb-0"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_generate_module');?>
</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-0">
                            <label class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_module_name');?>
</label>
                            <input value="" name="module" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'dashboard_module_name');?>
" required>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_generate');?>
</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }
}
}
