<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 03-Aug-19
     * Time: 1:31 PM
     */
    ?>
<input type="hidden" id="head_title" value="Liste des Adhésions">
<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">
    <div class="container-fluid">
        <div class="row mb-4 mx-auto">
            <h2 class="col-auto text-center py-2 px-5 mx-auto cadre-titre">Liste des Adhésions <span>👪</span></h2>
        </div>
        <div class="col-auto row my-2 mx-0 cadre p-4">
            <div class="col col-lg-auto">
                <label for="membre">
                    <input type="text" class="form-control form-control-sm text-uppercase" id="membre" placeholder="Membre..." aria-describedby="textHelp">
                    <small id="textHelp" class="form-text text-muted">Renseigner soit le nom ou le prénom.</small>
                </label>
            </div>
            <div class="col col-lg-auto">
                <button class="btn btn-sm btn-primary px-4 font-weight-bolder" onclick="filterAdhesion()">
                    Afficher <i class="fa fa-arrow-right"></i>
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
                    <th class="col">Membre</th>
                    <th class="col-2">Date d'Adhésion</th>
                </tr>
                </thead>
                <tbody id="liste_membres"></tbody>
            </table>
        </div>
    </div>
</div>