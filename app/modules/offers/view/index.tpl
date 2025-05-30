<div class="container-fluid">
    <div class="row justify-content-center justify-content-md-between align-items-center">
        <div class="col-12 col-sm-auto mb-3">
            <ul class="nav nav-underline flex-column flex-sm-row">
                <li class="nav-item">
                    <a class="nav-link" href="{$ABS_PATH}profile/brands"><span class="h3">Бренды</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{$ABS_PATH}profile/content"><span class="h3">Контент</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{$ABS_PATH}profile/offers"><span class="h3">Предложения</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{$ABS_PATH}profile/deals"><span class="h3">Сделки</span></a>
                </li>
            </ul>
        </div>
        <div class="col-auto mb-3">
            <button type="button" data-action="add" class="btn btn-outline-primary rounded-pill border-style-dashed"><i class="mdi mdi-plus"></i> {#button_add#}</button>
        </div>
    </div>
    <div id="offersList" class="row g-3">
        {for $foo=1 to 4}
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                <div class="card bg-transparent" role="button">
                    <div class="shimmer ratio ratio-4x3 card-img-top"></div>
                    <div class="card-body">
                        <div class="shimmer hg-4 rounded-2"></div>
                    </div>
                </div>
            </div>
        {/for}
    </div>
</div>

<template id="offerTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <div class="card hover" data-action="edit" role="button" data-href="{$API_PATH}/profile/offer/:id">
            <div class="ratio ratio-4x3">
                <img src=":logotype" class="card-img-top" alt=":name">
            </div>
            <div class="card-body">
                <h6>:name</h6>
            </div>
        </div>
    </div>
</template>

{$modal_tpl}