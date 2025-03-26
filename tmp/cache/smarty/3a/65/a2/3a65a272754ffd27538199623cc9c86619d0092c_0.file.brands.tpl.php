<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 02:03:11
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/brands.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dc1af147837_59880732',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a65a272754ffd27538199623cc9c86619d0092c' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/brands.tpl',
      1 => 1704735854,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dc1af147837_59880732 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 col-md mb-4"><h2><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'catalog_brands_page_header');?>
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
                    <li><button class="dropdown-item">По новинкам</button></li>
                    <li><button class="dropdown-item">По рейтингу</button></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
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
    </div>
</div>

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
