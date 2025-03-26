class Catalog {

    constructor() {
        this.sort_field = "o.created";
        this.sort_order = "DESC";
        this.search = "";
        this.filters = this.getParamsAsObject(location.search)?.filters || [];
        this.applyFiltersFromQuery();
        this.build();
        this.events();
    }

    getParamsAsObject(query) {

        query = query.substring(query.indexOf("?") + 1);

        const re = /([^&=]+)=?([^&]*)/g;
        const decodeRE = /\+/g;

        const decode = function (str) {
            return decodeURIComponent(str.replace(decodeRE, " "));
        };

        let params = {}, e;
        while (e = re.exec(query)) {
            let k = decode(e[1]), v = decode(e[2]);
            if (k.substring(k.length - 2) === "[]") {
                k = k.substring(0, k.length - 2);
                (params[k] || (params[k] = [])).push(v);
            } else params[k] = v;
        }

        const assign = function (obj, keyPath, value) {
            const lastKeyIndex = keyPath.length - 1;
            for (let i = 0; i < lastKeyIndex; ++i) {
                const key = keyPath[i];
                if (!(key in obj))
                    obj[key] = {};
                obj = obj[key];
            }
            obj[keyPath[lastKeyIndex]] = value;
        };

        for (const prop in params) {
            const structure = prop.split("[");
            if (structure.length > 1) {
                const levels = [];
                structure.forEach(function (item, i) {
                    const key = item.replace(/[?[\]\\ ]/g, "");
                    levels.push(key);
                });
                assign(params, levels, params[prop]);
                delete (params[prop]);
            }
        }
        return params;
    };

    build() {
        this.setBadges();
        this.loadOffers();
        this.loadCategories();
        this.loadBrands();
        this.setOwlCarousel();
    }

    events() {
        this.onViewType();
        this.onSort();
        this.onApplyFilters();
    }

    applyFiltersFromQuery() {
        if ($(`#navbarFilter`).length) {
            $(`#navbarFilter`).jsonToForm({
                query: this.filters?.query,
                categories: this.filters?.categories,
            }, {
                "query": (value) => {
                    this.search = value;
                    $(`#navbarFilter [name="query"]`).val(value).trigger("change");
                },
                "categories": (value) => {
                    $(`#navbarFilter [name="categories[]"]`).val(value).trigger("change");
                },
            });
        }
    }

    setOwlCarousel() {
        if ($(".preview-gallery").length) {
            $(".preview-gallery").owlCarousel({
                margin: 10,
                loop: true,
                autoWidth: true,
                center: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 3,
                        nav: false,
                    },
                    1140: {
                        items: 5,
                        nav: true,
                    },
                },
            });
        }
    }

    onViewType() {
        $(document).on("click", `[data-action="view-type"]`, (e) => {
            e.preventDefault();
            const viewType = $(e.currentTarget).data("view-type") || "Grid";
            localStorage.setItem("viewType", viewType);
            this.build();
            $(e.currentTarget).blur();
        });
    }

    onApplyFilters() {
        $(document).on("click", `[data-action="apply_filters"]`, (e) => {
            e.preventDefault();
            const openedCanvas = bootstrap.Offcanvas.getInstance(document.getElementById("navbarFilter"));
            openedCanvas.hide();
            this.filters = $("#navbarFilter").serializeJSON();
            this.build();
            $(e.currentTarget).blur();
        });
    }

    onSort() {
        $(document).on("click", `[data-action="order"]`, (e) => {
            e.preventDefault();
            const el = $(e.currentTarget);
            this.sort_field = $(e.currentTarget).data("sort") || "o.created";
            this.sort_order = $(e.currentTarget).data("order") || "DESC";
            this.build();
            $(e.currentTarget).blur();
        });
    }

    setBadges() {
        if ($("#filtersBadge").length) {
            if (
                this.filters?.categories?.length
                || this.filters?.notoriety?.length
                || this.filters?.application?.length
                || this.filters?.placement?.length
                || this.filters?.country?.length
                || this.filters?.region?.length
                || this.filters?.query?.length
                || this.search?.length
            ) {
                $("#filtersBadge").removeClass("d-none");
            } else {
                $("#filtersBadge").addClass("d-none");
            }
        }
        if ($("#categoriesFilterBadge").length) {
            if (this.filters?.categories?.length) {
                $("#categoriesFilterBadge").removeClass("d-none");
            } else {
                $("#categoriesFilterBadge").addClass("d-none");
            }
        }
        if ($("#groupsFilterBadge").length) {
            if (this.filters?.groups?.length) {
                $("#groupsFilterBadge").removeClass("d-none");
            } else {
                $("#groupsFilterBadge").addClass("d-none");
            }
        }
        if ($("#notorietyFilterBadge").length) {
            if (this.filters?.notoriety?.length) {
                $("#notorietyFilterBadge").removeClass("d-none");
            } else {
                $("#notorietyFilterBadge").addClass("d-none");
            }
        }
        if ($("#applicationFilterBadge").length) {
            if (this.filters?.application?.length) {
                $("#applicationFilterBadge").removeClass("d-none");
            } else {
                $("#applicationFilterBadge").addClass("d-none");
            }
        }
        if ($("#placementFilterBadge").length) {
            if (this.filters?.placement?.length) {
                $("#placementFilterBadge").removeClass("d-none");
            } else {
                $("#placementFilterBadge").addClass("d-none");
            }
        }
        if ($("#territoryFilterBadge").length) {
            if (this.filters?.country?.length || this.filters?.region?.length) {
                $("#territoryFilterBadge").removeClass("d-none");
            } else {
                $("#territoryFilterBadge").addClass("d-none");
            }
        }
    }

    loadOffers() {

        const $offersList = $("#offersList");

        if ($offersList.length) {

            $.ajax(`${API_PATH}/offers`, {
                method: "GET",
                data: {
                    limit: $offersList.data("limit") || 24,
                    start: $offersList.data("start") || 0,
                    sort: this.sort_field,
                    order: this.sort_order,
                    search: this.search,
                    filters: this.filters,
                },
                dataType: "json",
                contentType: "application/json; charset=utf-8",
            })
                .done((data) => {
                    if (data.length) {
                        $offersList.html("");
                        const viewType = ($offersList.data("view") === "switchable") ? (localStorage.getItem("viewType") || "Grid") : "Grid";
                        const offerTemplate = $(`#offerTemplate${viewType}`).html();
                        data.forEach((item) => {

                            const image = item.content?.files[0]?.thumb720 || `${ABS_PATH}assets/images/noimage_4x3.png`;
                            const slides = (item.content?.files.length > 1) ? `data-hover-slides="${item.content?.files.slice(1, 6).map(item => `${item.thumb720 || `${ABS_PATH}assets/images/noimage_4x3.png`}`)}"` : "";

                            $offersList.append($(offerTemplate
                                .replace(/:name/ig, item.content?.name || "Без названия")
                                .replace(/:description/ig, item.description || "")
                                .replace(/:price/ig, new Intl.NumberFormat("ru-RU").format(item.price || 0) + " руб./мес.")
                                .replace(/:term/ig, item.termless ? "Аренда: Бессрочно" : `Аренда: от ${item.term_min} до ${item.term_max} мес.`)
                                .replace(/:id/ig, item.id || "")
                                .replace(/:favorite/ig, item.favorite?.toString() || "false")
                                .replace(/:image/ig, image)
                                .replace(/data-hover-slides=":slides"/ig, slides)));
                        });

                        hoverSlider.prepareMarkup();

                    } else {
                        $offersList.html("<h3>Список пуст</h3>");
                    }
                })
                .fail((data) => {
                    Swal.fire({
                        icon: "error",
                        title: ajaxErrorStatusMessage,
                        text: data?.responseJSON?.message || ajaxErrorStatus500,
                        confirmButtonText: buttonOk,
                    });
                });
        }
    }

    loadCategories() {
        if ($("#categoriesList").length) {
            $.ajax(`${API_PATH}/categories`, {
                method: "GET",
                dataType: "json",
                contentType: "application/json; charset=utf-8",
            })
                .done((data) => {
                    if (data.length) {
                        $("#categoriesList").html("");
                        const categoryTemplate = $("#categoryTemplate").html();
                        data.forEach((item) => {
                            $("#categoriesList").append($(categoryTemplate
                                .replace(/:name/ig, item.title || "Без названия")
                                .replace(/:id/ig, item.id || "")
                                .replace(/:image/ig, item.images?.["4x3"] || `${ABS_PATH}assets/images/noimage_4x3.png`)));
                        });
                    }
                })
                .fail((data) => {
                    Swal.fire({
                        icon: "error",
                        title: ajaxErrorStatusMessage,
                        text: data?.responseJSON?.message || ajaxErrorStatus500,
                        confirmButtonText: buttonOk,
                    });
                });
        }
    }

    loadBrands() {
        if ($("#brandsList").length) {
            $.ajax(`${API_PATH}/brands`, {
                method: "GET",
                data: {
                    limit: 12,
                    start: 0,
                },
                dataType: "json",
                contentType: "application/json; charset=utf-8",
            })
                .done((data) => {
                    if (data.length) {
                        $("#brandsList").html("");
                        const brandTemplate = $("#brandTemplate").html();
                        data.forEach((item) => {
                            $("#brandsList").append($(brandTemplate
                                .replace(/:name/ig, item.name || "Без названия")
                                .replace(/:id/ig, item.id || "")
                                .replace(/:logotype/ig, item.logotype || `${ABS_PATH}assets/images/noimage_1x1.png`)));
                        });
                    }
                })
                .fail((data) => {
                    Swal.fire({
                        icon: "error",
                        title: ajaxErrorStatusMessage,
                        text: data?.responseJSON?.message || ajaxErrorStatus500,
                        confirmButtonText: buttonOk,
                    });
                });
        }
    }

}

$(document).ready(function () {
    new Catalog();
});
