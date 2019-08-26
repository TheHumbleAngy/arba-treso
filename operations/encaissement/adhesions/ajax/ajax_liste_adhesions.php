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
            $sql_mbr = "SELECT * FROM operations o INNER JOIN membres m ON o.id_membre = m.id_membre WHERE id_categorie = 'CAT01' AND m.nom_membre LIKE '%{$qry}%' OR m.pren_membre LIKE '%{$qry}%'";
        else
            $sql_mbr = "SELECT * FROM operations o INNER JOIN membres m ON o.id_membre = m.id_membre WHERE id_categorie = 'CAT01'";

        $result = mysqli_query($connection, $sql_mbr);
        if ($result->num_rows > 0) {
            $membres = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($membres as $membre) {
                $mbr[$i][0] = $membre['id_membre'];
                $mbr[$i][1] = $membre['nom_membre'] . " " . $membre['pren_membre'];
                $mbr[$i++][2] = $membre['date_operation'];
            }

            $result->free();
            $connection->close();

            echo json_encode($mbr);
        }
    }