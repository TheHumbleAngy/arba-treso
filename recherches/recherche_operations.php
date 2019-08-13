<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jul-19
     * Time: 9:54 AM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Recherche - Cotisations <span>💰</span></h2>
        <div class="col-12 my-2 cadre px-4 py-2">
            <div class="row">
                <div class="col-9">
                    <div class="row mx-0 my-3">
                        <div class="col mr-4">
                            <h5 class="cadre-titre-search">Types d'oprération</h5>
                            <div class="row">
                                <label for="typ_op" class="col">
                                    <select class="custom-select custom-select-sm text-uppercase" id="typ_op" onchange="">
                                        <option value="">Type...</option>
                                        <option value="0">Dépense</option>
                                        <option value="1">Recette</option>
                                    </select>
                                </label>
                                <label for="cate" class="col">
                                    <select class="custom-select custom-select-sm text-uppercase" id="categorie">
                                        <option value="">Categorie...</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col ">
                            <h5 class="cadre-titre-search">Année</h5>
                            <div class="row">
                                <label for="annee" class="col">
                                    <select class="custom-select custom-select-sm text-uppercase" id="annee">
                                        <option value="">Annee...</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </label>
                                <label for="mois" class="col">
                                    <select class="custom-select custom-select-sm text-uppercase" id="mois">
                                        <option value="">Mois...</option>
                                        <option value="M01">Janvier</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 my-3">
                        <div class="col-11 mr-3">
                            <h5 class="cadre-titre-search">Membres</h5>
                            <div class="row">
                                <label for="nom" class="col-4">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="nom"
                                           placeholder="Nom...">
                                </label>
                                <label for="prenoms" class="col">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="prenoms"
                                           placeholder="Prenoms...">
                                </label>
                            </div>
                            <div class="row">
                                <label for="genre" class="col-3">
                                    <select class="custom-select custom-select-sm text-uppercase" id="genre">
                                        <option value="">Genre...</option>
                                        <option value="F">Femme</option>
                                        <option value="H">Homme</option>
                                    </select>
                                </label>
                                <label for="commune" class="col">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="commune"
                                           placeholder="Commune...">
                                </label>
                                <label for="ville" class="col">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="ville"
                                           placeholder="Ville...">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row mx-0 my-3">
                        <div class="col px-0">
                            <h5 class="cadre-titre-search">Dates</h5>
                            <div class="row">
                                <div class="col">
                                    <label for="date_ope">
                                        <input type="date" id="date_ope" class="form-control form-control-sm"
                                               aria-describedby="textHelp">
                                        <small id="textHelp" class="form-text text-muted">Date de l'opération</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 my-3">
                        <div class="col px-0">
                            <div class="row">
                                <div class="col">
                                    <label for="date_saisie">
                                        <input type="date" id="date_saisie" class="form-control form-control-sm"
                                               aria-describedby="textHelp">
                                        <small id="textHelp" class="form-text text-muted">Date de saisie de l'opération</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-2 justify-content-center">
                <div class="col-2">
                    <button class="btn btn-primary col" onclick="searchOperation()" title="Rechercher">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="feedback" class="my-4"></div>
</div>