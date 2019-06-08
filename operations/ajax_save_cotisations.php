<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jun-19
     * Time: 6:51 PM
     */
    if (isset($_POST['data'])) {
        $data = $_POST['data'];
        $n = sizeof($data);
        $mbr = array();
        $coti = array();
        $mois = array();
        $mtt = array();
        $test = true;

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        for ($i = 0; $i < $n; $i++) {
            // lines

            $m = sizeof($data[$i]);
            for ($j = 0; $j < $m; $j++) {
                // columns

                if ($j == 0) {
                    $info[$i][$j] = $data[$i][$j];
                    $mbr[$i] = $data[$i][$j];
                } else {
                    $coti = explode('-', $data[$i][$j]);
                    $mois[$i][$j - 1] = $coti[0];
                    $mtt[$i][$j - 1] = $coti[1];

                    $size_mois = sizeof($mois);
                    $size_mtt = sizeof($mtt);

                    $info[$i][$j] = "{$mois[$i][$j - 1]}, {$mtt[$i][$j - 1]}";
                }
            }

            // "KOUAKOU ANGE" "1, 2000" "2, 2000" "3, 1000" "4, 3000" "11, 2000"
            for ($j = 0; $j < sizeof($mois[$i]); $j++) {
                if ((int)$mois[$i][$j] < 10)
                    $mois[$i][$j] = 'M0' . $mois[$i][$j];
                else
                    $mois[$i][$j] = 'M' . $mois[$i][$j];
            }

            // "KOUAKOU ANGE" "M01, 2000" "M02, 2000" "M03, 1000" "M04, 3000" "M11, 2000"
            $nom_mbr = explode(' ', $mbr[$i], 2); //
            $nom = $nom_mbr[0];
            $prenoms = $nom_mbr[1];
            $an = date('Y');
            $today = date('Y-m-d');

            // Getting the id of the current member, on line i
            $sql_mbr = "SELECT id_membre FROM membres WHERE nom_membre = '{$nom}' AND pren_membre = '{$prenoms}'";

            $resultat = mysqli_query($connection, $sql_mbr);
            if ($resultat->num_rows) {
                $lignes = $resultat->fetch_all(MYSQLI_ASSOC);
                foreach ($lignes as $ligne) {
                    $id_mbr = $ligne['id_membre'];
                }
            }
            // End getting the member's id

            // Inserting data...
            for ($j = 0; $j < sizeof($mois[$i]); $j++) {
                $id_mois = $mois[$i][$j];
                $montant = $mtt[$i][$j];

                // Checking that info to be saved do not exist already
                $sql_test = "SELECT * FROM operations WHERE id_membre = '{$id_mbr}' AND id_mois = '{$id_mois}' AND annee_cotisation = '{$an}'";
                $resultat = mysqli_query($connection, $sql_test);
                if ($resultat->num_rows) {
                    $test = false;

                    break;
                } else {
                    $sql = "INSERT INTO operations (id_membre, id_mois, montant_cotisation, date_operation, annee_cotisation) VALUES ('{$id_mbr}', '{$id_mois}', '{$montant}', '{$today}', '{$an}')";
                    $resultat = mysqli_query($connection, $sql);
                }
            }
            // End inserting data
            if (!$test)
                break;
        }

        if ($test)
            echo "Data saved!";
        else
            echo "Data not saved. Some data already exist";
    }
