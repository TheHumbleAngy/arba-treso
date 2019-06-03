<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 21-Sep-18
     * Time: 10:52 PM
     */

    if (isset($_POST['nbr']) && empty($_POST['nbr']) === false && isset($_POST['nature']) && ($_POST['nature']) === "0" || $_POST['nature'] === "1") {
        $nbr = stripcslashes($_POST['nbr']);
        $nature = stripcslashes($_POST['nature']);
        $libelle_nature = $nature == "0" ? "Cotisations" : "Depenses";

        echo '<span id="nbr_" hidden>' . $nbr . '</span>
<table class="table table-sm table-hover my-4 ncare bg-light font-weight-light" id="etat" style="border-radius: 10px">
    <thead class="bg-primary text-light">
    <tr>
        <th class="col-1 text-center">N°</th>
        <th class="col-9">Membre</th>
        <th class="">Cotisation</th>
    </tr>
    </thead>
    <tbody>';
        for ($i = 1; $i <= $nbr; $i++) {
            echo '<tr>';
            echo '<td class="text-center">
    <span class="text-uppercase text-primary" id="numero' . $i . '">' . $i . '</span>
</td>
<td>
    <input type="text" class="form-control form-control-sm text-uppercase" id="membre' . $i . '">
</td>
<td>
    <input type="text" class="form-control form-control-sm text-uppercase" id="cotisation' . $i . '">
</td>
';
            echo '</tr>';
        }
        echo '
        </tbody>
    </table>
        ';
    }