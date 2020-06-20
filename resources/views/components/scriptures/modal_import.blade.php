<div class="modal fade" id="importModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Importer les écritures</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="importScriptures" enctype="multipart/form-data">

                    <div class="alert alert-warning alert-dismissible mb-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Lisez bien ceci :</h5>
                        <ul>
                            <li>l'import ne peut se faire que pour un exercice non clôturé</li>
                            <li>votre fichier d'écritures doit être structuré ainsi : section analytique, code général, date, journal, n° pièce, libellé, montant débit, montant crédit, type (Situation, Réalisé)</li>
                            <li>votre fichier doit comporter l'intégralité des écritures pour l'exercice sélectionné</li>
                        </ul>
                    </div>

                    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
                    @csrf

                    <div class="form-group mb-4" id="step1">
                        <label for="fiscalYear">Exercice comptable* :</label>
                        <select name="fiscal_year_id" class="form-control" id="fiscalYear" required>
                            <option value="0">Sélectionnez un exercice...</option>
                        </select>
                        <div class="alert alert-light mt-2 d-none" id="checkScripturesInfo" role="alert"></div>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label for="fiscalYear">Type d'écritures :</label>
                        <select name="entry_type" class="form-control" id="entryType" required>
                            <option value="null">Sélectionnez un type d'écritures à importer...</option>
                            <option value="Situation">Situation</option>
                            <option value="Réalisé">Réalisé</option>
                            <option value="Prévisionnel">Prévisionnel</option>
                        </select>
                    </div> --}}
                    <div class="form-group mb-4 d-none" id="step2">
                        <label for="scripturesImport">Fichier à importer* :</label>
                        <input type="file" class="form-control" name="scriptures" id="scripturesImport" aria-describedby="fileHelp" required>
                        <small id="fileHelp" class="form-text text-muted">(Taille maximum : 5 Mo, Formats acceptés : *.xlsx, *.xls, *.csv)</small>
                    </div>

                    <div class="form-group mb-4 d-none" id="step3">
                        <label for="scripturesImport">Montant attendu* :</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="amount_check" id="amountCheck" placeholder="Montant en €" aria-label="Montant en euros" aria-describedby="amountCheckHelp">
                            <div class="input-group-append">
                                <button class="btn btn-warning" id="amountCheckBtn" type="button" disabled>Vérifier</button>
                            </div>
                        </div>
                        <small id="amountCheckHelp" class="form-text text-muted">Saisissez un résultat entier attendu pour l'exercice sélectionné. Vous devez vérifier ce résultat avant de finaliser l'import.</small>
                        <div class="alert mt-2 d-none" id="amountCheckInfo" role="alert"></div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
                        <div>
                            <button type="submit" id="submitImport" class="btn btn-primary" disabled>Importer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
