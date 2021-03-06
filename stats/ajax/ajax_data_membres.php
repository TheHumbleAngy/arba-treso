<?php
    /**
     * Created by PhpStorm.
     * User: NCARE
     * Date: 7/10/2019
     * Time: 7:15 AM
     */

    require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');

    if (isset($_GET['entity']) && isset($_GET['prop'])) {
        $entity = $_GET['entity'];
        $prop = $_GET['prop'];

        if ($entity == 'cotisations') {

        } elseif ($entity == 'depenses') {

        } elseif ($entity == 'membres') {
            if ($prop == 'genre') {
                $genre = [];
                $data = [];

                $sql = "SELECT genre_membre, COUNT(genre_membre) FROM membres WHERE genre_membre NOT LIKE '' GROUP BY genre_membre";

                $result = mysqli_query($connection, $sql);
                if ($result->num_rows) {
                    $i = 0;
                    while ($row = mysqli_fetch_row($result)) {
                        $genre[$i] = $row[0];
                        $data[$i++] = $row[1];
                    }
                }

                $result->free();
                $connection->close();

                /**
                 * @param $item
                 * @return string
                 */
                $update = function ($item) {
                    return $item == 'F' ? 'Femmes' : 'Hommes';
                };

                $genre = array_map($update, $genre);

                echo json_encode([$genre, $data]);

            } elseif ($prop == 'localite') {
                $localite = [];
                $data = [];

                $sql = "SELECT adresse_membre, COUNT(adresse_membre) FROM membres WHERE adresse_membre NOT LIKE '' GROUP BY adresse_membre";

                $result = mysqli_query($connection, $sql);
                if ($result->num_rows) {
                    $i = 0;
                    while ($row = mysqli_fetch_row($result)) {
                        $localite[$i] = $row[0];
                        $data[$i++] = $row[1];
                    }
                }

                $result->free();
                $connection->close();

                echo json_encode([$localite, $data]);
            }
        }
    }
