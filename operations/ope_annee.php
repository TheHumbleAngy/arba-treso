<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 16-Apr-19
     * Time: 2:42 PM
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
        <th class="text-center">N°</th>
        <th class="w-25">Membre</th>
        <th class="">Jan</th>
        <th class="">Fev</th>
        <th class="">Mars</th>
        <th class="">Avr</th>
        <th class="">Mai</th>
        <th class="">Juin</th>
        <th class="">Juil</th>
        <th class="">Août</th>
        <th class="">Sep</th>
        <th class="">Oct</th>
        <th class="">Nov</th>
        <th class="">Dec</th>
        <th class=""></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-center text-primary">
            <span class="" id="numero">1</span>
        </td>
        <td>
            <input type="text" id="coti_mbr" class="form-control form-control-sm text-uppercase awesomplete" onblur="loadMembreData(this)">
        </td>
        <td>
            <input type="text" id="jan" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="fev" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="mars" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="avr" class="form-control form-control-sm ">
        </td>
        <td class="">
            <input type="text" id="mai" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="juin" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="juil" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="aout" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="sep" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="oct" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="nov" class="form-control form-control-sm ">
        </td>
        <td>
            <input type="text" id="dec" class="form-control form-control-sm ">
        </td>
        <td>
            <button class="btn btn-sm btn-outline-success" onclick="addRow(5)">
                <i class="fas fa-plus-circle faa-float"></i>
            </button>
        </td>
    </tr>
    </tbody>
</table>