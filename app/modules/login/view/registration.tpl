<div class="container py-7">
    <div class="row justify-content-center auth-page">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-center">{#registration_title#}</h5>
                </div>
                <div class="card-body">
                    <form id="registrationForm" class="text-start" role="form" method="post" action="{$ABS_PATH}login/register">
                        <input type="hidden" class="captcha-response" name="captcha_response">
                        {* <div class="mb-3">
                            <label class="form-label" for="registration_inn">{#registration_form_inn#} <span class="text-danger">*</span></label>
                            <input id="registration_inn" type="number" name="inn" class="form-control no-arrows" placeholder="{#registration_form_inn#}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="registration_firstname">{#registration_form_firstname#} <span class="text-danger">*</span></label>
                            <input id="registration_firstname" type="text" name="firstname" class="form-control" placeholder="{#registration_form_firstname#}" required>
                        </div> *}
                        <div class="mb-3">
                            <label class="form-label" for="registration_email">{#registration_form_email#} <span class="text-danger">*</span></label>
                            <input id="registration_email" type="email" autocomplete="email" name="email" class="form-control" placeholder="{#registration_form_email#}" required>
                            <p class="form-text">{#registration_form_email_tip#}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="registration_phone">{#registration_form_phone#} <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-3">
                                    <input id="registration_code_number" value="+7" type="tel" name="code_number" class="form-control" placeholder="{#registration_form_phone#}" readonly>
                                    <input id="registration_code" name="code" value="RU" type="hidden" required>
                                    {* <div class="input-group">
                                        <select id="code" name="code" class="country-select2 w-100" data-width="100%" data-dropdown-auto-width="true" readonly="readonly">
                                            {foreach from=$countries item=country}
                                                <option value="{$country[1]|strtoupper}" data-country-name="{$country[0]}" data-country-code="+{$country[2]}"
                                                        {if $country[1]|strtoupper == 'RU'}selected{/if}>+{$country[2]}</option>
                                            {/foreach}
                                        </select>
                                    </div> *}
                                </div>
                                <div class="col">
                                    <input id="registration_phone" name="phone" value="" type="tel" class="form-control" placeholder="{#registration_form_phone#}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="registration_password">{#registration_form_pass#} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input id="registration_password" type="password" autocomplete="new-password" name="password" class="form-control" placeholder="{#registration_form_pass_short#}" required>
                                <button class="btn btn-outline-primary btn-icon showPass" tabindex="-1" type="button"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="registration_password_confirm">{#registration_form_pass_confirm#} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input id="registration_password_confirm" type="password" autocomplete="new-password" name="password_confirm" class="form-control" placeholder="{#registration_form_pass_confirm#}" required>
                                <button class="btn btn-outline-primary btn-icon showPass" tabindex="-1" type="button"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>
                        {* <div class="mb-3">
                            <label class="form-label" for="registration_lastname">{#registration_form_lastname#}</label>
                            <input id="registration_lastname" type="text" name="lastname" class="form-control" placeholder="{#registration_form_lastname#}">
                        </div> *}
                        {* <div class="form-check form-check-flat form-check-primary mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="tof_agreement" value="1" required>
                                {#registration_form_agreement#} <a href="{$ABS_PATH}agreement" target="_blank">{#registration_form_tof#}</a>
                            </label>
                        </div>
                        <div class="form-check form-check-flat form-check-primary mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="pp_agreement" value="1" required>
                                {#registration_form_agreement#} <a href="{$ABS_PATH}privacy-policy" target="_blank">{#registration_form_pp#}</a>
                            </label>
                        </div>
                        <div class="form-check form-check-flat form-check-primary mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="pdp_agreement" value="1" required>
                                {#registration_form_agreement#} <a href="{$ABS_PATH}personal-data-processing" target="_blank">{#registration_form_pdp#}</a>
                            </label>
                        </div> *}
                        <p class="small text-muted mb-3">Регистрируясь, вы подтверждаете, что принимаете <a href="/agreement" target="_blank">Условиями использования</a> и даете
                            <a href="/privacy-policy" target="_blank">Согласие</a> на обработку персональных данных.</p>
                        <button type="submit" class="btn w-100 btn-primary btn-icon-text">{#button_register#}</button>
                        <p class="mt-4 text-center">{#login_registered_text#} <a href="{$ABS_PATH}login">{#login_registered_link#}</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>