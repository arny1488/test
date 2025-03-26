$.fn.jsonToForm = function (data, callbacks) {
    const formInstance = this;

    const options = {
        data: data || null,
        callbacks: callbacks,
    };

    const convertPath = (path) => {
        return path.filter(n => (n !== null)).map((v, i) => (i === 0) ? v : `[${v}]`).join("");
    };

    function parse(path, data) {
        if (data != null) {
            $.each(data, function (k, v) {

                const realPath = convertPath([path, k]);

                if (options.callbacks) {
                    if (options.callbacks.hasOwnProperty(realPath)) {
                        options.callbacks[realPath](v);
                        return;
                    }
                    const matches = Object.keys(options.callbacks).filter((key) => realPath.match(key));
                    if (matches.length) {
                        options.callbacks[matches[0]](v);
                        return;
                    }
                }

                if (typeof v === "object") {
                    parse(realPath, v);
                } else {

                    const elements = $(`[name^="${realPath}"]`, formInstance);

                    $(elements).each(function (index, element) {
                        if (Array.isArray(v)) {
                            v.forEach(function (val) {
                                $(element).is("select")
                                    ? $(element)
                                        .find("[value='" + val + "']")
                                        .prop("selected", true).val(val).trigger("change")
                                    : $(element).val() == val
                                        ? $(element).prop("checked", true).val(val).trigger("change")
                                        : "";
                            });
                        } else if ($(element).is(":checkbox") || $(element).is(":radio")) {
                            // checkbox group or radio group
                            $(element).val() == v ? $(element).prop("checked", true).trigger("change") : "";
                        } else {
                            $(`[name="${realPath}"]`, formInstance).val(v).trigger("change");
                        }
                    });

                }
            });
        }
    }

    parse(null, data);

};