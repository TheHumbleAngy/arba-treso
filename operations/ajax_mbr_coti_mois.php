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
            $i = 0;
            foreach ($lignes as $ligne) {
                $mois[$i++] = $ligne['id_mois'];
                $cotisation[$i++] = $ligne['montant_operation'];
            }

            $n = 3; $k = 0;
            for ($i = 0; $i < $n; $i++) {
                for ($j = 0; $j < $n; $j++)
                    $data[$i][$j] = $k++;
            }

            echo json_encode($lignes);
        }
    }