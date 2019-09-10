<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jun-19
     * Time: 6:51 PM
     */
    if (isset($_POST['data']) && isset($_POST['year'])) {
        $data = $_POST['data'];
        $n = sizeof($data);
        $mbr = array();
        $coti = array();
        $mois = array();
        $mtt = array();
        $test_mbr_exist = true;
        $test_op_exist = false;
        $test_insert = true;
        $id_categorie = "CAT02";
        $count = 0;
        $obs = "COTISATION MENSUELLE";

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        for ($i = 0; $i < $n; $i++) {

            $m = sizeof($data[$i]);
            for ($j = 0; $j < $m; $j++) {

                if ($j == 0) {
                    $mbr[$i] = $data[$i][$j];
                }
                else {
                    $coti = explode('-', $data[$i][$j]);
                    $mois[$i][$j - 1] = $coti[0];
                    $mtt[$i][$j - 1] = $coti[1];
                }
            }

            // "KOUAKOU ANGE" "1, 2000" "2, 2000" "3, 1000" "4, 3000" "11, 2000"
            for ($j = 0; $j < sizeof($mois[$i]); $j++) {
                if ((int)$mois[$i][$j] < 10) {
                    $mois[$i][$j] = 'M0' . $mois[$i][$j];
                }
                else {
                    $mois[$i][$j] = 'M' . $mois[$i][$j];
                }
            }

            // "KOUAKOU ANGE" "M01, 2000" "M02, 2000" "M03, 1000" "M04, 3000" "M11, 2000"
            $nom_mbr = explode(' ', $mbr[$i], 2); //
            $nom = mysqli_real_escape_string($connection, $nom_mbr[0]);
            $prenoms = mysqli_real_escape_string($connection, $nom_mbr[1]);
            $an = $_POST['year'];
            $today = date('Y-m-d');

            // Getting the id of the current member, on line i
            $sql_mbr = "SELECT id_membre FROM membres WHERE nom_membre = '{$nom}' AND pren_membre = '{$prenoms}'";

            $result = mysqli_query($connection, $sql_mbr);
            if ($result->num_rows) {
                $lignes = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($lignes as $ligne) {
                    $id_mbr = $ligne['id_membre'];
                }
            }
            else {
                // The member already exists
                $test_mbr_exist = false;

                continue;
            }
            // End getting the member's id

            // Inserting data...
            for ($j = 0; $j < sizeof($mois[$i]); $j++) {
                $id_mois = $mois[$i][$j];
                $montant = $mtt[$i][$j];

                // Checking that info to be saved do not exist already
                $sql_test_exist = "SELECT * FROM operations WHERE id_membre = '{$id_mbr}' AND id_mois = '{$id_mois}' AND id_categorie = 'CAT02' AND montant_operation = '{$montant}' AND annee_operation = '{$an}'";
                $result = mysqli_query($connection, $sql_test_exist);
                if ($result->num_rows) {
                    $test_op_exist = true;

                    break;
                }
                else {
                    $sql_last = "SELECT id_operation FROM operations ORDER BY id_operation DESC LIMIT 1";

                    $year = date('y');
                    $result = mysqli_query($connection, $sql_last);
                    $number = 0;
                    if ($result->num_rows > 0) {
                        $ids = $result->fetch_all(MYSQLI_ASSOC);

                        foreach ($ids as $id) {
                            $id_last_op = $id['id_operation'];
                        }

                        $id_year = substr($id_last_op, 0, 2);

                        $number = $id_year == $year ? substr($id_last_op, 6) : $number;
                    }

                    $number = sprintf('%04d', ++$number);
                    $id_ope = $year . "-OP-" . $number;
                    $date_ope = $_POST['date_ope'];

                    $sql = "INSERT INTO operations (id_operation, id_membre, id_mois, id_categorie, montant_operation, obs_operation, date_saisie_operation, date_operation, annee_operation) VALUES ('{$id_ope}', '{$id_mbr}', '{$id_mois}', '{$id_categorie}', {$montant}, '{$obs}', '{$today}', '{$date_ope}', {$an})";
                    if ($result = mysqli_query($connection, $sql)) {
                        $count++;
                    } else {
                        $test_insert = false;

                        break;
                    }
                }
            }
            // End inserting data
            if ($test_op_exist) {
                break;
            }
        }

        if (!$test_op_exist && $test_mbr_exist && $test_insert && $count > 0) {
            echo "Data saved!";
        } else {
            echo "Data not saved. Some data already exist";
        }

//        $result->free();
        $connection->close();
    }
