<!-- Modal -->
<div class="modal fade" id="addOrgType4Modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-lg-down">
        <form id="addOrgType4Form" data-action="{$API_PATH}/profile/organization/:id" class="modal-content orgForm">
            <input type="hidden" name="type" value="4" data-default-value="4">
            <div class="modal-header">
                <h5 class="modal-title">Физическое лицо</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="inn4">{#profile_form_inn#}</label>
                                    <input id="inn4" name="inn" value="" type="number" class="form-control no-arrows" placeholder="{#profile_form_inn#}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lastname4">{#profile_form_lastname#}</label>
                                    <input id="lastname4" name="details[lastname]" value="" type="text" class="form-control" placeholder="{#profile_form_lastname#}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname4">{#profile_form_firstname#}</label>
                                    <input id="firstname4" name="details[firstname]" value="" type="text" class="form-control" placeholder="{#profile_form_firstname#}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="patronymic4">{#profile_form_patronymic#}</label>
                                    <input id="patronymic4" name="details[patronymic]" value="" type="text" class="form-control" placeholder="{#profile_form_patronymic#}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="birthdate4">{#profile_form_birthdate#}</label>
                                    <input id="birthdate4" name="details[birthdate]" value="" type="text" class="form-control datepicker" placeholder="{#profile_form_birthdate#}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="address4">{#profile_form_address#}</label>
                                    <input id="address4" type="text" name="details[legal_address]" class="form-control typeahead address" placeholder="{#profile_form_address#}" required>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <label class="form-label">{#profile_form_passport_header#}</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="passport_id4">{#profile_form_passport_id#}</label>
                                    <input id="passport_id4" name="details[passport][id]" value="{$user.data.passport.id}" type="number" class="form-control no-arrows" placeholder="{#profile_form_passport_id#}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="passport_date4">{#profile_form_passport_date#}</label>
                                    <input id="passport_date4" name="details[passport][date]" value="{$user.data.passport.date}" type="text" class="form-control datepicker" placeholder="{#profile_form_passport_date#}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="passport_issuer4">{#profile_form_passport_issuer#}</label>
                                    <input id="passport_issuer4" name="details[passport][issuer]" value="{$user.data.passport.issuer}" type="text" class="form-control" placeholder="{#profile_form_passport_issuer#}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="row">
                            <div class="col-12 mt-4 mt-xl-0 bankWidget">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <label class="form-label">{#profile_form_bank_account_header#}</label>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill border-style-dashed mb-2" data-action="add-bank"><i class="mdi mdi-plus"></i> {#button_add#}</button>
                                    </div>
                                </div>
                                <div class="bankWrapper">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-4 mb-3">
                                <label class="form-label">{#profile_form_documents#} <i class="text-primary mdi mdi-information-slab-circle-outline" tabindex="0" data-bs-toggle="popover" data-bs-custom-class="custom-popover" data-bs-trigger="focus"
                                                                                        data-bs-html="true" data-bs-title="Обязательные документы:" data-bs-content="<ul class='text-start mb-0'>
                                        <li>Скан паспорта (стр 2-3);</li>
                                        <li>Скан паспорта (регистрация).</li>
                                    </ul>"></i></label>
                                <div class="position-relative">
                                    <div id="docDZ1" class="dropzone form-control d-flex align-content-start flex-wrap gap-2 p-2 no-message user-select-none sortableJS"></div>
                                    <button type="button" class="docDZbtn btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-danger rounded-pill border-style-dashed d-none" data-action="delete">{#button_delete#}</button>
                <div class="ms-auto">
                    <button type="button" class="btn btn-outline-secondary border-style-dashed rounded-pill" data-bs-dismiss="modal">{#button_cancel#}</button>
                    <button type="submit" class="btn btn-primary rounded-pill">{#button_save#}</button>
                </div>
            </div>
        </form>
    </div>
</div>