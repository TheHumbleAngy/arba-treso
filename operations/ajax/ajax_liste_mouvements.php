<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-Aug-19
     * Time: 4:02 PM
     */

    if (isset($_POST['type'])) {
        $id_typ = $_POST['type'];

        $sql = "
SELECT DISTINCT
  o.id_operation,
  date_operation_interlocuteur,
  obs_operation,
  nom_interlocuteur,
  pren_interlocuteur,
  montant_operation,
  commentaires
FROM interlocuteurs i 
  INNER JOIN operations_interlocuteurs o on i.id_interlocuteur = o.id_interlocuteur
  INNER JOIN operations o2 on o.id_operation = o2.id_operation
  INNER JOIN categories c on o2.id_categorie = c.id_categorie
  INNER JOIN types_operation to2 on c.id_typ_op = to2.id_typ_op
WHERE c.id_typ_op = {$id_typ}";

        if (isset($_POST['info']) && $_POST['info'] != '') {
            $date = $_POST['info'];
            $sql .= " AND o.date_operation_interlocuteur = '{$date}'";
        }

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');
        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $mvts = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0;

            foreach ($mvts as $mvt) {
                $ope[$i][0] = $mvt['id_operation'];
                $ope[$i][1] = $mvt['date_operation_interlocuteur'];
                $ope[$i][2] = $mvt['obs_operation'];
                $ope[$i][3] = $mvt['montant_operation'];
                $ope[$i][4] = $mvt['nom_interlocuteur'] . " " . $mvt['pren_interlocuteur'];
                $ope[$i++][5] = $mvt['commentaires'];
            }

            $result->free();
            $connection->close();

            echo json_encode($ope);
        }
    }