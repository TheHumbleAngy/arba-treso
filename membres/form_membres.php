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

        <form action="" id="form_membre">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control text-uppercase" id="nom" placeholder="Nom" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="prenoms">Prénoms</label>
                    <input type="text" class="form-control text-uppercase" id="prenoms" placeholder="Prénoms" required>
                </div>
            </div>
            <div class="form-group">
                <label for="adresse">Localité</label>
                <input type="text" class="form-control text-uppercase text-uppercase" id="adresse"
                       placeholder="Commune, Ville" required>
            </div>
            <div class="form-group">
                <label for="contact">Contacts</label>
                <input type="text" class="form-control" id="contact" placeholder="00 00 00 00" required>
            </div>
            <button type="button" class="btn btn-primary col-6 col-lg-4 my-2" onclick="saveMember()">
                <i class="fas fa-save mr-2 faa-pulse"></i>
                Enregistrer
            </button>
        </form>

        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="successModalLabel">ARBA ✔️</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <blockquote class="blockquote">
                            <p class="mb-0">Enregistré 👍</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorYearModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="errorYearModalLabel">ARBA 🚫</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <blockquote class="blockquote">
                            <p class="mb-0">Veuillez renseigner le
                                <mark>nom</mark>
                                et le/les
                                <mark>prénom(s)</mark>
                                .
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>