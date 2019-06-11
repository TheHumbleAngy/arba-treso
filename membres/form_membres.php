<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 15-Apr-19
     * Time: 6:14 PM
     */
?>
<div class="parent">
    <div id="wrapper_membre" class="shadow gradient p-5">

        <div class="myMenu">
            <div class="item gallery">
                <div class="dot dot1"></div>
                <div class="dot dot2"></div>
                <div class="dot dot3"></div>
                <div class="dot dot4"></div>
                <div class="dot dot5"></div>
                <div class="dot dot6"></div>
            </div>

            <div class="nav-items item1">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="nav-items item2">
                <i class="fas fa-users"></i>
            </div>
            <div class="nav-items item3">
                <i class="fas fa-search"></i>
            </div>
            <div class="nav-items item4">
                <i class="fas fa-folder"></i>
            </div>
        </div>

        <!--<div style="position: relative">
            <a class="retour mx-2" role="button" data-toggle="tooltip" data-placement="right"
               title="Accueil" href="index.php"><i class="fas fa-home fa-1-5x"></i></a>
        </div>-->

        <div class="container-fluid">
            <div class="myBg align-items-center">
                <div class="col">
                    <div class="row my-5">
                        <div class="col">
                            <label for="nom" class="inp">
                                <input type="text" id="nom" placeholder="&nbsp;" class="text-capitalize">
                                <span class="label">Nom</span>
                                <span class="border"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col">
                            <label for="prenoms" class="inp">
                                <input type="text" id="prenoms" placeholder="&nbsp;" class="text-capitalize">
                                <span class="label">Prénoms</span>
                                <span class="border"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col">
                            <label for="adresse" class="inp">
                                <input type="text" id="adresse" placeholder="&nbsp;">
                                <span class="label">Adresse</span>
                                <span class="border"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col">
                            <label for="contact" class="inp">
                                <input type="text" id="contact" placeholder="&nbsp;">
                                <span class="label">Contact</span>
                                <span class="border"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-lg btn-primary col-5" onclick="enregistrer()">
                            <i class="fas fa-save mr-2 faa-pulse"></i>
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
