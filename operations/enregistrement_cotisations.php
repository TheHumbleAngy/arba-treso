<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-May-19
     * Time: 6:06 PM
     */
    if ($_POST['info']) {
        $info = $_POST['info']; //echo $info;
        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');
        $liste_mois = array(
            array("1", "M01"),
            array("2", "M02"),
            array("3", "M03"),
            array("4", "M04"),
            array("5", "M05"),
            array("6", "M06"),
            array("7", "M07"),
            array("8", "M08"),
            array("9", "M09"),
            array("10", "M10"),
            array("11", "M11"),
            array("12", "M12"),
        );

        $mois = date('n');
        $an = date('Y');
        $date = date('Y-m-d');

        $id_mois = "RAS";
        for ($i = 0; $i < sizeof($liste_mois); $i++) {
            if ($mois == $liste_mois[$i][0]) {
                $id_mois = $liste_mois[$i][1];
                break;
            }
        }

        $j = 0;
        $k = 0;
        $list_mbr_wrong = [];
        for ($i = 0; $i < sizeof($info); $i++) {
            $data[$i] = explode('_', $info[$i]);
            $mbr[$i] = $data[$i][0];
            $coti[$i] = $data[$i][1];

            $infos[$i] = $mbr[$i] . " & " . $coti[$i];

            $membre = explode(' ', $mbr[$i], 2);
            $nom_membre = $membre[0];
            $pren_membre = $membre[1];
            $test = true;

            // Recuperation de l'id du membre
            $sql_mbr = "SELECT id_membre FROM membres WHERE nom_membre = '" . $nom_membre . "' AND pren_membre = '" . $pren_membre . "'";

            $resultat = mysqli_query($connection, $sql_mbr);
            if ($resultat->num_rows > 0) {
                $liste = $resultat->fetch_all(MYSQLI_ASSOC);
                foreach ($liste as $element) {
                    $id_membre = $element['id_membre'];
                }

                // Verification de l'existence de l'operation à saisir
                $check = "SELECT * FROM operations WHERE id_membre = '" . $id_membre . "' AND id_mois = '" . $id_mois . "' AND annee_operation = '" . $an . "'";
                $res = mysqli_query($connection, $check);

//                $tot[$i] = $res->num_rows;
                // Si la ligne à insérer n'existe pas déjà
                if ($res->num_rows < 1) {
                    $sql_ope = "INSERT INTO operations (id_membre, id_mois, montant_operation, date_operation, annee_operation) VALUES ('" . $id_membre . "', '" . $id_mois . "', " . $coti[$i] . ", '" . $date . "', '" . $an . "')";
                    $res = mysqli_query($connection, $sql_ope);
                    $j++;
                } else {
                    $list_mbr_wrong[$k++] = $nom_membre . " " . $pren_membre;
                }

            }
        }

        if (sizeof($list_mbr_wrong) > 0)
            echo json_encode($list_mbr_wrong);
        else
            echo json_encode($infos);

//        echo json_encode($tot);
    }