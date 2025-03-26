<div class="owl-carousel owl-theme owl-player">

    {foreach from=$offer['content']['files'] item=file}
        <div class="item">
            <div class="px-2">
                {if str_starts_with($file['mime'], 'image/')}
                    <img src="{$file['thumb1280']|default:''}" class="mx-auto" style="max-height: 70vh; max-width: 100%; width: auto; height: auto;" alt="">
                {/if}

                {if str_starts_with($file['mime'], 'video/')}
                    <div class="playerContainer show position-relative">

                        <div class="ratio ratio-16x9 bg-dark">
                            <video preload="metadata" {* controls poster="poster.jpg" *}>
                                <source src="{$file['video1280']|default:''}">
                            </video>
                        </div>

                        <div class="playerControls position-absolute bottom-0 start-0 end-0 p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <button class="btn btn-secondary btn-icon playerPlayPause"><i class="mdi mdi-play"></i><i class="mdi mdi-pause d-none"></i></button>
                                </div>
                                <div class="col">
                                    <input class="form-range mt-1 playerProgress" value="0" min="0" type="range" step="1">
                                </div>
                                <div class="col-auto">
                                    <div class="playerTime">
                                        <time class="time-left d-inline-block wd-75 text-center small py-1 px-3 rounded-pill bg-body-tertiary bg-opacity-75" style="font-variant-numeric: tabular-nums;">00:00</time>
                                    </div>
                                </div>
                                <div class="col-auto d-none d-md-block">
                                    <button class="btn btn-secondary btn-icon playerVolume"><i class="mdi mdi-volume-high"></i><i class="mdi mdi-volume-medium d-none"></i><i class="mdi mdi-volume-low d-none"></i><i class="mdi mdi-volume-mute d-none"></i></button>
                                </div>
                                <div class="col-auto d-none d-md-block player-volume-slider">
                                    <input class="form-range mt-1 playerVolumeSlider" value="1" data-mute="0.5" type="range" max="1" min="0" step="0.01">
                                </div>
                                <div class="col-auto player-fullscreen">
                                    <button class="btn btn-secondary btn-icon playerFullscreen"><i class="mdi mdi-fullscreen"></i><i class="mdi mdi-fullscreen-exit d-none"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                {/if}

                {if str_starts_with($file['mime'], 'audio/')}
                    <div class="playerContainer show position-relative">

                        <div class="ratio ratio-16x9 bg-light">
                            <div>
                                <div class="peaks h-100 d-flex align-items-center bg-body"></div>
                            </div>
                            <audio preload="metadata" data-peaks="{$file['audio1280']|default:''}.dat">
                                <source src="{$file['audio1280']|default:''}">
                            </audio>
                        </div>

                        <div class="playerControls position-absolute bottom-0 start-0 end-0 p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <button class="btn btn-secondary btn-icon playerPlayPause"><i class="mdi mdi-play"></i><i class="mdi mdi-pause d-none"></i></button>
                                </div>
                                <div class="col">
                                    <input class="form-range mt-1 playerProgress" value="0" min="0" type="range" step="1">
                                </div>
                                <div class="col-auto">
                                    <div class="playerTime">
                                        <time class="time-left d-inline-block wd-75">00:00</time>
                                    </div>
                                </div>
                                <div class="col-auto d-none d-md-block">
                                    <button class="btn btn-secondary btn-icon playerVolume"><i class="mdi mdi-volume-high"></i><i class="mdi mdi-volume-medium d-none"></i><i class="mdi mdi-volume-low d-none"></i><i class="mdi mdi-volume-mute d-none"></i></button>
                                </div>
                                <div class="col-auto d-none d-md-block player-volume-slider">
                                    <input class="form-range mt-1 playerVolumeSlider" value="1" data-mute="0.5" type="range" max="1" min="0" step="0.01">
                                </div>
                                <div class="col-auto player-fullscreen">
                                    <button class="btn btn-secondary btn-icon playerFullscreen"><i class="mdi mdi-fullscreen"></i><i class="mdi mdi-fullscreen-exit d-none"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                {/if}

            </div>

            {* if $file.copyright}
                <div class="position-absolute top-0 start-0 m-1">
                    <button class="btn btn-secondary btn-icon btnCopyright"><i class="mdi mdi-copyright"></i></button>
                    <div class="d-none itemCopyright">{$file.copyright}</div>
                </div>
            {/if *}

        </div>
    {/foreach}

</div>