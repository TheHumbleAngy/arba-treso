<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-May-19
     * Time: 5:15 PM
     */
?>
<input type="hidden" id="head_title" value="cotisations">
<div class="bg-white col-xl-11 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <div class="row mb-4 mx-auto">
            <h2 class="col-auto text-center py-2 px-5 mx-auto cadre-titre">Cotisations Mensuelles <span>💰</span></h2>
        </div>
        <form class="col-auto my-2 cadre p-4 mx-auto">
            <div class="form-row mb-0 mx-0">
                <div class="col-auto">
                    <label for="param_annee" class="">
                        <select class="custom-select custom-select-sm" name="annee" id="param_annee" aria-describedby="textHelp">
                            <option value="">Sélectionner...</option>
                            <option value="<?php echo date('Y'); ?>">
                                <?php echo date('Y'); ?>
                            </option>
                        </select>
                        <small id="textHelp" class="form-text text-muted">Année</small>
                    </label>


                </div>
                <div class="col-auto">
                    <label for="date_ope" class="">
                        <input type="date" id="date_ope" class="form-control form-control-sm"
                               aria-describedby="passwordHelpInline" onchange="showCotisations()">
                        <small id="textHelp" class="form-text text-muted">Date</small>
                    </label>


                </div>
                <div class="col-auto d-flex align-items-center justify-content-center">
                    <button class="btn btn-sm btn-primary faa-parent animated-hover col-auto px-4 mx-auto ml-md-5 font-weight-bolder"
                            disabled type="button"
                            id="enregistrer" onclick="saveCotisations()">
                        <i class="fas fa-save mr-2 faa-pulse"></i>
                        Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">

    </div>
    <div id="feedback" class="my-lg-4"></div>

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

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorYearModalLabel"
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
                        <p class="mb-0"></p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>