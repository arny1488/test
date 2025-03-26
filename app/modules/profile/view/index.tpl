<div class="container-fluid">
    <div class="row g-xxl-5">
        <div class="col-12 col-xxl-6 mb-5">
            <h3 class="mb-3">Аккаунт</h3>
            <form class="row justify-content-center" id="profileForm" action="{$API_PATH}/profile">
                <input type="hidden" name="id" value="{$smarty.const.USERID}">
                <div class="col-md-auto grid-margin stretch-card d-flex flex-column justify-content-center pe-md-5">
                    <div class="text-center" style="min-width: 250px">
                        <a id="profilePhotoBtn" href="#." data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{#button_change#}" class="d-inline-block position-relative">
                            <img id="profilePhoto" class="rounded-circle" style="width: 150px" src="{$user.photo|default:"/uploads/avatars/default.jpg"}" alt="profile">
                            <i class="mdi mdi-camera-iris mdi-24px position-absolute" style="bottom: -5px; right: 0"></i>
                        </a>
                        <input type="hidden" name="photo" value="">
                        <input type="file" accept="image/*" class="d-none" id="cropperImageUpload">
                    </div>
                    <div class="text-center mt-2"><span class="h4">{$user.firstname|default:""} {$user.lastname|default:""}</span></div>
                </div>
                <div class="col-12 col-md">
                    <div class="mb-3">
                        <label class="form-label" for="lastname">{#profile_form_lastname#}</label>
                        <input id="lastname" name="lastname" value="{$user.lastname}" type="text" class="form-control" placeholder="{#profile_form_lastname#}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="firstname">{#profile_form_firstname#}</label>
                        <input id="firstname" name="firstname" value="{$user.firstname}" type="text" class="form-control" placeholder="{#profile_form_firstname#}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="patronymic">{#profile_form_patronymic#}</label>
                        <input id="patronymic" name="patronymic" value="{$user.patronymic}" type="text" class="form-control" placeholder="{#profile_form_patronymic#}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">{#profile_form_email#}{if $user.email_verified}<i class="mdi mdi-check-circle text-success ms-2" title="{#profile_form_email_verified#}"
                                                                                                                data-bs-title="{#profile_form_email_verified#}" data-bs-toggle="tooltip" data-bs-placement="top"></i>{/if}</label>
                        <input id="email" name="email" value="{$user.email}" type="email" class="form-control" placeholder="{#profile_form_email#}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone">{#profile_form_phone#}{if $user.phone_verified}<i class="mdi mdi-check-circle text-success ms-2" title="{#profile_form_phone_verified#}"
                                                                                                                data-bs-title="{#profile_form_phone_verified#}" data-bs-toggle="tooltip" data-bs-placement="top"></i>{/if}</label>
                        <div class="row">
                            <div class="col-3 col-sm-auto">
                                <div style="max-width: 5rem">
                                    <input value="+7" type="tel" class="form-control" placeholder="{#user_country_code#}" readonly data-readonly>
                                    <input id="country_code" name="country_code" value="RU" data-default-value="RU" type="hidden" required>
                                    {* <select id="code" name="code" class="country-select2 w-100" data-width="100%" data-dropdown-auto-width="true">
                                            {if !$user.country_code}
                                                <option value="" data-country-name="" disabled selected>{#profile_form_country_code#}</option>
                                            {/if}
                                            {foreach from=$countries item=country}
                                                <option value="{$country[1]|strtoupper}" data-country-name="{$country[0]}"
                                                        {if $country[1]|strtoupper == $user.country_code}selected{/if}>+{$country[2]}</option>
                                            {/foreach}
                                        </select> *}
                                </div>
                            </div>
                            <div class="col">
                                <input id="phone" name="phone" value="{$user.phone}" type="tel" class="form-control" placeholder="{#profile_form_phone#}" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">{#profile_form_pass_change#}</label>
                        <div class="input-group">
                            <input id="password" name="password" type="text" class="form-control" placeholder="{#profile_form_pass#}">
                            <button type="button" class="btn btn-outline-primary btn-icon genPass" title="{#button_generate#}" data-bs-title="{#button_generate#}" data-bs-toggle="tooltip" data-bs-placement="top"><i class="mdi icon-lg mdi-lock-reset"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary rounded-pill"><i class="mdi mdi-check"></i> {#button_save#}</button>
                </div>
            </form>
        </div>
        <div class="col-12 col-xxl-6 mb-5">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto mb-3">
                    <h3>Мои организации</h3>
                </div>
                <div class="col-auto mb-3">
                    <button type="button" href="#" class="btn btn-outline-primary rounded-pill border-style-dashed" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-plus"></i> {#button_add#}</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item addOrgBtn" href="#" data-type="1">Юридическое лицо</a></li>
                        <li><a class="dropdown-item addOrgBtn" href="#" data-type="2">Индивидуальный предприниматель</a></li>
                        <li><a class="dropdown-item addOrgBtn" href="#" data-type="3">Самозанятый гражданин</a></li>
                        <li><a class="dropdown-item addOrgBtn" href="#" data-type="4">Физическое лицо</a></li>
                    </ul>
                </div>
            </div>
            <div id="orgList" class="row g-3">
                <div class="col-12 text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<template id="orgTemplate">
    <div class="col-12 col-md-6 col-lg-4 col-xxl-6">
        <div class="card hover h-100" role="button" data-action="edit" data-href="{$API_PATH}/profile/organization/:id" data-type=":type">
            <div class="card-body">
                <h4>:name</h4>
                <p class="small text-muted mb-1">:kind</p>
                <p class="mb-0">ИНН: :inn</p>
            </div>
        </div>
    </div>
</template>

<template id="bankTpl">
    <div class="card mb-3 bankCard">
        <div class="card-body pt-3 pb-1">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6>Банк</h6>
                <button type="button" class="btn btn-link text-danger p-0" data-action="delete-bank"><i class="mdi mdi-trash-can-outline"></i></button>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="bank_:index_account_bik">{#profile_form_bank_account_bik#}</label>
                        <input id="bank_:index_account_bik" name="banks[:index][bik]" value="" type="number" class="form-control typeahead bik no-arrows" placeholder="{#profile_form_bank_account_bik#}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="bank_:index_account_id">{#profile_form_bank_account_id#}</label>
                        <input id="bank_:index_account_id" name="banks[:index][account_id]" value="" type="number" class="form-control no-arrows" placeholder="{#profile_form_bank_account_id#}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="bank_:index_name">{#profile_form_bank_name#}</label>
                        <input id="bank_:index_name" name="banks[:index][name]" value="" type="text" class="form-control bank" placeholder="{#profile_form_bank_name#}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="bank_:index_corr_id">{#profile_form_bank_corr_id#}</label>
                        <input id="bank_:index_corr_id" name="banks[:index][corr_id]" value="" type="number" class="form-control corr no-arrows" placeholder="{#profile_form_bank_corr_id#}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input"
                               name="details[default_bank]"
                               value=":index"
                               id="defaultBank:index"
                               required>
                        <label class="form-check-label" for="defaultBank:index">
                            Основной банк
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="docItemTpl">
    <div class="card border-1 border-secondary border-opacity-25 shadow-sm mb-auto" style="position: relative">
        <img class="card-img" src="{$ABS_PATH}assets/images/thumb_file.jpg" role="button" data-dz-thumbnail/>
        <input type="hidden" name="documents[]" value="">
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

{$cropper_tpl}
{$add_org1_tpl}
{$add_org2_tpl}
{$add_org3_tpl}
{$add_org4_tpl}
{$pdf_tpl}