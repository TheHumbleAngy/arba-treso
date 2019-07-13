<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 14-Jun-19
     * Time: 8:04 PM
     */
?>

<table class="table table-sm table-hover bg-light font-weight-light" id="arr_adhesions">
    <thead class="bg-primary text-light">
    <tr>
        <th class="text-center">N°</th>
        <th class="w-15">Nom</th>
        <th class="w-25">Prénoms</th>
        <th class="">Contact</th>
        <th class="">Commune</th>
        <th class="">Ville</th>
        <th class="text-center">Genre</th>
        <th class="w-6" title="Droit d'adhésion">Droit A.</th>
        <th class=""></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-center text-primary">
            <span class="" id="numero">1</span>
        </td>
        <td>
            <input type="text" id="nom" class="form-control form-control-sm text-uppercase awesomplete" onblur="" title="Membre">
        </td>
        <td>
            <input type="text" id="pren" class="form-control form-control-sm text-uppercase" title="Prénoms">
        </td>
        <td>
            <input type="text" id="contact" class="form-control form-control-sm " title="Contact">
        </td>
        <td>
            <label for="com"></label><select class="custom-select custom-select-sm" id="com">
                <option value=""></option>
            </select>
        </td>
        <td>
            <label for="vil"></label><select class="custom-select custom-select-sm" id="vil">
                <option value=""></option>
            </select>
        </td>
        <td class="text-center">
            <label for="genre"></label><select class="custom-select custom-select-sm" id="genre" onchange="setGender(this)">
                <option value=""></option>
                <option value="F">F</option>
                <option value="H">H</option>
            </select>
        </td>
        <td class="">
            <input type="text" id="mtt" class="form-control form-control-sm text-right" title="Frais" readonly>
        </td>
        <td>
            <button class="btn btn-sm btn-outline-success" onclick="addRow('arr_adhesions', 2, true)">
                <i class="fas fa-plus-circle faa-float"></i>
            </button>
        </td>
    </tr>
    </tbody>
</table>