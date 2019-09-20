<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-Aug-19
     * Time: 11:52 AM
     */

    require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');

    if (isset($_POST['info'])) {
        $sql = $_POST['info'];

        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            ?>
            <div id="added_div" class="row justify-content-end my-4 mx-0 container-fluid">
                <form class="form-inline">
                    <label for="montant_total" class="mr-2 font-weight-bolder">Montant Total</label>
                    <input type="text" id="montant_total"
                           class="form-control form-control-sm text-right font-weight-bold text-primary">
                </form>
            </div>
            <div class="border border-primary rounded" style="max-width: 150%">
                <table class="table table-sm table-hover bg-light" id="arr_operations">
                    <thead class="bg-primary text-light">
                    <tr class="row mx-0">
                        <th class="col-05">N°</th>
                        <th class="col" title="">Id.</th>
                        <th class="col" title="Date Mouvement">Date</th>
                        <th class="col" title="Type du Mouvement">Type</th>
                        <th class="col text-center">Montant</th>
                        <th class="col">Catégorie</th>
                        <th class="col text-truncate" title="Nom de l'interlocuteur">Nom Interlocuteur</th>
                        <th class="col">Titre</th>
                        <th class="col">Contact</th>
                        <th class="col-2">Membre</th>
                    </tr>
                    </thead>
                    <tbody id="liste_mouvements">

                    <?php
                        $mouvements = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 0;
                        $tot = 0;
                        foreach ($mouvements as $mvt) {
                            $id_operation = $mvt['id_operation'];
                            $id_typ_op = $mvt['id_typ_op'];
                            $date_operation = $mvt['date_operation'];
                            $libelle_typ_op = $mvt['libelle_typ_op'];
                            $montant_operation = $mvt['montant_operation'];
                            $libelle_categorie = $mvt['libelle_categorie'];
                            $nom_interlocuteur = $mvt['nom_interlocuteur'];
                            $pren_interlocuteur = $mvt['pren_interlocuteur'];
                            $titre_interlocuteur = $mvt['titre_interlocuteur'];
                            $contact_interlocuteur = $mvt['contact_interlocuteur'];
                            $nom_membre = $mvt['nom_membre'];
                            $pren_membre = $mvt['pren_membre'];
                            $obs_operation = $mvt['obs_operation'];
                            ?>
                            <tr class="row mx-0">
                                <td class="col-05 text-primary text-right">
                                    <?php echo ++$i; ?>
                                </td>
                                <td class="col text-primary font-weight-bold text-truncate" title="Identifiant de l'opération">
                                    <?php echo $id_operation; ?>
                                </td>
                                <td class="col" title="Date de l'opération">
                                    <?php echo date("d-m-Y", strtotime($date_operation)); ?>
                                </td>
                                <td class="col">
                                    <?php echo $libelle_typ_op; ?>
                                </td>
                                <td class="col text-right">
                                    <?php
                                        if ($id_typ_op == 1) {
                                            echo "<span class=\"font-weight-bolder text-success\" title=\"" . $obs_operation . "\">" . number_format($montant_operation, 0, '', '.') . "</span>";
                                        } else {
                                            echo "<span class=\"font-weight-bolder text-danger\" title=\"" . $obs_operation . "\">" . number_format($montant_operation, 0, '', '.') . "</span>";
                                            $montant_operation = $montant_operation * -1;
                                        }
                                    ?>
                                </td>
                                <td class="col">
                                    <?php echo $libelle_categorie; ?>
                                </td>
                                <td class="col text-truncate" title="<?php echo $nom_interlocuteur . " " . $pren_interlocuteur; ?>">
                                    <?php echo $nom_interlocuteur . " " . $pren_interlocuteur; ?>
                                </td>
                                <td class="col text-truncate" title="<?php echo $titre_interlocuteur; ?>">
                                    <?php echo $titre_interlocuteur; ?>
                                </td>
                                <td class="col text-truncate" title="<?php echo $contact_interlocuteur; ?>">
                                    <?php echo $contact_interlocuteur; ?>
                                </td>
                                <td class="col-2 text-truncate" title="<?php echo $nom_membre . " " . $pren_membre; ?>">
                                    <?php echo $nom_membre . " " . $pren_membre; ?>
                                </td>
                            </tr>
                            <?php
                            $tot += $montant_operation;
                        }

                    ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        else {
            echo "Not found";
        }

        $result->free();
        $connection->close();
    }

    if (isset($tot) && $tot != 0) {
        echo '<input type="hidden" id="total" value="' . number_format($tot, 0, "", ".") . '">';
    }
?>

