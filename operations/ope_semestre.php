<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-May-19
     * Time: 5:51 PM
     */
?>

<table class="table table-sm table-hover bg-light font-weight-light" id="tab_cotisations">
    <thead class="bg-primary text-light">
    <tr>
        <th class="text-center">N°</th>
        <th class="w-25">Membre</th>
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