Dropzone.autoDiscover = false;

class Brands {

    constructor() {

        this.docsDZ = null;
        this.build();
        this.events();
    }

    build() {
        this.customSelect();
        this.setDropZone();
        this.setSortable();
        this.formValidate();
        this.loadBrands();
    }

    events() {
        this.onAdd();
        this.onEdit();
        this.onDelete();
        this.onPhotoUpload();
        this.onDocPreview();
        this.onModalClose();
    }

    setDropZone() {
        this.docsDZ = new Dropzone(`.dropzone`, {
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
            clickable: "#docBtn",
            maxFiles: 1,
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
                        $("#docBtn").buttonDisabled($(this.docsDZ.element).find(".card").length > 0);
                    });
                } else {
                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    }
                }
            },
        });

        this.docsDZ.on("addedfile", async (file) => {
            const docInput = $(file.previewElement).find(`[name="document"]`).eq(0);
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
            $("#docBtn").buttonDisabled($(this.docsDZ.element).find(".card").length > 0);
        });

    }

    loadBrands() {
        $.ajax(`${API_PATH}/profile/brands`, {
            method: "GET",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
        })
            .done((data) => {
                $("#brandsList").html("");

                const brandTemplate = $("#brandTemplate").html();

                if (data.length) {
                    data.forEach((item) => {
                        $("#brandsList").append($(brandTemplate
                            .replace(/:name/ig, item.name || "Без названия")
                            .replace(/:id/ig, item.id || "")
                            .replace(/:logotype/ig, item.logotype || `${ABS_PATH}assets/images/noimage_1x1.png`)));
                    });
                } else {
                    $("#brandsList").html("<h5 class=\"text-uppercase text-muted\">Список пуст</h5>");
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

    customSelect() {
        $(".select2").select2({
            dropdownParent: $("#brandModal"),
            minimumResultsForSearch: 10,
        });
    }

    onAdd() {
        $(document).on("click", `[data-action="add"]`, (e) => {
            e.preventDefault();
            $("#brandForm").attr("method", "POST").attr("action", $("#brandForm").data("action").replace("/:id", ""));
            $("#brandModal").modal("show");
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

                    $(`#brandForm`).jsonToForm(data, {
                        "logotype": (value) => {
                            $(`#brandForm #brandImage`)[0].src = value || `${ABS_PATH}assets/images/noimage_1x1.png`;
                            $(`#brandForm [name="logotype"]`).val("");
                        },
                        "document": (value) => {
                            if (value) {
                                this.docsDZ.displayExistingFile({name: "document.pdf", size: 1, base64data: value}, `${ABS_PATH}assets/images/thumb_pdf.jpg`);
                            }
                        },
                        "notoriety_ids": (value) => {
                            $(`#brand_notoriety`).val(value).trigger("change");
                        },
                    });

                    $("#brandForm").attr("method", "PATCH").attr("action", $("#brandForm").data("action").replace(":id", data.id));
                    $(`#brandForm [data-action="delete"]`).removeClass("d-none");
                    $("#brandModal").modal("show");

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
        $(document).on("click", `#brandForm [data-action="delete"]`, (e) => {
            e.preventDefault();
            Swal.fire({
                title: "Удалить бренд?",
                text: "Также будут удалены контент и предложения, связанные с этим брендом!",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: buttonDelete,
                cancelButtonText: buttonCancel,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax($("#brandForm").attr("action"), {
                        method: "DELETE",
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                    })
                        .done((data) => {
                            $("#brandModal").modal("hide");

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

                            this.loadBrands();
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

    onPhotoUpload() {

        const croppingImage = $("#croppingImage")[0];
        const imageUploadInput = $("#cropperImageUpload");
        const cropperModal = $("#cropperModal");

        let cropper;

        $(document).on("click", "#brandImageBtn", (e) => {
            e.preventDefault();
            imageUploadInput.trigger("click");
            return false;
        });

        imageUploadInput[0].addEventListener("change", (e) => {
            if (e.target.files.length) {

                croppingImage.src = `${ABS_PATH}assets/images/noimage_1x1.png`;

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
                                viewMode: 0,
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
            }).toDataURL("image/png", 100);
            $("#brandForm input[name=\"logotype\"]").val(imgSrc);
            $("#brandImage")[0].src = imgSrc;
            cropperModal.modal("hide");
            return false;
        });
    }

    onDocPreview() {
        $(document).on("click", `#docDZ [data-dz-thumbnail]`, (e) => {
            $("#docModal").modal("show");
            $("#pdfData")[0].src = $(e.currentTarget).parents(".card").find(`[name="document"]`).eq(0).val();
        });
    }

    onModalClose() {
        $("#brandModal").on("hidden.bs.modal", () => {
            Common.clearForm("#brandForm");
            $("#brandImage")[0].src = $("#brandImage").data("src");
            this.docsDZ.files = [];
            $(this.docsDZ.element).find(".card").each((i, e) => $(e).remove());
            $("#docBtn").buttonDisabled(false);
            $(`#brandForm [data-action="delete"]`).addClass("d-none");
        });

        $("#docModal").on("hidden.bs.modal", () => {
            $("#pdfData")[0].src = null;
        });
    }

    formValidate() {

        $("#brandForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                },
                organization_id: {
                    required: true,
                },
                country: {
                    required: true,
                },
                "notoriety[]": {
                    required: true,
                },
                description: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: validator_i18n.required,
                },
                organization_id: {
                    required: validator_i18n.required,
                },
                country: {
                    required: validator_i18n.required,
                },
                "notoriety[]": {
                    required: validator_i18n.required,
                },
                description: {
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
                    data: JSON.stringify({document: "", ...$(form).serializeJSON()}),
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                })
                    .done((data) => {
                        $("#brandModal").modal("hide");

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

                        this.loadBrands();

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
    new Brands();
});