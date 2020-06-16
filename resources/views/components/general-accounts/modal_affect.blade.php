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
                    <div class="form-group mb-2">
                       CERFA 1
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="affectCerfa1Group">Groupe</label>
                            <select name="cerfa1_group" id="affectCerfa1Group" class="custom-select">
                                <option value="0" selected>Sélectionner un groupe...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="affectCerfa1Line">Ligne</label>
                            <select name="cerfa1_line_id" id="affectCerfa1Line" class="custom-select" disabled>
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
