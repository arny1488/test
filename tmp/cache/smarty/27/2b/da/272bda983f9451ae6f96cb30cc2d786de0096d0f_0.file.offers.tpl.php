<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 02:02:53
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/offers.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dc19d71ee15_37864016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '272bda983f9451ae6f96cb30cc2d786de0096d0f' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/offers.tpl',
      1 => 1704730286,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dc19d71ee15_37864016 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 col-md mb-4"><h2><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'catalog_offers_page_header');?>
</h2></div>
        <div class="col-12 col-md-auto mb-4">
            <button type="button" class="btn btn-flat btn-icon rounded-circle" data-action="view-type" data-view-type="Grid"><i class="mdi mdi-view-grid-outline"></i></button>
            <button type="button" class="btn btn-flat btn-icon rounded-circle" data-action="view-type" data-view-type="List"><i class="mdi mdi-view-agenda-outline"></i></button>
            <div class="ms-3 d-inline-block">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed text-body dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-swap-vertical"></i> сортировка
                </button>
                <ul class="dropdown-menu dropdown-menu-end mn-wd-200 mx-wd-350">
                    <li>
                        <button class="dropdown-item" data-action="order" data-sort="o.created" data-order="DESC">По новинкам</button>
                    </li>
                    <li>
                        <button class="dropdown-item" data-action="order" data-sort="c.name" data-order="ASC">По названию</button>
                    </li>
                    <li>
                        <button class="dropdown-item" data-action="order" data-sort="o.price" data-order="ASC">По возрастанию цены</button>
                    </li>
                    <li>
                        <button class="dropdown-item" data-action="order" data-sort="o.price" data-order="DESC">По убыванию цены</button>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed text-body position-relative" data-bs-toggle="offcanvas" data-bs-target="#navbarFilter" aria-controls="navbarFilter" aria-label="Toggle navigation">
                <i class="mdi mdi-tune-variant"></i> фильтры
                <span id="filtersBadge" class="d-none position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>
            </button>
        </div>
    </div>
</div>

<nav class="navbar bg-body-tertiary fixed-top p-0">
    <div class="container-fluid">
        <?php echo $_smarty_tpl->tpl_vars['filters_tpl']->value;?>

    </div>
</nav>

<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div id="offersList" data-view="switchable" data-start="0" data-limit="24" class="row g-3 pb-3">
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

<template id="offerTemplateList">
    <div class="col-12">
        <a class="card hover text-decoration-none item-card" role="button" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/offer/:id" data-offer-id=":id" data-favorite=":favorite">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 col-xxl-3 mb-3 mb-lg-0">
                        <div class="position-relative">
                            <img src=":image" data-hover-slides=":slides" class="rounded-2" alt=":name">
                            <button type="button" class="favorite" data-action="favorite"><i class="bi"></i></button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xxl-6 mb-3 mb-lg-0">
                        <h4 class="mb-3">:name</h4>
                        <div>:description</div>
                    </div>
                    <div class="col-12 col-lg-4 col-xxl-3">
                        <h4 class="mb-3">:price</h4>
                        <div>:term</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</template>
<?php }
}
