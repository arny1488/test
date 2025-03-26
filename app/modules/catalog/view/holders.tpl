<div class="container-fluid mb-4">
    <h2>{#catalog_holders_page_header#}</h2>
</div>
<div class="mb-4 mx-n2 mx-xl-n5 px-2 px-xl-5">
    <div class="container-fluid">
        <div class="row g-3 pb-3">
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