<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-Aug-19
     * Time: 4:02 PM
     */

    if (sizeof($_POST)) {

        $sql = "
SELECT DISTINCT
  o2.id_operation,
  date_operation,
  obs_operation,
  nom_interlocuteur,
  pren_interlocuteur,
  montant_operation,
  obs_operation
FROM interlocuteurs i 
  INNER JOIN operations o2 on i.id_interlocuteur = o2.id_interlocuteur
  INNER JOIN categories c on o2.id_categorie = c.id_categorie
  INNER JOIN types_operation to2 on c.id_typ_op = to2.id_typ_op";

        if (isset($_POST['info']) && $_POST['info'] != '') {
            $date = $_POST['info'];
            $sql .= " WHERE o.date_operation = '{$date}'";
        }

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');
        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $mvts = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($mvts as $mvt) {
                $ope[$i][0] = $mvt['id_operation'];
                $ope[$i][1] = $mvt['date_operation'];
                $ope[$i][2] = $mvt['obs_operation'];
                $ope[$i][3] = $mvt['montant_operation'];
                $ope[$i][4] = $mvt['nom_interlocuteur'] . " " . $mvt['pren_interlocuteur'];
                $ope[$i++][5] = $mvt['obs_operation'];
            }

            $result->free();
            $connection->close();

            echo json_encode($ope);
        }
    }
