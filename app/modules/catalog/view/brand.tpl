<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-xl-2 mb-3 mb-md-0">
            <img class="img-fluid rounded-circle bg-secondary bg-opacity-25" src="{$brand['logotype']}" alt="{$brand['name']}">
        </div>
        <div class="col align-self-center">
            <h4 class="mb-3">{$brand['name']}</h4>
            <p>Страна происхождения: {$filters_countries[$brand['country_id']].data['ru']}</p>
            <p class="mb-5">Популярность: {foreach from=$brand['notoriety_ids'] item=id name=foo}{$filters_notoriety[$id].data['ru']}{if !$smarty.foreach.foo.last}, {/if}{/foreach}</p>
            <div>
                {$brand['description']}
            </div>
        </div>
    </div>
    {if $brand_offers}
        <section class="mb-3 mt-5">
            <h3 class="mb-3">Предложения этого бренда</h3>
            <div class="row g-3 pb-3">
                {foreach from=$brand_offers item=offer}
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                        <a class="card hover text-decoration-none item-card" role="button" href="{$ABS_PATH}catalog/offer/{$offer.id}" data-offer-id="{$offer.id}" data-favorite="{if $offer.favorite}true{else}false{/if}">
                            <div class="position-relative">
                                <div class="ratio ratio-4x3">
                                    <img src="{$offer.content.files[0].thumb720}" class="card-img-top" alt="{$offer.content.name}">
                                </div>
                                <button type="button" class="favorite" data-action="favorite"><i class="bi"></i></button>
                            </div>
                            <div class="card-body">
                                <h6>{$offer.content.name}</h6>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        </section>
    {/if}
</div>

