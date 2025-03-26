<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-12 col-md mb-4"><h2>{#catalog_brands_page_header#}</h2></div>
        <div class="col-12 col-md-auto mb-4">
            <button type="button" class="btn btn-flat btn-icon rounded-circle"><i class="mdi mdi-view-grid-outline"></i></button>
            <button type="button" class="btn btn-flat btn-icon rounded-circle"><i class="mdi mdi-view-agenda-outline"></i></button>
            <div class="ms-3 d-inline-block">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed text-body dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-swap-vertical"></i> сортировка
                </button>
                <ul class="dropdown-menu dropdown-menu-end mn-wd-200 mx-wd-350">
                    <li><button class="dropdown-item">По названию</button></li>
                    <li><button class="dropdown-item">По новинкам</button></li>
                    <li><button class="dropdown-item">По рейтингу</button></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div id="brandsList" class="row g-3 mb-1 flex-nowrap overflow-hidden">
            {for $foo=1 to 12}
                <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
                    <div class="shimmer ratio ratio-1x1 rounded-circle mb-2" role="button"></div>
                    <div class="shimmer hg-4 rounded-2 w-75 mx-auto"></div>
                </div>
            {/for}
        </div>
    </div>
</div>

<template id="brandTemplate">
    <div class="col-6 col-md-4 col-lg-3 col-xxl-2">
        <div class="ratio ratio-1x1 rounded-circle mb-2">
            <a href="{$ABS_PATH}catalog/brand/:id" class="rounded-circle img-hover">
                <img src=":logotype" class="img-fluid rounded-circle bg-secondary bg-opacity-25" alt=":name">
            </a>
        </div>
        <h6 class="text-center">:name</h6>
    </div>
</template>
