<div class="shimmer bg-body-tertiary mb-5 mt-n4 mx-n2 mx-xl-n5" style="height: 340px">
    <iframe src="/uploads/promo/2/index.html" style="border: none; width: 100%; height: 340px; margin: 0; padding: 0;"></iframe>
</div>
<div class="mb-1 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div id="offersList" class="row g-3 mb-5 flex-nowrap overflow-hidden">
            {for $foo=1 to 6}
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
        <div id="categoriesList" class="row g-3 mb-5 flex-nowrap overflow-hidden">
            {for $foo=1 to 6}
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
        <div id="brandsList" class="row g-3 mb-5 flex-nowrap overflow-hidden">
            {for $foo=1 to 12}
                <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                    <div class="shimmer ratio ratio-1x1 rounded-circle mb-2" role="button"></div>
                    <div class="shimmer hg-4 rounded-2 w-75 mx-auto"></div>
                </div>
            {/for}
        </div>
    </div>
</div>

<template id="offerTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <a class="card hover text-decoration-none item-card" role="button" href="{$ABS_PATH}catalog/offer/:id" data-offer-id=":id" data-favorite=":favorite">
            <div class="position-relative">
                <img src=":image" data-hover-slides=":slides" class="card-img-top" alt=":name">
                <button type="button" class="favorite" data-action="favorite"><i class="bi"></i></button>
            </div>
            <div class="card-body">
                <h6 class="hg-4">:name</h6>
            </div>
        </a>
    </div>
</template>

<template id="categoryTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <a class="card hover text-decoration-none" role="button" href="{$ABS_PATH}catalog/offers?filters[categories][]=:id" data-category-id=":id">
            <img src=":image" class="card-img-top img-fluid w-100" alt=":name">
            <div class="card-body">
                <h6 class="text-center hg-4 overflow-hidden">:name</h6>
            </div>
        </a>
    </div>
</template>

<template id="brandTemplate">
    <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
        <div class="ratio ratio-1x1 rounded-circle mb-2">
            <a href="{$ABS_PATH}catalog/brand/:id" class="rounded-circle img-hover">
                <img src=":logotype" class="img-fluid rounded-circle bg-secondary bg-opacity-25" alt=":name">
            </a>
        </div>
        <h6 class="text-center hg-4 overflow-hidden">:name</h6>
    </div>
</template>
