<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 28-Jun-19
     * Time: 11:43 AM
     */
?>
<input type="hidden" id="head_title" value="Recherche - Membres">
<div class="bg-white col-10 mx-auto p-2" style="border-radius: 10px">
    <div class="container-fluid">
        <div class="row mb-4 mx-auto">
            <h2 class="col-auto text-center py-2 px-5 mx-auto cadre-titre">Recherche - Membres <span>👪</span></h2>
        </div>
        <form novalidate>
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
                            <div class="col">
                                <div class="row">
                                    <label for="ville" class="col">
                                        <input type="text" class="form-control form-control-sm text-uppercase awesomplete" id="ville"
                                               placeholder="Ville...">
                                    </label>
                                </div>
                                <div class="row mx-0 justify-content-end">
                                    <button class="btn btn-sm btn-outline-dark col col-lg-10 col-xl-8" type="reset" title="Reinitialiser les zones de saisie" aria-describedby="textHelp">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </div>
                                <small id="textHelp" class="form-text text-muted text-lg-right">Réinitialiser les champs</small>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row my-2 justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2">
                        <button class="btn btn-sm btn-primary col font-weight-bolder" onclick="findMembres('recherche')" title="Rechercher" type="button">
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