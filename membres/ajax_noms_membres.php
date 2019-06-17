<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-May-19
     * Time: 11:56 AM
     */

    $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

    if ($_POST['usage'] == 'autocompletion') {
        $sql_mbr = "SELECT * FROM membres";

        $resultat = mysqli_query($connection, $sql_mbr);
        if ($resultat->num_rows > 0) {
            $membres = $resultat->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $id_mbr = $membre['id_membre'];
                $nom_mbr = $membre['nom_membre'];
                $pren_mbr = $membre['pren_membre'];

                $mbr[$i++] = $nom_mbr . " " . $pren_mbr;
            }

            echo json_encode($mbr);
        }
    } elseif ($_POST['usage'] == 'listing' && $_POST['info'] == '') {
        $sql_mbr = "SELECT * FROM membres";

        $resultat = mysqli_query($connection, $sql_mbr);
        if ($resultat->num_rows > 0) {
            $membres = $resultat->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $mbr[$i][0] = $membre['id_membre'];
                $mbr[$i][1] = $membre['nom_membre'] . " " .$membre['pren_membre'];
                $mbr[$i][2] = $membre['adresse_membre'];
                $mbr[$i++][3] = $membre['contact_membre'];
            }

            echo json_encode($mbr);
        }
    } elseif ($_POST['usage'] == 'listing' && $_POST['info'] != '') {
        $param = $_POST['info'];

        $sql_mbr = "SELECT * FROM membres WHERE nom_membre LIKE '%" . $param . "%' OR pren_membre LIKE '%" . $param . "%'";

        $resultat = mysqli_query($connection, $sql_mbr);
        if ($resultat->num_rows > 0) {
            $membres = $resultat->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $mbr[$i][0] = $membre['id_membre'];
                $mbr[$i][1] = $membre['nom_membre'] . " " .$membre['pren_membre'];
                $mbr[$i][2] = $membre['adresse_membre'];
                $mbr[$i++][3] = $membre['contact_membre'];
            }

            echo json_encode($mbr);
        }
    }