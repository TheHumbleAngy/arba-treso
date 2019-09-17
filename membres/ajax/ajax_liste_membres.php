<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 11-Jun-19
     * Time: 4:41 PM
     */
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');

    $sql_mbr = "SELECT * FROM membres";

    $result = mysqli_query($connection, $sql_mbr);
    if ($result->num_rows > 0) {
        $membres = $result->fetch_all(MYSQLI_ASSOC);
        $i = 0;

        foreach ($membres as $membre) {
            $id_mbr = $membre['id_membre'];
            $nom_mbr = $membre['nom_membre'];
            $pren_mbr = $membre['pren_membre'];

            $mbr[$i++] = $nom_mbr . " " . $pren_mbr;
        }

        $result->free();
        $connection->close();

        echo json_encode($mbr);
    }