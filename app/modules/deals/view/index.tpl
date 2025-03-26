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
                    <a class="nav-link" href="{$ABS_PATH}profile/offers"><span class="h3">Предложения</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{$ABS_PATH}profile/deals"><span class="h3">Сделки</span></a>
                </li>
            </ul>
        </div>
        <div class="col-auto mb-3">
            <button type="button" data-action="add" class="btn btn-outline-primary rounded-pill border-style-dashed"><i class="mdi mdi-plus"></i> {#button_add#}</button>
        </div>
    </div>
    <div id="dealssList" class="row g-3">
        {for $foo=1 to 5}
            <div class="col-12">
                <div class="card bg-transparent" role="button">
                    <div class="card-body">
                        <div class="shimmer hg-4 wd-200 rounded-2 mb-1"></div>
                        <div class="shimmer hg-3 w-100 rounded-2 mb-1"></div>
                        <div class="shimmer hg-3 w-100 rounded-2 mb-1"></div>
                        <div class="shimmer hg-3 w-75 rounded-2 mb-1"></div>
                    </div>
                </div>
            </div>
        {/for}
    </div>
</div>