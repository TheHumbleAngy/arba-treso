<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 23-May-19
     * Time: 2:41 PM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Liste des Cotisations <span>📖</span></h2>
        <div class="col-lg-8 mx-auto row my-2 cadre p-4 justify-content-center">
            <div class="col">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="general" name="rdoChoix" class="custom-control-input" value="1" onchange="choixProceder()">
                    <label class="custom-control-label" for="general">Général</label>
                </div>
            </div>
            <div class="col">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="particulier" name="rdoChoix" class="custom-control-input" value="2" onchange="choixProceder()">
                    <label class="custom-control-label" for="particulier">Particulier</label>
                </div>
            </div>
            <div class="col">
                <label for="particulier_mbr">
                    <input type="text" class="form-control" id="particulier_mbr" placeholder="Membre..." disabled>
                </label>
            </div>
        </div>
        <div class="row justify-content-center my-4">
            <button class="btn btn-primary col-lg-3 col-md-4" onclick="procederConsultation()">
                Proceder <i class="fa fa-arrow-right"></i>
            </button>
        </div>
    </div>

    <div id="feedback" class="mb-4"></div>
</div>