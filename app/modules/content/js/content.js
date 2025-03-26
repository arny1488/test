Dropzone.autoDiscover = false;

class Content {

    constructor() {

        this.docsDZ = null;
        this.mediaDZ = null;
        this.mediaDZ_processing = false;
        this.mediaDZ_progress = 0;
        this.build();
        this.events();
    }

    build() {
        this.customSelect();
        this.setDropZone();
        this.setSortable();
        this.formValidate();
        this.loadContent();
    }

    events() {
        this.onAdd();
        this.onEdit();
        this.onDelete();
        this.onDocPreview();
        this.onModalClose();
    }

    setDropZone() {

        const dzOptions = {
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
            thumbnailWidth: 150,
            thumbnailHeight: 150,
            createImageThumbnails: false,
        };

        this.mediaDZ = new Dropzone(`#medaDZ`, {
            ...dzOptions,
            url: `${API_PATH}`,
            clickable: "#mediaBtn",
            chunking: true,
            chunkSize: 10 * 1024 * 1024, // 10 MB
            maxFilesize: 8192, // 8GB
            maxFiles: 25,
            parallelUploads: 100,
            acceptedFiles: ".jpg,.jpeg,.tif,.tiff,.mp4,.avi,.mov,.aac,.mp3,.wav,.ogg,.flac",
            previewTemplate: document.querySelector("#mediaItemTpl").innerHTML,
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
                            if (file.serverID) {
                                $('#contentForm').append($(`<input type="hidden" name="delete_media[]" value="${file.serverID}">`));
                            }
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
            chunksUploaded: (file, done) => {
                let currentFile = file;
                $.ajax({
                    url: this.mediaDZ.options.url,
                    method: "PATCH",
                    data: {
                        dzuuid: currentFile.upload.uuid,
                        dztotalchunkcount: currentFile.upload.totalChunkCount,
                        filename: currentFile.name,
                        full_path: currentFile.fullPath || currentFile.name,
                        position: currentFile.position || 0,
                    },
                    success: () => {
                        setTimeout(() => done(), 50);
                    },
                    error: (msg) => {
                        console.log("chunksUpload ERROR", msg);
                        currentFile.accepted = false;
                        this.mediaDZ.files._errorProcessing([currentFile], msg.responseJSON?.info || "Error");
                    },
                });
            },
        });

        this.mediaDZ.on("addedfile", file => {
            console.dir(file);
        });

        this.mediaDZ.on("sending", function (file, xhr, data) {
            data.append("fileuuid", file.upload.uuid);
            data.append("full_path", file.fullPath || file.name);
        });

        this.mediaDZ.on("queuecomplete", () => {
            console.log("queuecomplete");
            this.mediaDZ_processing = false;
        });

        this.mediaDZ.on("totaluploadprogress", (progress) => {
            // console.log("totaluploadprogress", progress);
            this.mediaDZ_progress = progress;
        });

        this.docsDZ = new Dropzone(`#docDZ`, {
            ...dzOptions,
            url: `${API_PATH}`,
            clickable: "#docBtn",
            maxFiles: 1,
            maxFilesize: 10,
            parallelUploads: 5,
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

    loadContent() {
        $.ajax(`${API_PATH}/profile/contents`, {
            method: "GET",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
        })
            .done((data) => {
                $("#contentsList").html("");

                const contentTemplate = $("#contentTemplate").html();

                if (data.length) {
                    data.forEach((item) => {
                        $("#contentsList").append($(contentTemplate
                            .replace(/:name/ig, item.name || "Без названия")
                            .replace(/:id/ig, item.id || "")
                            .replace(/:logotype/ig, item.files[0]?.thumb720 || `${ABS_PATH}assets/images/noimage_4x3.png`)));
                    });
                } else {
                    $("#contentsList").html("<h5 class=\"text-uppercase text-muted\">Список пуст</h5>");
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
            dropdownParent: $("#contentModal"),
            minimumResultsForSearch: 25,
            templateResult: (data, container) => {
                if (data.element) {
                    $(container).addClass($(data.element).attr("class"));
                }
                return data.text;
            },
        });
    }

    onAdd() {
        $(document).on("click", `[data-action="add"]`, (e) => {
            e.preventDefault();
            $("#contentForm").attr("method", "POST").attr("action", $("#contentForm").data("action").replace("/:id", ""));
            $("#contentModal").modal("show");
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

                    $(`#contentForm`).jsonToForm(data, {
                        // "logotype": (value) => {
                        //     $(`#contentForm #contentImage`)[0].src = value || `${ABS_PATH}assets/images/noimage_4x3.png`;
                        //     $(`#contentForm [name="logotype"]`).val(value || `${ABS_PATH}assets/images/noimage_4x3.png`);
                        // },
                        "document": (value) => {
                            if (value) {
                                this.docsDZ.displayExistingFile({name: "document.pdf", size: 1, base64data: value}, `${ABS_PATH}assets/images/thumb_pdf.jpg`);
                            }
                        },
                        "type_ids": (value) => {
                            $(`#content_type`).val(value).trigger("change");
                        },
                        "files": (value) => {
                            if (value?.length) {
                                value.forEach(item => {
                                    this.mediaDZ.displayExistingFile({name: item.file, size: item.size, serverID: item.id, position: item.position}, item.thumb150 || `${ABS_PATH}assets/images/thumb_jpg.jpg`, () => {

                                    }, '*', false);
                                });
                            }
                        },
                    });

                    $("#contentForm").attr("method", "PATCH").attr("action", $("#contentForm").data("action").replace(":id", data.id));
                    $(`#contentForm [data-action="delete"]`).removeClass("d-none");
                    $("#contentModal").modal("show");

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
        $(document).on("click", `#contentForm [data-action="delete"]`, (e) => {
            e.preventDefault();
            Swal.fire({
                title: "Удалить контент?",
                text: "Также будут удалены предложения, связанные с этим брендом!",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: buttonDelete,
                cancelButtonText: buttonCancel,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax($("#contentForm").attr("action"), {
                        method: "DELETE",
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                    })
                        .done((data) => {

                            $("#contentModal").modal("hide");

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

                            this.loadContent();
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

    onDocPreview() {
        $(document).on("click", `#docDZ [data-dz-thumbnail]`, (e) => {
            $("#docModal").modal("show");
            $("#pdfData")[0].src = $(e.currentTarget).parents(".card").find(`[name="document"]`).eq(0).val();
        });
    }

    onModalClose() {
        $("#contentModal").on("hidden.bs.modal", () => {
            Common.clearForm("#contentForm");
            this.docsDZ.files = [];
            $(this.docsDZ.element).find(".card").each((i, e) => $(e).remove());
            this.mediaDZ.files = [];
            $(this.mediaDZ.element).find(".card").each((i, e) => $(e).remove());
            $("#docBtn").buttonDisabled(false);
            $(`#contentForm [data-action="delete"]`).addClass("d-none");
            $(`#contentForm input[name="delete_media[]"]`).remove();
        });

        $("#docModal").on("hidden.bs.modal", () => {
            $("#pdfData")[0].src = null;
        });
    }

    formValidate() {

        $("#contentForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                },
                brand_id: {
                    required: true,
                },
                "type_ids[]": {
                    required: true,
                },
                // description: {
                //     required: true,
                // },
            },
            messages: {
                name: {
                    required: validator_i18n.required,
                },
                brand_id: {
                    required: validator_i18n.required,
                },
                "type_ids[]": {
                    required: validator_i18n.required,
                },
                // description: {
                //     required: validator_i18n.required,
                // },
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

                        if (this.mediaDZ.getQueuedFiles().length) {

                            this.mediaDZ.options.url = `${API_PATH}/profile/content/${data.id}/upload`;

                            this.mediaDZ_processing = true;

                            this.mediaDZ.processQueue();

                            let timerInterval;

                            Swal.fire({
                                title: "Загрузка медиа файлов...",
                                html: "Загружено <b></b>%<br>Дождитесь окончания загрузки.",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                    const b = Swal.getHtmlContainer().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        b.textContent = Math.round(this.mediaDZ_progress).toString();
                                        if (!this.mediaDZ_processing) {
                                            Swal.close();
                                        }
                                    }, 250);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                },
                            }).then((result) => {
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

                                $("#contentModal").modal("hide");
                                this.loadContent();
                            });

                        } else {
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

                            $("#contentModal").modal("hide");
                            this.loadContent();
                        }

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
    new Content();
});