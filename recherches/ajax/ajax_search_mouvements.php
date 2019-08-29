<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 29-Aug-19
     * Time: 11:52 AM
     */
    ?>
<div class="border border-primary rounded" style="width: 150%">
    <table class="table table-sm table-hover bg-light" id="arr_operations">
        <thead class="bg-primary text-light">
        <tr class="row mx-0">
            <th class="col-05" rowspan="2">N°</th>
            <th class="col-1" rowspan="2" title="Date Mouvement">Date</th>
            <th class="col-2" rowspan="2" title="Type du Mouvement">Type</th>
            <th class="col" rowspan="2">Montant</th>
            <th class="col-1" rowspan="2">Catégorie</th>
            <th class="col-1">Nom</th>
            <th class="col-1">Prénoms</th>
            <th class="col-1">Titre</th>
            <th class="col-1">Contact</th>
            <th class="col-1" rowspan="2">Membre</th>
            <th class="col" rowspan="2">Commentaire</th>
        </tr>
        </thead>
        <tbody id="liste_operations">

        <?php
            $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

            if (isset($_POST['info'])) {
                $sql = $_POST['info'];

                $result = mysqli_query($connection, $sql);
                if ($result->num_rows > 0) {
                    $mouvements = $result->fetch_all(MYSQLI_ASSOC);
                    $i = 0;
                    $tot = 0;
                    foreach ($mouvements as $mvt) {
                        $id_operation = $mvt['id_operation'];
                        $nom_membre = $mvt['nom_membre'];
                        $pren_membre = $mvt['pren_membre'];
                        $libelle_commune = $mvt['libelle_commune'];
                        $libelle_ville = $mvt['libelle_ville'];
                        $libelle_categorie = $mvt['libelle_categorie'];
                        $libelle_typ_op = $mvt['libelle_typ_op'];
                        $montant_operation = $mvt['montant_operation'];
                        $libelle_mois = $mvt['libelle_mois'];
                        $annee_operation = $mvt['annee_operation'];
                        $date_operation = $mvt['date_operation'];
                        $date_saisie_operation = $mvt['date_saisie_operation'];
                        $obs_operation = $mvt['obs_operation'];
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
