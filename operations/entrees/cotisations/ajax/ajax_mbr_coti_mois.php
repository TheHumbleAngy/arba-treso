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
        $result = mysqli_query($connection, $sql);
        if ($result->num_rows) {
            $lignes = $result->fetch_all(MYSQLI_ASSOC);

            echo json_encode($lignes);
        }

        $result->free();
        $connection->close();
    }