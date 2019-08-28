<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 28-Aug-19
     * Time: 4:09 PM
     */
?>
<input type="hidden" id="head_title" value="Recherche - Mouvements">
<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">
    <div class="container-fluid">
        <div class="row mb-4 mx-auto">
            <h2 class="col-auto text-center py-2 px-5 mx-auto cadre-titre">Recherche - Mouvements <span>🔄</span></h2>
        </div>
        <form novalidate>
            <div class="col-12 my-2 cadre px-4 py-2">
                <div class="row">
                    <div class="col">
                        <div class="row mx-0 my-3">
                            <div class="col mr-4">
                                <h5 class="cadre-titre-search">Type d'oprération</h5>
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
                                <h5 class="cadre-titre-search">Période</h5>
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
                                <h5 class="cadre-titre-search">Interlocuteur</h5>
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
                                    <label for="titre" class="col col-lg-auto">
                                        <input type="text" class="form-control form-control-sm text-uppercase" id="titre"
                                               placeholder="Titre...">
                                    </label>
                                    <label for="commune" class="col col-lg-auto">
                                        <input type="text" class="form-control form-control-sm text-uppercase" id="commune"
                                               placeholder="Commune...">
                                    </label>
                                    <label for="contact" class="col col-lg-auto">
                                        <input type="text" class="form-control form-control-sm text-uppercase" id="contact"
                                               placeholder="Contact...">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
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
                        <div class="row mx-0">
                            <button class="btn btn-sm btn-outline-dark col" type="reset" title="Reinitialiser les zones de saisie">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row my-2 justify-content-center">
                    <div class="col-2">
                        <button class="btn btn-sm btn-primary col font-weight-bolder" onclick="searchMouvements()" title="Rechercher" type="button">
                            Rechercher <i class="fa fa-search ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="feedback" class="my-4"></div>
</div>