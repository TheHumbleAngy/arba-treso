<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 14-Jun-19
     * Time: 3:57 PM
     */
?>
<div class="row justify-content-center">
    <div class="col-6 col-md-8 col-xl-5">
        <div id="wrapper_param" class="shadow gradient">
            <div class="row">
                <form class="col-10">
                    <div class="row my-3">
                        <div class="col-6 col-sm-4 col-xl-5 text-right">
                            <h6 class="my-2">
                                <label for="type_param" class="m-0">Type d'opération</label>
                            </h6>
                        </div>
                        <div class="col-6 col-sm-8 col-xl-5">
                            <select class="custom-select custom-select" name="entite" id="type_param"
                                    onchange="setParameter(0)">
                                <option value="">Sélectionner...</option>
                                <option value="0">Entrée</option>
                                <option value="1">Sortie</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary my-3" data-toggle="modal" data-target="#newOperationModal">
                        <i class="fas fa-cog faa-spin animated fa-1-5x mx-auto"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="newOperationModal" tabindex="-1" role="dialog" aria-labelledby="newOperationModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newOperationModalLabel">ARBA ⚙️</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="blockquote">
                                        <form>
                                            <div class="form-group">
                                                <label for="categorie">Catégorie</label>
                                                <input type="text" class="form-control text-uppercase" id="categorie" placeholder="...">
                                            </div>
                                            <div class="form-group">
                                                <label for="type_ope">Type d'opération</label>
                                                <select class="custom-select text-uppercase" id="type_ope">
                                                    <option selected>-</option>
                                                    <option value="0">Dépense</option>
                                                    <option value="1">Recette</option>
                                                </select>
                                            </div>
                                        </form>
                                    </blockquote>
                                </div>
                                <div class="modal-footer">

                                    <div id="alert_msg" class="mr-auto"></div>
                                    <button type="button" class="btn btn-primary" id="btn_save" onclick="saveCategorie()">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="" id="proceder_param" role="button"
                   class="btn btn-primary btn-block my-2 mx-auto faa-parent animated-hover col-6 col-lg-4 justify-content-between">
                    Procéder
                    <i class="fa fa-arrow-right my-auto faa-passing ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>