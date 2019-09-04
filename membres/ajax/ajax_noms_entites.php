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

        $state = isset($_POST['state']) ? $_POST['state'] : 0;

        $result = mysqli_query($connection, $sql_mbr);
        if ($result->num_rows > 0) {
            $membres = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $id_mbr = $membre['id_membre'];
                $nom_mbr = $membre['nom_membre'];
                $pren_mbr = $membre['pren_membre'];

                if ($state == 0)
                    $mbr[$i++] = $nom_mbr . " " . $pren_mbr;
                else {
                    $mbr[$i][0] = $nom_mbr;
                    $mbr[$i++][1] = $pren_mbr;
                }
            }

            if ($state != 0) {
                $sql_inter = "SELECT * FROM interlocuteurs";
                $result = mysqli_query($connection, $sql_inter);
                if ($result->num_rows > 0) {
                    $inters = $result->fetch_all(MYSQLI_ASSOC);

                    foreach ($inters as $inter) {
                        $id_inter = $inter['id_interlocuteur'];
                        $nom_inter = $inter['nom_interlocuteur'];
                        $pren_inter = $inter['pren_interlocuteur'];

                        $mbr[$i][0] = $nom_inter;
                        $mbr[$i++][1] = $pren_inter;
                    }
                }
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
    elseif ($_POST['usage'] == 'listing' && $_POST['entity'] == 'membres' && $_POST['info'] != '') {
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
    elseif ($_POST['usage'] == 'listing' && $_POST['entity'] == 'membres') {
        $sql_mbr = "SELECT DISTINCT m.id_membre, nom_membre, pren_membre, genre_membre, contact_membre, libelle_commune, libelle_ville, date_operation FROM membres m INNER JOIN operations o ON o.id_membre = m.id_membre INNER JOIN villes v on m.id_ville = v.id_ville INNER JOIN communes c on m.id_commune = c.id_commune WHERE id_categorie = 'CAT01' ORDER BY nom_membre, pren_membre ";

        $result = mysqli_query($connection, $sql_mbr);
        if ($result->num_rows > 0) {
            $membres = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $mbr[$i][0] = $membre['id_membre'];
                $mbr[$i][1] = $membre['id_membre'];
                $mbr[$i][2] = $membre['nom_membre'] . " " .$membre['pren_membre'];
                $mbr[$i][3] = $membre['genre_membre'];
                $mbr[$i][4] = $membre['contact_membre'];
                $mbr[$i][5] = $membre['libelle_commune'];
                $mbr[$i][6] = $membre['libelle_ville'];
                $mbr[$i++][7] = $membre['date_operation'];
            }

            $result->free();
            $connection->close();

            echo json_encode($mbr);
        }
    }