<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-xl-8 mb-3">
            <div class="d-flex align-items-center border border-1 border-secondary border-opacity-25 rounded-2 text-center position-relative bg-body-tertiary ht-vh-50-f ht-vh-sm-30-f ht-vh-md-50-f ht-vh-xxl-35-f overflow-hidden">
                <div class="position-absolute w-100 h-100 opacity-25 rounded-2" style="background-image: url('{$offer['content']['files'][0]['thumb360']|default:''}'); background-size: cover; background-position: center;"></div>
                <div class="preview-gallery owl-carousel">
                    {foreach from=$offer['content']['files'] item=file name=gallery}
                        {if str_starts_with($file['mime'], 'image/')}
                            <img style="object-fit: cover; object-position: center;" class="ht-vh-50-f ht-vh-sm-30-f ht-vh-md-50-f ht-vh-xxl-35-f w-auto showPlayer" data-url="{$ABS_PATH}catalog/gallery/{$offer['id']}" data-index="{$smarty.foreach.gallery.index}" role="button" src="{$file['thumb1280']|default:''}" alt="{$offer['content']['name']}">
                        {/if}
                        {if str_starts_with($file['mime'], 'video/')}
                            <img style="object-fit: cover; object-position: center;" class="ht-vh-50-f ht-vh-sm-30-f ht-vh-md-50-f ht-vh-xxl-35-f w-auto showPlayer" data-url="{$ABS_PATH}catalog/gallery/{$offer['id']}" data-index="{$smarty.foreach.gallery.index}" role="button" src="{$file['thumb1280']|default:''}" alt="{$offer['content']['name']}">
                        {/if}
                        {if str_starts_with($file['mime'], 'audio/')}
                            <img style="object-fit: cover; object-position: center;" class="ht-vh-50-f ht-vh-sm-30-f ht-vh-md-50-f ht-vh-xxl-35-f w-auto showPlayer" data-url="{$ABS_PATH}catalog/gallery/{$offer['id']}" data-index="{$smarty.foreach.gallery.index}" role="button" src="{$file['thumb1280']|default:''}" alt="{$offer['content']['name']}">
                        {/if}
                    {/foreach}
                </div>
                {* <img style="max-width: 100%; max-height: 100%; z-index: 5;" class="d-block mx-auto" src="{$offer['content']['files'][0]['thumb1280']|default:''}" alt="{$offer['content']['name']}"> *}
            </div>
        </div>
        <div class="col-xl-4 mb-3">
            <div class="card bg-body-tertiary h-100">
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                        <h3 class="mb-5">{$offer['content']['name']}</h3>
                        <div class="mb-5">
                            {foreach from=$offer['content']['type_ids'] item=cat}
                                <span class="tag small py-1 px-3 border border-1 border-primary rounded-pill" role="button">{$filters_categories[$cat].title}</span>
                            {/foreach}
                        </div>
                        <h4 class="mb-1">{Number::numFormat($offer['price'])} руб./мес.</h4>
                        {if $offer['termless']}
                            <p>бессрочно</p>
                        {else}
                            <p>от {$offer['term_min']} до {$offer['term_max']} мес.</p>
                        {/if}
                        {if $offer['exclusive'] || $offer['fast_deal']}
                            <div class="mt-3">
                                {if $offer['exclusive']}<p class="mt-0 mb-2"><i class="mdi mdi-thumb-up-outline bg-pink-accent text-black rounded-circle text-center wd-25-f ht-25-f d-inline-block"></i> Эксклюзивное предложение</p>{/if}
                                {if $offer['fast_deal']}<p class="mt-0 mb-2"><i class="mdi mdi-lightning-bolt bg-yellow text-black rounded-circle text-center wd-25-f ht-25-f d-inline-block"></i> Быстрая сделка</p>{/if}
                            </div>
                        {/if}
                    </div>
                    <div class="row flex-grow-0">
                        <div class="col">
                            <button type="button" class="btn btn-lg btn-primary d-block w-100 text-center"><i class="bi bi-plus-lg"></i> Добавить в корзину</button>
                        </div>
                        <div class="col-auto" data-favorite="{if $offer['favorite']}true{else}false{/if}" data-offer-id="{$offer['id']}">
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
                    {$offer['description']}
                </div>
                <div class="tab-pane p-3 fade" id="chars-tab-pane" role="tabpanel" aria-labelledby="chars-tab" tabindex="0">
                    <p>Доступно для аренды: {foreach from=$offer['allowed_for_ids'] item=id name=foo}{$groups[$id]}{if !$smarty.foreach.foo.last}, {/if}{/foreach}</p>
                    <p>Сфера применения: {foreach from=$offer['application_ids'] item=id name=foo}{$filters_application[$id].data['ru']}{if !$smarty.foreach.foo.last}, {/if}{/foreach}</p>
                    <p>Территория применения: {foreach from=$offer['country_id'] item=id name=foo}{$filters_countries[$id].data['ru']}{if !$smarty.foreach.foo.last}, {/if}{/foreach}</p>
                    <p class="mb-0">Размещение: {foreach from=$offer['placement_ids'] item=id name=foo}{$filters_placement[$id].data['ru']}{if !$smarty.foreach.foo.last}, {/if}{/foreach}</p>
                </div>
                <div class="tab-pane p-3 fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    <div class="row align-items-center">
                        <div class="col-md-3 col-xl-2 mb-3 mb-md-0">
                            <a href="{$ABS_PATH}catalog/brand/{$offer['content']['brand']['id']}"><img class="img-fluid rounded-circle bg-secondary bg-opacity-25" src="{$offer['content']['brand']['logotype']}"
                                                                                                       alt="{$offer['content']['brand']['name']}"></a>
                        </div>
                        <div class="col">
                            <a href="{$ABS_PATH}catalog/brand/{$offer['content']['brand']['id']}" class="text-decoration-none"><h4 class="mb-3">{$offer['content']['brand']['name']}</h4></a>
                            <p>Страна происхождения: {$filters_countries[$offer['content']['brand']['country_id']].data['ru']}</p>
                            <p>Популярность: {foreach from=$offer['content']['brand']['notoriety_ids'] item=id name=foo}{$filters_notoriety[$id].data['ru']}{if !$smarty.foreach.foo.last}, {/if}{/foreach}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {if $brand_offers}
        <section class="mb-3 mt-5">
            <h3 class="mb-3">Другие предложения этого бренда</h3>
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

{$player_tpl}