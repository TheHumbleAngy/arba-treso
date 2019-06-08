<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-May-19
     * Time: 5:15 PM
     */
    ?>

<div class="bg-white col-xl-10 mx-lg-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h3>Cotisations</h3>
        <div class="row my-2 cadre p-4 justify-content-center col-md-8 mx-auto">
            <div class="col col-md-6">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="annuelle" name="rdoChoix" class="custom-control-input" value="0" onchange="choixCotisation()">
                    <label class="custom-control-label" for="annuelle">Annuelle</label>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="semestre" name="rdoChoix" class="custom-control-input" value="1" onchange="choixCotisation()">
                    <label class="custom-control-label" for="semestre">Dernier Semèstre</label>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary" onclick="clearRadios()">Clear radios!</button>
    <div id="feedback" class="mb-4"></div>
</div>