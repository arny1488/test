<div class="container">
    <div class="row justify-content-center auth-page">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border-danger">
                <div class="card-header">
                    <h5 class="text-center text-danger">{#error_page_title#}: {$_header}</h5>
                </div>
                <div class="card-body">
                    <p class="mb-4 text-center" style="text-wrap: balance;">{$_message}</p>
                    <a href="{$ABS_PATH}" class="btn w-100 btn-primary btn-icon-text">{#goto_home_page#}</a>
                </div>
            </div>
        </div>
    </div>
</div>