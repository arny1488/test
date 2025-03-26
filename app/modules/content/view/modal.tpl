<!-- Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down">
        <form id="contentForm" data-action="{$API_PATH}/profile/content/:id" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Контент</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="content_name">{#content_form_name#}</label>
                            <input id="content_name" value="" type="text" name="name" class="form-control" placeholder="{#content_form_name#}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="content_type">{#content_form_type#}</label>
                            <div class="input-group">
                                <select id="content_type" name="type_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="{#content_form_type#}" required>
                                    {foreach from=$types item=type}
                                        {if $type.parent == 0}
                                            <option value="{$type.id}">{$type.title}</option>
                                            {foreach from=$types item=sub_element}
                                                {if $type.id == $sub_element.parent}
                                                    <option class="small ps-3" value="{$sub_element.id}">{$sub_element.title}</option>
                                                {/if}
                                            {/foreach}
                                        {/if}
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="content_brand">{#content_form_brand#}</label>
                            <div class="input-group">
                                <select id="content_brand" name="brand_id" class="form-select select2 w-100" data-width="100%" data-placeholder="{#content_form_brand#}" required>
                                    <option></option>
                                    {foreach from=$brands item=brand}
                                        <option value="{$brand.id}">{$brand.name}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        {* <div class="mb-3">
                            <label class="form-label" for="content_description">{#content_form_description#}</label>
                            <textarea id="content_description" name="description" class="form-control tinymce-editor" placeholder="{#content_form_description#}">{$content.description}</textarea>
                        </div> *}
                        <div class="mb-3">
                            <label class="form-label" for="content_document">{#content_form_document#}</label>
                            <div class="position-relative">
                                <div id="docDZ" class="dropzone form-control d-flex align-content-start flex-wrap gap-2 p-2 no-message user-select-none sortableJS"></div>
                                <button id="docBtn" type="button" class="btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="d-flex h-100 flex-column mb-3 pb-3">
                            <div class="flex-grow-0">
                                <label class="form-label mb-1">{#content_form_files#}</label>
                            </div>
                            <div class="flex-grow-1 position-relative">
                                <div id="medaDZ" class="dropzone form-control h-100 d-flex align-content-start flex-wrap gap-2 p-2 no-message user-select-none sortableJS"></div>
                                <button id="mediaBtn" type="button" class="btn btn-lg btn-primary btn-icon rounded-circle m-2 position-absolute end-0 bottom-0"><i class="mdi icon-xl mdi-folder-search-outline"></i></button>
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