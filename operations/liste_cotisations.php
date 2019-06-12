<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 23-May-19
     * Time: 2:41 PM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Liste des Cotisations <span>📖</span></h2>
        <div class="row">
            <div class="col-8 my-2 cadre p-4 justify-content-center">
                <div class="row">
                    <div class="col">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="general" name="rdoChoix" class="custom-control-input" value="1"
                                   onchange="choixProceder()">
                            <label class="custom-control-label" for="general">Général</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="particulier" name="rdoChoix" class="custom-control-input" value="2"
                                   onchange="choixProceder()">
                            <label class="custom-control-label" for="particulier">Particulier</label>
                        </div>
                    </div>
                    <div class="col">
                        <label for="particulier_mbr">
                            <input type="text" class="form-control" id="particulier_mbr" placeholder="Membre..."
                                   disabled>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-3 ml-2 cadre my-2 p-4">
                <div class="form-group row mb-0 mx-0">
                    <label for="param_annee" class="col col-form-label">Année</label>
                    <select class="custom-select custom-select col" name="annee" id="param_annee"
                            onchange="choixCotisation()">
                        <option value="<?php echo date('Y'); ?>">
                            <?php echo date('Y'); ?>
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-center my-4">
            <button class="btn btn-primary col-lg-3 col-md-4" onclick="procederConsultation()">
                Proceder <i class="fa fa-arrow-right"></i>
            </button>
        </div>
    </div>

    <div id="feedback" class="mb-4"></div>
</div>