<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-May-19
     * Time: 5:51 PM
     */
?>

<div class="row">
    <button class="btn btn-block btn-outline-primary faa-parent animated-hover col-lg-2 col-sm-3 mx-auto my-4"
            id="valider" onclick="save_cotisations()">
        <i class="fas fa-save mr-2 faa-pulse"></i>
        Enregistrer
    </button>
    <div class="modal fade" id="modal-response" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Operation</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="content-response"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-sm table-hover bg-light font-weight-light" id="tab_cotisations">
    <thead class="bg-primary text-light">
    <tr>
        <th class="col-1 text-center">N°</th>
        <th class="col-9">Membre</th>
        <th class="">Cotisation</th>
        <th class=""></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-center text-primary">
            <span class="" id="numero">1</span>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm text-uppercase awesomplete" id="coti_mbr">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm " id="cotisation">
        </td>
        <td>
            <button class="btn btn-sm btn-outline-success" onclick="addRow(5)">
                <i class="fas fa-plus-circle faa-float"></i>
            </button>
        </td>
    </tr>
    </tbody>
</table>