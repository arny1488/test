<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 02:03:05
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/categories.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dc1a9c427a6_84656636',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30c8e1b9261d0312ff07532b0ad9074fe964cdd1' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/categories.tpl',
      1 => 1704728746,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dc1a9c427a6_84656636 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid mb-4">
    <h2><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'catalog_categories_page_header');?>
</h2>
</div>
<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div id="categoriesList" class="row g-3 pb-3">
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
<?php }
}
