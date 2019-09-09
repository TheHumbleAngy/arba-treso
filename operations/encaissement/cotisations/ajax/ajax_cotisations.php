<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 16-Apr-19
     * Time: 2:42 PM
     */
?>

<table class="table table-sm table-hover bg-light font-weight-light" id="arr_cotisations">
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
            <input type="text" id="coti_mbr" class="form-control form-control-sm text-uppercase awesomplete" onblur="memberDataLoader(this)" title="Membre">
        </td>
        <td>
            <input type="text" id="jan" class="form-control form-control-sm " title="Janvier">
        </td>
        <td>
            <input type="text" id="fev" class="form-control form-control-sm " title="Février">
        </td>
        <td>
            <input type="text" id="mars" class="form-control form-control-sm " title="Mars">
        </td>
        <td>
            <input type="text" id="avr" class="form-control form-control-sm " title="Avril">
        </td>
        <td>
            <input type="text" id="mai" class="form-control form-control-sm " title="Mai">
        </td>
        <td>
            <input type="text" id="juin" class="form-control form-control-sm " title="Juin">
        </td>
        <td>
            <input type="text" id="juil" class="form-control form-control-sm " title="Juillet">
        </td>
        <td>
            <input type="text" id="aout" class="form-control form-control-sm " title="Aout">
        </td>
        <td>
            <input type="text" id="sep" class="form-control form-control-sm " title="Septembre">
        </td>
        <td>
            <input type="text" id="oct" class="form-control form-control-sm " title="Octobre">
        </td>
        <td>
            <input type="text" id="nov" class="form-control form-control-sm " title="Novembre">
        </td>
        <td>
            <input type="text" id="dec" class="form-control form-control-sm " title="Décembre">
        </td>
        <td>
            <button class="btn btn-sm btn-outline-success" onclick="rowAdder('arr_cotisations', 10)">
                <i class="fas fa-plus-circle faa-float"></i>
            </button>
        </td>
    </tr>
    </tbody>
</table>