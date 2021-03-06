<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 23-May-19
     * Time: 2:41 PM
     */
?>
<input type="hidden" id="head_title" value="Liste des Cotisations">
<div class="bg-white col-xl-11 mx-auto p-2 shadow-sm mb-4" style="border-radius: 10px">
    <div class="container-fluid">
        <div class="row mb-4 mx-auto">
            <h2 class="col-auto text-center py-2 px-5 mx-auto cadre-titre">Liste des Cotisations Annuelles <span>📖</span></h2>
        </div>
        <div class="row my-2 mb-4 justify-content-center">
            <div class="col col-lg-auto mx-4 row cadre p-4">
                <div class="col col-lg-auto">
                    <div class="form-group row mb-0 mx-0">
                        <label for="param_annee" class=""></label>
                        <select class="custom-select custom-select-sm" name="annee" id="param_annee">
                            <option value="">Année</option>
                            <option value="<?php echo date('Y'); ?>">
                                <?php echo date('Y'); ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col col-lg-auto">
                    <label for="param">
                        <input type="text" class="form-control form-control-sm text-uppercase" id="param"
                               placeholder="Membre..."
                               aria-describedby="textHelp">
                        <small id="textHelp" class="form-text text-muted">Entrer le nom <strong>OU</strong> le prénom.
                        </small>
                    </label>
                </div>
                <div class="col col-lg-auto">
                    <button class="btn btn-sm btn-primary px-4 font-weight-bolder" onclick="displayConsultations()">
                        Afficher <i class="fa fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>
            <div class="col mx-4 row cadre p-4">
                <div class="col col-xl-auto">
                    <label for="cagnotte_annee">
                        <select class="custom-select custom-select-sm" id="cagnotte_annee"
                                onchange="setMoisCagnotte(this)">
                            <option value="">Année</option>
                            <option value="<?php echo date('Y'); ?>">
                                <?php echo date('Y'); ?>
                            </option>
                        </select>
                    </label>
                </div>
                <div class="col col-xl-auto">
                    <label for="cagnotte_mois">
                        <select class="custom-select custom-select-sm" id="cagnotte_mois" disabled
                                onchange="getCagnotteMoisAnnee(this); getRecetteMoisAnnee(this)">
                            <option value="">Mois</option>
                        </select>
                    </label>
                </div>
                <div class="col ">
                    <label for="cagnotte">
                        <input type="text" class="form-control form-control-sm text-right" id="cagnotte" value="0"
                               readonly aria-describedby="textHelpCagnotte">
                        <small id="textHelpCagnotte" class="form-text text-muted text-right">Cagnotte.</small>
                    </label>
                </div>
                <div class="col ">
                    <label for="recette">
                        <input type="text" class="form-control form-control-sm text-right" id="recette" value="0"
                               readonly aria-describedby="textHelpRecette">
                        <small id="textHelpRecette" class="form-text text-muted text-right">Recette.</small>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="feedback" class="my-lg-4">
        <div class="d-flex justify-content-center">
            <div class="spinner-grow text-primary" role="status" style="display: none">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="feedbackModalLabel">ARBA ❌</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <blockquote class="blockquote">
                        <p class="mb-0"></p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>