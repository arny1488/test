<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 11:19:12
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/offers/view/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab4500d8e768_81020108',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '853dd6de46f964fdb01fab35a11d13ca90a6d278' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/offers/view/index.tpl',
      1 => 1696045820,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab4500d8e768_81020108 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid">
    <div class="row justify-content-center justify-content-md-between align-items-center">
        <div class="col-12 col-sm-auto mb-3">
            <ul class="nav nav-underline flex-column flex-sm-row">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile/brands"><span class="h3">Бренды</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile/content"><span class="h3">Контент</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile/offers"><span class="h3">Предложения</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile/deals"><span class="h3">Сделки</span></a>
                </li>
            </ul>
        </div>
        <div class="col-auto mb-3">
            <button type="button" data-action="add" class="btn btn-outline-primary rounded-pill border-style-dashed"><i class="mdi mdi-plus"></i> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'button_add');?>
</button>
        </div>
    </div>
    <div id="offersList" class="row g-3">
        <?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? 4+1 - (1) : 1-(4)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                <div class="card bg-transparent" role="button">
                    <div class="shimmer ratio ratio-4x3 card-img-top"></div>
                    <div class="card-body">
                        <div class="shimmer hg-4 rounded-2"></div>
                    </div>
                </div>
            </div>
        <?php }
}
?>

    </div>
</div>

<template id="offerTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <div class="card hover" data-action="edit" role="button" data-href="<?php echo $_smarty_tpl->tpl_vars['API_PATH']->value;?>
/profile/offer/:id">
            <div class="ratio ratio-4x3">
                <img src=":logotype" class="card-img-top" alt=":name">
            </div>
            <div class="card-body">
                <h6>:name</h6>
            </div>
        </div>
    </div>
</template>

<?php echo $_smarty_tpl->tpl_vars['modal_tpl']->value;
}
}
