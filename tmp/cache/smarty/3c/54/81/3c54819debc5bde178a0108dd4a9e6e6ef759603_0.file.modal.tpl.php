<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:18:38
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/brands/view/modal.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab44de7022a4_25321165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c54819debc5bde178a0108dd4a9e6e6ef759603' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/brands/view/modal.tpl',
      1 => 1698380140,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab44de7022a4_25321165 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Modal -->
<div class="modal fade" id="brandModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down">
        <form id="brandForm" data-action="<?php echo $_smarty_tpl->tpl_vars['API_PATH']->value;?>
/profile/brand/:id" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Бренд</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div id="logoWrap" draggable="true" class="mb-3">
                            <label class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_files');?>
</label>
                            <div class="position-relative">
                                <img id="brandImage" src="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
assets/images/noimage_1x1.png" data-src="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
assets/images/noimage_1x1.png" class="img-fluid rounded-1" alt=""/>
                                <input type="hidden" name="logotype" value="">
                                <input type="file" accept="image/*" class="d-none" id="cropperImageUpload">
                                <button id="brandImageBtn" type="button" class="btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="brand_organization"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_organization');?>
 <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select id="brand_organization" name="organization_id" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_organization');?>
" required>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['organizations']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['element']->value['name'];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_name"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_name');?>
 <span class="text-danger">*</span></label>
                            <input id="brand_name" value="" type="text" name="name" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_name');?>
" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_country"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_country');?>
 <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select id="brand_country" name="country_id" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_country');?>
" required>
                                    <option></option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countries']->value, 'country');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['country']->value['data'][Session::getvar('current_language')];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_notoriety"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_notoriety');?>
 <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select id="brand_notoriety" name="notoriety_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_notoriety');?>
" required>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notoriety']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['element']->value['data'][Session::getvar('current_language')];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_description"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_description');?>
 <span class="text-danger">*</span></label>
                            <textarea id="brand_description" name="description" class="form-control tinymce-editor" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_description');?>
" required><?php echo $_smarty_tpl->tpl_vars['brand']->value['description'];?>
</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_document"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'brand_form_document');?>
</label>
                            <div class="position-relative">
                                <div id="docDZ" class="dropzone form-control d-flex align-content-start flex-wrap gap-2 p-2 no-message user-select-none sortableJS"></div>
                                <button id="docBtn" type="button" class="btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
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
