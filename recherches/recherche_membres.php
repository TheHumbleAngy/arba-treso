<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 28-Jun-19
     * Time: 11:43 AM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Recherche - Membres <span>👪</span></h2>

        <div class="col-12 mx-auto my-2 cadre p-4">
            <div class="row justify-content-center">
                <label for="nom" class="col-3">
                    <input type="text" class="form-control form-control-sm text-uppercase" id="nom" placeholder="Nom..." aria-describedby="textHelp">
                </label>
                <label for="prenoms" class="col">
                    <input type="text" class="form-control form-control-sm text-uppercase" id="prenoms" placeholder="Prénoms..." aria-describedby="textHelp">
                </label>
                <label for="genre" class="col-2">
                    <select class="custom-select custom-select-sm" id="genre">
                        <option value="">Genre</option>
                        <option value="F">Femme</option>
                        <option value="M">Homme</option>
                    </select>
                </label>
                <label for="localite" class="col-3">
                    <input type="text" class="form-control form-control-sm text-uppercase" id="localite" placeholder="Localité..." aria-describedby="textHelp">
                </label>
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