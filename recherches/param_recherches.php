<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-Jun-19
     * Time: 5:16 PM
     */
    ?>
<div class="row">
    <div class="col-auto mx-auto">
        <div id="wrapper_param" class="shadow gradient">
            <h3 class="mx-5 px-md-5 px-lg-0 mb-4">Parametrage Recherche</h3>
            <div class="row my-3">
                <div class="col-4">
                    <label for="type_param">Formulaire</label>
                </div>
                <div class="col-auto ">
                    <select class="custom-select custom-select-sm" id="type_param"
                            onchange="setParameter(2)">
                        <option value="">Sélectionner...</option>
                        <option value="0">Membres</option>
                        <option value="1">Opérations</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <a href="" id="proceder_param" role="button"
                   class="btn btn-primary btn-block my-2 mx-auto faa-parent animated-hover w-50 justify-content-between">
                    Procéder
                    <i class="fa fa-arrow-right my-auto faa-passing ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>