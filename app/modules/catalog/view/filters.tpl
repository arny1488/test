<form class="offcanvas offcanvas-end wd-100p-f wd-md-500-f" tabindex="-1" id="navbarFilter" aria-labelledby="navbarFilterLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="navbarFilterLabel">Фильтры</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body position-relative p-0 overflow-y-hidden">
        <div class="h-100 position-relative PerfectScrollbar">
            <div class="m-3">
                <input type="hidden" name="sort_field" value="0">
                <input type="hidden" name="sort_order" value="desc">

                <div class="mb-3" role="search"><i class="search-icon bi bi-search"></i> <input type="search" name="query" value="" class="form-control" placeholder="Поиск..."></div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#categoriesFilter">
                                Категории
                                <span id="categoriesFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#categoriesFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="categoriesFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                {foreach from=$filters_categories item=element}
                                    {if $element.parent == 0}
                                        <div class="form-check mb-2">
                                            <input type="checkbox" data-parent="0" class="form-check-input" id="categories_{$element.id}"
                                                   name="categories[]" value="{$element.id}">
                                            <label class="form-check-label" for="categories_{$element.id}">
                                                {$element.title}
                                            </label>
                                        </div>
                                        {foreach from=$filters_categories item=sub_element}
                                            {if $element.id == $sub_element.parent}
                                                <div class="form-check mb-2 ms-3">
                                                    <input type="checkbox" data-parent="{$element.id}" class="form-check-input" id="categories_{$sub_element.id}" name="categories[]"
                                                           value="{$sub_element.id}">
                                                    <label class="form-check-label small" for="categories_{$sub_element.id}">
                                                        {$sub_element.title}
                                                    </label>
                                                </div>
                                            {/if}
                                        {/foreach}
                                    {/if}
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col"><h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#groupsFilter">
                                Доступно для
                                <span id="groupsFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#groupsFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="groupsFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                {foreach from=$groups item=element}
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="groups_{$element.id}" name="groups[]" value="{$element.id}">
                                        <label class="form-check-label" for="groups_{$element.id}">
                                            {$element.name}
                                        </label>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#notorietyFilter">
                                Популярность бренда
                                <span id="notorietyFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#notorietyFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="notorietyFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                {foreach from=$filters_notoriety item=element}
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="notoriety_{$element.id}" name="notoriety[]" value="{$element.id}">
                                        <label class="form-check-label" for="notoriety_{$element.id}">
                                            {$element.data['ru']}
                                        </label>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#applicationFilter">
                                Сфера применения контента
                                <span id="applicationFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#applicationFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="applicationFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                {foreach from=$filters_application item=group}
                                    {if !$group.parent_id}
                                        <p class="fw-bold text-muted mb-1">{$group.data[Session::getvar('current_language')]}</p>
                                        {foreach from=$filters_application item=element}
                                            {if $group.id == $element.parent_id}
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" id="application_{$element.id}" name="application[]" value="{$element.id}">
                                                    <label class="form-check-label" for="application_{$element.id}">
                                                        {$element.data['ru']}
                                                    </label>
                                                </div>
                                            {/if}
                                        {/foreach}
                                    {/if}
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#placementFilter">
                                Размещение
                                <span id="placementFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#placementFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="placementFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                {foreach from=$filters_placement item=element}
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="placement_{$element.id}" name="placement[]" value="{$element.id}">
                                        <label class="form-check-label" for="placement_{$element.id}">
                                            {$element.data['ru']}
                                        </label>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group mb-3">
                    <div class="row align-items-center pb-2">
                        <div class="col">
                            <h6 class="m-0 py-1 cursor-pointer filter-group-title position-relative d-inline-block" data-bs-toggle="collapse" href="#territoryFilter">
                                Территория
                                <span id="territoryFilterBadge" class="d-none position-absolute top-0 start-100 p-1 bg-danger border border-light rounded-circle"></span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <button data-bs-toggle="collapse" href="#territoryFilter" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i class="mdi mdi-chevron-down vertical-center"></i></button>
                        </div>
                    </div>
                    <div id="territoryFilter" class="collapse">
                        <div class="card">
                            <div class="card-body p-2 pb-0">
                                {foreach from=$filters_countries item=country}
                                    {if is_array($filters_regions[$country.id]) && count($filters_regions[$country.id])}
                                        <div class="row g-0 align-items-center mb-2">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="country_{$country.id}" name="country[]" value="{$country.id}">
                                                    <label class="form-check-label" for="country_{$country.id}">
                                                        {$country.data['ru']}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button data-bs-toggle="collapse" href="#regionsFilter_{$country.id}" type="button" class="btn btn-icon btn-sm btn-outline-primary rounded-circle text-body"><i
                                                            class="mdi mdi-chevron-down vertical-center"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="regionsFilter_{$country.id}" class="collapse">
                                            <div class="ms-3">
                                                {foreach from=$filters_regions[$country.id] item=region}
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="region_{$region.id}" name="region[]" value="{$region.id}">
                                                        <label class="form-check-label small" for="region_{$region.id}">
                                                            {$region.data['ru']}
                                                        </label>
                                                    </div>
                                                {/foreach}
                                            </div>
                                        </div>
                                    {else}
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="country_{$country.id}" name="country[]" value="{$country.id}">
                                            <label class="form-check-label" for="country_{$country.id}">
                                                {$country.data['ru']}
                                            </label>
                                        </div>
                                    {/if}
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="exclusive" name="exclusive" {if $_filters.exclusive} checked {/if}>
                        <label class="form-check-label" for="exclusive">
                            Эксклюзивное предложение
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="fast_deal" name="fast_deal" {if $_filters.fast_deal} checked {/if}>
                        <label class="form-check-label" for="fast_deal">
                            Быстрая сделка
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="offer_price">Цена, руб / мес</label>
                    <div class="row mb-1">
                        <div class="col-6">
                            <input value="{$_filters.price_min|default:$min_price}" type="number" min="{$min_price}" max="{$max_price}" step="1000" name="price_min" class="form-control form-control-xs" required>
                        </div>
                        <div class="col-6">
                            <input value="{$_filters.price_max|default:$max_price}" type="number" min="{$min_price}" max="{$max_price}" step="1000" name="price_max" class="form-control form-control-xs" required>
                        </div>
                    </div>
                    <!--div class="px-2">
                <input id="offer_price" type="text"
                       data-slider-min="{$min_price}" data-slider-max="{$max_price}" data-slider-step="1000"
                       data-slider-value="[{$_filters.price_min|default:$min_price},{$_filters.price_max|default:$max_price}]">
            </div-->
                </div>
                <div class="mb-3">
                    <label class="form-label" for="offer_term">Срок, мес</label>
                    <div class="row mb-1">
                        <div class="col-6">
                            <input value="{$_filters.term_min|default:$min_term}" type="number" min="{$min_term}" max="{$max_term}" step="1" name="term_min" class="form-control form-control-xs">
                        </div>
                        <div class="col-6">
                            <input value="{$_filters.term_max|default:$max_term}" type="number" min="{$min_term}" max="{$max_term}" step="1" name="term_max" class="form-control form-control-xs">
                        </div>
                    </div>
                    <!--div class="px-2">
                <input id="offer_term" type="text"
                       data-slider-min="{$min_term}" data-slider-max="{$max_term}" data-slider-step="1"
                       data-slider-value="[{$_filters.term_min|default:$min_term},{$_filters.term_max|default:$max_term}]">
            </div-->
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-bottom p-3 border-top">
        <button type="button" class="btn btn-primary w-100 d-block" data-action="apply_filters">Применить</button>
    </div>
</form>
