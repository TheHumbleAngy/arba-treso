<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 18-Aug-19
     * Time: 12:35 PM
     */
    if (isset($_POST['dateOpe']) && isset($_POST['dest']) && isset($_POST['mtt']) && isset($_POST['ordr']) && isset($_POST['com'])) {
        $date_ope = $_POST['dateOpe'];
        $id_mbr = $_POST['dest'];
        $montant = $_POST['mtt'];
        $ordre_de = $_POST['ordr'];
        $commentaires = $_POST['com'];
        $id_categorie = $_POST['cate'];

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        $obs = "A l'ordre de {$ordre_de}.\n" . $commentaires;
        $obs = mysqli_real_escape_string($connection, $obs);

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
        $today = date('Y-m-d');
        $an = substr($today, 0, 4);

        $sql_op = "INSERT INTO operations (id_operation, id_membre, id_mois, id_categorie, montant_operation, obs_operation, date_saisie_operation, date_operation, annee_operation) VALUES ('{$id_ope}', '{$id_mbr}', '{$id_mois}', '{$id_categorie}', {$montant}, '{$obs}', '{$today}', '{$date_ope}', {$an})";
//        echo $sql_op;
        if ($result = mysqli_query($connection, $sql_op))
            echo "Saved";
        else
            echo "Not saved";
    }
    else
        echo "Veuillez renseigner tous les champs";