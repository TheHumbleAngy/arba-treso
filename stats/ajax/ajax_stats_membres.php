<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 07-Jul-19
     * Time: 3:14 PM
     */

    if (isset($_POST['entity']) && isset($_POST['prop'])) {
        $entity = $_POST['entity'];
        $prop = $_POST['prop'];

        switch ($entity) {

            case 'membres':
                switch ($prop) {
                    case 'genre':
                        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

                        $sql = "SELECT (SELECT COUNT(*) FROM membres WHERE genre_membre = 'F') AS total_femmes, (SELECT COUNT(*) FROM membres WHERE genre_membre = 'M') AS total_hommes FROM dual;";

                        $resultat = mysqli_query($connection, $sql);
                        if ($resultat->num_rows) {
                            $data_values = $resultat->fetch_array(MYSQLI_NUM);
                            $labels = ['Femmes', 'Hommes'];

                            $data = [$labels, $data_values];
                        }

                        $resultat->free();
                        $connection->close();

                        echo $data;

                        break;
                }
                break;
        }
    }