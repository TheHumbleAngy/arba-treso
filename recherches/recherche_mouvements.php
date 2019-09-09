<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 28-Aug-19
     * Time: 4:09 PM
     */
?>
<input type="hidden" id="head_title" value="Recherche - Mouvements">
<div class="bg-white col mx-auto p-2" style="border-radius: 10px">
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
                                        <select class="custom-select custom-select-sm" id="typ_op" onchange="setCategorie(this)">
                                            <option value="">Type...</option>
                                            <option value="0">Décaissement</option>
                                            <option value="1">Encaissement</option>
                                        </select>
                                    </label>
                                    <label for="cate" class="col">
                                        <select class="custom-select custom-select-sm" id="categorie">
                                            <option value="">Catégorie...</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col ">
                                <h5 class="cadre-titre-search">Période</h5>
                                <div class="row">
                                    <label for="annee" class="col">
                                        <select class="custom-select custom-select-sm" id="annee">
                                            <option value="">Année...</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </label>
                                    <label for="mois" class="col">
                                        <select class="custom-select custom-select-sm" id="mois">
                                            <option value="">Mois...</option>
                                            <option value="M01">Janvier</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0 my-3">
                            <div class="col-8">
                                <h5 class="cadre-titre-search">Bénéficiaire - Donateur</h5>
                                <div class="row">
                                    <label for="nom" class="col-4">
                                        <input type="text" class="form-control form-control-sm text-uppercase" id="nom"
                                               placeholder="Nom...">
                                    </label>
                                    <label for="prenoms" class="col">
                                        <input type="text" class="form-control form-control-sm text-uppercase"
                                               id="prenoms"
                                               placeholder="Prenoms...">
                                    </label>
                                </div>
                                <div class="row">
                                    <label for="titre" class="col col-lg-auto">
                                        <input type="text" class="form-control form-control-sm text-uppercase"
                                               id="titre"
                                               placeholder="Titre...">
                                    </label>
                                    <label for="commune" class="col col-lg-auto">
                                        <input type="text" class="form-control form-control-sm text-uppercase"
                                               id="commune"
                                               placeholder="Commune...">
                                    </label>
                                    <label for="contact" class="col col-lg-auto">
                                        <input type="text" class="form-control form-control-sm text-uppercase"
                                               id="contact"
                                               placeholder="Contact...">
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <h5 class="cadre-titre-search">Membre Intermédiaire</h5>
                                <div class="row">
                                    <label for="nom" class="col">
                                        <input type="text" class="form-control form-control-sm text-uppercase"
                                               id="membre"
                                               placeholder="Nom ou prenoms...">
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
                        <div class="row mx-0">
                            <button class="btn btn-sm btn-outline-dark col" type="reset"
                                    title="Reinitialiser les zones de saisie" aria-describedby="textHelp">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                        <small id="textHelp" class="form-text text-muted">Réinitialiser les champs</small>
                    </div>
                </div>

                <div class="row my-2 justify-content-center">
                    <div class="col-2">
                        <button class="btn btn-sm btn-primary col font-weight-bolder" onclick="findMouvements()"
                                title="Rechercher" type="button">
                            Rechercher <i class="fa fa-search ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="feedback" class="my-4"></div>

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