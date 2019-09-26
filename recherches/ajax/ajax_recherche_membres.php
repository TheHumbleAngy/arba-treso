<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-Jun-19
     * Time: 5:51 AM
     */
    require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');

    if (isset($_POST['info'])) {
        $sql = $_POST['info'];
        $sql .= " ORDER BY m.nom_membre, m.pren_membre";

        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $membres = $result->fetch_all(MYSQLI_ASSOC);
            $i = 0; ?>

            <div class="border border-primary rounded">
                <table class="table table-sm table-hover bg-light" id="arr_membres">
                    <thead class="bg-primary text-light">
                    <tr class="row mx-0">
                        <th class="text-center col-05">N°</th>
                        <th class="col-1 text-center" title="Identifiant">Id.</th>
                        <th class="col">Nom</th>
                        <th class="col">Prénoms</th>
                        <th class="col-1 text-center">Genre</th>
                        <th class="col">Contacts</th>
                        <th class="col">Commune</th>
                        <th class="col">Ville</th>
                    </tr>
                    </thead>
                    <tbody id="liste_membres">

                    <?php
                        foreach ($membres as $membre) {
                            $id_mbr = $membre['id_membre'];
                            $nom_mbr = $membre['nom_membre'];
                            $pren_mbr = $membre['pren_membre'];
                            $gender = $membre['genre_membre'];
                            $contacts = $membre['contact_membre'];
                            $com = $membre['libelle_commune'];
                            $vil = $membre['libelle_ville'];
                            $date = $membre['date_crea_membre'];
                            ?>
                            <tr class="row mx-0">
                                <td class="text-center text-primary font-weight-light col-05">
                                    <?php echo ++$i; ?>
                                </td>
                                <td class="text-center text-primary col-1">
                                    <?php echo $id_mbr; ?>
                                </td>
                                <td class="col text-uppercase">
                                    <?php echo $nom_mbr; ?>
                                </td>
                                <td class="col text-uppercase text-truncate">
                                    <?php echo $pren_mbr; ?>
                                </td>
                                <?php if ($gender == 'H') { ?>
                                <td class="col-1 text-center text-uppercase text-primary" title="Homme">
                                    <?php }
                                        else { ?>
                                <td class="col-1 text-center text-uppercase text-primary" title="Femme">
                                    <?php } ?>
                                    <?php echo $gender; ?>
                                </td>
                                <td class="col text-truncate">
                                    <?php echo $contacts; ?>
                                </td>
                                <td class="col">
                                    <?php echo $com; ?>
                                </td>
                                <td class="col">
                                    <?php echo $vil; ?>
                                </td>
                            </tr>
                            <?php
                        } ?>

                    </tbody>
                </table>
            </div>

            <?php
        } else {
            echo "Not found";
        }
        $result->free();
        $connection->close();
    }
?>