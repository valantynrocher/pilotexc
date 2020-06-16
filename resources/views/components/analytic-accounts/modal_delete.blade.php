<div class="modal fade" id="deleteModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h6 class="modal-title">Supprimer le compte analytique</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="deleteForm">
                @csrf
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-outline-light">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
