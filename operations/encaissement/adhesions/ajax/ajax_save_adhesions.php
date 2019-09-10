<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 17-Jun-19
     * Time: 7:12 PM
     */
    if (isset($_POST['arr']) && isset($_POST['dateAdhe'])) {

        $data = $_POST['arr'];
        $date = trim($_POST['dateAdhe']);
        $n = sizeof($data);
        $test_mbr_exist = false;
        $test_insert = true;
        $id_categorie = "CAT01";
        $id_fonction = "FCT04"; // membre regulier
        $count = 0;
        $obs = "FRAIS ADHESION";

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        for ($i = 0; $i < $n; $i++) {

            $m = sizeof($data[$i]);

            $nom = mysqli_real_escape_string($connection, strtoupper(trim($data[$i][0])));
            $pren = mysqli_real_escape_string($connection, strtoupper(trim($data[$i][1])));
            $contact = $data[$i][2];
            $id_commune = strtoupper(trim($data[$i][3]));
            $id_ville = strtoupper(trim($data[$i][4]));
            $genre = $data[$i][5];
            $mtt = $data[$i][6] * 1000;

            // Checking that info to be saved do not exist already
            $sql_mbr_exist = "SELECT * FROM membres WHERE nom_membre = '{$nom}' AND pren_membre = '{$pren}' AND genre_membre = '{$genre}'";
            $result = mysqli_query($connection, $sql_mbr_exist);
            if ($result->num_rows) {
                $test_mbr_exist = true;

                break;
            }
            else {
                // Saving data...
                // ..."membre"
                $sql_last = "SELECT id_membre FROM membres ORDER BY id_membre DESC LIMIT 1";

                $year = date('y');
                $number = '000';
                $result = mysqli_query($connection, $sql_last);
                $id_last_mbr = '';
                if ($result->num_rows > 0) {
                    $membres = $result->fetch_all(MYSQLI_ASSOC);

                    foreach ($membres as $membre) {
                        $id_last_mbr = $membre['id_membre'];
                    }

                    $id_year = substr($id_last_mbr, 1, 2);

                    $number = $id_year == $year ? substr($id_last_mbr, 3) : $number;
                }

                $number = sprintf('%03d', ++$number);
                $id_mbr = 'M' . $year . $number;
                $nom = mysqli_escape_string($connection, strtoupper($nom));
                $pren = mysqli_escape_string($connection, strtoupper($pren));

                $sql_mbr = "INSERT INTO membres (id_membre, id_fonction, id_commune, id_ville, nom_membre, pren_membre, genre_membre, contact_membre, date_crea_membre) VALUES ('{$id_mbr}', '{$id_fonction}', '{$id_commune}', '{$id_ville}', '{$nom}', '{$pren}', '{$genre}', '{$contact}', '{$date}')";
                if (mysqli_query($connection, $sql_mbr)) {
                    // ...operation
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
                    $id_mois = "M" . date('m');
                    $an = substr($date, 0, 4);

                    $sql_op = "INSERT INTO operations (id_operation, id_membre, id_mois, id_categorie, montant_operation, obs_operation, date_saisie_operation, date_operation, annee_operation) VALUES ('{$id_ope}', '{$id_mbr}', '{$id_mois}', '{$id_categorie}', {$mtt}, '{$obs}', '{$date}', '{$date}', {$an})";
                    if ($result = mysqli_query($connection, $sql_op)) {
                        $test_insert = true;
                    } else {
                        $test_insert = false;

                        break;
                    }

                } else {
                    $test_insert = false;

                    break;
                }
            }
        }

        if ($test_mbr_exist)
            echo "{$nom} {$pren} already exists.";
        elseif (!$test_insert)
            echo "Error while inserting data";
        else
            echo "Data saved";

        if ($result) {
            // $result->free();
            $connection->close();
        }

        // echo json_encode($sql_op);
    }