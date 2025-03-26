<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <div class="d-none d-md-block">
                            <a class="btn btn-inverse-primary btn-icon-text" href="{$ABS_PATH}event_log/download" target="_blank">
                                <i class="mdi mdi-tray-arrow-down btn-icon-prepend"></i> {#button_download#}
                            </a>
                        </div>
                        <div class="d-md-none">
                            <a class="btn btn-inverse-primary btn-icon" href="{$ABS_PATH}event_log/download" target="_blank">
                                <i class="mdi mdi-tray-arrow-down btn-icon-prepend"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col col-md-6 col-xxl-4">
                        <div class="input-group">
                            <span class="input-group-text px-2"><i class="mdi mdi-filter-outline"></i></span>
                            <input id="tableFilter" type="text" class="form-control">
                            <button id="tableFilterClear" type="button" class="input-group-text px-2"><i class="mdi mdi-close text-danger"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="eventLogControlTable" class="display table table-hover text-nowrap align-middle">
                    <thead>
                    <tr>
                        <th class="text-start all">{#event_log_dt#}</th>
                        <th class="text-start all">{#event_log_type#}</th>
                        {* <th class="text-start tablet desktop">{#event_log_module#}</th> *}
                        <th class="text-start desktop">{#event_log_user#}</th>
                        <th class="text-start desktop">{#event_log_ip#}</th>
                        <th class="text-start desktop">{#event_log_description#}</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>