<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 06-Jul-19
     * Time: 9:54 AM
     */
?>
<div class="border border-primary rounded" style="width: 150%">
    <table class="table table-sm table-hover bg-light" id="arr_operations">
        <thead class="bg-primary text-light">
        <tr class="row mx-0">
            <th class="col-05">N°</th>
            <th class="col-1" title="Identifiant">Id.</th>
            <th class="col-2">Membre</th>
            <th class="col">Localité</th>
            <th class="col-1" title="Type Opération">Type Op.</th>
            <th class="col-1">Catégorie</th>
            <th class="col-1">Montant</th>
            <th class="col-1">Période</th>
            <th class="col-1" title="Date Opération">Date Op.</th>
            <th class="col-1">Date Saisie</th>
            <th class="col">Observation</th>
        </tr>
        </thead>
        <tbody id="liste_operations">

        <?php
            $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

            if (isset($_POST['info'])) {
                $sql = $_POST['info'];

                $result = mysqli_query($connection, $sql);
                if ($result->num_rows > 0) {
                    $operations = $result->fetch_all(MYSQLI_ASSOC);
                    $i = 0;
                    $tot = 0;
                    foreach ($operations as $operation) {
                        $id_operation = $operation['id_operation'];
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
                            <td class="col-05 text-primary">
                                <span class="text-uppercase">
                                    <?php echo ++$i; ?>
                                </span>
                            </td>
                            <td class="col-1 text-primary font-weight-bold">
                                <span class="text-uppercase" title="Identifiant de l'opération">
                                    <?php echo $id_operation; ?>
                                </span>
                            </td>
                            <td class="col-2">
                                <span class="text-uppercase" title="Membre">
                                    <?php echo $nom_membre . ' ' . $pren_membre; ?>
                                </span>
                            </td>
                            <td class="col">
                                <span class="text-uppercase" title="Localité">
                                    <?php echo $libelle_commune . ', ' . $libelle_ville; ?>
                                </span>
                            </td>
                            <td class="col-1">
                                <span class="text-uppercase" title="Type de l'opération <?php echo $id_operation; ?>">
                                    <?php echo $libelle_typ_op; ?>
                                </span>
                            </td>
                            <td class="col-1">
                                <span class="text-uppercase" title="Catégorie de l'opération <?php echo $id_operation; ?>">
                                    <?php echo $libelle_categorie; ?>
                                </span>
                            </td>
                            <td class="col-1">
                                <span class="text-uppercase mtt" title="Montant de l'opération <?php echo $id_operation; ?>">
                                    <?php echo number_format($montant_operation, 0, '', '.'); ?>
                                </span>
                            </td>
                            <td class="col-1">
                                <span class="text-uppercase" title="Période de l'opération <?php echo $id_operation; ?>">
                                    <?php echo $libelle_mois . ' ' . $annee_operation; ?>
                                </span>
                            </td>
                            <td class="col-1">
                                <span class="text-uppercase" title="Date de l'opération <?php echo $id_operation; ?>">
                                    <?php echo $date_operation; ?>
                                </span>
                            </td>
                            <td class="col-1">
                                <span class="text-uppercase" title="Date de saisie de l'opération <?php echo $id_operation; ?>">
                                    <?php echo $date_saisie_operation; ?>
                                </span>
                            </td>
                            <td class="col">
                                <span class="text-uppercase" title="Observation <?php echo $id_operation; ?>">
                                    <?php echo $obs_operation; ?>
                                </span>
                            </td>
                        </tr>
                        <?php
                        $tot += $montant_operation;
                    }
                }

                $result->free();
                $connection->close();
            }
        ?>
        </tbody>
    </table>
    <?php
        if (isset($tot)) {
            echo '<input type="hidden" id="total" value="' . $tot . '">';
        }
    ?>
</div>