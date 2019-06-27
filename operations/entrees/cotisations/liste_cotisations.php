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
            <div class="col-lg-8 my-2 mx-auto row cadre p-4 justify-content-center">
                <div class="col">
                    <div class="form-group row mb-0 mx-0">
                        <label for="param_annee" class="col col-form-label text-right">Année</label>
                        <select class="custom-select custom-select col" name="annee" id="param_annee">
                            <option value="<?php echo date('Y'); ?>">
                                <?php echo date('Y'); ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="param">
                        <input type="text" class="form-control text-uppercase" id="param" placeholder="Membre..."
                               aria-describedby="textHelp">
                        <small id="textHelp" class="form-text text-muted">Renseigner le nom ou le prénom.</small>
                    </label>
                </div>
                <div class="col">
                    <button class="btn btn-primary col col-lg-10" onclick="procederConsultation('param')">
                        Proceder <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="feedback" class="mb-4"></div>
</div>