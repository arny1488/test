<!-- Modal -->
<div class="modal fade" id="addOrgType1Modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-lg-down">
        <form id="addOrgType1Form" data-action="{$API_PATH}/profile/organization/:id" class="modal-content orgForm">
            <input type="hidden" name="type" value="1" data-default-value="1">
            <div class="modal-header">
                <h5 class="modal-title">Юридическое лицо</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="organization_name1">{#profile_form_organization_name#}</label>
                                    <input id="organization_name1" name="name" value="" type="text" class="form-control typeahead name" placeholder="{#profile_form_organization_name#}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inn1">{#profile_form_inn#}</label>
                                    <input id="inn1" name="inn" value="" type="number" class="form-control no-arrows" placeholder="{#profile_form_inn#}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="kpp1">{#profile_form_kpp#}</label>
                                    <input id="kpp1" name="details[kpp]" value="{$user.data.kpp}" type="number" class="form-control no-arrows" placeholder="{#profile_form_kpp#}" required>
                                </div>
                            </div>
                            <div class="col-12 mt-4 mb-3">
                                <label class="form-label" for="address1">{#profile_form_legal_address_header#}</label>
                                <input id="address1" type="text" name="details[legal_address]" class="form-control typeahead address" placeholder="{#profile_form_address#}" required>
                            </div>
                            <div id="addrEq" class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="actual_address1">{#profile_form_actual_address_header#}</label>
                                    <input id="actual_address1" type="text" name="details[actual_address]" class="form-control typeahead address" placeholder="{#profile_form_address#}">
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input name="details[addresses_equal]" type="checkbox" value="1" class="form-check-input addrEq">
                                            {#profile_form_actual_address_eq_legal#}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <label class="form-label">{#profile_form_executive_header#}</label>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="executive_name1">{#profile_form_executive_name#}</label>
                                    <input id="executive_name1" name="details[executive][name]" value="" type="text" class="form-control" placeholder="{#profile_form_executive_name#}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="executive_position1">{#profile_form_executive_position#}</label>
                                    <input id="executive_position1" name="details[executive][position]" value="" type="text" class="form-control" placeholder="{#profile_form_executive_position#}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="executive_reason1">{#profile_form_executive_reason#}</label>
                                    <input id="executive_reason1" name="details[executive][reason]" value="" type="text" class="form-control" placeholder="{#profile_form_executive_reason#}">
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
                                <label class="form-label">{#profile_form_documents#} <i class="text-primary mdi mdi-information-slab-circle-outline" tabindex="0" data-bs-toggle="popover" data-bs-custom-class="custom-popover" data-bs-trigger="focus" data-bs-html="true" data-bs-title="Обязательные документы:" data-bs-content="<ul class='text-start mb-0'>
                                        <li>Решение о назначении директора;</li>
                                        <li>Скан паспорта директора (стр 2-3);</li>
                                        <li>Скан паспорта директора (регистрация);</li>
                                        <li>Устав с отметкой налогового органа;</li>
                                        <li>Св-во ИНН;</li>
                                        <li>Св-во ОГРН;</li>
                                        <li>Выписка из налоговой.</li>
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