<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-Jun-19
     * Time: 5:51 AM
     */
?>
<div class="border border-primary rounded">
    <table class="table table-sm table-hover bg-light" id="arr_membres">
        <thead class="bg-primary text-light">
        <tr class="row mx-0">
            <th class="text-center">N°</th>
            <th class="col">Nom</th>
            <th class="col">Prénoms</th>
            <th class="col-1">Genre</th>
            <th class="col-2">Contacts</th>
            <th class="col-2">Commune</th>
            <th class="col-2">Ville</th>
            <th class="col-2">Adhésion</th>
        </tr>
        </thead>
        <tbody id="liste_membres">

        <?php
            $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

            if (isset($_POST['info'])) {
                $sql = $_POST['info'];

                $result = mysqli_query($connection, $sql);
                if ($result->num_rows > 0) {
                    $membres = $result->fetch_all(MYSQLI_ASSOC);
                    $i = 0;
                    foreach ($membres as $membre) {
                        $nom_mbr = $membre['nom_membre'];
                        $pren_mbr = $membre['pren_membre'];
                        $com = $membre['libelle_commune'];
                        $vil = $membre['libelle_ville'];
                        $tel = $membre['contact_membre'];
                        $date = $membre['date_crea_membre'];
                        $gender = $membre['genre_membre'];
                        ?>
                        <tr class="row mx-0">
                            <td class="col-1 text-center text-primary font-weight-light">
                                <span class="">
                                    <?php echo ++$i; ?>
                                </span>
                            </td>
                            <td class="col-2">
                                <span class="text-uppercase">
                                    <?php echo $nom_mbr; ?>
                                </span>
                            </td>
                            <td class="col-3">
                                <span class="text-uppercase">
                                    <?php echo $pren_mbr; ?>
                                </span>
                            </td>
                            <td class="col-2">
                                <span class="text-uppercase">
                                    <?php echo $loc; ?>
                                </span>
                            </td>
                            <td class="col-2">
                                <span class="text-uppercase">
                                    <?php echo $tel; ?>
                                </span>
                            </td>
                            <td class="col-1 text-center">
                                <span class="text-uppercase">
                                    <?php echo $gender; ?>
                                </span>
                            </td>
                            <td class="col-1">
                                <span class="text-uppercase">
                                    <?php echo $date; ?>
                                </span>
                            </td>
                        </tr>
                        <?php
                    }
                }

                $result->free();
                $connection->close();
            }
        ?>
        </tbody>
    </table>
</div>