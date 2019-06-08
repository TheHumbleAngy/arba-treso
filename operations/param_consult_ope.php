<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 23-May-19
     * Time: 2:41 PM
     */
?>

<div class="bg-white col-xl-10 mx-lg-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h3>Consultation</h3>
        <div class="row my-2 cadre p-4 justify-content-center">
            <div class="col-lg-2 col-sm-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="general" name="rdoChoix" class="custom-control-input" value="1" onchange="choixProceder()">
                    <label class="custom-control-label" for="general">Général</label>
                </div>
            </div>
            <div class="col-lg-2 col-sm-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="particulier" name="rdoChoix" class="custom-control-input" value="2" onchange="choixProceder()">
                    <label class="custom-control-label" for="particulier">Particulier</label>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
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