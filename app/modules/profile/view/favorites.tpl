<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 col-md mb-4"><h2>{#favorites_page_header#}</h2></div>
        <div class="col-12 col-md-auto mb-4">
            <button type="button" class="btn btn-flat btn-icon rounded-circle"><i class="mdi mdi-view-grid-outline"></i></button>
            <button type="button" class="btn btn-flat btn-icon rounded-circle"><i class="mdi mdi-view-agenda-outline"></i></button>
            <div class="ms-3 d-inline-block">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed text-body dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-swap-vertical"></i> сортировка
                </button>
                <ul class="dropdown-menu dropdown-menu-end mn-wd-200 mx-wd-350">
                    <li><button class="dropdown-item">По названию</button></li>
                    <li><button class="dropdown-item">По возрастанию цены</button></li>
                    <li><button class="dropdown-item">По убыванию цены</button></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div id="favoritesList" data-start="0" data-limit="24" class="row g-3 pb-3">
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
    </div>
</div>

<template id="offerTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <a class="card hover text-decoration-none item-card" role="button" href="{$ABS_PATH}catalog/offer/:id" data-offer-id=":id" data-favorite=":favorite">
            <div class="position-relative">
                <div class="ratio ratio-4x3">
                    <img src=":logotype" class="card-img-top" alt=":name">
                </div>
                <button type="button" class="favorite" data-action="favorite"><i class="bi"></i></button>
            </div>
            <div class="card-body">
                <h6>:name</h6>
            </div>
        </a>
    </div>
</template>