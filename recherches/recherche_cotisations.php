<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jul-19
     * Time: 9:54 AM
     */
?>
<input type="hidden" id="head_title" value="Recherche - Cotisations">
<div class="bg-white col mx-auto p-2" style="border-radius: 10px">
    <div class="container-fluid">
        <div class="row mb-4 mx-auto">
            <h2 class="col-auto text-center py-2 px-5 mx-auto cadre-titre">Recherche - Cotisations <span>💰</span></h2>
        </div>
        <form novalidate>
            <div class="col-12 my-2 cadre px-4 py-2">
                <div class="row">
                    <div class="col">
                        <div class="row mx-0 my-3">
                            <div class="col mr-4">
                                <h5 class="cadre-titre-search">Période</h5>
                                <div class="row">
                                    <label for="annee" class="col">
                                        <select class="custom-select custom-select-sm " id="annee">
                                            <option value="">Année...</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </label>
                                    <label for="mois" class="col">
                                        <select class="custom-select custom-select-sm " id="mois">
                                            <option value="">Mois...</option>
                                            <option value="M01">Janvier</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col ">
                                <h5 class="cadre-titre-search">Localité</h5>
                                <div class="row">
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
                        <div class="row mx-0 my-3">
                            <div class="col col-md-10 col-lg-8 mr-3">
                                <h5 class="cadre-titre-search">Membre</h5>
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
                                            <small id="textHelp" class="form-text text-muted">...de l'opération</small>
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
                                            <small id="textHelp" class="form-text text-muted">...de saisie de l'opération</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <button class="btn btn-sm btn-outline-dark col" type="reset" title="Reinitialiser les zones de saisie" aria-describedby="textHelp">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                        <small id="textHelp" class="form-text text-muted">Réinitialiser les champs</small>
                    </div>
                </div>

                <div class="row my-2 justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2">
                        <button class="btn btn-sm btn-primary col font-weight-bolder" onclick="searchCotisations()" title="Rechercher" type="button">
                            Rechercher <i class="fa fa-search ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="feedback" class="my-4"></div>
</div>