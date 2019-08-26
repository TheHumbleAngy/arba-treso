<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 23-May-19
     * Time: 2:41 PM
     */
?>
<input type="hidden" id="head_title" value="Liste des Cotisations">
<div class="bg-white col-xl-11 mx-auto p-2" style="border-radius: 10px">
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
                    <button class="btn btn-sm btn-primary px-4 font-weight-bolder" onclick="procederConsultation('param')">
                        Afficher <i class="fa fa-arrow-right"></i>
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
                <div class="col col-xl-auto">
                    <label for="cagnotte">
                        <input type="text" class="form-control form-control-sm text-right" id="cagnotte" value="0"
                               readonly aria-describedby="textHelpCagnotte">
                        <small id="textHelpCagnotte" class="form-text text-muted text-right">Cagnotte.</small>
                    </label>
                </div>
                <div class="col col-xl-auto">
                    <label for="recette">
                        <input type="text" class="form-control form-control-sm text-right" id="recette" value="0"
                               readonly aria-describedby="textHelpRecette">
                        <small id="textHelpRecette" class="form-text text-muted text-right">Recette.</small>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="feedback" class="mb-4"></div>
</div>