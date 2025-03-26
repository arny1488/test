<div class="container py-7">
    <div class="row justify-content-center auth-page">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-center">{#login_reset#}</h5>
                </div>
                <form id="newPassForm" role="form" method="post" action="{$ABS_PATH}login/change_password">
                    <input type="hidden" name="email" value="{$email}">
                    <input type="hidden" name="hash" value="{$hash}">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="user_password">{#login_new_password#} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input id="user_password" type="password" autocomplete="new-password" name="password" class="form-control" placeholder="{#login_new_password#}" required>
                                <button class="btn btn-inverse-primary btn-icon showPass" tabindex="-1" type="button"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="user_password_confirm">{#login_new_password_confirm#} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input id="user_password_confirm" type="password" autocomplete="new-password" name="password_confirm" class="form-control" placeholder="{#login_new_password_confirm#}" required>
                                <button class="btn btn-inverse-primary btn-icon showPass" tabindex="-1" type="button"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn w-100 btn-primary btn-icon-text">{#login_change#}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>