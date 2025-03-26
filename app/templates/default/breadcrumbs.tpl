{if is_array($data.breadcrumbs) && count($data.breadcrumbs) > 1}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dot">
            {foreach from=$data.breadcrumbs item=item}
                {if $item.href}
                    <li class="breadcrumb-item"><a href="{$item.href}">{$item.text}</a></li>
                {else}
                    <li class="breadcrumb-item active" aria-current="page">{$item.text}</li>
                {/if}
            {/foreach}
        </ol>
    </nav>
{/if}