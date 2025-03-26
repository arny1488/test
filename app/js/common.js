var $window = $(window);
var $body = $("body");
var $locale = $("html").attr("lang") || navigator.language;

class Password {

    static _getRandomByte() {
        let result = null;
        if (window.crypto && window.crypto.getRandomValues) {
            result = new Uint8Array(1);
            window.crypto.getRandomValues(result);
            return result[0];
        } else if (window.msCrypto && window.msCrypto.getRandomValues) {
            result = new Uint8Array(1);
            window.msCrypto.getRandomValues(result);
            return result[0];
        } else {
            return Math.floor(Math.random() * 256);
        }
    }

    static generate(length) {

        const _pattern = /[a-zA-Z0-9_\-+.]/;

        return Array.apply(null, {"length": length})
            .map(() => {
                let result;
                while (true) {
                    result = String.fromCharCode(this._getRandomByte());
                    if (_pattern.test(result)) {
                        return result;
                    }
                }
            }, this)
            .join("");
    }

}

class Common {

    constructor() {
        this.build();
        this.events();
    }

    build() {

        window['hoverSliderOptions'] = {};

        this.setButtonHandlers();
        this.setTimezoneCookie();
        this.setThemeCookie();
        this.setValidateMessages();
        this.addValidateMethods();
        this.initializeClipboardPlugin();
        Common.initializeBootstrapTooltip();
        Common.initializeBootstrapPopover();
        this.setPerfectScrollbar();
        this.setSidebarScrollbar();
        this.foldSidebar();
        this.stickHorizontalMenu();
        this.clearableInput();
        this.radioGroupInput();
    }

    events() {
        this.onThemeChange();
        this.onSidebarToggle();
        this.onSidebarHover();
        this.onSidebarOutsideClick();
        this.onHorizontalMenuToggle();
        this.onShowHidePass();

        $(document).on('select2:open', function(e) {
            document.querySelector(`[aria-controls="select2-${e.target.id}-results"]`).focus();
        });

    }

    setValidateMessages() {
        $.extend($.validator.messages, {
            "required": "Это поле обязательно для заполнения",
            "radio": "Выберете один из вариантов",
            "minLength": "Это поле должно содержать не менее {0} знаков",
            "maxLength": "Это поле должно содержать не более {0} знаков",
            "range": "Введите значение от {0} до {1}",
            "select": "Необходимо выбрать значение",
            "phone": "Введите номер телефона",
            "phone_used": "Номер телефона уже используется",
            "email": "Введите адрес электронной почты",
            "email_used": "Адрес электронной почты уже используется",
            "equalTo": "Введите то же значение еще раз",
            "number": "Введите число",
            "digits": "Вводите только цифры",
            "inn": "ИНН должен содержать 10 или 12 цифр",
            "inn_used": "Организация с таким ИНН уже зарегистрирована",
            "date": "Введите корректные дату и время",
            "future": "Введите дату и время после {0}",
            "step": "Введите число кратное {0}",
            "group": "Заполните как минимум {0} из этих полей",
            "common": "Введите корректное значение",
            "remote": "Введите правильное значение.",
            "url": "Введите корректный URL.",
            "dateISO": "Введите корректную дату в формате ISO.",
            "extension": "Выберите файл с правильным расширением.",
            "maxlength": $.validator.format("Введите не больше {0} символов."),
            "minlength": $.validator.format("Введите не меньше {0} символов."),
            "rangelength": $.validator.format("Введите значение длиной от {0} до {1} символов."),
            "max": $.validator.format("Введите число, меньшее или равное {0}."),
            "min": $.validator.format("Введите число, большее или равное {0}."),
        });
    }

    setButtonHandlers() {
        $.fn.buttonLoading = function (isLoading) {

            if (this.text().trim().length && !this.hasClass("btn-icon-text")) this.addClass("btn-icon-text");

            if (isLoading && !this.hasClass("disabled")) {
                this
                    .addClass("disabled")
                    .prop("disabled", true)
                    .prepend("<span class=\"spinner-border spinner-border-sm btn-icon-prepend\" role=\"status\" aria-hidden=\"true\"></span>")
                    .find("i").addClass("d-none");
            } else if (!isLoading && this.hasClass("disabled")) {
                this
                    .removeClass("disabled")
                    .prop("disabled", false)
                    .find("span.spinner-border").remove();
                this.find("i").removeClass("d-none");
            }

            return this;
        };

        $.fn.buttonDisabled = function (isDisabled) {

            if (isDisabled && !this.hasClass("disabled")) {
                this
                    .addClass("disabled")
                    .prop("disabled", true);
            } else if (!isDisabled && this.hasClass("disabled")) {
                this
                    .removeClass("disabled")
                    .prop("disabled", false);
            }

            return this;
        };

    }

    // set browser timezone cookie
    setTimezoneCookie() {
        const timezone = $body.data("timezone");
        const browser_timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

        if (timezone?.length && browser_timezone && (browser_timezone !== timezone)) {
            Cookies.set("browser_timezone", browser_timezone, {expires: 365, path: "/"});
            location.reload();
        }
    }

    // set theme cookie
    setThemeCookie() {
        if (!Cookies.get("theme")) {
            if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
                Cookies.set("theme", "dark", {expires: 365});
            } else {
                Cookies.set("theme", "light", {expires: 365});
            }
            location.reload();
        }
    }

    // switch theme handler
    onThemeChange() {
        $(".themeChange").on("click", (e) => {
            e.preventDefault;

            let newTheme = (Cookies.get("theme") === "dark") ? "light" : "dark";
            let cssElement = $("#themeCSS");
            let cssURL = cssElement.attr("href");

            Cookies.set("theme", newTheme, {expires: 365});
            cssElement.attr("href", cssURL.replace(/(dark|light)/g, newTheme));
            $body.data("theme", newTheme);
            $("#themeSwitch").prop("checked", (newTheme === "dark"));

            window.dispatchEvent(new CustomEvent("theme-change", {detail: {theme: newTheme}}));

            return false;
        });
    }

    // initialize clipboard plugin
    initializeClipboardPlugin() {

        const clipboardButtons = $(".btn-clipboard");

        if (clipboardButtons.length) {

            // Enabling tooltip to all clipboard buttons
            clipboardButtons.attr("data-bs-toggle", "tooltip").attr("title", buttonClipboard);

            const clipboard = new ClipboardJS(".btn-clipboard");

            clipboard.on("success", function (e) {
                e.trigger.innerHTML = "copied";
                setTimeout(function () {
                    e.trigger.innerHTML = "copy";
                    e.clearSelection();
                }, 700);
            });
        }
    }

    // initialize bootstrap tooltip
    static initializeBootstrapTooltip(element) {
        const tooltipTriggerList = [].slice.call((element || document).querySelectorAll("[data-bs-toggle=\"tooltip\"]"));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // initialize bootstrap popover
    static initializeBootstrapPopover() {
        const popoverTriggerList = [].slice.call(document.querySelectorAll("[data-bs-toggle=\"popover\"]"));
        const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    }

    // apply perfect-scrollbar to sidebar
    setSidebarScrollbar() {
        if ($(".sidebar .sidebar-body").length) {
            const sidebarBodyScroll = new PerfectScrollbar(".sidebar-body", {
                wheelPropagation: false,
                minScrollbarLength: 20,
            });
        }
    }

    // apply perfect-scrollbar to sidebar
    setPerfectScrollbar() {

        const browser = bowser.getParser(window.navigator.userAgent);

        if ($(".PerfectScrollbar").length && !browser.is("mobile")) {
            $(".PerfectScrollbar").each((index, element) => {
                new PerfectScrollbar($(element).get(0), {
                    wheelPropagation: true,
                    minScrollbarLength: 20,
                });
            });

        }
    }

    // sidebar toggle handler
    onSidebarToggle() {
        $(".sidebar-toggler").on("click", function (e) {
            e.preventDefault();
            $(".sidebar-header .sidebar-toggler").toggleClass("active not-active");
            if (window.matchMedia("(min-width: 992px)").matches) {
                e.preventDefault();
                $body.toggleClass("sidebar-folded");
            } else if (window.matchMedia("(max-width: 991px)").matches) {
                e.preventDefault();
                $body.toggleClass("sidebar-open");
            }
        });
    }

    // sidebar hover handler
    onSidebarHover() {

        //  open sidebar-folded when hover
        $(".sidebar .sidebar-body").hover(
            function () {
                if ($body.hasClass("sidebar-folded")) {
                    $body.addClass("open-sidebar-folded");
                }
            },
            function () {
                if ($body.hasClass("sidebar-folded")) {
                    $body.removeClass("open-sidebar-folded");
                }
            });
    }

    // sidebar outside click/touch handler
    onSidebarOutsideClick() {
        $(document).on("click touchstart", function (e) {
            e.stopPropagation();

            // closing off sidebar menu when clicking outside of it
            if (!$(e.target).closest(".sidebar-toggler").length) {
                var sidebar = $(e.target).closest(".sidebar").length;
                var sidebarBody = $(e.target).closest(".sidebar-body").length;
                if (!sidebar && !sidebarBody) {
                    if ($body.hasClass("sidebar-open")) {
                        $body.removeClass("sidebar-open");
                    }
                }
            }
        });
    }

    // sidebar-folded on large devices
    foldSidebar() {

        function iconSidebar(e) {
            if (e.matches) {
                $body.addClass("sidebar-folded");
            } else {
                $body.removeClass("sidebar-folded");
            }

            // fix charts width
            setTimeout(() => window.dispatchEvent(new Event("resize")), 200);
        }

        const desktopMedium = window.matchMedia("(min-width:992px) and (max-width: 1399px)");
        desktopMedium.addEventListener("change", iconSidebar);
        iconSidebar(desktopMedium);
    }

    // horizontal menu toggle handler
    onHorizontalMenuToggle() {
        $("[data-toggle=\"horizontal-menu-toggle\"]").on("click", function () {
            $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
        });
    }

    // horizontal submenu click handler
    onHorizontalMenuShow() {
        const navItemClicked = $(".horizontal-menu .page-navigation > .nav-item");
        navItemClicked.on("click", function (event) {
            if (window.matchMedia("(max-width: 991px)").matches) {
                if (!($(this).hasClass("show-submenu"))) {
                    navItemClicked.removeClass("show-submenu");
                }
                $(this).toggleClass("show-submenu");
            }
        });
    }

    // stick horizontal menu on scroll down
    stickHorizontalMenu() {
        $window.scroll(function () {
            if (window.matchMedia("(min-width: 992px)").matches) {
                const menu = $(".horizontal-menu");
                if ($window.scrollTop() >= 60) {
                    menu.addClass("fixed-on-scroll");
                } else {
                    menu.removeClass("fixed-on-scroll");
                }
            }
        });
    }

    // add custom jq validate methods
    addValidateMethods() {
        $.validator.addMethod(
            "regex",
            (value, element, regexp) => {
                var re = new RegExp(regexp);
                return re.test(value);
            },
            validator_i18n.required,
        );
    }

    // show form validation messages as tooltip
    static validateCustomErrorMessage(errorMap, errorList) {

        // Removing tooltips and `is-invalid` class for valid elements
        $.each(this.validElements(), (index, element) => {
            const $element = $(element);
            let $_element;
            if ($element.hasClass("select2-hidden-accessible")) {
                $("#select2-" + $element.attr("id") + "-container").parent().removeClass("border-danger");
                $_element = $("#select2-" + $element.attr("id") + "-container").parents(".select2.select2-container").eq(0);
            } else if ($element.hasClass("btn-check")) {
                $_element = $element.parent(".btn-group");
                $_element.removeClass("is-invalid");
            } else if ($element.is(`[type="radio"]`)) {
                $_element = $(`[name="${$element.attr("name")}"]`);
                $_element.removeClass("is-invalid");
            } else {
                $element.removeClass("is-invalid");
                $_element = $element;
            }
            $_element
                .tooltip("dispose")
                .attr("title", ""); // Clear title 'cause no error
        });

        // Creating new tooltips and set `is-invalid` class for invalid elements
        $.each(errorList, (index, error) => {
            const $element = $(error.element);
            let $_element;
            if ($element.hasClass("select2-hidden-accessible")) {
                $("#select2-" + $element.attr("id") + "-container").parent().addClass("border-danger");
                $_element = $("#select2-" + $element.attr("id") + "-container").parents(".select2.select2-container").eq(0);
            } else if ($element.hasClass("btn-check")) {
                $_element = $element.parent(".btn-group");
                $_element.addClass("is-invalid");
            } else if ($element.is(`[type="radio"]`)) {
                $_element = $(`[name="${$element.attr("name")}"]`);
                $_element.addClass("is-invalid");
            } else {
                $element.addClass("is-invalid");
                $_element = $element;
            }
            $_element
                .tooltip("dispose") // Remove old tooltip
                .attr("title", error.message)
                .tooltip(); // New tooltip with error message
        });

    }

    onShowHidePass() {
        // Show/Hide password
        $(document).on("click", ".showPass", function () {
            const pass_input = $(this).parent(".input-group").find("input");
            const hide = pass_input.attr("type") === "text";
            pass_input.attr("type", hide ? "password" : "text");
            $(this).find("i").attr("class", hide ? "mdi mdi-eye-outline" : "mdi mdi-eye-off-outline");
        });
    }

    radioGroupInput() {
        $(document).on("change input", "[data-input-radio-group]", (event) => {
            const $target = $(event.target);
            const group_id = $target.data("input-radio-group");
            if ($target.val() && $target.val().length) {
                $(`[data-input-radio-group="${group_id}"]`).each((index, element) => {
                    if (element !== $target.get(0)) {
                        $(element).prop("readonly", true).prop("disabled", true).val(null);
                    }
                });
            } else {
                $(`[data-input-radio-group="${group_id}"]`).prop("readonly", false).prop("disabled", false).val(null);
            }
        });
    }

    clearableInput() {
        $("input.form-control.clearable").each((index, element) => {
            const $element = $(element);
            const $button = $(`<button type="button" class="input__clear"><span>×</span></button>`);
            $element.wrap(`<div class="clearable-input-wrapper"></div>`).after($button);
            const $wrapper = $element.parent(".clearable-input-wrapper").eq(0);
            if ($element.val().length && !$element.is("[readonly]")) {
                $wrapper.addClass("clearable");
            }
            $element.on("change input change.td", () => {
                if ($element.val().length && !$element.is("[readonly]")) {
                    $wrapper.addClass("clearable");
                } else {
                    $wrapper.removeClass("clearable");
                }
            });
            $button.on("click", (e) => {
                e.preventDefault();
                $element.val(null).trigger("change").trigger("input").trigger("clear");
                $wrapper.removeClass("clearable");
                return false;
            });
        });
    }

    static clearForm(formSelector) {
        $(`${formSelector} input, ${formSelector} textarea, ${formSelector} select, ${formSelector} .btn-group`).val("").prop("readonly", false).prop("disabled", false).tooltip("dispose").attr("title", "").trigger("change");
        $(`${formSelector} textarea`).not(".select2-search__field").height("3rem").attr("title", "");
        $(`${formSelector} button[type="submit"]`).removeClass("d-none").buttonLoading(false);
        $(`${formSelector}`)[0].reset();
        $(`${formSelector} .select2-selection`).removeClass("border-danger");
        $(`${formSelector} .select2`).val(null).trigger("change").trigger("input");
        $(`${formSelector} .select2-search--inline .select2-search__field`).css("width", "100%");
        $(`${formSelector} input[data-default-value], ${formSelector} textarea[data-default-value], ${formSelector} select`).each((index, element) => $(element).val($(element).data("default-value")).trigger("change"));
        $(`${formSelector} input[data-readonly], ${formSelector} textarea[data-readonly], ${formSelector} select[data-default-value]`).prop("readonly", true);
        $(`${formSelector} .select2-selection__rendered`).tooltip("dispose").attr("title", "");
        $(`${formSelector} [data-default-visibility="hidden"]`).hide();
        $(`${formSelector} [data-default-visibility="visible"]`).show();
        $(`${formSelector} .is-valid, ${formSelector} .is-invalid`).removeClass("is-valid is-invalid");
        $(`${formSelector} .select2-selection.border-danger`).removeClass("border-danger");
        //$(`${formSelector} .select2`).removeClass("select2-container--focus select2-container--open");
        $(`${formSelector} [type="submit"]`).focus();
    }

}

$(document).ready(() => {
    new Common();
});