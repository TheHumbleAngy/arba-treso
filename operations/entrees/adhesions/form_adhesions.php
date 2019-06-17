<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 14-Jun-19
     * Time: 5:39 PM
     */
?>

<div class="bg-white col-xl-10 mx-lg-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Adhésions <span>📝</span></h2>
        <div class="col-lg-8 mx-auto row my-2 cadre p-4 justify-content-center">
            <div class="col">
                <label for="date_adhe">
                    <input type="date" id="date_adhe" class="form-control" aria-describedby="textHelp" onchange="choixDateAdhesion()">
                    <small id="textHelp" class="form-text text-muted">Renseigner la date d'adhésion.</small>
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <button class="btn btn-block btn-outline-primary faa-parent animated-hover col-lg-2 col-sm-3 mx-auto my-4"
                disabled
                id="enregistrer" onclick="">
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