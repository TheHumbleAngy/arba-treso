<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 11-Jun-19
     * Time: 1:08 PM
     */
?>
<input type="hidden" id="head_title" value="parametrage Consultaion">
<div class="row">
    <div class="col-auto mx-auto">
        <div id="wrapper_param" class="shadow gradient">
            <div id="param_title">
                <h3 class="mr-5 pr-5">Parametrage Consultation</h3>
            </div>
            <div class="row my-3 mx-0">
                <div class="col-4">
                    <label for="type_param">Formulaire</label>
                </div>
                <div class="col-auto ">
                    <select class="custom-select custom-select-sm" id="type_param"
                            onchange="setParameter(this, 1)">
                        <option value="">Sélectionner...</option>
                        <option value="0">Liste des Adhésions</option>
                        <option value="1">Liste des Cotisations annuelles</option>
                        <option value="2">Liste des Membres</option>
                        <option value="" disabled>-----</option>
                        <option value="3">Liste des Décaissements</option>
                        <option value="4">Liste des Encaissements</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <a href="" id="proceder_param" role="button"
                   class="btn btn-sm btn-primary my-2 mx-auto faa-parent animated-hover col-auto px-4 font-weight-bolder">
                    Procéder
                    <i class="fa fa-arrow-right my-auto faa-passing ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>