<!-- Modal -->
<div class="modal fade" id="offerModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down">
        <form id="offerForm" data-action="{$API_PATH}/profile/offer/:id" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Предложение</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="offer_content">{#offer_form_content#}</label>
                            <div class="input-group">
                                <select id="offer_content" name="content_id" class="form-select select2 w-100" data-width="100%" data-placeholder="{#offer_form_content#}" required>
                                    <option></option>
                                    {foreach from=$contents item=element}
                                        <option value="{$element.id}">{$element.name}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="offer_description">{#offer_form_description#}</label>
                            <textarea id="offer_description" name="description" class="form-control tinymce-editor" placeholder="{#offer_form_description#}"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="offer_price">{#offer_form_price#}</label>
                            <input id="offer_price" name="price" value="100" data-default-value="100" type="number" min="100" step="20" class="form-control" placeholder="{#offer_form_price#}" required>
                            <p class="form-text text-danger">{#offer_form_price_hint_1#}<span id="offer_income" class="px-1 fw-bold">80</span>{#offer_form_price_hint_2#}</p>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input id="offer_termless" name="termless" type="checkbox" class="form-check-input" value="1" data-default-value="1">
                                    {#offer_form_termless#}</label>
                            </div>
                        </div>
                        <div class="mb-3" id="offer_terms" data-default-visibility="visible">
                            <label class="form-label" for="offer_term">{#offer_form_term#}</label>
                            <div class="row mb-1">
                                <div class="col-6">
                                    <input value="1" data-default-value="1" type="number" min="1" max="120" step="1" name="term_min" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <input value="120" data-default-value="120" type="number" min="1" max="120" step="1" name="term_max" class="form-control" required>
                                </div>
                            </div>
                            <div class="px-2">
                                <input id="offer_term" type="text" required
                                       data-slider-min="1" data-slider-max="120" data-slider-step="1" data-slider-tooltip="hide"
                                       data-slider-value="[1,120]">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input name="fast_deal" type="checkbox" class="form-check-input" value="1" data-default-value="1">
                                    {#offer_form_fast_deal#}</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input name="exclusive" type="checkbox" class="form-check-input" value="1" data-default-value="1">
                                    {#offer_form_exclusive#}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label" for="allowed_for">{#offer_form_allowed_for#}</label>
                            <div class="input-group">
                                <select id="allowed_for" name="allowed_for_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="{#offer_form_allowed_for#}" data-default-value="[1,2,3,4]" required>
                                    <option value="*">Все</option>
                                    {foreach from=$groups item=element}
                                        <option value="{$element.id}" selected>{$element.name}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="offer_application">{#offer_form_application#}</label>
                            <div class="input-group">
                                <select id="offer_application" name="application_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="{#offer_form_application#}" required>
                                    {foreach from=$application item=group}
                                        {if !$group.parent_id}
                                            <optgroup label="{$group.data[Session::getvar('current_language')]}">
                                                {foreach from=$application item=element}
                                                    {if $group.id == $element.parent_id}
                                                        <option value="{$element.id}">{$element.data[Session::getvar('current_language')]}</option>
                                                    {/if}
                                                {/foreach}
                                            </optgroup>
                                        {/if}
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="offer_country">{#offer_form_country#}</label>
                            <div class="input-group">
                                <select id="offer_country" name="country_id" class="form-select select2 w-100" data-width="100%" data-placeholder="{#offer_form_country#}" required>
                                    <option></option>
                                    {foreach from=$countries item=country}
                                        <option value="{$country.id}">{$country.data[Session::getvar('current_language')]}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="offer_region">{#offer_form_region#}</label>
                            <div class="input-group">
                                <select id="offer_region" name="region_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-default-value="0" required>
                                    <option value="0" selected>{#offer_form_region_any#}</option>
                                    {foreach from=$regions key=key item=country}
                                        <optgroup label="" class="d-none">
                                            {foreach from=$country item=region}
                                                <option value="{$region.id}" data-country-id="{$key}" {if $key != $offer.country_id} class="d-none" {/if}>{$region.data[Session::getvar('current_language')]}</option>
                                            {/foreach}
                                        </optgroup>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="offer_placement">{#offer_form_placement#}</label>
                            <div class="input-group">
                                <select id="offer_placement" name="placement_ids[]" multiple="multiple" class="form-select select2 w-100" data-width="100%" data-placeholder="{#offer_form_placement#}" required>
                                    {foreach from=$placement item=element}
                                        <option value="{$element.id}">{$element.data[Session::getvar('current_language')]}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input id="offer_charity" name="charity" type="checkbox" class="form-check-input" value="1" data-default-value="1">
                                    {#offer_form_charity#}</label>
                            </div>
                        </div>
                        <div id="offer_charity_wrapper" style="display: none" data-default-visibility="hidden">
                            <div class="mb-3">
                                <label class="form-label" for="offer_fund">{#offer_form_fund#}</label>
                                <div class="input-group">
                                    <select id="offer_fund" name="fund_id" class="form-select select2 w-100" data-width="100%" data-placeholder="{#offer_form_fund#}">
                                        <option></option>
                                        {foreach from=$funds item=element}
                                            <option value="{$element.id}">{$element.name}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_charity_percent">{#offer_form_charity_percent#}</label>
                                        <input id="offer_charity_percent" value="0" data-default-value="0" type="number" min="0" max="100" name="charity_percent" class="form-control" placeholder="{#offer_form_charity_percent#}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_charity_sum">{#offer_form_charity_sum#}</label>
                                        <input id="offer_charity_sum" value="0" data-default-value="0" type="number" min="0" step="1" name="charity_sum" class="form-control" placeholder="{#offer_form_charity_sum#}">
                                    </div>
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