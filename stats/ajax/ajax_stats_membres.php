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
        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        switch ($entity) {

            case 'membres':
                switch ($prop) {
                    case 'genre':
                        $sql = "SELECT (SELECT COUNT(*) FROM membres WHERE genre_membre = 'F') AS total_femmes, (SELECT COUNT(*) FROM membres WHERE genre_membre = 'M') AS total_hommes FROM dual";

                        $resultat = mysqli_query($connection, $sql);
                        if ($resultat->num_rows) {
                            $items = $resultat->fetch_all(MYSQLI_NUM);

                            $labels = ['Femmes', 'Hommes'];

                            $data = [$labels, $items];
                        }

                        $resultat->free();
                        $connection->close();

                        echo json_encode($data);

                        break;

                    case 'localite':

                        break;
                }
                break;

            case 'cotisations':

                break;

            case 'depenses':

                break;
        }
    }