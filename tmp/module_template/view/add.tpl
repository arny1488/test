<!-- Modal -->
<div class="modal fade" id="addExampleModal" tabindex="-1" aria-labelledby="addExampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addExampleForm" method="post" action="{$ABS_PATH}example/add">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExampleModalLabel"> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{#button_close#}"></button>
                </div>
                <div class="modal-body pb-2">
                    <div class="mb-3">
                        <label for="example_name">{#example_name#}</label>
                        <input class="form-control bs-max-length" maxlength="100" name="example_name" value="" id="example_name" type="text" placeholder="{#example_name#}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{#button_cancel#}</button>
                    <button type="submit" class="btn btn-primary">{#button_add#}</button>
                </div>
            </form>
        </div>
    </div>
</div>