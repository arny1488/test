<script>
    var ABS_PATH = '{$ABS_PATH}';
    var API_PATH = '{$API_PATH}';
</script>

<script src="{$ABS_PATH}assets/i18n/{Session::getvar('current_language')}.js?v={$APP_BUILD}"></script>
<script src="{$ABS_PATH}assets/core/core.js?v={$APP_BUILD}"></script>
<script src="{$ABS_PATH}app/js/common.js?v={$APP_BUILD}"></script>

{foreach from=$dependencies item=file}
    {if $file.file|pathinfo:$smarty.const.PATHINFO_EXTENSION == 'js'}
        <script src="{$file.file}?v={$APP_BUILD}" {$file.params} defer></script>
    {/if}
{/foreach}
