let $playerModal, seekCanUpdate = true, itemIndex = 0;

const Player = {

    initialize() {
        this.build();
        this.events();
    },

    build() {
        $playerModal = $("#playerModal");

        // fix owl / player controls conflict
        $(document).on("mousedown mousemove touchstart touchmove", ".playerControls", (e) => {
            e.stopPropagation();
        });
    },

    events() {
        this.onShowPlayer();
        this.onPlayerOpen();
        this.onPlayerClose();

        this.onCopyrightShow();

        // player
        this.onPlayerPlayPause();
        this.onPlayerSeek();
        this.onPlayerVolume();
        this.onMuteToggle();
        this.onToggleFullScreen();
        this.onSeek();

    },

    onCopyrightShow() {

        $(document).on("click", ".btnCopyright", (event) => {
            event.preventDefault();

            const $btn = $(event.currentTarget);

            Swal.fire("", $btn.parent().find(".itemCopyright").html());
        });
    },

    onShowPlayer() {

        $(document).on("click", ".showPlayer", (event) => {
            event.preventDefault();

            const url = $(event.currentTarget).data("url");

            itemIndex = parseInt($(event.currentTarget).data("index")) || 0;

            if (url) {

                $playerModal.find(".playerContent").load(url, () => {

                    if (!screenfull.isEnabled) {
                        $playerModal.find(".player-fullscreen").remove();
                    }

                    const browser = bowser.getParser(window.navigator.userAgent);

                    if (browser.is("mobile") || browser.is("tablet")) {
                        $playerModal.find(".player-volume-slider").remove();
                    }

                    $playerModal.modal("show");

                });
            }

        });
    },

    onPlayerOpen() {
        $playerModal.on("shown.bs.modal", () => {

            const $owl = $playerModal.find(".owl-player").eq(0);

            $owl.on("initialized.owl.carousel", () => {
                $playerModal.find(".preloader").remove();
                setTimeout(() => {
                    $owl.trigger("refresh.owl.carousel");
                }, 10);
            });

            $owl.on("translated.owl.carousel", () => {

                seekCanUpdate = true;

                $playerModal.find("audio, video").each((index, element) => {
                    if (!element.paused) {
                        element.pause();
                        element.currentTime = 0;
                    }
                });
            });

            $owl.owlCarousel({
                items: 1,
                startPosition: itemIndex || 0,
                nav: false,
                loop: false,
                margin: 1,
                stagePadding: 1,
                smartSpeed: 450,
            });

            // bind event handlers
            $playerModal.find("audio, video").each((index, media) => {
                this.initializeMedia(media);
                this.updateVolumeButton(media, $(media).parents(".playerContainer").find(".playerVolume"));
                $(media).parents(".playerContainer").find(".playerVolumeSlider").data("volume", media.volume);
            });

            $playerModal.find("audio").each((index, media) => {
                (function (Peaks) {

                    const options = {
                        overview: {
                            container: $(media).parents(".playerContainer").find(".peaks")[0],
                            waveformColor: "#8A88FF",
                            playedWaveformColor: "#888",
                            highlightOffset: 11,
                            playheadColor: "#888",
                            playheadTextColor: "rgba(0, 0, 0, 0)",
                            axisGridlineColor: "rgba(0, 0, 0, 0)",
                            showAxisLabels: false,
                        },
                        mediaElement: media,
                        dataUri: {
                            arraybuffer: $(media).data("peaks"),
                        },
                        // webAudio: {
                        //     audioContext: new AudioContext(),
                        //     multiChannel: true
                        // }
                    };

                    Peaks.init(options, (err, peaks) => {
                        const overview = peaks.views.getView("overview");
                        overview.enableSeek(false);
                    });

                })(peaks);
            });

        });
    },

    onPlayerClose() {
        $playerModal.on("hidden.bs.modal", () => {
            seekCanUpdate = true;
            itemIndex = 0;
            $playerModal
                .find(".playerContent")
                .html("<div class=\"text-center\"><div class=\"spinner-border text-white\" role=\"status\"><span class=\"visually-hidden\">Loading...</span> </div></div>");
        });
    },

    updatePlayButton(media, $button) {
        if (media.paused || media.ended) {
            $button.find(".mdi-pause").addClass("d-none");
            $button.find(".mdi-play").removeClass("d-none");
        } else {
            $button.find(".mdi-play").addClass("d-none");
            $button.find(".mdi-pause").removeClass("d-none");
        }
    },

    updateVolumeButton(media, $button) {
        if (media.muted || media.volume === 0) {
            $button.find(".mdi-volume-high, .mdi-volume-medium, .mdi-volume-low").addClass("d-none");
            $button.find(".mdi-volume-mute").removeClass("d-none");
        } else if (media.volume > 0 && media.volume <= 0.33) {
            $button.find(".mdi-volume-high, .mdi-volume-medium, .mdi-volume-mute").addClass("d-none");
            $button.find(".mdi-volume-low").removeClass("d-none");
        } else if (media.volume > 0.33 && media.volume <= 0.66) {
            $button.find(".mdi-volume-high, .mdi-volume-low, .mdi-volume-mute").addClass("d-none");
            $button.find(".mdi-volume-medium").removeClass("d-none");
        } else {
            $button.find(".mdi-volume-mute, .mdi-volume-low, .mdi-volume-medium").addClass("d-none");
            $button.find(".mdi-volume-high").removeClass("d-none");
        }
    },

    updateVolume(media, $container) {
        if (media.muted) {
            media.muted = false;
        }
        media.volume = $container.find(".playerVolumeSlider").val();
    },

    onPlayerPlayPause() {
        $(document).on("click", ".playerContainer .playerPlayPause", (event) => {
            const $button = $(event.currentTarget);
            const $container = $button.parents(".playerContainer").eq(0);
            const media = $container.find("audio, video")[0];
            if (media.paused || media.ended) { // Start playing
                $container.removeClass("show");
                media.play();
                $(media).on("timeupdate", () => {
                    this.updateProgress(media, $container);
                });
                $(media).on("pause", () => {
                    this.updatePlayButton(media, $button);
                    $container.addClass("show");
                    $(media).off("timeupdate pause");
                });
                this.updatePlayButton(media, $button);
                this.updateVolumeButton(media, $container.find(".playerVolume"));
            } else { // Stop playing
                media.pause();
            }
        });
    },

    onPlayerSeek() {
        $(document).on("change", ".playerContainer .playerProgress", (event) => {
            const $progress = $(event.currentTarget);
            const $container = $progress.parents(".playerContainer").eq(0);
            const media = $container.find("audio, video")[0];
            media.currentTime = $progress.val();
            this.updateProgress(media, $container);
        });
    },

    onPlayerVolume() {
        $(document).on("change", ".playerContainer .playerVolumeSlider", (event) => {
            const $volume = $(event.currentTarget);
            const $container = $volume.parents(".playerContainer").eq(0);
            const media = $container.find("audio, video")[0];
            $volume.data("volume", $volume.val());
            this.updateVolume(media, $container);
            this.updateVolumeButton(media, $container.find(".playerVolume"));
            $(media).on("volumechange", () => {
                this.updateVolumeButton(media, $container.find(".playerVolume"));
            });
        });
    },

    onMuteToggle() {
        $(document).on("click", ".playerContainer .playerVolume", (event) => {
            const $button = $(event.currentTarget);
            const $container = $button.parents(".playerContainer").eq(0);
            const media = $container.find("audio, video")[0];
            this.toggleMute(media, $container);
            this.updateVolumeButton(media, $container.find(".playerVolume"));
        });
    },

    onToggleFullScreen() {

        $(document).on("click", ".playerContainer .playerFullscreen", (event) => {

            const $button = $(event.currentTarget);
            const $container = $button.parents(".playerContainer").eq(0);

            if (screenfull.isEnabled) {

                if (screenfull.isFullscreen) {

                    screenfull.exit().then(() => {
                        $button.find(".mdi-fullscreen").removeClass("d-none");
                        $button.find(".mdi-fullscreen-exit").addClass("d-none");
                    });

                } else {

                    screenfull.request($container[0], {navigationUI: "hide"}).then(() => {
                        $button.find(".mdi-fullscreen").addClass("d-none");
                        $button.find(".mdi-fullscreen-exit").removeClass("d-none");
                    });

                }

            }

        });

    },

    onSeek() {

        $(document).on("mousedown touchstart touchmove", ".playerProgress", () => {
            seekCanUpdate = false;
        });

        $(document).on("mouseup touchend touchcancel", ".playerProgress", () => {
            setTimeout(() => {
                seekCanUpdate = true;
            }, 100);
        });

    },

    // Player functions
    formatTime(timeInSeconds) {

        if (timeInSeconds) {

            const result = new Date(timeInSeconds * 1000).toISOString().substr(11, 8);

            return {
                minutes: result.substr(3, 2),
                seconds: result.substr(6, 2),
            };
        }

        return {
            minutes: "00",
            seconds: "00",
        };
    },

    initializeMedia(media) {
        const mediaDuration = Math.round(media.duration);
        $(media).parents(".playerContainer").find(".playerProgress").prop("max", mediaDuration);
        const time = this.formatTime(mediaDuration);
        $(media).parents(".playerContainer").find(".playerTime .time-left").text(`${time.minutes}:${time.seconds}`);
    },

    updateProgress(media, $container) {
        const time = this.formatTime(Math.round(media.duration - media.currentTime));
        $container.find(".playerTime .time-left").text(`${time.minutes}:${time.seconds}`);
        if (seekCanUpdate) {
            $container.find(".playerProgress").val(Math.floor(media.currentTime));
        }
    },

    toggleMute(media, $container) {
        media.muted = !media.muted;

        const $volume = $container.find(".playerVolumeSlider");

        if (media.muted) {
            $volume.data("volume", $volume.val());
            $volume.val(0);
        } else {
            $volume.val($volume.data("volume"));
        }
    },

};

$(document).ready(function () {
    Player.initialize();
});