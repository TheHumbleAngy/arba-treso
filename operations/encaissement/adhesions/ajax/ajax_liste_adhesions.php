<?php
    /**
     * Created by PhpStorm.
     * User: NCARE
     * Date: 8/26/2019
     * Time: 10:19 PM
     */
    if (isset($_POST['info'])) {
        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        $qry = $_POST['info'];
        if ($qry)
            $sql_mbr = "SELECT * FROM membres m INNER JOIN operations o ON o.id_membre = m.id_membre WHERE id_categorie = 'CAT01' AND (nom_membre LIKE '%{$qry}%' OR pren_membre LIKE '%{$qry}%') ORDER BY nom_membre, pren_membre";
        else
            $sql_mbr = "SELECT * FROM membres m INNER JOIN operations o ON o.id_membre = m.id_membre WHERE id_categorie = 'CAT01' ORDER BY nom_membre, pren_membre";

        $result = mysqli_query($connection, $sql_mbr);
        if ($result->num_rows > 0) {
            $membres = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $mbr[$i][0] = $membre['id_membre'];
                $mbr[$i][1] = $membre['nom_membre'] . " " . $membre['pren_membre'];
                $mbr[$i][2] = $membre['date_operation'];
                $mbr[$i++][3] = $membre['montant_operation'];
            }

            $result->free();
            $connection->close();

            echo json_encode($mbr);
        }
    }