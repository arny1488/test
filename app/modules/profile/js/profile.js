Dropzone.autoDiscover = false;

class Profile {

    constructor() {

        moment.locale($locale);
        this.remoteSuggestTimeout = null;
        this.docsDZ = null;

        this.build();
        this.events();
    }

    build() {
        this.customSelect();
        this.setSortable();
        this.addValidateMethods();
        this.formValidate();
        this.loadOrganizations();
    }

    events() {
        this.onPhotoUpload();
        this.onGeneratePass();
        this.onAddOrgBtn();
        this.onEditOrg();
        this.onDeleteOrg();
        this.onAddBankBtn();
        this.onDeleteBankBtn();
        this.onDocPreview();
        this.onModalClose();
    }

    setSortable() {

        $(".sortableJS").each((i, e) => {
            new Sortable($(e)[0], {
                animation: 150,
                ghostClass: "bg-light",
                draggable: ".card",
                filter: ".dz-message",
                dataIdAttr: "photo-id",
                onSort: (event) => {
                    // $.ajax(`${API_PATH}/photos/sort`, {
                    //     method: "PATCH",
                    //     data: JSON.stringify({order: this.SZones[album_date].toArray()}),
                    //     dataType: "json",
                    //     contentType: "application/json; charset=utf-8",
                    // })
                    //     .done((data) => {
                    //
                    //         const Toast = Swal.mixin({
                    //             toast: true,
                    //             position: "top-end",
                    //             showConfirmButton: false,
                    //             timer: 3000,
                    //             timerProgressBar: true,
                    //         });
                    //
                    //         Toast.fire({
                    //             icon: "success",
                    //             title: ajaxSuccessMessage,
                    //         });
                    //     })
                    //     .fail((data) => {
                    //         Swal.fire({
                    //             icon: "error",
                    //             title: ajaxErrorStatusMessage,
                    //             text: data?.responseJSON?.message || ajaxErrorStatus500,
                    //             confirmButtonText: buttonOk,
                    //         });
                    //     });
                },
            });
        });

    }

    onSuggest() {

        $("#address1, #actual_address1, #address2, #address3, #address4").typeahead(null, {
            name: "address-suggest",
            limit: 20,
            display: "display",
            source: (query, syncResults, asyncResults) => {
                if (query.length > 2) {
                    clearTimeout(this.remoteSuggestTimeout);
                    this.remoteSuggestTimeout = setTimeout(() => {
                        $.get(`${API_PATH}/suggestions/address?query=${query}`, data => asyncResults(data));
                    }, 250);
                } else {
                    syncResults(null);
                }
            },
        }).bind("typeahead:select", (e, suggestion) => {
            $(e).val(suggestion.raw?.data?.address?.unrestricted_value || "");
        });

        $("#organization_name1, #inn1").typeahead(null, {
            name: "org-suggest",
            limit: 20,
            display: "display",
            source: (query, syncResults, asyncResults) => {
                if (query.length > 2) {
                    clearTimeout(this.remoteSuggestTimeout);
                    this.remoteSuggestTimeout = setTimeout(() => {
                        $.get(`${API_PATH}/suggestions/party/legal?query=${query}`, data => asyncResults(data));
                    }, 250);
                } else {
                    syncResults(null);
                }
            },
        }).bind("typeahead:select", (e, suggestion) => {
            $("#organization_name1")
                .val(suggestion.raw?.data?.name?.short_with_opf || suggestion.raw?.value || "")
                .typeahead("val", suggestion.raw?.data?.name?.short_with_opf || suggestion.raw?.value || "");
            $("#inn1")
                .val(suggestion.raw?.data?.inn || "")
                .typeahead("val", suggestion.raw?.data?.inn || "");
            $("#kpp1").val(suggestion.raw?.data?.kpp || "");
            $("#address1").val(suggestion.raw?.data?.address?.unrestricted_value || "");
        });

        $("#inn2").typeahead(null, {
            name: "individual-suggest",
            limit: 20,
            display: "display",
            source: (query, syncResults, asyncResults) => {
                if (query.length > 2) {
                    clearTimeout(this.remoteSuggestTimeout);
                    this.remoteSuggestTimeout = setTimeout(() => {
                        $.get(`${API_PATH}/suggestions/party/individual?query=${query}`, data => asyncResults(data));
                    }, 250);
                } else {
                    syncResults(null);
                }
            },
        }).bind("typeahead:select", (e, suggestion) => {
            $("#inn2")
                .val(suggestion.raw?.data?.inn || "")
                .typeahead("val", suggestion.raw?.data?.inn || "");
            $("#ogrnip2")
                .val(suggestion.raw?.data?.ogrn || "")
                .typeahead("val", suggestion.raw?.data?.ogrn || "");
            $("#lastname2")
                .val(suggestion.raw?.data?.fio?.surname || "")
                .typeahead("val", suggestion.raw?.data?.fio?.surname || "");
            $("#firstname2").val(suggestion.raw?.data?.fio?.name || "");
            $("#patronymic2").val(suggestion.raw?.data?.fio?.patronymic || "");
            $("#address2").val(suggestion.raw?.data?.address?.unrestricted_value || "");
        });

        $(".bankCard input.bik").typeahead(null, {
            name: "bank-suggest",
            limit: 20,
            display: "display",
            source: (query, syncResults, asyncResults) => {
                if (query.length > 2) {
                    clearTimeout(this.remoteSuggestTimeout);
                    this.remoteSuggestTimeout = setTimeout(() => {
                        $.get(`${API_PATH}/suggestions/bank?query=${query}`, data => asyncResults(data));
                    }, 250);
                } else {
                    syncResults(null);
                }
            },
        }).bind("typeahead:select", (e, suggestion) => {
            const bankCard = $(e.currentTarget).parents(".bankCard").eq(0);
            $(e.currentTarget)
                .val(suggestion.raw?.data?.bic || "")
                .typeahead("val", suggestion.raw?.data?.bic || "");
            bankCard.find(".bank").val(suggestion.raw?.data?.name?.payment || "");
            bankCard.find(".corr").val(suggestion.raw?.data?.correspondent_account || "");
        });

    }

    setDropZone(form) {
        this.docsDZ = new Dropzone(`${form} .dropzone`, {
            dictDefaultMessage: "",
            dictFallbackMessage: "К сожалению, ваш браузер не поддерживает Drag'n'Drop",
            dictFallbackText: "Пожалуйста, воспользуйтесь старой доброй формой для загрузки",
            dictFileTooBig: "Файл слишком большой ({{filesize}}MB). Максимальный допустимый размер файла {{maxFilesize}}MB",
            dictInvalidFileType: "Вы не можете загружать файлы этого типа.",
            dictResponseError: "Произошла ошибка при загрузке файла. Попробуйте еще раз. Если ошибка будет повторяться - передайте эту информацию администратору сайта: Код ошибки {{statusCode}}",
            dictCancelUpload: "Отменить загрузку",
            dictCancelUploadConfirmation: "Уверены, что хотите прервать загрузку?",
            dictRemoveFile: "Удалить файл",
            dictRemoveFileConfirmation: null,
            dictMaxFilesExceeded: "Превышен лимит количества файлов. Вы можете загрузить не более {{maxFiles}}",
            autoProcessQueue: false,
            clickable: `${form} .docDZbtn`,
            maxFiles: 100,
            maxFilesize: 10,
            parallelUploads: 5,
            thumbnailWidth: 150,
            thumbnailHeight: 150,
            url: `${API_PATH}`,
            acceptedFiles: "application/pdf",
            previewTemplate: document.querySelector("#docItemTpl").innerHTML,
            removedfile: (file) => {
                if (!(file.status === "canceled")) {
                    Swal.fire({
                        title: "Удалить файл?",
                        text: file.name,
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: buttonDelete,
                        cancelButtonText: buttonCancel,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (file.previewElement != null && file.previewElement.parentNode != null) {
                                file.previewElement.parentNode.removeChild(file.previewElement);
                            }
                        }
                    });
                } else {
                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    }
                }
            },
        });

        this.docsDZ.on("addedfile", async (file) => {
            const docInput = $(file.previewElement).find(`[name="documents[]"]`).eq(0);
            if (file.base64data) {
                docInput.val(file.base64data);
            } else {
                const doc_file = this.docsDZ.files[0];
                if (doc_file) {
                    let documentBase64 = null;
                    const toBase64 = file => new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = () => resolve(reader.result);
                        reader.onerror = reject;
                    });

                    try {
                        documentBase64 = await toBase64(doc_file);
                        docInput.val(documentBase64);
                    } catch (error) {
                        console.error(error);
                    }
                } else {
                    docInput.val(null);
                }
            }
        });

    }

    loadOrganizations() {
        $.ajax(`${API_PATH}/profile/organizations`, {
            method: "GET",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
        })
            .done((data) => {

                $("#orgList").html("");

                const orgTemplate = $("#orgTemplate").html();

                const types = [
                    "Юридическое лицо",
                    "Индивидуальный предприниматель",
                    "Самозанятый гражданин",
                    "Физическое лицо",
                ];

                if (data.length) {
                    data.forEach((item) => {
                        $("#orgList").append($(orgTemplate
                            .replace(/:id/ig, item.id || 0)
                            .replace(/:name/ig, item.name || "Без названия")
                            .replace(/:inn/ig, item.inn || "Не указан")
                            .replace(/:type/ig, item.type_id || 0)
                            .replace(/:kind/ig, types[item.type_id - 1])));
                    });
                } else {
                    $("#orgList").html("<h5 class=\"text-uppercase text-muted\">Список пуст</h5>");
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

    onAddOrgBtn() {
        $(document).on("click", ".addOrgBtn", (e) => {
            const orgType = $(e.currentTarget).data("type");
            this.addBank($(`#addOrgType${orgType}Modal`).find(".bankWidget").eq(0));
            $(`#addOrgType${orgType}Modal [name="details[default_bank]"]`).eq(0).prop("checked", true);
            $(`#addOrgType${orgType}Modal .orgForm`).attr("method", "POST").attr("action", $(`#addOrgType${orgType}Modal .orgForm`).data("action").replace("/:id", ""));
            this.setDropZone(`#addOrgType${orgType}Modal .orgForm`);
            this.onSuggest();
            $(`#addOrgType${orgType}Modal`).modal("show");
        });
    }

    onEditOrg() {
        $(document).on("click", `[data-action="edit"]`, (e) => {
            const orgType = $(e.currentTarget).data("type");
            $.ajax(e.currentTarget.dataset.href.toString(), {
                method: "GET",
                dataType: "json",
                contentType: "application/json; charset=utf-8",
            })
                .done((data) => {

                    data.banks?.forEach(item => {
                        this.addBank($(`#addOrgType${orgType}Modal .orgForm .bankWidget`).eq(0));
                    });

                    this.setDropZone(`#addOrgType${orgType}Modal .orgForm`);

                    $(`#addOrgType${orgType}Modal .orgForm`).jsonToForm(data, {
                        "documents": (value) => {
                            if (value && value.length) {
                                value.forEach(doc => this.docsDZ.displayExistingFile({name: "document.pdf", size: 1, base64data: doc}, `${ABS_PATH}assets/images/thumb_pdf.jpg`));
                            }
                        },
                    });

                    $(`#addOrgType${orgType}Modal .orgForm`).attr("method", "PATCH").attr("action", $(`#addOrgType${orgType}Modal .orgForm`).data("action").replace(":id", data.id));
                    $(`#addOrgType${orgType}Modal .orgForm [data-action="delete"]`).removeClass("d-none");
                    this.onSuggest();
                    $(`#addOrgType${orgType}Modal`).modal("show");
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

    onDeleteOrg() {
        $(document).on("click", `[data-action="delete"]`, (e) => {

            const url = $(e.currentTarget).parents(".orgForm").eq(0).attr("action");
            const modal = $(e.currentTarget).parents(".modal").eq(0);

            e.preventDefault();
            Swal.fire({
                title: "Удалить организацию?",
                text: "Также будут удалены бренды, контент и предложения, связанные с этой организацией!",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: buttonDelete,
                cancelButtonText: buttonCancel,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax(url, {
                        method: "DELETE",
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                    })
                        .done((data) => {

                            modal.modal("hide");

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

                            this.loadOrganizations();
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

    addBank(widget) {
        const template = $("#bankTpl").html().toString();
        const index = parseInt(widget.find(`[name="details[default_bank]"]`).last().val() || -1) + 1;
        widget.find(".bankWrapper").eq(0).append($(template.replace(/:index/g, index.toString())));
    }

    onAddBankBtn() {
        $(document).on("click", `[data-action="add-bank"]`, (e) => {
            this.addBank($(e.currentTarget).parents(".bankWidget").eq(0));
        });
    }

    onDeleteBankBtn() {
        $(document).on("click", `[data-action="delete-bank"]`, (e) => {
            const widget = $(e.currentTarget).parents(".bankWidget").eq(0);
            if (widget.find(".bankCard").length > 1) {
                $(e.currentTarget).parents(".bankCard").eq(0).remove();
                setTimeout(() => {
                    if (
                        (widget.find(".bankCard").length === 1) ||
                        (widget.find(`[name="details[default_bank]"]:checked`).length === 0)
                    ) {
                        widget.find(`[name="details[default_bank]"]`).eq(0).prop("checked", true);
                    }
                }, 50);
            }
        });
    }

    onDocPreview() {
        $(document).on("click", `#docDZ1 [data-dz-thumbnail], #docDZ2 [data-dz-thumbnail], #docDZ3 [data-dz-thumbnail], #docDZ4 [data-dz-thumbnail]`, (e) => {
            $("#docModal").modal("show");
            $("#pdfData")[0].src = $(e.currentTarget).parents(".card").find(`[name="documents[]"]`).eq(0).val();
        });
    }

    onModalClose() {
        $("#addOrgType1Modal, #addOrgType2Modal, #addOrgType3Modal, #addOrgType4Modal").on("hidden.bs.modal", (e) => {
            Common.clearForm(`#${$(e.currentTarget).find(".orgForm")[0].id}`);
            $(`#${$(e.currentTarget).find(".orgForm")[0].id} *`).typeahead("destroy");
            $(e.currentTarget).find(".bankCard").remove();
            $(e.currentTarget).find(`[data-action="delete"]`).addClass("d-none");
            this.docsDZ.files = [];
            $(this.docsDZ.element).find(".card").each((i, e) => $(e).remove());
            this.docsDZ.destroy();
        });
    }

    customSelect() {

        const formatCountry = country => {
            if (!country.id) {
                return country.text;
            }
            return $(
                "<span>" + country.text + " <span class=\"opacity-75\">" + $(country.element).data("country-name") + "</span>" + "</span>",
            );
        };

        const matchCustom = (params, data) => {
            // If there are no search terms, return all the data
            if ($.trim(params.term) === "") {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === "undefined") {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if ((data.text.toUpperCase().indexOf(params.term.toUpperCase()) > -1) || ($(data.element).data("country-name").toUpperCase().indexOf(params.term.toUpperCase()) > -1)) {
                return data;
            }

            // Return `null` if the term should not be displayed
            return null;
        };

        $(".select2").select2({
            dropdownParent: $("#profileForm"),
            minimumResultsForSearch: 25,
        });

        $(".country-select2").select2({
            dropdownParent: $("#profileForm"),
            minimumResultsForSearch: 25,
            templateResult: formatCountry,
            matcher: matchCustom,
        });

        $(`.select2-selection__rendered`).attr("title", "");

        $(".datepicker").each((index, element) => {
            new TempusDominus(element, {
                //container: $("#verificationForm")[0],
                display: {
                    //theme: $body.data("theme") === "dark" ? "dark" : "light",
                    icons: {
                        type: "icons",
                        time: "mdi mdi-clock-outline",
                        date: "mdi mdi-calendar",
                        up: "mdi mdi-chevron-up",
                        down: "mdi mdi-chevron-down",
                        previous: "mdi mdi-chevron-left",
                        next: "mdi mdi-chevron-right",
                        today: "mdi mdi-calendar-check",
                        clear: "mdi mdi-trash-can-outline",
                        close: "mdi mdi-close",
                    },
                    components: {
                        calendar: true,
                        date: true,
                        month: true,
                        year: true,
                        decades: true,
                        clock: false,
                        hours: false,
                        minutes: false,
                        seconds: false,
                    },
                },
                localization: {...tempusdominus_i18n, format: "L"},
                useCurrent: false,
                viewDate: moment().format("L LT"),
                allowInputToggle: false,
            });
        });

    }

    onPhotoUpload() {

        const croppingImage = $("#croppingImage")[0];
        const imageUploadInput = $("#cropperImageUpload");
        const cropperModal = $("#cropperModal");

        let cropper;

        $(document).on("click", "#profilePhotoBtn", (e) => {
            e.preventDefault();
            imageUploadInput.trigger("click");
            return false;
        });

        imageUploadInput[0].addEventListener("change", (e) => {
            if (e.target.files.length) {

                croppingImage.src = `${ABS_PATH}assets/images/placeholder.jpg`;

                if (cropper) {
                    cropper.destroy();
                }

                // start file reader
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (e.target.result) {
                        cropperModal.modal("show");
                        setTimeout(() => {
                            croppingImage.src = e.target.result;
                            cropper = new Cropper(croppingImage, {
                                aspectRatio: 1,
                                viewMode: 1,
                                autoCropArea: 1,
                            });
                        }, 300);
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        cropperModal.on("hidden.bs.modal", () => {
            imageUploadInput[0].value = null;
        });

        $("#applyCroppedImage").on("click", (e) => {
            e.preventDefault();
            let imgSrc = cropper.getCroppedCanvas({
                width: 1000,
                minWidth: 1000,
                maxWidth: 1000,
            }).toDataURL("image/jpeg", 100);
            $("#profileForm input[name=\"photo\"]").val(imgSrc);
            $("#profilePhoto")[0].src = imgSrc;
            cropperModal.modal("hide");
            return false;
        });
    }

    onGeneratePass() {
        $(document).on("click", ".genPass", (e) => {
            $(e.target).parents(".input-group").eq(0).find(".form-control").eq(0).val(Password.generate(16)).focus().blur();
            $(e.currentTarget).blur();
        });
    }

    addValidateMethods() {

        $.validator.addMethod(
            "phoneWithCode",
            (value, element, arg) => {

                // const code = $("select[name=\"country_code\"]").val();
                const code = $("input[name=\"country_code\"]").val();

                if ((code == null) || (code === "")) {
                    return false;
                }

                const filtered = value.replace(/\D/g, "");

                $(element).val(filtered);

                const phoneNumber = libphonenumber.parsePhoneNumber(value, code);

                if ((filtered !== null) && (filtered !== "") && (filtered.length > 4) && phoneNumber.isValid()) {

                    $(element).val(phoneNumber.nationalNumber);
                    return true;
                }

            },
            validator_i18n.phone,
        );

        $.validator.addMethod(
            "codeWithPhone",
            (value, element, arg) => {

                const valid = ((value !== null) && (value !== ""));

                if (valid) {
                    $(element).removeClass("is-invalid"); //.addClass('is-valid');
                    $(element).siblings(".select2.select2-container").eq(0).find(".select2-selection").removeClass("is-invalid");
                } else {
                    $(element).addClass("is-invalid"); // .removeClass('is-valid')
                    $(element).siblings(".select2.select2-container").eq(0).find(".select2-selection").addClass("is-invalid");
                }

                return valid;
            },
            validator_i18n.select,
        );

    }

    formValidate() {

        $("select").on("select2:close", (e) => {
            $(e.currentTarget).valid();
        });

        $("select[name=\"country_code\"]").on("change", (e) => {
            $("input[name=\"phone\"]").val("");
        });

        const isPasswordPresent = () => {
            return $("input[name=\"password\"]").val().length > 0;
        };

        $("#profileForm").validate({
            rules: {
                lastname: {
                    required: true,
                    minlength: 2,
                },
                firstname: {
                    required: true,
                    minlength: 2,
                },
                patronymic: {
                    required: true,
                    minlength: 2,
                },
                country_code: {
                    required: true,
                    codeWithPhone: true,
                },
                phone: {
                    required: true,
                    phoneWithCode: true,
                    remote: {
                        url: `${API_PATH}/check/phone`,
                        type: "post",
                        dataType: "json",
                        contentType: "application/json",
                        processData: true,
                        beforeSend: (jqXHR, settings) => {
                            settings.data = JSON.stringify({
                                phone: $("input[name=\"phone\"]").val(),
                                country_code: $("input[name=\"country_code\"]").val(),
                                user_id: $("input[name=\"id\"]").val() || null,
                            });
                        },
                    },
                },
                email: {
                    required: true,
                    regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                    remote: {
                        url: `${API_PATH}/check/email`,
                        type: "post",
                        dataType: "json",
                        contentType: "application/json",
                        processData: true,
                        beforeSend: (jqXHR, settings) => {
                            settings.data = JSON.stringify({
                                email: $("input[name=\"email\"]").val(),
                                user_id: $("input[name=\"id\"]").val() || null,
                            });
                        },
                    },
                },
                password: {
                    minlength: {
                        depends: isPasswordPresent,
                        param: 6,
                    },
                },
            },
            messages: {
                lastname: {
                    required: validator_i18n.required,
                    minlength: $.validator.format(validator_i18n.minLength),
                },
                firstname: {
                    required: validator_i18n.required,
                    minlength: $.validator.format(validator_i18n.minLength),
                },
                patronymic: {
                    required: validator_i18n.required,
                    minlength: $.validator.format(validator_i18n.minLength),
                },
                country_code: {
                    required: validator_i18n.required,
                },
                phone: {
                    required: validator_i18n.required,
                    remote: validator_i18n.phone_used,
                },
                email: {
                    required: validator_i18n.required,
                    regex: validator_i18n.email,
                    remote: validator_i18n.email_used,
                },
                password: {
                    required: validator_i18n.required,
                    minlength: $.validator.format(validator_i18n.minLength),
                },
            },
            showErrors: Common.validateCustomErrorMessage,
            errorClass: "is-invalid",
            validClass: "is-valid",
            submitHandler: (form) => {

                $(form).find("button[type=\"submit\"]").buttonLoading(true);

                $.ajax($(form).attr("action"), {
                    method: "PUT",
                    data: JSON.stringify($(form).serializeJSON()),
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                })
                    .done((data) => {

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

        $(".orgForm").each((i, f) => {
            $(f).validate({
                rules: {
                    inn: {
                        required: true,
                        digits: true,
                        regex: /(\d{10})|(\d{12})/,
                    },
                },
                messages: {
                    inn: {
                        required: validator_i18n.required,
                        digits: validator_i18n.digits,
                        regex: validator_i18n.inn,
                    },
                },
                showErrors: Common.validateCustomErrorMessage,
                errorClass: "is-invalid",
                validClass: "is-valid",
                submitHandler: (form) => {

                    $(form).find("button[type=\"submit\"]").buttonLoading(true);

                    $.ajax($(form).attr("action"), {
                        method: $(form).attr("method"),
                        data: JSON.stringify({documents: [], ...$(form).serializeJSON()}),
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                    })
                        .done((data) => {

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

                            $(form).parents(".modal").eq(0).modal("hide");

                            this.loadOrganizations();

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
        });
    }

}

$(document).ready(function () {
    new Profile();
});