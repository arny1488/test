<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:19:28
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/cropper.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab4510d3aa96_29147882',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13fce29906a05f5b88008fb4a07574830653b8bc' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/cropper.tpl',
      1 => 1694623920,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab4510d3aa96_29147882 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Modal -->
<div class="modal fade" id="cropperModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <style>
                        .cropper-view-box {
                            border-radius: 50%;
                        }
                    </style>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
assets/images/placeholder.jpg" class="w-100" style="max-height: 70vh" id="croppingImage" alt="cropper">
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_cancel');?>
</button>
                <button type="button" id="applyCroppedImage" class="btn btn-primary rounded-pill"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_apply');?>
</button>
            </div>
        </div>
    </div>
</div><?php }
}
