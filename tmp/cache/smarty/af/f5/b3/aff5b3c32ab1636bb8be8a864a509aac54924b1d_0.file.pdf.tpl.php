<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:18:57
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/content/view/pdf.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab44f15e9490_93280222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aff5b3c32ab1636bb8be8a864a509aac54924b1d' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/content/view/pdf.tpl',
      1 => 1695103612,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab44f15e9490_93280222 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Modal -->
<div class="modal fade" id="docModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Документ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <embed id="pdfData" src="" width="100%" height="100%" style="min-height: 80vh" type="application/pdf"/>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_close');?>
</button>
            </div>
        </div>
    </div>
</div><?php }
}
