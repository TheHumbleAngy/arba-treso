<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-Jun-19
     * Time: 5:16 PM
     */
    ?>
<input type="hidden" id="head_title" value="recherche">
<div class="row">
    <div class="col-auto mx-auto">
        <div id="wrapper_param" class="shadow gradient">
            <div id="param_title">
                <h3 class="mr-5 pr-5">Parametrage Recherche</h3>
            </div>
            <div class="row my-3 mx-0">
                <div class="col-4">
                    <label for="type_param">Formulaire</label>
                </div>
                <div class="col-auto ">
                    <select class="custom-select custom-select-sm" id="type_param"
                            onchange="setParameter(this, 2)">
                        <option value="">Sélectionner...</option>
                        <option value="0">Membres</option>
                        <option value="1">Cotisations annuelles</option>
                        <option value="" disabled>-----</option>
                        <option value="2">Mouvements</option>
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