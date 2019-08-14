<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 14-Jun-19
     * Time: 3:57 PM
     */
?>
<div class="row justify-content-center">
    <div class="col-6 col-xl-5">
        <div id="wrapper_param" class="shadow gradient">
            <div class="row my-3">
                <form class="col-10 row form-inline">
                    <label for="type_param" class="col">Type d'opération</label>
                    <select class="custom-select custom-select-sm col" name="entite" id="type_param"
                            onchange="setCategorie(this)">
                        <option value="">Sélectionner...</option>
                        <option value="0">Sortie</option>
                        <option value="1">Entrée</option>
                    </select>
                </form>
            </div>
            <div class="row my-3">
                <form class="col-10 row form-inline">
                    <label for="cate" class="col">Catégorie</label>
                    <select class="custom-select custom-select-sm col" name="entite" id="cate"
                            onchange="setParameter(0)">
                        <option value="">Sélectionner...</option>
                    </select>
                </form>
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#newOperationModal">
                        <i class="fas fa-cog faa-spin animated fa-1-5x mx-auto"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="newOperationModal" tabindex="-1" role="dialog"
                         aria-labelledby="newOperationModalLabel"
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
                                                <label for="sav_categorie">Catégorie</label>
                                                <input type="text" class="form-control text-uppercase" id="sav_categorie"
                                                       placeholder="...">
                                            </div>
                                            <div class="form-group">
                                                <label for="sav_type_ope">Type d'opération</label>
                                                <select class="custom-select text-uppercase" id="sav_type_ope">
                                                    <option selected>-</option>
                                                    <option value="0">Sortie</option>
                                                    <option value="1">Entrée</option>
                                                </select>
                                            </div>
                                        </form>
                                    </blockquote>
                                </div>
                                <div class="modal-footer">

                                    <div id="alert_msg" class="mr-auto"></div>
                                    <button type="button" class="btn btn-primary" id="btn_save"
                                            onclick="saveCategorie()">Enregistrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="" id="proceder_param" role="button"
                   class="btn btn-primary btn-block my-2 mx-auto faa-parent animated-hover col-5 col-lg-4 justify-content-between">
                    Procéder
                    <i class="fa fa-arrow-right my-auto faa-passing ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>