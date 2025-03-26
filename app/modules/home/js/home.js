class Home {

    constructor() {
        this.build();
        this.events();
    }

    build() {
        this.loadOffers();
        this.loadCategories();
        this.loadBrands();
    }

    events() {
    }

    loadOffers() {
        if ($("#offersList").length) {
            $.ajax(`${API_PATH}/offers`, {
                method: "GET",
                data: {
                    limit: 6,
                    start: 0,
                },
                dataType: "json",
                contentType: "application/json; charset=utf-8",
            })
                .done((data) => {
                    if (data.length) {
                        $("#offersList").html("");
                        const offerTemplate = $("#offerTemplate").html();
                        data.forEach((item) => {
                            const image = item.content?.files[0]?.thumb720 || `${ABS_PATH}assets/images/noimage_4x3.png`;
                            const slides = (item.content?.files.length > 1) ? `data-hover-slides="${item.content?.files.slice(1,6).map(item => `${item.thumb720 || `${ABS_PATH}assets/images/noimage_4x3.png`}`)}"` : '';
                            $("#offersList").append($(offerTemplate
                                .replace(/:name/ig, item.content?.name || "Без названия")
                                .replace(/:id/ig, item.id || "")
                                .replace(/:favorite/ig, item.favorite?.toString() || "false")
                                .replace(/:image/ig, image)
                                .replace(/data-hover-slides=":slides"/ig, slides)));
                        });
                        hoverSlider.prepareMarkup();
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
                                .replace(/:image/ig, item.images?.['4x3'] || `${ABS_PATH}assets/images/noimage_4x3.png`)));
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
    new Home();
});
