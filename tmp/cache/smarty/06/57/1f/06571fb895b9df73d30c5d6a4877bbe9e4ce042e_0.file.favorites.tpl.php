<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-10-03 14:43:59
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/favorites.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66fe837f85d028_67735261',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06571fb895b9df73d30c5d6a4877bbe9e4ce042e' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/profile/view/favorites.tpl',
      1 => 1696526662,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66fe837f85d028_67735261 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 col-md mb-4"><h2><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'favorites_page_header');?>
</h2></div>
        <div class="col-12 col-md-auto mb-4">
            <button type="button" class="btn btn-flat btn-icon rounded-circle"><i class="mdi mdi-view-grid-outline"></i></button>
            <button type="button" class="btn btn-flat btn-icon rounded-circle"><i class="mdi mdi-view-agenda-outline"></i></button>
            <div class="ms-3 d-inline-block">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed text-body dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-swap-vertical"></i> сортировка
                </button>
                <ul class="dropdown-menu dropdown-menu-end mn-wd-200 mx-wd-350">
                    <li><button class="dropdown-item">По названию</button></li>
                    <li><button class="dropdown-item">По возрастанию цены</button></li>
                    <li><button class="dropdown-item">По убыванию цены</button></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div id="favoritesList" data-start="0" data-limit="24" class="row g-3 pb-3">
            <?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? 6+1 - (1) : 1-(6)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
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
</div>

<template id="offerTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <a class="card hover text-decoration-none item-card" role="button" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/offer/:id" data-offer-id=":id" data-favorite=":favorite">
            <div class="position-relative">
                <div class="ratio ratio-4x3">
                    <img src=":logotype" class="card-img-top" alt=":name">
                </div>
                <button type="button" class="favorite" data-action="favorite"><i class="bi"></i></button>
            </div>
            <div class="card-body">
                <h6>:name</h6>
            </div>
        </a>
    </div>
</template><?php }
}
