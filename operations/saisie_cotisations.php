<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-May-19
     * Time: 5:15 PM
     */
?>

<div class="bg-white col-xl-10 mx-lg-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Cotisations <span>💰</span></h2>

        <form class="row my-2 cadre p-4 justify-content-center mx-auto col-md-8">
            <div class="col ">
                <div class="form-group row mb-0">
                    <label for="param_annee" class="col-sm-2 col-form-label">Année</label>
                    <select class="custom-select custom-select col-sm-3" name="annee" id="param_annee"
                            onchange="choixCotisation()">
                        <option value="">Sélectionner...</option>
                        <option value="<?php echo date('Y'); ?>">
                            <?php echo date('Y'); ?>
                        </option>
                    </select>
                </div>
            </div>
        </form>

    </div>

    <!--    <button class="btn btn-primary" onclick="cboYearLoader(2)">Test ✔️</button>-->
    <div class="row">
        <button class="btn btn-block btn-outline-primary faa-parent animated-hover col-lg-2 col-sm-3 mx-auto my-4"
                disabled
                id="enregistrer" onclick="saveCotisations()">
            <i class="fas fa-save mr-2 faa-pulse"></i>
            Enregistrer
        </button>
    </div>
    <div id="feedback" class="mb-4"></div>

    <!-- Modals -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="successModalLabel">ARBA ✔️</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <blockquote class="blockquote">
                        <p class="mb-0">Les cotisations ont bien été enregistrées 👍</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorYear" tabindex="-1" role="dialog" aria-labelledby="errorYearModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="errorYearModalLabel">ARBA 🚫</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <blockquote class="blockquote">
                        <p class="mb-0">Veuillez sélectionner l'année SVP.</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>