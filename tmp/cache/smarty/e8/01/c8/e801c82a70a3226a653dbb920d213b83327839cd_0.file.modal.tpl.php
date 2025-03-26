<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:18:57
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/content/view/modal.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab44f15e2087_39924952',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e801c82a70a3226a653dbb920d213b83327839cd' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/content/view/modal.tpl',
      1 => 1696525484,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab44f15e2087_39924952 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down">
        <form id="contentForm" data-action="<?php echo $_smarty_tpl->tpl_vars['API_PATH']->value;?>
/profile/content/:id" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Контент</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="content_name"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'content_form_name');?>
</label>
                            <input id="content_name" value="" type="text" name="name" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'content_form_name');?>
" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="content_type"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'content_form_type');?>
</label>
                            <div class="input-group">
                                <select id="content_type" name="type_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'content_form_type');?>
" required>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['types']->value, 'type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['type']->value) {
?>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value['parent'] == 0) {?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['type']->value['title'];?>
</option>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['types']->value, 'sub_element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sub_element']->value) {
?>
                                                <?php if ($_smarty_tpl->tpl_vars['type']->value['id'] == $_smarty_tpl->tpl_vars['sub_element']->value['parent']) {?>
                                                    <option class="small ps-3" value="<?php echo $_smarty_tpl->tpl_vars['sub_element']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['sub_element']->value['title'];?>
</option>
                                                <?php }?>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                        <?php }?>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="content_brand"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'content_form_brand');?>
</label>
                            <div class="input-group">
                                <select id="content_brand" name="brand_id" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'content_form_brand');?>
" required>
                                    <option></option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['brands']->value, 'brand');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['brand']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['brand']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['brand']->value['name'];?>
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
                            <label class="form-label" for="content_document"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'content_form_document');?>
</label>
                            <div class="position-relative">
                                <div id="docDZ" class="dropzone form-control d-flex align-content-start flex-wrap gap-2 p-2 no-message user-select-none sortableJS"></div>
                                <button id="docBtn" type="button" class="btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="d-flex h-100 flex-column mb-3 pb-3">
                            <div class="flex-grow-0">
                                <label class="form-label mb-1"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'content_form_files');?>
</label>
                            </div>
                            <div class="flex-grow-1 position-relative">
                                <div id="medaDZ" class="dropzone form-control h-100 d-flex align-content-start flex-wrap gap-2 p-2 no-message user-select-none sortableJS"></div>
                                <button id="mediaBtn" type="button" class="btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
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
