<div class="modal fade" id="addModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ajouter un compte analytique</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="addForm">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-8 form-group">
                            <label for="addId">Code*</label>
                            <input type="number" name="id" id="addId" class="form-control" required>
                        </div>
                        <div class="col-lg-7 col-sm-12 form-group">
                            <label for="addName">Libellé*</label>
                            <input type="text" name="name" id="addName" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4 form-group p-4">
                            <div class="custom-control custom-switch custom-switch-off-normal custom-switch-on-info">
                                <input type="checkbox" name="active" class="custom-control-input" id="addActive" value="1">
                                <label class="custom-control-label" for="addActive">Actif</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col form-group">
                            <label for="addStructure">Structure*</label>
                            <select name="structure_id" id="addStructure" class="custom-select" required>
                                <option value="0" selected>Sélectionner une structure...</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col form-group">
                            <label for="addFolder">Dossier*</label>
                            <select name="folder" id="addFolder" class="custom-select" required>
                                <option value="0" selected>Sélectionner un dossier...</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="addSector">Secteur*</label>
                            <select name="sector" id="addSector" class="custom-select" disabled required>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="addService">Service*</label>
                            <select name="service_id" id="addService" class="custom-select" disabled required>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn bg-pink">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
