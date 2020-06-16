<div class="card">
    <div class="card-header bg-pink">
        <h4 class="card-title bg-pink">Fonctionnalités</h4>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div>
                    <h6>Actions</h6>
                </div>
                <div>
                    <button type="button" class="btn mb-2 mr-2 bg-pink" data-target="#addModal" data-toggle="modal">
                        <i class="fas fa-plus-circle mr-2"></i>Ajouter
                    </button>
                </div>
            </div>
            <div class="col-md-5 mb-3">
                <div>
                    <h6>Filtrer par</h6>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend"><label class="input-group-text">Actif</label></div>
                    <select class="custom-select filter-select" data-column="7" id="activeSelect">
                        <option value="">Tous</option>
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend"><label class="input-group-text">Recherche</label></div>
                    <input type="text" id="searchInput" class="form-control" placeholder="Votre mot-clé">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div>
                    <h6>Actions sur sélection en cours</h6>
                </div>
                <div class="mb-2">
                    <button type="button" id="affectBtn" class="select-action btn btn-info disabled"
                    data-target="#affectModal" data-toggle="modal">
                        <i class="fas fa-folder-open mr-2"></i>Affecter
                    </button>
                </div>
                <div>
                    <button type="button" id="activateBtn" class="select-action btn btn-info mb-2 mr-2 disabled"
                    data-target="#activateToggleModal" data-action="activate" data-state="Actif" data-toggle="modal">
                        <i class="fas fa-check-circle mr-2"></i>Activer
                        </button>

                    <button type="button" id="desactivateBtn" class="select-action btn btn-info mb-2 disabled"
                    data-target="#activateToggleModal" data-action="desactivate" data-state="Inactif" data-toggle="modal">
                        <i class="fas fa-times-circle mr-2"></i>Désactiver
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
