<div class="modal fade" id="importModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Importer les écritures</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="addFiscalYearForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Lisez bien ceci :</h5>
                        <ul>
                            <li>l'import ne peut se faire que pour un exercice non clôturé</li>
                            <li>votre fichier d'écritures doit être structuré ainsi : section analytique, code général, date, journal, n° pièce, libellé, montant débit, montant crédit, type (Situation, Réalisé)</li>
                            <li>votre fichier doit comporter l'intégralité des écritures pour l'exercice sélectionné</li>
                        </ul>
                    </div>
                    @csrf
                    <div class="form-group">
                        <select name="fiscal_year_id" class="form-control" id="fiscalYear" required>
                            <option value="0">Sélectionnez un exercice comptable...</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                {{-- <input type="file" class="custom-file-input" name="scriptures" id="scripturesImport" aria-describedby="fileHelp" required>
                                <label class="custom-file-label" for="scripturesImport">Sélectionnez un fichier à importer</label> --}}
                                <input type="file" class="form-control mr-5" name="scriptures" id="scripturesImport" aria-describedby="fileHelp" required>
                            </div>
                        </div>
                        <small id="fileHelp" class="form-text text-muted">(Taille maximum : 5 Mo, Formats acceptés : *.xlsx, *.xls, *.csv)</small>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" id="submitImport" class="btn btn-primary">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
