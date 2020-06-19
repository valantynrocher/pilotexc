<div class="modal fade" id="addFiscalYearModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Ajouter un exercice comptable</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="addFiscalYearForm">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-8 form-group">
                            <label class="mr-3" for="addName">Libellé**</label>
                            <input type="text" name="name" id="addName" class="form-control" readonly>
                        </div>
                        <div class="col-4 form-group">
                            <label for="addStatus">Statut</label>
                            <select type="text" name="status" id="addStatus" class="form-control">
                                <option value="En cours">En cours</option>
                                <option value="Clôturé">Clôturé</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="addMonthStart">Mois de début*</label>
                            <select name="month_start" id="addMonthStart" class="form-control">
                                <option value="0">Sélectionnez un mois de début...</option>
                                <option value="01">Janvier</option>
                                <option value="02">Février</option>
                                <option value="03">Mars</option>
                                <option value="04">Avril</option>
                                <option value="05">Mai</option>
                                <option value="06">Juin</option>
                                <option value="07">Juillet</option>
                                <option value="08">Août</option>
                                <option value="09">Septembre</option>
                                <option value="10">Octobre</option>
                                <option value="11">Novembre</option>
                                <option value="12">Décembre</option>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <label for="addYearStart">Année de début*</label>
                            <select name="year_start" id="addYearStart" class="form-control">
                                <option value="0">Sélectionnez une année de début...</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="addMonthEnd">Mois de fin**</label>
                            <select name="month_end" id="addMonthEnd" class="form-control" readonly>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <label for="addYearEnd">Année de fin**</label>
                            <select name="year_end" id="addYearEnd" class="form-control" readonly>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <small>Les champs marqués d'un** se complètent automatiquement.</small>
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
