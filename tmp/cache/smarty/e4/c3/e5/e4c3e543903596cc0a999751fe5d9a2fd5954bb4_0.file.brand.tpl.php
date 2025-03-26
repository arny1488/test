<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-08-01 12:07:22
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/brand.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_66ab504a2d8769_03425412',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4c3e543903596cc0a999751fe5d9a2fd5954bb4' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/modules/catalog/view/brand.tpl',
      1 => 1697941292,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66ab504a2d8769_03425412 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-xl-2 mb-3 mb-md-0">
            <img class="img-fluid rounded-circle bg-secondary bg-opacity-25" src="<?php echo $_smarty_tpl->tpl_vars['brand']->value['logotype'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['brand']->value['name'];?>
">
        </div>
        <div class="col align-self-center">
            <h4 class="mb-3"><?php echo $_smarty_tpl->tpl_vars['brand']->value['name'];?>
</h4>
            <p>Страна происхождения: <?php echo $_smarty_tpl->tpl_vars['filters_countries']->value[$_smarty_tpl->tpl_vars['brand']->value['country_id']]['data']['ru'];?>
</p>
            <p class="mb-5">Популярность: <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['brand']->value['notoriety_ids'], 'id', false, NULL, 'foo', array (
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
            <div>
                <?php echo $_smarty_tpl->tpl_vars['brand']->value['description'];?>

            </div>
        </div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['brand_offers']->value) {?>
        <section class="mb-3 mt-5">
            <h3 class="mb-3">Предложения этого бренда</h3>
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

<?php }
}
