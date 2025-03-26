<div class="container-fluid mb-4">
    <h2>{#catalog_categories_page_header#}</h2>
</div>
<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div id="categoriesList" class="row g-3 pb-3">
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
