<!-- Modal -->
<div class="modal fade" id="brandModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down">
        <form id="brandForm" data-action="{$API_PATH}/profile/brand/:id" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Бренд</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div id="logoWrap" draggable="true" class="mb-3">
                            <label class="form-label">{#brand_form_files#}</label>
                            <div class="position-relative">
                                <img id="brandImage" src="{$ABS_PATH}assets/images/noimage_1x1.png" data-src="{$ABS_PATH}assets/images/noimage_1x1.png" class="img-fluid rounded-1" alt=""/>
                                <input type="hidden" name="logotype" value="">
                                <input type="file" accept="image/*" class="d-none" id="cropperImageUpload">
                                <button id="brandImageBtn" type="button" class="btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="brand_organization">{#brand_form_organization#} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select id="brand_organization" name="organization_id" class="form-select select2 w-100" data-width="100%" data-placeholder="{#brand_form_organization#}" required>
                                    {foreach from=$organizations item=element}
                                        <option value="{$element.id}">{$element.name}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_name">{#brand_form_name#} <span class="text-danger">*</span></label>
                            <input id="brand_name" value="" type="text" name="name" class="form-control" placeholder="{#brand_form_name#}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_country">{#brand_form_country#} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select id="brand_country" name="country_id" class="form-select select2 w-100" data-width="100%" data-placeholder="{#brand_form_country#}" required>
                                    <option></option>
                                    {foreach from=$countries item=country}
                                        <option value="{$country.id}">{$country.data[Session::getvar('current_language')]}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_notoriety">{#brand_form_notoriety#} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select id="brand_notoriety" name="notoriety_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="{#brand_form_notoriety#}" required>
                                    {foreach from=$notoriety item=element}
                                        <option value="{$element.id}">{$element.data[Session::getvar('current_language')]}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_description">{#brand_form_description#} <span class="text-danger">*</span></label>
                            <textarea id="brand_description" name="description" class="form-control tinymce-editor" placeholder="{#brand_form_description#}" required>{$brand.description}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="brand_document">{#brand_form_document#}</label>
                            <div class="position-relative">
                                <div id="docDZ" class="dropzone form-control d-flex align-content-start flex-wrap gap-2 p-2 no-message user-select-none sortableJS"></div>
                                <button id="docBtn" type="button" class="btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
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