<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 23-May-19
     * Time: 2:41 PM
     */
?>

<div class="bg-white col-xl-11 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Liste des Cotisations <span>📖</span></h2>

        <div class="row my-2 mb-4">
            <div class="col mx-0 row cadre p-4 justify-content-center">
                <div class="col">
                    <div class="form-group row mb-0 mx-0">
                        <label for="param_annee" class="col col-form-label text-right">Année</label>
                        <select class="custom-select custom-select-sm col" name="annee" id="param_annee">
                            <option value="<?php echo date('Y'); ?>">
                                <?php echo date('Y'); ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="param">
                        <input type="text" class="form-control form-control-sm text-uppercase" id="param" placeholder="Membre..."
                               aria-describedby="textHelp">
                        <small id="textHelp" class="form-text text-muted">Renseigner le nom ou le prénom.</small>
                    </label>
                </div>
                <div class="col col-lg-3">
                    <button class="btn btn-sm btn-primary col" onclick="procederConsultation('param')">
                        Proceder <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="col mx-0 ml-1 cadre p-4 row">
                <div class="col">
                    <div class="form-group row mb-0 mx-0">
                        <label for="cagnotte_annee"></label><select class="custom-select custom-select-sm col col-lg-4 mx-1" name="annee" id="cagnotte_annee" onchange="setMoisCagnotte(this)">
                            <option value="">Annee</option>
                            <option value="<?php echo date('Y'); ?>">
                                <?php echo date('Y'); ?>
                            </option>
                        </select>
                        <label for="cagnotte_mois"></label><select class="custom-select custom-select-sm col mx-1" name="annee" id="cagnotte_mois" disabled onchange="getCagnotteMoisAnnee(this); getRecetteMoisAnnee(this)">
                            <option value="">Mois</option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group row mb-0 mx-0">
                        <label for="cagnotte"></label>
                        <div class="col px-0">
                            <input type="text" class="form-control form-control-sm text-right" id="cagnotte" value="0" readonly
                                   aria-describedby="textHelp">
                            <small id="textHelp" class="form-text text-muted text-right">Cagnotte.</small>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group row mb-0 mx-0">
                        <label for="recette"></label>
                        <div class="col px-0">
                            <input type="text" class="form-control form-control-sm text-right" id="recette" value="0" readonly
                                   aria-describedby="textHelp">
                            <small id="textHelp" class="form-text text-muted text-right">Recette.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="feedback" class="mb-4"></div>
</div>