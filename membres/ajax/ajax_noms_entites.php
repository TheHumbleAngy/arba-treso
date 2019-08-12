<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-May-19
     * Time: 11:56 AM
     */

    $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

    if ($_POST['usage'] == 'autocompletion' && $_POST['entity'] == 'membres') {
        $sql_mbr = "SELECT * FROM membres";

        $result = mysqli_query($connection, $sql_mbr);
        if ($result->num_rows > 0) {
            $membres = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $id_mbr = $membre['id_membre'];
                $nom_mbr = $membre['nom_membre'];
                $pren_mbr = $membre['pren_membre'];

                $mbr[$i++] = $nom_mbr . " " . $pren_mbr;
            }

            $result->free();
            $connection->close();

            echo json_encode($mbr);
        }
    }
    elseif ($_POST['usage'] == 'autocompletion' && $_POST['entity'] == 'communes') {
        $sql = "SELECT * FROM communes";

        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $communes = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($communes as $commune) {
                $id = $commune['id_commune'];
                $libelle = $commune['libelle_commune'];

                $com[$i++] = $libelle;
            }

            $result->free();
            $connection->close();

            echo json_encode($com);
        }
    }
    elseif ($_POST['usage'] == 'autocompletion' && $_POST['entity'] == 'villes') {
        $sql = "SELECT * FROM villes";

        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $villes = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($villes as $ville) {
                $id = $ville['id_ville'];
                $libelle = $ville['libelle_ville'];
                $region = $ville['region_ville'];

                $vil[$i++] = $libelle;
            }

            $result->free();
            $connection->close();

            echo json_encode($vil);
        }
    }
    elseif ($_POST['usage'] == 'listing' && $_POST['info'] == '') {
        $sql_mbr = "SELECT * FROM membres m INNER JOIN villes v on m.id_ville = v.id_ville INNER JOIN communes c on m.id_commune = c.id_commune";

        $result = mysqli_query($connection, $sql_mbr);
        if ($result->num_rows > 0) {
            $membres = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $mbr[$i][0] = $membre['id_membre'];
                $mbr[$i][1] = $membre['nom_membre'] . " " .$membre['pren_membre'];
                $mbr[$i][2] = $membre['genre_membre'];
                $mbr[$i][3] = $membre['contact_membre'];
                $mbr[$i][4] = $membre['libelle_commune'];
                $mbr[$i][5] = $membre['libelle_ville'];
                $mbr[$i++][6] = $membre['date_crea_membre'];
            }

            $result->free();
            $connection->close();

            echo json_encode($mbr);
        }
    }
    elseif ($_POST['usage'] == 'listing' && $_POST['info'] != '') {
        $param = $_POST['info'];

        $sql_mbr = "SELECT * FROM membres WHERE nom_membre LIKE '%{$param}%' OR pren_membre LIKE '%{$param}%'";

        $result = mysqli_query($connection, $sql_mbr);
        if ($result->num_rows > 0) {
            $membres = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $mbr[$i][0] = $membre['id_membre'];
                $mbr[$i][1] = $membre['nom_membre'] . " " .$membre['pren_membre'];
                $mbr[$i][2] = $membre['genre_membre'];
                $mbr[$i][3] = $membre['contact_membre'];
                $mbr[$i][4] = $membre['libelle_commune'];
                $mbr[$i][5] = $membre['libelle_ville'];
                $mbr[$i++][6] = $membre['date_crea_membre'];
            }

            $result->free();
            $connection->close();

            echo json_encode($mbr);
        }
    }