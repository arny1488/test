<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 12:00:22
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/offer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab4ea6657c29_89717643',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0cbf9e26b12f1b24117f1c709a66a8429126328c' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/offer.tpl',
      1 => 1698520884,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab4ea6657c29_89717643 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-xl-8 mb-3">
            <div class="d-flex align-items-center border border-1 border-secondary border-opacity-25 rounded-2 text-center position-relative bg-body-tertiary ht-vh-50-f ht-vh-sm-30-f ht-vh-md-50-f ht-vh-xxl-35-f overflow-hidden">
                <div class="position-absolute w-100 h-100 opacity-25 rounded-2" style="background-image: url('<?php echo (($tmp = @$_smarty_tpl->tpl_vars['offer']->value['content']['files'][0]['thumb360'])===null||$tmp==='' ? '' : $tmp);?>
'); background-size: cover; background-position: center;"></div>
                <div class="preview-gallery owl-carousel">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['offer']->value['content']['files'], 'file', false, NULL, 'gallery', array (
  'index' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_gallery']->value['index']++;
?>
                        <?php if (str_starts_with($_smarty_tpl->tpl_vars['file']->value['mime'],'image/')) {?>
                            <img style="object-fit: cover; object-position: center;" class="ht-vh-50-f ht-vh-sm-30-f ht-vh-md-50-f ht-vh-xxl-35-f w-auto showPlayer" data-url="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/gallery/<?php echo $_smarty_tpl->tpl_vars['offer']->value['id'];?>
" data-index="<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_gallery']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_gallery']->value['index'] : null);?>
" role="button" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['file']->value['thumb1280'])===null||$tmp==='' ? '' : $tmp);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['name'];?>
">
                        <?php }?>
                        <?php if (str_starts_with($_smarty_tpl->tpl_vars['file']->value['mime'],'video/')) {?>
                            <img style="object-fit: cover; object-position: center;" class="ht-vh-50-f ht-vh-sm-30-f ht-vh-md-50-f ht-vh-xxl-35-f w-auto showPlayer" data-url="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/gallery/<?php echo $_smarty_tpl->tpl_vars['offer']->value['id'];?>
" data-index="<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_gallery']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_gallery']->value['index'] : null);?>
" role="button" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['file']->value['thumb1280'])===null||$tmp==='' ? '' : $tmp);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['name'];?>
">
                        <?php }?>
                        <?php if (str_starts_with($_smarty_tpl->tpl_vars['file']->value['mime'],'audio/')) {?>
                            <img style="object-fit: cover; object-position: center;" class="ht-vh-50-f ht-vh-sm-30-f ht-vh-md-50-f ht-vh-xxl-35-f w-auto showPlayer" data-url="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/gallery/<?php echo $_smarty_tpl->tpl_vars['offer']->value['id'];?>
" data-index="<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_gallery']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_gallery']->value['index'] : null);?>
" role="button" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['file']->value['thumb1280'])===null||$tmp==='' ? '' : $tmp);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['name'];?>
">
                        <?php }?>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                </div>
                
            </div>
        </div>
        <div class="col-xl-4 mb-3">
            <div class="card bg-body-tertiary h-100">
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                        <h3 class="mb-5"><?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['name'];?>
</h3>
                        <div class="mb-5">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['offer']->value['content']['type_ids'], 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                <span class="tag small py-1 px-3 border border-1 border-primary rounded-pill" role="button"><?php echo $_smarty_tpl->tpl_vars['filters_categories']->value[$_smarty_tpl->tpl_vars['cat']->value]['title'];?>
</span>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                        </div>
                        <h4 class="mb-1"><?php echo Number::numFormat($_smarty_tpl->tpl_vars['offer']->value['price']);?>
 руб./мес.</h4>
                        <?php if ($_smarty_tpl->tpl_vars['offer']->value['termless']) {?>
                            <p>бессрочно</p>
                        <?php } else { ?>
                            <p>от <?php echo $_smarty_tpl->tpl_vars['offer']->value['term_min'];?>
 до <?php echo $_smarty_tpl->tpl_vars['offer']->value['term_max'];?>
 мес.</p>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['offer']->value['exclusive'] || $_smarty_tpl->tpl_vars['offer']->value['fast_deal']) {?>
                            <div class="mt-3">
                                <?php if ($_smarty_tpl->tpl_vars['offer']->value['exclusive']) {?><p class="mt-0 mb-2"><i class="mdi mdi-thumb-up-outline bg-pink-accent text-black rounded-circle text-center wd-25-f ht-25-f d-inline-block"></i> Эксклюзивное предложение</p><?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['offer']->value['fast_deal']) {?><p class="mt-0 mb-2"><i class="mdi mdi-lightning-bolt bg-yellow text-black rounded-circle text-center wd-25-f ht-25-f d-inline-block"></i> Быстрая сделка</p><?php }?>
                            </div>
                        <?php }?>
                    </div>
                    <div class="row flex-grow-0">
                        <div class="col">
                            <button type="button" class="btn btn-lg btn-primary d-block w-100 text-center"><i class="bi bi-plus-lg"></i> Добавить в корзину</button>
                        </div>
                        <div class="col-auto" data-favorite="<?php if ($_smarty_tpl->tpl_vars['offer']->value['favorite']) {?>true<?php } else { ?>false<?php }?>" data-offer-id="<?php echo $_smarty_tpl->tpl_vars['offer']->value['id'];?>
">
                            <button class="btn btn-lg btn-outline-secondary btn-icon favorite" data-action="favorite"><i class="bi"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="mb-3">
        <div class="border border-primary rounded">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane" type="button" role="tab" aria-controls="description-tab-pane" aria-selected="true">Описание</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chars-tab" data-bs-toggle="tab" data-bs-target="#chars-tab-pane" type="button" role="tab" aria-controls="chars-tab-pane" aria-selected="false" tabindex="-1">Характеристики</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false" tabindex="-1">Бренд</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane p-3 fade show active" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
                    <?php echo $_smarty_tpl->tpl_vars['offer']->value['description'];?>

                </div>
                <div class="tab-pane p-3 fade" id="chars-tab-pane" role="tabpanel" aria-labelledby="chars-tab" tabindex="0">
                    <p>Доступно для аренды: <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['offer']->value['allowed_for_ids'], 'id', false, NULL, 'foo', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['total'];
echo $_smarty_tpl->tpl_vars['groups']->value[$_smarty_tpl->tpl_vars['id']->value];
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] : null)) {?>, <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
</p>
                    <p>Сфера применения: <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['offer']->value['application_ids'], 'id', false, NULL, 'foo', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['total'];
echo $_smarty_tpl->tpl_vars['filters_application']->value[$_smarty_tpl->tpl_vars['id']->value]['data']['ru'];
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] : null)) {?>, <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
</p>
                    <p>Территория применения: <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['offer']->value['country_id'], 'id', false, NULL, 'foo', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['total'];
echo $_smarty_tpl->tpl_vars['filters_countries']->value[$_smarty_tpl->tpl_vars['id']->value]['data']['ru'];
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] : null)) {?>, <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
</p>
                    <p class="mb-0">Размещение: <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['offer']->value['placement_ids'], 'id', false, NULL, 'foo', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['total'];
echo $_smarty_tpl->tpl_vars['filters_placement']->value[$_smarty_tpl->tpl_vars['id']->value]['data']['ru'];
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] : null)) {?>, <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
</p>
                </div>
                <div class="tab-pane p-3 fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    <div class="row align-items-center">
                        <div class="col-md-3 col-xl-2 mb-3 mb-md-0">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/brand/<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['brand']['id'];?>
"><img class="img-fluid rounded-circle bg-secondary bg-opacity-25" src="<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['brand']['logotype'];?>
"
                                                                                                       alt="<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['brand']['name'];?>
"></a>
                        </div>
                        <div class="col">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/brand/<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['brand']['id'];?>
" class="text-decoration-none"><h4 class="mb-3"><?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['brand']['name'];?>
</h4></a>
                            <p>Страна происхождения: <?php echo $_smarty_tpl->tpl_vars['filters_countries']->value[$_smarty_tpl->tpl_vars['offer']->value['content']['brand']['country_id']]['data']['ru'];?>
</p>
                            <p>Популярность: <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['offer']->value['content']['brand']['notoriety_ids'], 'id', false, NULL, 'foo', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['total'];
echo $_smarty_tpl->tpl_vars['filters_notoriety']->value[$_smarty_tpl->tpl_vars['id']->value]['data']['ru'];
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['last'] : null)) {?>, <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>
</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if ($_smarty_tpl->tpl_vars['brand_offers']->value) {?>
        <section class="mb-3 mt-5">
            <h3 class="mb-3">Другие предложения этого бренда</h3>
            <div class="row g-3 pb-3">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['brand_offers']->value, 'offer');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['offer']->value) {
?>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                        <a class="card hover text-decoration-none item-card" role="button" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/offer/<?php echo $_smarty_tpl->tpl_vars['offer']->value['id'];?>
" data-offer-id="<?php echo $_smarty_tpl->tpl_vars['offer']->value['id'];?>
" data-favorite="<?php if ($_smarty_tpl->tpl_vars['offer']->value['favorite']) {?>true<?php } else { ?>false<?php }?>">
                            <div class="position-relative">
                                <div class="ratio ratio-4x3">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['files'][0]['thumb720'];?>
" class="card-img-top" alt="<?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['name'];?>
">
                                </div>
                                <button type="button" class="favorite" data-action="favorite"><i class="bi"></i></button>
                            </div>
                            <div class="card-body">
                                <h6><?php echo $_smarty_tpl->tpl_vars['offer']->value['content']['name'];?>
</h6>
                            </div>
                        </a>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

            </div>
        </section>
    <?php }?>
</div>

<?php echo $_smarty_tpl->tpl_vars['player_tpl']->value;
}
}
