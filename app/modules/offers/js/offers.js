class Offers {

    constructor() {
        this.build();
        this.events();
    }

    build() {
        this.customSlider();
        this.customSelect();
        this.loadOffers();
        this.formValidate();
    }

    events() {
        this.onAdd();
        this.onEdit();
        this.onDelete();
        this.onModalClose();
    }

    customSlider() {

        const term_slider = new Slider("#offer_term", {
            // initial options object
        });

        const term_min = $("input[name=\"term_min\"]");
        const term_max = $("input[name=\"term_max\"]");

        term_slider.on("change", () => {
            const values = term_slider.getValue();
            term_min.val(values[0]);
            term_max.val(values[1]);
        });

        $(document).on("change", "input[name=\"term_min\"], input[name=\"term_max\"]", () => {

            const values = [parseInt(term_min.val()), parseInt(term_max.val())].sort((a, b) => {
                return a - b;
            });

            term_min.val(values[0]);
            term_max.val(values[1]);
            term_slider.setValue(values);
        });
    }

    customSelect() {

        $(".select2").select2({
            dropdownParent: $("#offerModal"),
            minimumResultsForSearch: 10,
            templateResult: (data, container) => {
                if (data.element) {
                    $(container).addClass($(data.element).attr("class"));
                }
                return data.text;
            },
        });

        $(document).on("change input", `[name="price"]`, (e) => {
            const price = isNaN(parseFloat($(e.currentTarget).val())) ? 0 : Math.round(parseFloat($(e.currentTarget).val()));
            $("#offer_income").html((price * 0.8).toFixed(0).toString());
        });

        $(document).on("change", "#offer_termless", (e) => {
            if ($(e.currentTarget).is(":checked")) {
                $("#offer_terms").hide();
            } else {
                $("#offer_terms").show();
            }
        });

        $(document).on("select2:select", "#allowed_for", (e) => {
            if (e.params.data.id === "*") {
                $(e.currentTarget).val(["1", "2", "3", "4"]).trigger("change");
            } else if (e.params.data.id !== "*") {
                $(e.currentTarget).val([...$(e.currentTarget).val()].filter(item => item !== "*")).trigger("change");
            }
        });

        $(document).on("select2:unselect", "#allowed_for", (e) => {
            if (!($(e.currentTarget).val()).length) {
                $(e.currentTarget).val(["1", "2", "3", "4"]).trigger("change");
            }
        });

        $(document).on("change", "#offer_charity", (e) => {
            if ($(e.currentTarget).is(":checked")) {
                $("#offer_charity_wrapper").show();
            } else {
                $("#offer_charity_wrapper").hide();
            }
        });

    }

    onAdd() {
        $(document).on("click", `[data-action="add"]`, (e) => {
            e.preventDefault();
            $("#offerForm").attr("method", "POST").attr("action", $("#offerForm").data("action").replace("/:id", ""));
            $("#offerModal").modal("show");
        });
    }

    onEdit() {
        $(document).on("click", `[data-action="edit"]`, (e) => {
            e.preventDefault();
            $.ajax(e.currentTarget.dataset.href.toString(), {
                method: "GET",
                dataType: "json",
                contentType: "application/json; charset=utf-8",
            })
                .done((data) => {

                    $(`#offerForm`).jsonToForm(data, {
                        "allowed_for_ids": (value) => {
                            $(`#offerForm [name="allowed_for_ids[]"]`).val(value).trigger("change");
                        },
                        "application_ids": (value) => {
                            $(`#offerForm [name="application_ids[]"]`).val(value).trigger("change");
                        },
                        "region_ids": (value) => {
                            $(`#offerForm [name="region_ids[]"]`).val(value).trigger("change");
                        },
                        "placement_ids": (value) => {
                            $(`#offerForm [name="placement_ids[]"]`).val(value).trigger("change");
                        },
                    });

                    $("#offerForm").attr("method", "PATCH").attr("action", $("#offerForm").data("action").replace(":id", data.id));
                    $(`#offerForm [data-action="delete"]`).removeClass("d-none");
                    $("#offerModal").modal("show");

                })
                .fail((data) => {
                    Swal.fire({
                        icon: "error",
                        title: ajaxErrorStatusMessage,
                        text: data?.responseJSON?.message || ajaxErrorStatus500,
                        confirmButtonText: buttonOk,
                    });
                });
        });
    }

    onDelete() {
        $(document).on("click", `#offerForm [data-action="delete"]`, (e) => {
            e.preventDefault();
            Swal.fire({
                title: "Удалить предложение?",
                text: "Сделки, связанные с этим предложением, удалены не будут.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: buttonDelete,
                cancelButtonText: buttonCancel,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax($("#offerForm").attr("action"), {
                        method: "DELETE",
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                    })
                        .done((data) => {
                            $("#offerModal").modal("hide");

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "bottom",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });

                            Toast.fire({
                                icon: "success",
                                title: ajaxSuccessMessage,
                            });

                            this.loadOffers();
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
            });
        });
    }

    onModalClose() {
        $("#offerModal").on("hidden.bs.modal", () => {
            Common.clearForm("#offerForm");
            $(`#offerForm [data-action="delete"]`).addClass("d-none");
        });
    }

    loadOffers() {
        $.ajax(`${API_PATH}/profile/offers`, {
            method: "GET",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
        })
            .done((data) => {
                $("#offersList").html("");

                const offerTemplate = $("#offerTemplate").html();

                if (data.length) {
                    data.forEach((item) => {
                        $("#offersList").append($(offerTemplate
                            .replace(/:name/ig, item.content?.name || "Без названия")
                            .replace(/:id/ig, item.id || "")
                            .replace(/:logotype/ig, item.content?.files[0]?.thumb720 || `${ABS_PATH}assets/images/noimage_4x3.png`)));
                    });
                } else {
                    $("#offersList").html("<h5 class=\"text-uppercase text-muted\">Список пуст</h5>");
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

    formValidate() {

        $("#offerForm").validate({
            rules: {
                content_id: {
                    required: true,
                },
                description: {
                    required: true,
                },
                price: {
                    required: true,
                },
                "allowed_for_ids[]": {
                    required: true,
                },
                "application_ids[]": {
                    required: true,
                },
                country_id: {
                    required: true,
                },
                "region_ids[]": {
                    required: true,
                },
                "placement_ids[]": {
                    required: true,
                },
            },
            messages: {
                content_id: {
                    required: validator_i18n.required,
                },
                description: {
                    required: validator_i18n.required,
                },
                price: {
                    required: validator_i18n.required,
                },
                "allowed_for_ids[]": {
                    required: validator_i18n.required,
                },
                "application_ids[]": {
                    required: validator_i18n.required,
                },
                country_id: {
                    required: validator_i18n.required,
                },
                "region_ids[]": {
                    required: validator_i18n.required,
                },
                "placement_ids[]": {
                    required: validator_i18n.required,
                },
            },
            showErrors: Common.validateCustomErrorMessage,
            errorClass: "is-invalid",
            validClass: "is-valid",
            submitHandler: (form) => {

                $(form).find("button[type=\"submit\"]").buttonLoading(true);

                $.ajax($(form).attr("action"), {
                    method: $(form).attr("method"),
                    data: JSON.stringify($(form).serializeJSON()),
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                })
                    .done((data) => {
                        $("#offerModal").modal("hide");

                        const Toast = Swal.mixin({
                            toast: true,
                            position: "bottom",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });

                        Toast.fire({
                            icon: "success",
                            title: ajaxSuccessMessage,
                        });

                        this.loadOffers();

                    })
                    .fail((data) => {
                        Swal.fire({
                            icon: "error",
                            title: ajaxErrorStatusMessage,
                            text: data?.responseJSON?.message || ajaxErrorStatus500,
                            confirmButtonText: buttonOk,
                        });
                    })
                    .always(() => {
                        $(form).find("button[type=\"submit\"]").buttonLoading(false);
                    });
            },
        });
    }

}

$(document).ready(function () {
    new Offers();
});