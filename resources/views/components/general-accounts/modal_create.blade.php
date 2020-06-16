<div class="modal fade" id="addModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ajouter un compte général</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="addForm">
                <div class="modal-body">

                    @csrf

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="addId">N° compte*</label>
                            <input type="number" name="id" id="addId" class="form-control" required>
                        </div>
                        <div class="col-md-7 form-group">
                            <label for="addName">Libellé*</label>
                            <input type="text" name="name" id="addName" class="form-control" required>
                        </div>
                        <div class="col-md-2 form-group p-4">
                            <div class="custom-control custom-switch custom-switch-off-normal custom-switch-on-info">
                                <input type="checkbox" name="active" class="custom-control-input" id="addActive" value="1">
                                <label class="custom-control-label" for="addActive">Actif</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        CERFA 1
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="addCerfa1Group">Groupe*</label>
                            <select name="cerfa1_group" id="addCerfa1Group" class="custom-select">
                                <option value="0" selected>Sélectionner un groupe...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="addCerfa1Line">Ligne*</label>
                            <select name="cerfa1_line_id" id="addCerfa1Line" class="custom-select" disabled>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
