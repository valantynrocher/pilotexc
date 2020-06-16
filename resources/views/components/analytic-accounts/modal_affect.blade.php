<div class="modal fade" id="affectModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Affecter la sélection de comptes</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="affectForm">
                <div class="modal-body">
                    <p></p>
                    <div class="selected-rows-list"></div>
                    @csrf
                    <div class="row">
                        <div class="col form-group">
                            <label for="affectStructure">Structure*</label>
                            <select name="structure_id" id="affectStructure" class="custom-select" required>
                                <option value="0" selected>Sélectionner une structure...</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col form-group">
                            <label for="affectFolder">Dossier*</label>
                            <select name="folder" id="affectFolder" class="custom-select" required>
                                <option value="0" selected>Sélectionner un dossier...</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="affectSector">Secteur*</label>
                            <select name="sector" id="affectSector" class="custom-select" disabled required>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="affectService">Service*</label>
                            <select name="service_id" id="affectService" class="custom-select" disabled required>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-info">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
