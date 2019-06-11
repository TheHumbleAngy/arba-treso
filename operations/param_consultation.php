<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 11-Jun-19
     * Time: 1:08 PM
     */
?>
<div id="wrapper_consultation" class="shadow gradient">
    <div class="container-fluid row">
        <form class="col-8 mb-2">
            <div class="row my-3">
                <div class="col-4">
                    <label for="type_consultation">Liste</label>
                </div>
                <div class="col-8">
                    <select class="custom-select custom-select" name="entite" id="type_consultation" onchange="choixConsultation()">
                        <option value="">Sélectionner...</option>
                        <option value="0">Cotisations</option>
                        <option value="1">Membres</option>
                    </select>
                </div>
            </div>
            <div id="details"></div>
        </form>
        <div class="col d-flex flex-column justify-content-center" style="color: #1A74B8">
            <i class="fas fa-cog faa-spin animated fa-2x mx-auto"></i>
        </div>
    </div>
    <div class="row">
        <a href="" id="proceder_consultation" class="btn btn-primary btn-block my-2 mx-auto faa-parent animated-hover col-8 col-lg-6" role="button">Procéder</a>
    </div>

    <div class="modal fade" id="errorListModal" tabindex="-1" role="dialog" aria-labelledby="errorListModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="errorListModalLabel">ARBA 🚫</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <blockquote class="blockquote">
                        <p class="mb-0">Veuillez faire un choix avant.</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
