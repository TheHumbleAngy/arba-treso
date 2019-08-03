<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jul-19
     * Time: 9:54 AM
     */
?>

<div class="bg-white col-xl-10 mx-auto p-2" style="border-radius: 10px">

    <div class="container-fluid">
        <h2 class="w-50 text-center py-2 mx-auto mb-4 cadre-titre">Recherche - Cotisations <span>💰</span></h2>
        <div class="col-12 mx-auto my-2 cadre px-4 py-2">
            <div class="row mx-0 my-3">
                <div class="col mr-4">
                    <h5 class="cadre-titre-search">Types d'oprération</h5>
                    <div class="row">
                        <label for="typ_op" class="col">
                            <select class="custom-select custom-select-sm" id="typ_op" onchange="setCategorie(this)">
                                <option value="">Type...</option>
                                <option value="0">Dépense</option>
                                <option value="1">Recette</option>
                            </select>
                        </label>
                        <label for="cate" class="col">
                            <select class="custom-select custom-select-sm" id="cate">
                                <option value="">Catégorie...</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="col ">
                    <h5 class="cadre-titre-search">Année</h5>
                    <div class="row">
                        <label for="annee" class="col">
                            <select class="custom-select custom-select-sm" id="annee">
                                <option value="2019">2019</option>
                            </select>
                        </label>
                        <label for="mois" class="col">
                            <select class="custom-select custom-select-sm" id="mois">
                                <option value="">Mois...</option>
                                <option value="M01">Janvier</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mx-0 my-3">
                <div class="col-9 mr-3">
                    <h5 class="cadre-titre-search">Membres</h5>
                    <div class="row">
                        <label for="nom" class="col-4">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="nom"
                                   placeholder="Nom">
                        </label>
                        <label for="prenoms" class="col">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="prenoms"
                                   placeholder="Prenoms">
                        </label>
                    </div>
                    <div class="row">
                        <label for="genre" class="col-3">
                            <select class="custom-select custom-select-sm" id="genre">
                                <option value="">Genre...</option>
                                <option value="F">Femme</option>
                                <option value="M">Homme</option>
                            </select>
                        </label>
                        <label for="commune" class="col">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="commune"
                                   placeholder="Commune">
                        </label>
                        <label for="ville" class="col">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="ville"
                                   placeholder="Ville">
                        </label>
                    </div>
                </div>
                <div class="col ">
                    <h5 class="cadre-titre-search">Dates</h5>
                    <div class="row">
                        <div class="col">
                            <label for="date_ope">
                                <input type="date" id="date_ope" class="form-control form-control-sm"
                                       aria-describedby="textHelp">
                                <small id="textHelp" class="form-text text-muted">Date de l'opération</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4 justify-content-center">
                <div class="col-2">
                    <button class="btn btn-primary col" onclick="" title="Rechercher">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="feedback" class="my-4"></div>
</div>

<script type="text/javascript">
    let typ_op = document.getElementById('typ_op');
    let cate = document.getElementById('cate');

    let annee = document.getElementById('annee');
    let mois = document.getElementById('mois');

    let nom = document.getElementById('nom');
    let prenoms = document.getElementById('prenoms');
    let genre = document.getElementById('genre');
    let ville = document.getElementById('ville');
    let commune = document.getElementById('commune');

    let date_op = document.getElementById('date_ope');

    let fields = [typ_op, cate, annee, mois, nom, prenoms, genre, ville, commune, date_op];
    let test = true;

    if (typ_op.value || cate.value || annee.value || mois.value || nom.value || prenoms.value || genre.value || ville.value || commune.value || date_op.value) {
        /* Categorie */
        if (cate.value) {
            let categorie = cate.value;
        }

        /* Annee */


        /* Membre */


        /* Date */

    }
</script>