<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-May-19
     * Time: 11:56 AM
     */

    $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

    $sql_mbr = "SELECT * FROM membres";

    $resultat = mysqli_query($connection, $sql_mbr);
    if ($resultat->num_rows > 0) {
        $membres = $resultat->fetch_all(MYSQLI_ASSOC);
        $i = 0;

        foreach ($membres as $membre) {
            $id_mbr = $membre['id_membre'];
            $nom_mbr = $membre['nom_membre'];
            $pren_mbr = $membre['pren_membre'];

            $mbr[$i++] = $nom_mbr . " " . $pren_mbr;
//            $mbr[$i++] = $id_mbr . "-" . $nom_mbr . " " . $pren_mbr;
        }

        echo json_encode($mbr);
    }