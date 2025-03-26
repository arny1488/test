<div class="container-fluid">
    <div class="row justify-content-center justify-content-md-between align-items-center">
        <div class="col-12 col-sm-auto mb-3">
            <ul class="nav nav-underline flex-column flex-sm-row">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{$ABS_PATH}profile/brands"><span class="h3">Бренды</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{$ABS_PATH}profile/content"><span class="h3">Контент</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{$ABS_PATH}profile/offers"><span class="h3">Предложения</span></a>
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
    <div id="brandsList" class="row g-3">
        {for $foo=1 to 4}
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
                <div class="card bg-transparent" role="button">
                    <div class="shimmer ratio ratio-1x1 card-img-top"></div>
                    <div class="card-body">
                        <div class="shimmer hg-4 rounded-2"></div>
                    </div>
                </div>
            </div>
        {/for}
    </div>
</div>

<template id="brandTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2">
        <div class="card hover" data-action="edit" role="button" data-href="{$API_PATH}/profile/brand/:id">
            <img src=":logotype" class="card-img-top" alt=":name">
            <div class="card-body">
                <h6>:name</h6>
            </div>
        </div>
    </div>
</template>

<template id="docItemTpl">
    <div class="card border-1 border-secondary border-opacity-25 shadow-sm mb-auto" style="position: relative">
        <img class="card-img" src="{$ABS_PATH}assets/images/thumb_pdf.jpg" role="button" data-dz-thumbnail/>
        <input type="hidden" name="document" value="">
        <div class="position-absolute" style="width: 150px; height: auto; inset: 0 0 auto;">
            <div class="m-2 px-2 rounded bg-warning shadow-sm dz-error-message">
                <p class="small text-dark" style="width: 100%;" data-dz-errormessage></p>
            </div>
        </div>
        <div class="position-absolute rounded-bottom dz-progress">
            <span class="d-block bg-success" data-dz-uploadprogress></span>
        </div>
        <div class="position-absolute dz-complete-show" style="inset: .25rem .25rem auto auto;">
            <button class="btn btn-icon btn-outline-danger" style="cursor: pointer !important;" type="button">
                <i class="mdi mdi-18px mdi-trash-can-outline" style="cursor: pointer !important;" data-dz-remove></i>
            </button>
        </div>
    </div>
</template>

{$modal_tpl}
{$cropper_tpl}
{$pdf_tpl}