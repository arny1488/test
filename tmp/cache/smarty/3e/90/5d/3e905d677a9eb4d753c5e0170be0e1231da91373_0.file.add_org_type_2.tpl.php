<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:19:28
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/add_org_type_2.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab4510d678b2_31588152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e905d677a9eb4d753c5e0170be0e1231da91373' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/add_org_type_2.tpl',
      1 => 1697957746,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab4510d678b2_31588152 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Modal -->
<div class="modal fade" id="addOrgType2Modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-lg-down">
        <form id="addOrgType2Form" data-action="<?php echo $_smarty_tpl->tpl_vars['API_PATH']->value;?>
/profile/organization/:id" class="modal-content orgForm">
            <input type="hidden" name="type" value="2" data-default-value="2">
            <div class="modal-header">
                <h5 class="modal-title">Индивидуальный предприниматель</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inn2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_inn');?>
</label>
                                    <input id="inn2" name="inn" value="" type="number" class="form-control no-arrows" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_inn');?>
">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="ogrnip2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_ogrnip');?>
</label>
                                    <input id="ogrnip2" name="details[ogrnip]" value="" type="number" class="form-control no-arrows" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_ogrnip');?>
">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lastname2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_lastname');?>
</label>
                                    <input id="lastname2" name="details[lastname]" value="" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_lastname');?>
" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_firstname');?>
</label>
                                    <input id="firstname2" name="details[firstname]" value="" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_firstname');?>
" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="patronymic2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_patronymic');?>
</label>
                                    <input id="patronymic2" name="details[patronymic]" value="" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_patronymic');?>
">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="birthdate2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_birthdate');?>
</label>
                                    <input id="birthdate2" name="details[birthdate]" value="" type="text" class="form-control datepicker" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_birthdate');?>
">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="address2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_address');?>
</label>
                                    <input id="address2" type="text" name="details[legal_address]" class="form-control typeahead address" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_address');?>
" required>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <label class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_passport_header');?>
</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="passport_id2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_passport_id');?>
</label>
                                    <input id="passport_id2" name="details[passport][id]" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['data']['passport']['id'];?>
" type="number" class="form-control no-arrows" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_passport_id');?>
">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="passport_date2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_passport_date');?>
</label>
                                    <input id="passport_date2" name="details[passport][date]" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['data']['passport']['date'];?>
" type="text" class="form-control datepicker" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_passport_date');?>
">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="passport_issuer2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_passport_issuer');?>
</label>
                                    <input id="passport_issuer2" name="details[passport][issuer]" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['data']['passport']['issuer'];?>
" type="text" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_passport_issuer');?>
">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="row">
                            <div class="col-12 mt-4 mt-xl-0 bankWidget">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <label class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_bank_account_header');?>
</label>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed mb-2" data-action="add-bank"><i class="mdi mdi-plus"></i> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_add');?>
</button>
                                    </div>
                                </div>
                                <div class="bankWrapper">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-4 mb-3">
                                <label class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'profile_form_documents');?>
 <i class="text-primary mdi mdi-information-slab-circle-outline" tabindex="0" data-bs-toggle="popover" data-bs-custom-class="custom-popover" data-bs-trigger="focus"
                                                                                        data-bs-html="true" data-bs-title="Обязательные документы:" data-bs-content="<ul class='text-start mb-0'>
                                        <li>Скан паспорта (стр 2-3);</li>
                                        <li>Скан паспорта (регистрация);</li>
                                        <li>Св-во ИНН;</li>
                                        <li>Св-во ОГРНИП;</li>
                                        <li>Выписка из налоговой.</li>
                                    </ul>"></i></label>
                                <div class="position-relative">
                                    <div id="docDZ1" class="dropzone form-control d-flex align-content-start flex-wrap gap-2 p-2 no-message user-select-none sortableJS"></div>
                                    <button type="button" class="docDZbtn btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-danger rounded-pill border-style-dashed d-none" data-action="delete"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_delete');?>
</button>
                <div class="ms-auto">
                    <button type="button" class="btn btn-outline-secondary border-style-dashed rounded-pill" data-bs-dismiss="modal"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_cancel');?>
</button>
                    <button type="submit" class="btn btn-primary rounded-pill"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_save');?>
</button>
                </div>
            </div>
        </form>
    </div>
</div><?php }
}
