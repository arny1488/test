<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 12:00:22
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/player.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab4ea65f78f5_96320421',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd38843a34bb9805dd41ed07d0dfd32a710f9551d' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/player.tpl',
      1 => 1698435870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab4ea65f78f5_96320421 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal fade" id="playerModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0">
                <div class="row g-0 align-items-center">
                    <div class="col-12">
                        <div class="playerContent">
                            <div class="text-center preloader">
                                <div class="spinner-border text-white" role="status"><span class="visually-hidden">Loading...</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-icon btn-lg btn-primary rounded-circle playerClose position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" style="z-index: 1100"><i class="mdi mdi-close vertical-center"></i></button>
</div><?php }
}
