<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 08:27:59
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668e1bdfe102a6_69920703',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f655205cb3330558a730154040bbae84bfdfbc27' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/index.tpl',
      1 => 1704735854,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668e1bdfe102a6_69920703 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid mb-4">
    <h2 class="mb-3"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'catalog_offers_page_header');?>
</h2>
    <div id="offersList" class="row g-3 mb-1 flex-nowrap overflow-hidden">
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
    <div class="row align-items-center mt-2 g-0">
        <div class="col"><hr class="border-secondary"></div>
        <div class="col-auto">
            <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/offers" class="btn btn-sm btn-outline-secondary border-secondary border-opacity-25 rounded-pill px-5 px-lg-7">Показать еще <i class="mdi mdi-chevron-down"></i></a>
        </div>
        <div class="col"><hr class="border-secondary"></div>
    </div>
</div>
<div class="container-fluid mb-4">
    <h2 class="mb-3"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'catalog_categories_page_header');?>
</h2>
    <div id="categoriesList" class="row g-3 mb-1 flex-nowrap overflow-hidden">
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
    <div class="row align-items-center mt-2 g-0">
        <div class="col"><hr class="border-secondary"></div>
        <div class="col-auto">
            <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/categories" class="btn btn-sm btn-outline-secondary border-secondary border-opacity-25 rounded-pill px-5 px-lg-7">Показать еще <i class="mdi mdi-chevron-down"></i></a>
        </div>
        <div class="col"><hr class="border-secondary"></div>
    </div>
</div>
<div class="container-fluid mb-4">
    <h2 class="mb-3"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'catalog_brands_page_header');?>
</h2>
    <div id="brandsList" class="row g-3 mb-1 flex-nowrap overflow-hidden">
        <?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? 12+1 - (1) : 1-(12)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                <div class="shimmer ratio ratio-1x1 rounded-circle mb-2" role="button"></div>
                <div class="shimmer hg-4 rounded-2 w-75 mx-auto"></div>
            </div>
        <?php }
}
?>

    </div>
    <div class="row align-items-center mt-2 g-0">
        <div class="col"><hr class="border-secondary"></div>
        <div class="col-auto">
            <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/brands" class="btn btn-sm btn-outline-secondary border-secondary border-opacity-25 rounded-pill px-5 px-lg-7">Показать еще <i class="mdi mdi-chevron-down"></i></a>
        </div>
        <div class="col"><hr class="border-secondary"></div>
    </div>
</div>



<template id="offerTemplateGrid">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <a class="card hover text-decoration-none item-card" role="button" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/offer/:id" data-offer-id=":id" data-favorite=":favorite">
            <div class="position-relative">
                <img src=":image" data-hover-slides=":slides" class="card-img-top" alt=":name">
                <button type="button" class="favorite" data-action="favorite"><i class="bi"></i></button>
            </div>
            <div class="card-body">
                <h6 class="hg-4">:name</h6>
            </div>
        </a>
    </div>
</template>

<template id="categoryTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <a class="card hover text-decoration-none" role="button" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/offers?filters[categories][]=:id" data-category-id=":id">
            <img src=":image" class="card-img-top img-fluid w-100" alt=":name">
            <div class="card-body">
                <h6 class="text-center hg-4 overflow-hidden">:name</h6>
            </div>
        </a>
    </div>
</template>

<template id="brandTemplate">
    <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
        <div class="ratio ratio-1x1 rounded-circle mb-2">
            <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/brand/:id" class="rounded-circle img-hover">
                <img src=":logotype" class="img-fluid rounded-circle bg-secondary bg-opacity-25" alt=":name">
            </a>
        </div>
        <h6 class="text-center">:name</h6>
    </div>
</template>
<?php }
}
