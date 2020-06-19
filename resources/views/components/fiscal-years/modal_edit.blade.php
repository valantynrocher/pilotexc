<div class="modal fade" id="editFiscalYearModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Modifier le statut de l'<span id="nameFiscalYear"></span></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="editFiscalYearForm">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col form-group">
                            <label for="editStatus">Statut</label>
                            <select type="text" name="status" id="editStatus" class="form-control">
                                <option value="En cours">En cours</option>
                                <option value="Clôturé">Clôturé</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
