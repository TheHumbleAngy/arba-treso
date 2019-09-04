<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 11-Jun-19
     * Time: 4:08 PM
     */
?>
<input type="hidden" id="head_title" value="Liste des Membres">
<div class="bg-white col-xl-11 col-xl-10 mx-auto p-2" style="border-radius: 10px">
    <div class="container-fluid">
        <div class="row mb-4 mx-auto">
            <h2 class="col-auto text-center py-2 px-5 mx-auto cadre-titre">Liste des Membres <span>👪</span></h2>
        </div>
        <div class="col-auto row my-2 mx-0 cadre p-4">
            <div class="col col-lg-auto">
                <label for="membre">
                    <input type="text" class="form-control form-control-sm text-uppercase" id="membre" placeholder="Membre..." aria-describedby="textHelp">
                    <small id="textHelp" class="form-text text-muted">Renseigner le nom <strong>OU</strong> le prénom.</small>
                </label>
            </div>
            <div class="col col-lg-auto">
                <button class="btn btn-sm btn-primary px-4 font-weight-bolder" onclick="filterMember('listing')">
                    Afficher <i class="fa fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>
    <div id="feedback" class="my-4">
        <div class="border border-primary rounded">
            <table class="table table-sm table-hover bg-light" id="arr_membres">
                <thead class="bg-primary text-light">
                <tr class="row mx-0">
                    <th class="col-1 text-center">N°</th>
                    <th class="col-1">Id.</th>
                    <th class="col">Membre</th>
                    <th class="col-1">Genre</th>
                    <th class="col-2 col-xl-1">Contact</th>
                    <th class="col-2 col-xl-1">Commune</th>
                    <th class="col-1 col-xl-1">Ville</th>
                    <th class="col-1 col-xl-1">Adhésion</th>
                </tr>
                </thead>
                <tbody id="liste_membres"></tbody>
            </table>
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