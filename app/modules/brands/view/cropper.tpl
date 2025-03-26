<!-- Modal -->
<div class="modal fade" id="cropperModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <style>
                        .cropper-view-box {
                            border-radius: 0;
                        }
                    </style>
                    <div class="ratio ratio-1x1">
                        <img src="{$ABS_PATH}assets/images/placeholder.jpg" class="w-100" style="max-height: 70vh" id="croppingImage" alt="cropper">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">{#button_cancel#}</button>
                <button type="button" id="applyCroppedImage" class="btn btn-primary rounded-pill">{#button_apply#}</button>
            </div>
        </div>
    </div>
</div>