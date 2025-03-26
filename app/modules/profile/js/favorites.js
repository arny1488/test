class Favorites {

    constructor() {
        this.build();
        this.events();
    }

    build() {
        this.loadFavorites();
    }

    events() {
        this.onFavoriteClick();
    }

    onFavoriteClick() {
        $(document).on("click", `[data-action="favorite"]`, (e) => {
            e.preventDefault();
            e.stopPropagation();
            const card = $(e.currentTarget).parents(`[data-favorite]`).eq(0);
            const isFavorite = card.attr("data-favorite").toLowerCase() === "true";
            const offer = card.data("offer-id");
            card.attr("data-favorite", (!isFavorite).toString());
            $.ajax(isFavorite ? `${API_PATH}/profile/favorite/${offer}` : `${API_PATH}/profile/favorite`, {
                method: isFavorite ? "DELETE" : "POST",
                data: isFavorite ? null : JSON.stringify({id: offer}),
                dataType: "json",
                contentType: "application/json; charset=utf-8",
            });
            return false;
        });
    }

    loadFavorites() {
        if ($("#favoritesList").length) {
            $.ajax(`${API_PATH}/profile/favorites`, {
                method: "GET",
                data: {
                    limit: $("#favoritesList").data("limit") || 6,
                    start: $("#favoritesList").data("start") || 0,
                },
                dataType: "json",
                contentType: "application/json; charset=utf-8",
            })
                .done((data) => {
                    $("#favoritesList").html("");

                    const offerTemplate = $("#offerTemplate").html();

                    if (data.length) {
                        data.forEach((item) => {
                            $("#favoritesList").append($(offerTemplate
                                .replace(/:name/ig, item.content?.name || "Без названия")
                                .replace(/:id/ig, item.id || "")
                                .replace(/:favorite/ig, item.favorite?.toString() || "false")
                                .replace(/:logotype/ig, item.content?.files[0]?.thumb720 || `${ABS_PATH}assets/images/noimage_4x3.png`)));
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
    new Favorites();
});