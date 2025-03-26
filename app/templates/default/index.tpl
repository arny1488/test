<!DOCTYPE html>
<html lang="{$current_language}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>

    <title>{$data.page_title} &middot; {$APP_NAME}</title>

    <meta name="description" content="{$data.page_description|default:''}">
    <meta name="keywords" content="{$data.page_keywords|default:''}">
    <meta name="author" content="{$data.page_author|default:''}">

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
<body data-page-id="{$data.page}">

<div id="page-loader">
    <div class="page-loader__spinner">
        <svg viewBox="25 25 50 50">
            <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>

{$main_menu_tpl}

<!-- CONTENT -->
{if defined('FULL_PAGE')}
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                {$content}
            </div>
        </div>
    </div>
{else}
    <div class="main-wrapper pt-4 px-2 px-xl-5" style="margin-top: 83px">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="container-fluid d-none d-md-block">
                    {$breadcrumbs_tpl}
                </div>
                {$content}
            </div>
        </div>
    </div>
{/if}
<!-- ./CONTENT -->

{$footer_tpl}

{foreach from=$injections item=injection}
    {$injection.html}
{/foreach}

</body>

{$styles_tpl}

{$scripts_tpl}

</html>
