<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jul-19
     * Time: 10:07 AM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Statistiques - Membres <span>👪</span></h2>

        <div class="col-12 mx-auto my-2 cadre p-4">
            <div class="row justify-content-center">
                <label for="nom" class="col">
                    <input type="text" class="form-control text-uppercase" id="nom" placeholder="Nom..." aria-describedby="textHelp">
                </label>
                <label for="genre" class="col col-lg-2">
                    <select class="custom-select custom-select" id="genre">
                        <option value="">Genre</option>
                        <option value="F">Feminin</option>
                        <option value="M">Masculin</option>
                    </select>
                </label>
                <label for="localite" class="col">
                    <input type="text" class="form-control text-uppercase" id="localite" placeholder="Localité..." aria-describedby="textHelp">
                </label>
            </div>
            <div class="row mt-2 justify-content-center">
                <div class="col-4 col-md-3 col-lg-2">
                    <button class="btn btn-primary col" onclick="">
                        Afficher <i class="far fa-chart-bar"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div id="feedback" class="my-4"></div>
</div>