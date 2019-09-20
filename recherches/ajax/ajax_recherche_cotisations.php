<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jul-19
     * Time: 9:54 AM
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
                           class="form-control form-control-sm text-right font-weight-bold text-success">
                </form>
            </div>
            <div class="border border-primary rounded" style="width: 150%">
                <table class="table table-sm table-hover bg-light" id="arr_operations">
                    <thead class="bg-primary text-light">
                    <tr class="row mx-0">
                        <th class="col-05 text-center">N°</th>
                        <th class="col-1" title="Identifiant">Id.</th>
                        <th class="col-2">Membre</th>
                        <th class="col">Localité</th>
                        <th class="col-1" title="Type Opération">Type Op.</th>
                        <th class="col-1 text-center">Montant</th>
                        <th class="col-1">Période</th>
                        <th class="col-1" title="Date Opération">Date Op.</th>
                        <th class="col-1">Date Saisie</th>
                        <th class="col">Observation</th>
                    </tr>
                    </thead>
                    <tbody id="liste_cotisations">

                    <?php
                        $operations = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 0;
                        $tot = 0;
                        foreach ($operations as $operation) {
                            $id_operation = $operation['id_operation'];
                            $id_typ_op = $operation['id_typ_op'];
                            $nom_membre = $operation['nom_membre'];
                            $pren_membre = $operation['pren_membre'];
                            $libelle_commune = $operation['libelle_commune'];
                            $libelle_ville = $operation['libelle_ville'];
                            $libelle_categorie = $operation['libelle_categorie'];
                            $libelle_typ_op = $operation['libelle_typ_op'];
                            $montant_operation = $operation['montant_operation'];
                            $libelle_mois = $operation['libelle_mois'];
                            $annee_operation = $operation['annee_operation'];
                            $date_operation = $operation['date_operation'];
                            $date_saisie_operation = $operation['date_saisie_operation'];
                            $obs_operation = $operation['obs_operation'];
                            ?>
                            <tr class="row mx-0">
                                <td class="text-center text-primary font-weight-light col-05">
                                    <?php echo ++$i; ?>
                                </td>
                                <td class="col-1 text-primary font-weight-bold text-truncate" title="Identifiant de l'opération">
                                    <?php echo $id_operation; ?>
                                </td>
                                <td class="col-2 text-uppercase" title="Membre">
                                    <?php echo $nom_membre . ' ' . $pren_membre; ?>
                                </td>
                                <td class="col text-uppercase text-truncate" title="Localité">
                                    <?php echo $libelle_commune . ', ' . $libelle_ville; ?>
                                </td>
                                <td class="col-1 text-uppercase text-truncate" title="Type de l'opération <?php echo $id_operation; ?>">
                                    <?php echo $libelle_typ_op; ?>
                                </td>
                                <td class="col-1 text-right font-weight-bolder text-success" title="Montant de l'opération <?php echo $id_operation; ?>">
                                    <?php echo number_format($montant_operation, 0, '', '.'); ?>
                                </td>
                                <td class="col-1 text-uppercase text-truncate" title="Période de l'opération <?php echo $id_operation; ?>">
                                    <?php echo $libelle_mois . ' ' . $annee_operation; ?>
                                </td>
                                <td class="col-1 text-uppercase" title="Date de l'opération <?php echo $id_operation; ?>">
                                    <?php echo date("d-m-Y", strtotime($date_operation)); ?>
                                </td>
                                <td class="col-1" title="Date de saisie de l'opération <?php echo $id_operation; ?>">
                                    <?php echo date("d-m-Y", strtotime($date_saisie_operation)); ?>
                                </td>
                                <td class="col text-truncate" title="Observation <?php echo $id_operation; ?>">
                                    <?php echo $obs_operation; ?>
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
        } else {
            echo "Not found";
        }

        $result->free();
        $connection->close();
    }

    if (isset($tot) && $tot != 0) {
        echo '<input type="hidden" id="total" value="' . number_format($tot, 0, "", ".") . '">';
    }
?>