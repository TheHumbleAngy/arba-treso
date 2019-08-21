<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 18-Aug-19
     * Time: 12:35 PM
     */
    if (isset($_POST['dateOpe']) && isset($_POST['dest']) && isset($_POST['mtt']) && isset($_POST['ordr']) && isset($_POST['com']) && isset($_POST['cate'])) {
        $id_mbr = $_POST['dest'];
        $id_mois = "M" . date('m');
        $id_categorie = $_POST['cate'];
        $montant = $_POST['mtt'];
        $date_ope = $_POST['dateOpe'];
        $year = date('y');
        $commentaires = $_POST['com'];
        $ordre_de = $_POST['ordr'];
        $titre = isset($_POST['titre']) ? $_POST['titre'] : "";
        $contact = isset($_POST['contact']) ? $_POST['contact'] : "";
        $commune = isset($_POST['commune']) ? $_POST['commune'] : "";

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        $obs = "A l'ordre de {$ordre_de}.\n" . $commentaires;
        $obs = mysqli_real_escape_string($connection, $obs);

        // 1- First, we create a new line in table 'operations'
        // 2- Then, we do the same in table 'interlocuteurs'
        // 3- Finally, we do the same in 'operations_interlocuteurs'

        /* - 1 - */
        $sql_last = "SELECT id_operation FROM operations ORDER BY id_operation DESC LIMIT 1";

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
        if ($result = mysqli_query($connection, $sql_op)) {

            /* - 2 - */
            // Saving in table 'interlocuteurs'
            $sql_last = "SELECT id_interlocuteur FROM interlocuteurs ORDER BY id_interlocuteur DESC LIMIT 1";

            $result = mysqli_query($connection, $sql_last);
            $number = 0;
            if ($result->num_rows > 0) {
                $ids = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($ids as $id) {
                    $id_last = $id['id_interlocuteur'];
                }

                $number = substr($id_last, 3);
            }

            $number = sprintf('%02d', ++$number);
            $id_interlocuteur = "ITL" . $number;

            $sql_itl = "INSERT INTO interlocuteurs (id_interlocuteur, nom_interlocuteur, titre_interlocuteur, contact_interlocuteur, localite_interlocuteur) VALUES ('{$id_interlocuteur}', '{$ordre_de}', '{$titre}', '{$contact}', '{$commune}')";

            if ($result = mysqli_query($connection, $sql_itl)) {

                /* - 3 - */
                // Saving in table 'operations_interlocuteurs'
                $sql_op_itl = "INSERT INTO operations_interlocuteurs (id_operation, id_interlocuteur, date_operation_interlocuteur, commentaires) VALUES ('{$id_ope}', '{$id_interlocuteur}', '{$date_ope}', '{$obs}')";

                if ($result = mysqli_query($connection, $sql_op_itl))
                    echo "Saved";
                else {
                    echo "{$id_ope} saved - {$id_interlocuteur} saved - {$id_ope}-{$id_interlocuteur} not saved";
                    echo $sql_op_itl;
                }

            }
            else {
                echo "{$id_ope} saved - {$id_interlocuteur} not saved";
                echo $sql_itl;
            }

        }
        else {
            echo "{$id_ope} not saved";
            echo $sql_op;
        }

    }
    else
        echo "Veuillez renseigner tous les champs";