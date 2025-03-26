<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 02:02:53
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/filters.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dc19d6fd9e0_14421257',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16b36253328c47aad8eb4cb924b55b27643fdf81' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/filters.tpl',
      1 => 1704731664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dc19d6fd9e0_14421257 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form class="offcanvas offcanvas-end wd-100p-f wd-md-500-f" tabindex="-1" id="navbarFilter" aria-labelledby="navbarFilterLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="navbarFilterLabel">Фильтры</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body position-relative p-0 overflow-y-hidden">
        <div class="h-100 position-relative PerfectScrollbar">
            <div class="m-3">
                <input type="hidden" name="sort_field" value="0">
                <input type="hidden" name="sort_order" value="desc">

                <div class="mb-3" role="search"><i class="search-icon bi bi-search"></i> <input type="search" name="query" value="" class="form-control" placeholder="Поиск..."></div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#categoriesFilter">
                                Категории
                                <span id="categoriesFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#categoriesFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="categoriesFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters_categories']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                    <?php if ($_smarty_tpl->tpl_vars['element']->value['parent'] == 0) {?>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" data-parent="0" class="form-check-input" id="categories_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
"
                                                   name="categories[]" value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                            <label class="form-check-label" for="categories_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['element']->value['title'];?>

                                            </label>
                                        </div>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters_categories']->value, 'sub_element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sub_element']->value) {
?>
                                            <?php if ($_smarty_tpl->tpl_vars['element']->value['id'] == $_smarty_tpl->tpl_vars['sub_element']->value['parent']) {?>
                                                <div class="form-check mb-2 ms-3">
                                                    <input type="checkbox" data-parent="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" class="form-check-input" id="categories_<?php echo $_smarty_tpl->tpl_vars['sub_element']->value['id'];?>
" name="categories[]"
                                                           value="<?php echo $_smarty_tpl->tpl_vars['sub_element']->value['id'];?>
">
                                                    <label class="form-check-label small" for="categories_<?php echo $_smarty_tpl->tpl_vars['sub_element']->value['id'];?>
">
                                                        <?php echo $_smarty_tpl->tpl_vars['sub_element']->value['title'];?>

                                                    </label>
                                                </div>
                                            <?php }?>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                    <?php }?>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col"><h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#groupsFilter">
                                Доступно для
                                <span id="groupsFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#groupsFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="groupsFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="groups_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" name="groups[]" value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                        <label class="form-check-label" for="groups_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                            <?php echo $_smarty_tpl->tpl_vars['element']->value['name'];?>

                                        </label>
                                    </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#notorietyFilter">
                                Популярность бренда
                                <span id="notorietyFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#notorietyFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="notorietyFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters_notoriety']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="notoriety_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" name="notoriety[]" value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                        <label class="form-check-label" for="notoriety_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                            <?php echo $_smarty_tpl->tpl_vars['element']->value['data']['ru'];?>

                                        </label>
                                    </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#applicationFilter">
                                Сфера применения контента
                                <span id="applicationFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#applicationFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="applicationFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters_application']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
                                    <?php if (!$_smarty_tpl->tpl_vars['group']->value['parent_id']) {?>
                                        <p class="fw-bold text-muted mb-1"><?php echo $_smarty_tpl->tpl_vars['group']->value['data'][Session::getvar('current_language')];?>
</p>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters_application']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                            <?php if ($_smarty_tpl->tpl_vars['group']->value['id'] == $_smarty_tpl->tpl_vars['element']->value['parent_id']) {?>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" id="application_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" name="application[]" value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                                    <label class="form-check-label" for="application_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                                        <?php echo $_smarty_tpl->tpl_vars['element']->value['data']['ru'];?>

                                                    </label>
                                                </div>
                                            <?php }?>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                    <?php }?>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#placementFilter">
                                Размещение
                                <span id="placementFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#placementFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="placementFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters_placement']->value, 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="placement_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
" name="placement[]" value="<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                        <label class="form-check-label" for="placement_<?php echo $_smarty_tpl->tpl_vars['element']->value['id'];?>
">
                                            <?php echo $_smarty_tpl->tpl_vars['element']->value['data']['ru'];?>

                                        </label>
                                    </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#territoryFilter">
                                Территория
                                <span id="territoryFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#territoryFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="territoryFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters_countries']->value, 'country');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
?>
                                    <?php if (is_array($_smarty_tpl->tpl_vars['filters_regions']->value[$_smarty_tpl->tpl_vars['country']->value['id']]) && count($_smarty_tpl->tpl_vars['filters_regions']->value[$_smarty_tpl->tpl_vars['country']->value['id']])) {?>
                                        <div class="row g-0 align-items-center mb-2">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="country_<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
" name="country[]" value="<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
">
                                                    <label class="form-check-label" for="country_<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
">
                                                        <?php echo $_smarty_tpl->tpl_vars['country']->value['data']['ru'];?>

                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button data-bs-toggle="collapse" href="#regionsFilter_<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i
                                                            class="mdi mdi-chevron-down vertical-center"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="regionsFilter_<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
" class="collapse">
                                            <div class="ms-3">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters_regions']->value[$_smarty_tpl->tpl_vars['country']->value['id']], 'region');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['region']->value) {
?>
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="region_<?php echo $_smarty_tpl->tpl_vars['region']->value['id'];?>
" name="region[]" value="<?php echo $_smarty_tpl->tpl_vars['region']->value['id'];?>
">
                                                        <label class="form-check-label small" for="region_<?php echo $_smarty_tpl->tpl_vars['region']->value['id'];?>
">
                                                            <?php echo $_smarty_tpl->tpl_vars['region']->value['data']['ru'];?>

                                                        </label>
                                                    </div>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="country_<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
" name="country[]" value="<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
">
                                            <label class="form-check-label" for="country_<?php echo $_smarty_tpl->tpl_vars['country']->value['id'];?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['country']->value['data']['ru'];?>

                                            </label>
                                        </div>
                                    <?php }?>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="exclusive" name="exclusive" <?php if ($_smarty_tpl->tpl_vars['_filters']->value['exclusive']) {?> checked <?php }?>>
                        <label class="form-check-label" for="exclusive">
                            Эксклюзивное предложение
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="fast_deal" name="fast_deal" <?php if ($_smarty_tpl->tpl_vars['_filters']->value['fast_deal']) {?> checked <?php }?>>
                        <label class="form-check-label" for="fast_deal">
                            Быстрая сделка
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="offer_price">Цена, руб / мес</label>
                    <div class="row mb-1">
                        <div class="col-6">
                            <input value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['_filters']->value['price_min'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['min_price']->value : $tmp);?>
" type="number" min="<?php echo $_smarty_tpl->tpl_vars['min_price']->value;?>
" max="<?php echo $_smarty_tpl->tpl_vars['max_price']->value;?>
" step="1000" name="price_min" class="form-control form-control-xs" required>
                        </div>
                        <div class="col-6">
                            <input value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['_filters']->value['price_max'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['max_price']->value : $tmp);?>
" type="number" min="<?php echo $_smarty_tpl->tpl_vars['min_price']->value;?>
" max="<?php echo $_smarty_tpl->tpl_vars['max_price']->value;?>
" step="1000" name="price_max" class="form-control form-control-xs" required>
                        </div>
                    </div>
                    <!--div class="px-2">
                <input id="offer_price" type="text"
                       data-slider-min="<?php echo $_smarty_tpl->tpl_vars['min_price']->value;?>
" data-slider-max="<?php echo $_smarty_tpl->tpl_vars['max_price']->value;?>
" data-slider-step="1000"
                       data-slider-value="[<?php echo (($tmp = @$_smarty_tpl->tpl_vars['_filters']->value['price_min'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['min_price']->value : $tmp);?>
,<?php echo (($tmp = @$_smarty_tpl->tpl_vars['_filters']->value['price_max'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['max_price']->value : $tmp);?>
]">
            </div-->
                </div>
                <div class="mb-3">
                    <label class="form-label" for="offer_term">Срок, мес</label>
                    <div class="row mb-1">
                        <div class="col-6">
                            <input value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['_filters']->value['term_min'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['min_term']->value : $tmp);?>
" type="number" min="<?php echo $_smarty_tpl->tpl_vars['min_term']->value;?>
" max="<?php echo $_smarty_tpl->tpl_vars['max_term']->value;?>
" step="1" name="term_min" class="form-control form-control-xs">
                        </div>
                        <div class="col-6">
                            <input value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['_filters']->value['term_max'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['max_term']->value : $tmp);?>
" type="number" min="<?php echo $_smarty_tpl->tpl_vars['min_term']->value;?>
" max="<?php echo $_smarty_tpl->tpl_vars['max_term']->value;?>
" step="1" name="term_max" class="form-control form-control-xs">
                        </div>
                    </div>
                    <!--div class="px-2">
                <input id="offer_term" type="text"
                       data-slider-min="<?php echo $_smarty_tpl->tpl_vars['min_term']->value;?>
" data-slider-max="<?php echo $_smarty_tpl->tpl_vars['max_term']->value;?>
" data-slider-step="1"
                       data-slider-value="[<?php echo (($tmp = @$_smarty_tpl->tpl_vars['_filters']->value['term_min'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['min_term']->value : $tmp);?>
,<?php echo (($tmp = @$_smarty_tpl->tpl_vars['_filters']->value['term_max'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['max_term']->value : $tmp);?>
]">
            </div-->
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-bottom p-3 border-top">
        <button type="button" class="btn btn-primary w-100 d-block" data-action="apply_filters">Применить</button>
    </div>
</form>
<?php }
}
