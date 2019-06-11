<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 11-Jun-19
     * Time: 4:08 PM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Liste des Membres <span>👪</span></h2>
        <div class="col-lg-8 mx-auto row my-2 cadre p-4 justify-content-center">
            <div class="col">
                <label for="membre">
                    <input type="text" class="form-control" id="membre" placeholder="Membre...">
                </label>
            </div>
            <div class="col justify-content-center">
                <button class="btn btn-primary col-6" onclick="filterMembre('listing')">
                    Filtrer <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>

    </div>

    <div id="feedback" class="my-4">
        <table class="table table-sm table-hover bg-light">
            <thead class="bg-primary text-light">
            <tr>
                <th class="col-1 text-center">N°</th>
                <th class="col-4">Membre</th>
                <th class="col-3">Contact</th>
                <th class="col">Adresse</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center text-primary font-weight-light">
                    <span class="" id="numero">1</span>
                </td>
                <td class="">
                    <span class="text-uppercase">kouakou ange</span>
                </td>
                <td class="">
                    <span class="">47 11 29 97</span>
                </td>
                <td class="">
                    <span class="">Cocody</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>