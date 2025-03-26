class Login {

    constructor() {
        this.build();
        this.events();
    }

    build() {
        this.customSelect();
        this.loginFormValidate();
        this.resetFormValidate();
        this.newPassFormValidate();
        this.registrationFormValidate();
    }

    events() {
        this.onResetModalClose();
        this.onSuggest();
    }

    customSelect() {

        function formatCountry(country) {
            if (!country.id) {
                return country.text;
            }
            return $(
                "<span>" + country.text + " <span class=\"text-muted\">" + $(country.element).data("country-name") + "</span>" + "</span>",
            );
        }

        function matchCustom(params, data) {
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
        }

        $(".select2").select2({
            minimumResultsForSearch: 25,
        });

        $(".country-select2").select2({
            minimumResultsForSearch: 25,
            templateResult: formatCountry,
            matcher: matchCustom,
        });
    }

    loginFormValidate() {
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    regex: /^(([^<>()\[\]\\.,;:\s@']+(\.[^<>()\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: validator_i18n.required,
                    regex: validator_i18n.email,
                },
                password: {
                    required: validator_i18n.required,
                },
            },
            showErrors: Common.validateCustomErrorMessage,
            errorClass: "is-invalid",
            validClass: "is-valid",
            submitHandler: (form) => {
                $(form).find("button[type=\"submit\"]").buttonLoading(true);
                form.submit();
            },
        });
    }

    resetFormValidate() {
        $("#resetForm").validate({
            rules: {
                email: {
                    required: true,
                    regex: /^(([^<>()\[\]\\.,;:\s@']+(\.[^<>()\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                },
            },
            messages: {
                email: {
                    required: validator_i18n.required,
                    regex: validator_i18n.email,
                },
            },
            showErrors: Common.validateCustomErrorMessage,
            errorClass: "is-invalid",
            validClass: "is-valid",
            submitHandler: (form) => {
                $(form).find("button[type=\"submit\"]").buttonLoading(true);
                $.post(
                    $(form).attr("action"),
                    $(form).serialize(),
                ).done((data) => {
                    $("#modalReset").modal("hide");
                    Swal.fire({
                        title: "",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: buttonOk,
                    }).then(() => location.href = `${ABS_PATH}login`);
                }).fail((data) => {
                    Swal.fire({
                        title: "",
                        text: data.responseJSON?.message || ajaxErrorStatusMessage,
                        icon: "error",
                        confirmButtonText: buttonOk,
                    }).then(() => location.href = `${ABS_PATH}login`);
                });
            },
        });
    }

    newPassFormValidate() {
        $("#newPassForm").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6,
                },
                password_confirm: {
                    required: true,
                    equalTo: "#user_password",
                },
            },
            messages: {
                password: {
                    required: validator_i18n.required,
                    minlength: $.validator.format(validator_i18n.minLength),
                },
                password_confirm: {
                    required: validator_i18n.required,
                    equalTo: validator_i18n.equalTo,
                },
            },
            showErrors: Common.validateCustomErrorMessage,
            errorClass: "is-invalid",
            validClass: "is-valid",
            submitHandler: (form) => {
                $(form).find("button[type=\"submit\"]").buttonLoading(true);
                $.post(
                    $(form).attr("action"),
                    $(form).serialize(),
                ).done((data) => {
                    Swal.fire({
                        title: "",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: buttonOk,
                    }).then(() => location.href = `${ABS_PATH}login`);
                }).fail((data) => {
                    Swal.fire({
                        title: "",
                        text: data.responseJSON?.message || ajaxErrorStatusMessage,
                        icon: "error",
                        confirmButtonText: buttonOk,
                    }).then(() => location.href = `${ABS_PATH}login`);
                });
            },
        });
    }

    onSuggest() {

        this.remoteSuggestTimeout = null;

        $("#registration_inn").typeahead(null, {
            name: "org-suggest",
            limit: 20,
            display: "display",
            source: (query, syncResults, asyncResults) => {
                if (query.length > 3) {
                    // Throttling for 500ms
                    clearTimeout(this.remoteSuggestTimeout);
                    this.remoteSuggestTimeout = setTimeout(() => {

                        $.get(`${ABS_PATH}login/captcha`, captcha => {
                            if (captcha.sid) {
                                $.get(`${ABS_PATH}login/inn_suggestions/${captcha.sid}/${query}`, data => {
                                    asyncResults(data);
                                });
                            } else {
                                asyncResults(null);
                            }
                        });


                    }, 500);
                } else {
                    syncResults(null);
                }
            },
        }).bind("typeahead:select", (e, suggestion) => {

            $("#registration_inn")
                .val(suggestion.data?.inn || "")
                .typeahead("val", suggestion.data?.inn || "");

        });

    }

    registrationFormValidate() {

        this.sid = "";

        $.get(`${ABS_PATH}login/captcha`, captcha => {
            this.sid = captcha.sid || "";
        });

        $.validator.addMethod(
            "phoneWithCode",
            (value, element, arg) => {

                //const code = $("select[name=\"code\"]").val();
                const code = $("input[name=\"code\"]").val();

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

        $("#registrationForm").validate({
            rules: {
                email: {
                    required: true,
                    regex: /^(([^<>()\[\]\\.,;:\s@']+(\.[^<>()\[\]\\.,;:\s@']+)*)|('.+'))@((\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}])|(([a-zA-Z\-\d]+\.)+[a-zA-Z]{2,}))$/,
                    remote: {
                        url: "/login/check_email",
                        type: "post",
                        dataType: "json",
                        data: {
                            email: () => {
                                return $("input[name=\"email\"]").val();
                            },
                            sid: () => {
                                return this.sid;
                            },
                        },
                    },
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                // firstname: {
                //     required: true,
                //     minlength: 2,
                // },
                password_confirm: {
                    required: true,
                    equalTo: "#registration_password",
                },
                code: {
                    required: true,
                    //codeWithPhone: true,
                },
                phone: {
                    required: true,
                    phoneWithCode: true,
                    remote: {
                        url: "/login/check_phone",
                        type: "post",
                        dataType: "json",
                        data: {
                            phone: () => {
                                return $("input[name=\"phone\"]").val();
                            },
                            code: () => {
                                return $("input[name=\"code\"]").val();
                            },
                            sid: () => {
                                return this.sid;
                            },
                        },
                    },
                },
                inn: {
                    required: true,
                    digits: true,
                    regex: /^((\d{10})|(\d{12}))$/,
                    remote: {
                        url: "/login/check_inn",
                        type: "post",
                        dataType: "json",
                        data: {
                            inn: () => {
                                return $("input[name=\"inn\"]").val();
                            },
                            sid: () => {
                                return this.sid;
                            },
                        },
                        dataFilter: (data) => {
                            return `"${data}"`;
                        },
                    },
                },
            },
            messages: {
                email: {
                    required: validator_i18n.required,
                    regex: validator_i18n.email,
                    remote: validator_i18n.email_used,
                },
                password: {
                    required: validator_i18n.required,
                    minlength: $.validator.format(validator_i18n.minLength),
                },
                firstname: {
                    required: validator_i18n.required,
                    minlength: $.validator.format(validator_i18n.minLength),
                },
                password_confirm: {
                    required: validator_i18n.required,
                    equalTo: validator_i18n.equalTo,
                },
                code: {
                    required: validator_i18n.required,
                },
                phone: {
                    required: validator_i18n.required,
                    remote: validator_i18n.phone_used,
                },
                inn: {
                    required: validator_i18n.required,
                    digits: validator_i18n.digits,
                    number: validator_i18n.inn,
                    regex: validator_i18n.inn,
                    // remote: validator_i18n.inn_used,
                },
            },
            showErrors: Common.validateCustomErrorMessage,
            errorClass: "is-invalid",
            validClass: "is-valid",
            submitHandler: (form) => {
                console.log("SUBMIT HANDLER");
                $(form).find("button[type=\"submit\"]").buttonLoading(true);
                $.get(`${ABS_PATH}login/captcha`, (data) => {
                    $(".captcha-response").val(data.sid || "").after(data.cel || "");
                    form.submit();
                });
            },
        });
    }

    onResetModalClose() {
        $("#modalReset").on("hidden.bs.modal", () => {
            $("#resetForm")[0].reset();
        });
    }

}

$(document).ready(() => {
    new Login();
});