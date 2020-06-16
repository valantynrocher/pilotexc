<div class="modal fade" id="activateToggleModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Action sur la sélection</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="activateToggleForm">
                @csrf
                <div class="modal-body">
                    <p></p>
                    <div class="selected-rows-list"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-info">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
