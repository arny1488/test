<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 col-md mb-4"><h2>{#catalog_offers_page_header#}</h2></div>
        <div class="col-12 col-md-auto mb-4">
            <button type="button" class="btn btn-flat btn-icon rounded-circle" data-action="view-type" data-view-type="Grid"><i class="mdi mdi-view-grid-outline"></i></button>
            <button type="button" class="btn btn-flat btn-icon rounded-circle" data-action="view-type" data-view-type="List"><i class="mdi mdi-view-agenda-outline"></i></button>
            <div class="ms-3 d-inline-block">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed text-body dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-swap-vertical"></i> сортировка
                </button>
                <ul class="dropdown-menu dropdown-menu-end mn-wd-200 mx-wd-350">
                    <li>
                        <button class="dropdown-item" data-action="order" data-sort="o.created" data-order="DESC">По новинкам</button>
                    </li>
                    <li>
                        <button class="dropdown-item" data-action="order" data-sort="c.name" data-order="ASC">По названию</button>
                    </li>
                    <li>
                        <button class="dropdown-item" data-action="order" data-sort="o.price" data-order="ASC">По возрастанию цены</button>
                    </li>
                    <li>
                        <button class="dropdown-item" data-action="order" data-sort="o.price" data-order="DESC">По убыванию цены</button>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed text-body position-relative" data-bs-toggle="offcanvas" data-bs-target="#navbarFilter" aria-controls="navbarFilter" aria-label="Toggle navigation">
                <i class="mdi mdi-tune-variant"></i> фильтры
                <span id="filtersBadge" class="d-none position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>
            </button>
        </div>
    </div>
</div>

<nav class="navbar bg-body-tertiary fixed-top p-0">
    <div class="container-fluid">
        {$filters_tpl}
    </div>
</nav>

<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div id="offersList" data-view="switchable" data-start="0" data-limit="24" class="row g-3 pb-3">
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

<template id="offerTemplateGrid">
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

<template id="offerTemplateList">
    <div class="col-12">
        <a class="card hover text-decoration-none item-card" role="button" href="{$ABS_PATH}catalog/offer/:id" data-offer-id=":id" data-favorite=":favorite">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 col-xxl-3 mb-3 mb-lg-0">
                        <div class="position-relative">
                            <img src=":image" data-hover-slides=":slides" class="rounded-2" alt=":name">
                            <button type="button" class="favorite" data-action="favorite"><i class="bi"></i></button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xxl-6 mb-3 mb-lg-0">
                        <h4 class="mb-3">:name</h4>
                        <div>:description</div>
                    </div>
                    <div class="col-12 col-lg-4 col-xxl-3">
                        <h4 class="mb-3">:price</h4>
                        <div>:term</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</template>
