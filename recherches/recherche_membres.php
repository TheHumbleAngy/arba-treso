<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 28-Jun-19
     * Time: 11:43 AM
     */
?>

<div class="bg-white col-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Recherche - Membres <span>👪</span></h2>

        <div class="col-12 mx-auto my-2 cadre p-4">
            <div class="row ">
                <div class="col-7">
                    <h5 class="cadre-titre-search">Membre</h5>
                    <div class="row">
                        <label for="nom" class="col">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="nom"
                                   placeholder="Nom...">
                        </label>
                        <label for="genre" class="col-5">
                            <select class="custom-select custom-select-sm" id="genre">
                                <option value="">Genre</option>
                                <option value="F">Femme</option>
                                <option value="H">Homme</option>
                            </select>
                        </label>
                    </div>
                    <div class="row">
                        <label for="prenoms" class="col">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="prenoms"
                                   placeholder="Prénoms...">
                        </label>
                    </div>
                </div>
                <div class="col">
                    <h5 class="cadre-titre-search">Localité</h5>
                    <div class="row">
                        <label for="commune" class="col">
                            <input type="text" class="form-control form-control-sm text-uppercase awesomplete" id="commune"
                                   placeholder="Commune...">
                        </label>
                        <label for="ville" class="col">
                            <input type="text" class="form-control form-control-sm text-uppercase awesomplete" id="ville"
                                   placeholder="Ville...">
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mt-2 justify-content-center">
                <div class="col-2">
                    <button class="btn btn-primary col" onclick="searchMember('recherche')" title="Rechercher">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="feedback" class="my-4"></div>
</div>