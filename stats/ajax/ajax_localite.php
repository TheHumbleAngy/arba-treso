<?php
    /**
     * Created by PhpStorm.
     * User: NCARE
     * Date: 7/10/2019
     * Time: 7:15 AM
     */

    $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');


    $sql = "SELECT adresse_membre, COUNT(adresse_membre) FROM membres WHERE adresse_membre NOT LIKE '' GROUP BY adresse_membre";

    $resultat = mysqli_query($connection, $sql);
    if ($resultat->num_rows) {
        // TODO: update all ajax calls that only get value to fit with the below pattern
        $i = 0;
        while ($row = mysqli_fetch_row($resultat)) {
            $localite[$i] = $row[0];
            $data[$i++] = $row[1];
        }
    }

    echo json_encode([$localite, $data]);