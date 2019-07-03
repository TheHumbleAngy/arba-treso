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
                <label for="nom" class="col-4">
                    <input type="text" class="form-control text-uppercase" id="nom" placeholder="Nom..." aria-describedby="textHelp">
                    <!--<small id="textHelp" class="form-text text-muted">Renseigner soit le nom ou le prénom.</small>-->
                </label>
                <label for="prenoms" class="col-4">
                    <input type="text" class="form-control text-uppercase" id="prenoms" placeholder="Prénoms..." aria-describedby="textHelp">
                    <!--<small id="textHelp" class="form-text text-muted">Renseigner soit le nom ou le prénom.</small>-->
                </label>
                <label for="genre" class="col-1">
                    <select class="custom-select custom-select" id="genre" aria-describedby="textHelp">
                        <option></option>
                        <option value="F">F</option>
                        <option value="M">M</option>
                    </select>
                    <small id="textHelp" class="form-text text-muted">Genre</small>
                </label>
                <label for="date_adhe" class="col">
                    <input type="date" id="date_adhe" class="form-control" aria-describedby="textHelp">
                    <small id="textHelp" class="form-text text-muted">Renseigner la date d'adhésion.</small>
                </label>
            </div>
            <div class="row ">
                <label for="localite" class="col-4">
                    <input type="text" class="form-control text-uppercase" id="localite" placeholder="Localité..." aria-describedby="textHelp">
                    <!--<small id="textHelp" class="form-text text-muted">Renseigner soit le nom ou le prénom.</small>-->
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