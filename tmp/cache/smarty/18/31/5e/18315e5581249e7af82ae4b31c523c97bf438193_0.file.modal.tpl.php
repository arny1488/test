<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:19:12
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/offers/view/modal.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab4500d81b04_82972733',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '18315e5581249e7af82ae4b31c523c97bf438193' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/offers/view/modal.tpl',
      1 => 1697976512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab4500d81b04_82972733 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Modal -->
<div class="modal fade" id="offerModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down">
        <form id="offerForm" data-action="<?php echo $_smarty_tpl->tpl_vars['API_PATH']->value;?>
/profile/offer/:id" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Предложение</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="offer_content"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_content');?>
</label>
                            <div class="input-group">
                                <select id="offer_content" name="content_id" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_content');?>
" required>
                                    <option></option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contents']->value, 'element');
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
                            <label class="form-label" for="offer_description"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_description');?>
</label>
                            <textarea id="offer_description" name="description" class="form-control tinymce-editor" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_description');?>
"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="offer_price"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_price');?>
</label>
                            <input id="offer_price" name="price" value="100" data-default-value="100" type="number" min="100" step="20" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_price');?>
" required>
                            <p class="form-text text-danger"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_price_hint_1');?>
<span id="offer_income" class="px-1 fw-bold">80</span><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_price_hint_2');?>
</p>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input id="offer_termless" name="termless" type="checkbox" class="form-check-input" value="1" data-default-value="1">
                                    <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_termless');?>
</label>
                            </div>
                        </div>
                        <div class="mb-3" id="offer_terms" data-default-visibility="visible">
                            <label class="form-label" for="offer_term"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_term');?>
</label>
                            <div class="row mb-1">
                                <div class="col-6">
                                    <input value="1" data-default-value="1" type="number" min="1" max="120" step="1" name="term_min" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <input value="120" data-default-value="120" type="number" min="1" max="120" step="1" name="term_max" class="form-control" required>
                                </div>
                            </div>
                            <div class="px-2">
                                <input id="offer_term" type="text" required
                                       data-slider-min="1" data-slider-max="120" data-slider-step="1" data-slider-tooltip="hide"
                                       data-slider-value="[1,120]">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input name="fast_deal" type="checkbox" class="form-check-input" value="1" data-default-value="1">
                                    <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_fast_deal');?>
</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input name="exclusive" type="checkbox" class="form-check-input" value="1" data-default-value="1">
                                    <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_exclusive');?>
</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="allowed_for"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_allowed_for');?>
</label>
                            <div class="input-group">
                                <select id="allowed_for" name="allowed_for_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_allowed_for');?>
" data-default-value="[1,2,3,4]" required>
                                    <option value="*">Все</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['element']->value['name'];?>
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
                            <label class="form-label" for="offer_application"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_application');?>
</label>
                            <div class="input-group">
                                <select id="offer_application" name="application_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_application');?>
" required>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['application']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
                                        <?php if (!$_smarty_tpl->tpl_vars['group']->value['parent_id']) {?>
                                            <optgroup label="<?php echo $_smarty_tpl->tpl_vars['group']->value['data'][Session::getvar('current_language')];?>
">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['application']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                                    <?php if ($_smarty_tpl->tpl_vars['group']->value['id'] == $_smarty_tpl->tpl_vars['element']->value['parent_id']) {?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['element']->value['data'][Session::getvar('current_language')];?>
</option>
                                                    <?php }?>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                            </optgroup>
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
                            <label class="form-label" for="offer_country"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_country');?>
</label>
                            <div class="input-group">
                                <select id="offer_country" name="country_id" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_country');?>
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
                            <label class="form-label" for="offer_region"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_region');?>
</label>
                            <div class="input-group">
                                <select id="offer_region" name="region_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-default-value="0" required>
                                    <option value="0" selected><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_region_any');?>
</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['regions']->value, 'country', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['country']->value) {
?>
                                        <optgroup label="" class="d-none">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['country']->value, 'region');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['region']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['region']->value['id'];?>
" data-country-id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['key']->value != $_smarty_tpl->tpl_vars['offer']->value['country_id']) {?> class="d-none" <?php }?>><?php echo $_smarty_tpl->tpl_vars['region']->value['data'][Session::getvar('current_language')];?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                        </optgroup>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="offer_placement"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_placement');?>
</label>
                            <div class="input-group">
                                <select id="offer_placement" name="placement_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_placement');?>
" required>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['placement']->value, 'element');
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
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input id="offer_charity" name="charity" type="checkbox" class="form-check-input" value="1" data-default-value="1">
                                    <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_charity');?>
</label>
                            </div>
                        </div>
                        <div id="offer_charity_wrapper" style="display: none" data-default-visibility="hidden">
                            <div class="mb-3">
                                <label class="form-label" for="offer_fund"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_fund');?>
</label>
                                <div class="input-group">
                                    <select id="offer_fund" name="fund_id" class="form-select select2 w-100" data-width="100%" data-placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_fund');?>
">
                                        <option></option>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['funds']->value, 'element');
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
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_charity_percent"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_charity_percent');?>
</label>
                                        <input id="offer_charity_percent" value="0" data-default-value="0" type="number" min="0" max="100" name="charity_percent" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_charity_percent');?>
">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_charity_sum"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_charity_sum');?>
</label>
                                        <input id="offer_charity_sum" value="0" data-default-value="0" type="number" min="0" step="1" name="charity_sum" class="form-control" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'offer_form_charity_sum');?>
">
                                    </div>
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
