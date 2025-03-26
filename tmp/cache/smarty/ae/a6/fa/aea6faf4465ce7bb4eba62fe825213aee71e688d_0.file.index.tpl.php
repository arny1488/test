<?php
/* Smarty version {Smarty::SMARTY_VERSION}, created on 2024-07-10 01:33:25
  from "/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32-dev-25',
  'unifunc' => 'content_668dbab561e880_63376778',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aea6faf4465ce7bb4eba62fe825213aee71e688d' => 
    array (
      0 => '/home/users/a/arny1488/domains/test.oblozhky.ru/app/templates/default/index.tpl',
      1 => 1709779910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668dbab561e880_63376778 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['current_language']->value;?>
">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>

    <title><?php echo $_smarty_tpl->tpl_vars['data']->value['page_title'];?>
 &middot; <?php echo $_smarty_tpl->tpl_vars['APP_NAME']->value;?>
</title>

    <meta name="description" content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['page_description'])===null||$tmp==='' ? '' : $tmp);?>
">
    <meta name="keywords" content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['page_keywords'])===null||$tmp==='' ? '' : $tmp);?>
">
    <meta name="author" content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['page_author'])===null||$tmp==='' ? '' : $tmp);?>
">

    <meta name="generator" content="https://rgbvision.net">

    <link rel="icon" type="image/svg" href="/favicon.svg">

    <style>
        #page-loader {
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fff;
            z-index: 1500;
            align-items: center;
            justify-content: center;
            display: flex;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                color-scheme: dark;
            }

            #page-loader {
                background-color: #141414;
            }
        }

        .page-loader__spinner {
            position: relative;
            width: 50px;
            height: 50px;
        }

        .page-loader__spinner svg {
            animation: rotate 2s linear infinite;
            transform-origin: center center;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .page-loader__spinner svg circle {
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
            animation: dash 1.5s ease-in-out infinite, color 5s ease-in-out infinite;
            stroke-linecap: round;
        }

        @keyframes rotate {
            100% {
                transform: rotate(360deg)
            }
        }

        @keyframes dash {
            0% {
                stroke-dasharray: 1, 200;
                stroke-dashoffset: 0
            }
            50% {
                stroke-dasharray: 89, 200;
                stroke-dashoffset: -35px
            }
            100% {
                stroke-dasharray: 89, 200;
                stroke-dashoffset: -124px
            }
        }

        @keyframes color {
            0%, 100% {
                stroke: #8A88FF
            }
            50% {
                stroke: #7d7d7d
            }
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>
<body data-page-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['page'];?>
">

<div id="page-loader">
    <div class="page-loader__spinner">
        <svg viewBox="25 25 50 50">
            <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>

<?php echo $_smarty_tpl->tpl_vars['main_menu_tpl']->value;?>


<!-- CONTENT -->
<?php if (defined('FULL_PAGE')) {?>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="main-wrapper pt-4 px-2 px-xl-5" style="margin-top: 83px">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container-fluid d-none d-md-block">
                    <?php echo $_smarty_tpl->tpl_vars['breadcrumbs_tpl']->value;?>

                </div>
                <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

            </div>
        </div>
    </div>
<?php }?>
<!-- ./CONTENT -->

<?php echo $_smarty_tpl->tpl_vars['footer_tpl']->value;?>


<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['injections']->value, 'injection');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['injection']->value) {
?>
    <?php echo $_smarty_tpl->tpl_vars['injection']->value['html'];?>

<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


</body>

<?php echo $_smarty_tpl->tpl_vars['styles_tpl']->value;?>


<?php echo $_smarty_tpl->tpl_vars['scripts_tpl']->value;?>


</html>
<?php }
}
