<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-Jun-19
     * Time: 5:16 PM
     */
    ?>
<div class="row justify-content-center">
    <div class="col-6 col-lg-5">
        <div id="wrapper_param" class="shadow gradient">
            <div class="container-fluid row">
                <form class="col-10 col-xl-11 mb-2">
                    <div class="row my-3">
                        <div class="col-6 col-xl-5 text-right">
                            <h6 class="my-2">
                                <label for="type_param" class="m-0">Entité</label>
                            </h6>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-5">
                            <select class="custom-select custom-select" name="entite" id="type_param"
                                    onchange="setParameter(2)">
                                <option value="">Sélectionner...</option>
                                <option value="0">Cotisations</option>
                                <option value="1">Dépenses</option>
                                <option value="2">Membres</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="col-2 col-xl-1 d-flex flex-column justify-content-center" id="fa_ico">
                    <i class="fas fa-cog faa-spin animated fa-2x mx-auto"></i>
                </div>
            </div>
            <div class="row">
                <a href="" id="proceder_param" role="button"
                   class="btn btn-primary btn-block my-2 mx-auto faa-parent animated-hover col-8 col-lg-4 justify-content-between">
                    Procéder
                    <i class="fa fa-arrow-right my-auto faa-passing ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>