<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 14-Jun-19
     * Time: 5:39 PM
     */
?>
<input type="hidden" id="head_title" value="adhésions">
<div class="bg-white col-11a col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Adhésions <span>🤝</span></h2>
        <div class="row mx-0 my-2 cadre p-4 justify-content-center">
            <div class="col-4 col-lg-2">
                <label for="date_adhe" class="m-0">
                    <input type="date" id="date_adhe" class="form-control" aria-describedby="textHelp" onchange="setDateAdhesion()">
                    <small id="textHelp" class="form-text text-muted">Entrez la date.</small>
                </label>
            </div>
            <div class="col">
                <div class="row">
                    <button class="btn btn-block btn-outline-primary faa-parent animated-hover w-25 mx-auto"
                            disabled
                            id="enregistrer" onclick="saveAdhesions()">
                        <i class="fas fa-save mr-2 faa-pulse"></i>
                        Enregistrer
                    </button>
                </div>
            </div>
        </div>
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
                        <p class="mb-0">La liste des adhérents a bien été enregistrée 👍</p>
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
                    <h4 class="modal-title" id="errorYearModalLabel">ARBA ❌</h4>
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