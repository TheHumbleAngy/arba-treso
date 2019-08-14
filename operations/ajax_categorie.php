<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 07-Aug-19
     * Time: 3:22 PM
     */
    if (isset($_POST['libelle']) && isset($_POST['type'])) {
        $libelle = strtoupper($_POST['libelle']);
        $type = $_POST['type'];

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        // Checking whether the entered "categories" exists
        $sql = "SELECT * FROM categories WHERE libelle_categorie = '{$libelle}' AND id_typ_op = {$type}";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows < 1) {
            $result->free();

            // Create a new record
            $sql = "SELECT id_categorie FROM categories ORDER BY id_categorie DESC LIMIT 1";
            $result = mysqli_query($connection, $sql);
            if ($result->num_rows > 0) {
                $ids = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($ids as $id) {
                    $id_last_cat = $id['id_categorie'];
                }

                $number = substr($id_last_cat, 3);
            }

            $number = sprintf('%02d', ++$number);
            $id_cat = 'CAT' . $number;

            $sql = "INSERT INTO categories (id_categorie, id_typ_op, libelle_categorie) VALUES ('{$id_cat}', '{$type}', '{$libelle}')";
            if ($result = mysqli_query($connection, $sql))
                echo "Data saved";
            else
                echo "Error while saving data";
        } else
            echo "Already in database";

        $connection->close();
    }
    elseif (isset($_POST['info'])) {
        $sql = strtoupper($_POST['info']);

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');
        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $set = $result->fetch_all(MYSQLI_ASSOC);

            echo json_encode($set);
        }

        $result->free();
        $connection->close();
    }