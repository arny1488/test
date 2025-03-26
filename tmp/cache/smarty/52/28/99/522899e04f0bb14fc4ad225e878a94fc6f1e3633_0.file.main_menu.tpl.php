<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 01:33:25
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/main_menu.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dbab55f87a0_70576206',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '522899e04f0bb14fc4ad225e878a94fc6f1e3633' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/main_menu.tpl',
      1 => 1704779566,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dbab55f87a0_70576206 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav class="navbar fixed-top navbar-expand-lg shadow-sm">
    <div class="container-fluid px-2 px-xl-5">
        <div class="position-relative">
            <button type="button" class="btn btn-icon btn-navbar bg-transparent border-0 text-body dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-list"></i></button>
            <ul class="dropdown-menu mn-wd-200 mx-wd-350">
                <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/offers">Предложения</a></li>
                <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/categories">Категории</a></li>
                <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/brands">Бренды</a></li>
                
                <li>
                    <hr class="dropdown-divider">
                </li>
                
                <li><a class="dropdown-item" href="#">Фонды</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><span class="small px-3">&copy; <?php echo date('Y');?>
</span></li>
            </ul>
        </div>
        <a class="navbar-brand mx-lg-4" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
">
            <svg width="150" height="57" viewBox="0 0 150 57" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.6833 28.5997C21.6833 31.8214 19.0679 34.433 15.8416 34.433C12.6154 34.433 10 31.8214 10 28.5997C10 25.3781 12.6154 22.7664 15.8416 22.7664C19.0679 22.7664 21.6833 25.3781 21.6833 28.5997Z"/>
                <path d="M27.4751 46C37.1538 46 45 38.165 45 28.5C45 18.835 37.1538 11 27.4751 11C27.4751 11 27.475 15.8697 27.475 22.6667C30.7013 22.6667 33.3167 25.2783 33.3167 28.5C33.3167 31.7217 30.7013 34.3333 27.475 34.3333C27.475 41.1303 27.4751 46 27.4751 46Z"/>
                <path d="M100.811 24.1973V30.6709H102.068V31.6963H100.811V34H99.7031V31.6963H95.0957V30.7256C95.5241 30.2425 95.957 29.7275 96.3945 29.1807C96.832 28.6292 97.249 28.071 97.6455 27.5059C98.0465 26.9408 98.4157 26.3779 98.7529 25.8174C99.0947 25.2523 99.3818 24.7122 99.6143 24.1973H100.811ZM96.3604 30.6709H99.7031V25.8721C99.3613 26.4691 99.0378 27.0023 98.7324 27.4717C98.4271 27.9411 98.1354 28.3672 97.8574 28.75C97.584 29.1328 97.3219 29.4792 97.0713 29.7891C96.8206 30.099 96.5837 30.3929 96.3604 30.6709ZM114.701 34H113.334L111.693 31.252C111.543 30.9967 111.397 30.7803 111.256 30.6025C111.115 30.4202 110.969 30.2721 110.818 30.1582C110.673 30.0443 110.513 29.9622 110.34 29.9121C110.171 29.8574 109.98 29.8301 109.766 29.8301H108.822V34H107.674V24.1973H110.6C111.028 24.1973 111.422 24.252 111.782 24.3613C112.147 24.4661 112.461 24.6279 112.726 24.8467C112.994 25.0654 113.204 25.3389 113.354 25.667C113.505 25.9906 113.58 26.3711 113.58 26.8086C113.58 27.1504 113.528 27.4648 113.423 27.752C113.323 28.0345 113.177 28.2874 112.985 28.5107C112.799 28.734 112.571 28.9255 112.302 29.085C112.037 29.2399 111.739 29.3607 111.406 29.4473V29.4746C111.57 29.5475 111.712 29.6318 111.83 29.7275C111.953 29.8187 112.069 29.9281 112.179 30.0557C112.288 30.1833 112.395 30.3291 112.5 30.4932C112.609 30.6527 112.73 30.8395 112.862 31.0537L114.701 34ZM108.822 25.2363V28.791H110.381C110.668 28.791 110.932 28.7477 111.174 28.6611C111.42 28.5745 111.632 28.4515 111.81 28.292C111.987 28.1279 112.126 27.9297 112.227 27.6973C112.327 27.4603 112.377 27.196 112.377 26.9043C112.377 26.3802 112.206 25.9723 111.864 25.6807C111.527 25.3844 111.037 25.2363 110.395 25.2363H108.822ZM121.25 34H116.055V24.1973H121.031V25.2363H117.203V28.4971H120.744V29.5293H117.203V32.9609H121.25V34ZM131.039 34H129.631L124.586 26.1865C124.458 25.9906 124.354 25.7855 124.271 25.5713H124.23C124.267 25.7809 124.285 26.2298 124.285 26.918V34H123.137V24.1973H124.627L129.535 31.8877C129.74 32.2067 129.872 32.4255 129.932 32.5439H129.959C129.913 32.2614 129.891 31.7806 129.891 31.1016V24.1973H131.039V34ZM139.406 25.2363H136.576V34H135.428V25.2363H132.604V24.1973H139.406V25.2363Z"/>
                <path d="M73.0049 25.9951H70.209V34H67.9941V25.9951H65.2119V24.1973H73.0049V25.9951ZM85.4941 34H83.3135V28.1348C83.3135 27.5013 83.3408 26.8018 83.3955 26.0361H83.3408C83.2269 26.6377 83.1243 27.0706 83.0332 27.335L80.7363 34H78.9316L76.5938 27.4033C76.5299 27.2256 76.4274 26.7699 76.2861 26.0361H76.2246C76.2839 27.0023 76.3135 27.8499 76.3135 28.5791V34H74.3242V24.1973H77.5576L79.5605 30.0078C79.7201 30.4727 79.8363 30.9398 79.9092 31.4092H79.9502C80.0732 30.8669 80.2031 30.3952 80.3398 29.9941L82.3428 24.1973H85.4941V34Z"/>
            </svg>
        </a>
        <button type="button" class="btn btn-icon btn-navbar bg-transparent border-0 text-body d-lg-none" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog">
                        Каталог
                    </a>
                </li>
            </ul>
            <form class="d-flex w-100 ms-lg-5" role="search" method="get" action="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
catalog/offers">
                <i class="search-icon bi bi-search"></i>
                <input class="form-control me-2 wd-100p" type="search" name="filters[query]" aria-label="Search">
            </form>
            <ul class="navbar-nav align-items-center mb-2 mb-lg-0">
                <li class="nav-item ms-lg-4">
                    <a class="nav-link d-flex align-items-center" href="#"><i class="h5 lh-1 bi bi-telephone"></i></a>
                </li>
                <li class="nav-item ms-lg-4">
                    <a class="nav-link d-flex align-items-center" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
favorites"><i class="h5 lh-1 bi bi-heart"></i></a>
                </li>
                <li class="nav-item ms-lg-4">
                    <a class="nav-link d-flex align-items-center" href="#"><i class="h5 lh-1 bi bi-bag"></i></a>
                </li>
                <?php if (Settings::get('user_settings','organization')) {?>
                    <li class="nav-item ms-lg-4">
                        <a class="nav-link d-flex align-items-center" href="#"><i class="h5 lh-1 bi bi-bell"></i></a>
                    </li>
                <?php }?>
                <li class="nav-item ms-lg-4 dropdown">
                    <?php if (defined('USERID')) {?>
                        <a class="nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="h4 lh-1 bi bi-person"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end mn-wd-200 mx-wd-350">
                            <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile"><i class="opacity-50 me-2 mdi mdi-account-circle-outline"></i> Профиль</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><h6 class="dropdown-header">Мои разделы</h6></li>
                            <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile/brands"><i class="opacity-50 me-2 mdi mdi-registered-trademark"></i> Бренды</a></li>
                            <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile/content"><i class="opacity-50 me-2 mdi mdi-image-multiple-outline"></i> Контент</a></li>
                            <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile/offers"><i class="opacity-50 me-2 mdi mdi-tag-multiple-outline mdi-flip-h"></i> Предложения</a></li>
                            <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
profile/deals"><i class="opacity-50 me-2 mdi mdi-handshake-outline"></i> Сделки</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
logout"><i class="opacity-50 me-2 mdi mdi-logout"></i> Выйти</a></li>
                        </ul>
                    <?php } else { ?>
                        <a class="nav-link d-flex align-items-center" href="<?php echo $_smarty_tpl->tpl_vars['ABS_PATH']->value;?>
login"><i class="h4 lh-1 bi bi-person"></i></a>
                    <?php }?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php }
}
