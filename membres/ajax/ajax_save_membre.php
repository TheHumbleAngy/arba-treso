<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 12-Jun-19
     * Time: 5:22 PM
     */
    $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

    $sql_last = "SELECT id_membre FROM membres ORDER BY id_membre DESC LIMIT 1";

    $year = date('y');
    $number = '000';
    $result = mysqli_query($connection, $sql_last);
    if ($result->num_rows > 0) {
        $membres = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($membres as $membre) {
            $id_last_mbr = $membre['id_membre'];
        }

        $id_year = substr($id_last_mbr, 1, 2);

        $number = $id_year == $year ? substr($id_last_mbr, 3) : $number;
    }

    $number = sprintf('%03d', ++$number);
    $id_mbr = 'M' . $year . $number;
    $nom = strtoupper($_POST['name']);
    $prenoms = strtoupper($_POST['pname']);
    $adresse = $_POST['addr'];
    $contacts = $_POST['contact'];

    $sql = "INSERT INTO membres (id_membre, nom_membre, pren_membre, adresse_membre, contact_membre) VALUES ('{$id_mbr}', '{$nom}', '{$prenoms}', '{$adresse}', '{$contacts}')";
    if ($result = mysqli_query($connection, $sql)) {
        echo $nom . " " . $prenoms;
    } else {
        echo "Error";
    }

    $result->free();
    $connection->close();