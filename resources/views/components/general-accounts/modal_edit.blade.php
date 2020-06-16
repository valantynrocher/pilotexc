<div class="modal fade" id="editModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Modifier le compte général</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="editForm">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="editId">N° compte*</label>
                            <input type="number" name="id" id="editId" class="form-control" disabled required>
                        </div>
                        <div class="col-md-7 form-group">
                            <label for="editName">Libellé*</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="col-md-2 form-group p-4">
                            <div class="custom-control custom-switch custom-switch-off-normal custom-switch-on-info">
                                <input type="checkbox" name="active" class="custom-control-input" id="editActive">
                                <label class="custom-control-label" for="editActive">Actif</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        CERFA 1
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="editCerfa1Group">Groupe*</label>
                            <select name="cerfa1_group" id="editCerfa1Group" class="custom-select">
                                <option value="0">Sélectionner un groupe...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="editCerfa1Line">Ligne*</label>
                            <select name="cerfa1_line_id" id="editCerfa1Line" class="custom-select">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn bg-teal">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
