<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700;900&display=swap" rel="stylesheet">

{foreach from=$dependencies item=file}
    {if $file.file|pathinfo:$smarty.const.PATHINFO_EXTENSION == 'css'}
        <link href="{$file.file}?v={$APP_BUILD}" rel="stylesheet" {$file.params}>
    {/if}
{/foreach}

<link rel="stylesheet" id="themeCSS" href="{$ABS_PATH}assets/core/core.css?v={$APP_BUILD}">
