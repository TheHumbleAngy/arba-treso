<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 30-May-19
     * Time: 3:21 AM
     */

    if ($_POST['info']) {
        $sql = $_POST['info'];

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');
        $resultat = mysqli_query($connection, $sql);
        if ($resultat->num_rows) {
            $lignes = $resultat->fetch_all(MYSQLI_ASSOC);

            echo json_encode($lignes);
        }
    }