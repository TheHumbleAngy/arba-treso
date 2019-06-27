<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 11-Jun-19
     * Time: 4:08 PM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Liste des Membres <span>👪</span></h2>

        <div class="col-lg-8 mx-auto row my-2 cadre p-4 justify-content-center">
            <div class="col">
                <label for="membre">
                    <input type="text" class="form-control text-uppercase" id="membre" placeholder="Membre..." aria-describedby="textHelp">
                    <small id="textHelp" class="form-text text-muted">Renseigner soit le nom ou le prénom.</small>
                </label>
            </div>
            <div class="col justify-content-center">
                <button class="btn btn-primary col-6" onclick="filterMembre('listing')">
                    Filtrer <i class="fa fa-arrow-right"></i>
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
                    <th class="col-4">Membre</th>
                    <th class="col-2">Localité</th>
                    <th class="col-2">Contact</th>
                    <th class="col-1">Genre</th>
                    <th class="col-2">Date d'adhésion</th>
                </tr>
                </thead>
                <tbody id="liste_membres"></tbody>
            </table>
        </div>
    </div>
</div>