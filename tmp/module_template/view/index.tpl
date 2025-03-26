<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between align-items-center">
                    {if Permissions::has('example_edit')}
                        <div class="col-auto">
                            <div class="d-none d-md-block">
                                <button type="button" class="btn btn-primary btn-icon-text" data-action="add">
                                    <i class="mdi mdi-plus btn-icon-prepend"></i> {#button_add#}
                                </button>
                            </div>
                            <div class="d-md-none">
                                <button type="button" class="btn btn-primary btn-icon" data-action="add">
                                    <i class="mdi mdi-plus btn-icon-prepend"></i>
                                </button>
                            </div>
                        </div>
                    {/if}
                    <div class="col col-md-6 col-xxl-4 ms-auto">
                        <div class="input-group">
                            <span class="input-group-text px-2"><i class="mdi mdi-filter-outline"></i></span>
                            <input id="tableFilter" type="text" class="form-control">
                            <button id="tableFilterClear" type="button" class="btn border px-2"><i class="mdi mdi-close text-danger"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="exampleControlTable" class="table table-hover text-nowrap align-middle">
                    <thead>
                    <tr>
                        <th class="text-start">{#example_name#}</th>
                        <th class="text-center" width="1%" data-orderable="false"><i class="mdi mdi-dots-horizontal m-0"></i></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div id="menuTpl" class="d-none">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-icon btn-secondary" type="button" id="exampleListMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="window">
                            <i class="mdi mdi-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="exampleListMenu">
                            <a class="dropdown-item my-1 py-2 d-flex align-items-center" href="{$ABS_PATH}example/edit/:id">
                                <i class="mdi mdi-pen me-1"></i>
                                <span>{#button_edit#}</span>
                            </a>
                            <a class="dropdown-item my-1 py-2 d-flex align-items-center confirmDeleteExample" href="{$ABS_PATH}example/delete/:id">
                                <i class="mdi mdi-trash-can-outline me-1"></i>
                                <span>{#button_delete#}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{$add_modal_tpl}