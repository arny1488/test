<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:19:28
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/pdf.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab4510d97803_27059798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0897c35a3c87ffb6a03db57989ecb521fd501854' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/pdf.tpl',
      1 => 1698466414,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab4510d97803_27059798 (Smarty_Internal_Template $_smarty_tpl) {
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
