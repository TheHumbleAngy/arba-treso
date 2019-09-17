<?php
    /**
     * Created by PhpStorm.
     * User: NCARE
     * Date: 7/13/2019
     * Time: 5:10 PM
     */
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');

    $sql = "SELECT * FROM communes";

    $result = mysqli_query($connection, $sql);
    if ($result->num_rows > 0) {
        $sets = $result->fetch_all(MYSQLI_ASSOC);
        $i = 0;

        foreach ($sets as $set) {
            $com[$i][0] = $set['id_commune'];
            $com[$i++][1] = $set['libelle_commune'];
        }

        $result->free();
    }

    $sql = "SELECT * FROM villes";

    $result = mysqli_query($connection, $sql);
    if ($result->num_rows > 0) {
        $sets = $result->fetch_all(MYSQLI_ASSOC);
        $i = 0;

        foreach ($sets as $set) {
            $ville[$i][0] = $set['id_ville'];
            $ville[$i++][1] = $set['libelle_ville'];
        }

        $result->free();
    }

    $connection->close();

    $data = [$com, $ville];
    echo json_encode($data);