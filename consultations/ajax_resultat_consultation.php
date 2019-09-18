<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 24-May-19
     * Time: 9:55 AM
     */
?>

<div class="border border-primary rounded">
    <table class="table table-sm table-hover arr_consultation bg-light rounded position-sticky" id="arr_coti_gnl">
        <thead class="bg-primary text-light">
        <tr>
            <th class="text-center">N°</th>
            <th class="">Membre</th>
            <th class="mx-lg-1 text-center">Jan.</th>
            <th class="mx-lg-1 text-center">Fev.</th>
            <th class="mx-lg-1 text-center">Mars</th>
            <th class="mx-lg-1 text-center">Avr.</th>
            <th class="mx-lg-1 text-center">Mai</th>
            <th class="mx-lg-1 text-center">Juin</th>
            <th class="mx-lg-1 text-center">Juil.</th>
            <th class="mx-lg-1 text-center">Août</th>
            <th class="mx-lg-1 text-center">Sep.</th>
            <th class="mx-lg-1 text-center">Oct.</th>
            <th class="mx-lg-1 text-center">Nov.</th>
            <th class="mx-lg-1 text-center">Dec.</th>
            <th class="mx-lg-1 text-center">Tot.</th>
        </tr>
        </thead>
        <tbody id="liste_cotisations">

        <?php
            require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');

            if (isset($_POST['param'])) {
                $param = $_POST['param'];

                $sql_mbr = "SELECT * FROM membres WHERE nom_membre LIKE '%{$param}%' OR pren_membre LIKE '%{$param}%'";

                $result = mysqli_query($connection, $sql_mbr);
                if ($result->num_rows > 0) {
                    $membres = $result->fetch_all(MYSQLI_ASSOC);
                    $i = 1;
                    foreach ($membres as $membre) {
                        $id_mbr = $membre['id_membre'];
                        $nom_mbr = $membre['nom_membre'];
                        $pren_mbr = $membre['pren_membre'];

                        $an = $_POST['year'];
                        $total = 0;
                        ?>
                        <tr>
                            <td class="text-center text-primary font-weight-light">
                            <span class="" id="numero">
                                <?php echo $i++; ?>
                            </span>
                            </td>
                            <td class="">
                            <span class="text-uppercase text-primary">
                                <?php echo $nom_mbr . " " . $pren_mbr; ?>
                            </span>
                            </td>

                            <?php

                                /* Debut liste cotisations */
                                for ($j = 1; $j <= 12; $j++) {

                                    $id_mois = ($j < 10) ? "M0" . $j : "M". $j;

                                    $sql_cotisations = "SELECT * FROM operations WHERE id_membre = '{$id_mbr}' AND annee_operation = '{$an}' AND id_mois = '{$id_mois}' AND id_categorie = 'CAT02'";
                                    $res = mysqli_query($connection, $sql_cotisations);
                                    $n = $res->num_rows;
                                    if ($res->num_rows > 0) {
                                        $cotisations = $res->fetch_all(MYSQLI_ASSOC);
                                        foreach ($cotisations as $cotisation) {
                                            ?>
                                            <td class="text-center">
                                            <span >
                                                <?php
                                                    echo number_format($cotisation['montant_operation'], 0, ',', '.');
                                                    $total += $cotisation['montant_operation'];
                                                ?>
                                            </span>
                                            </td>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <td></td>
                                        <?php
                                    }
                                }
                                /* Fin liste cotisations */
                            ?>

                            <td class="text-right text-primary font-weight-bold">
                            <span class="">
                                <?php echo number_format($total, 0, ',', '.'); ?>
                            </span>
                            </td>
                        </tr>
                        <?php
                    }
                }

                $result->free();
                $connection->close();
            }
            else {
                $sql_mbr = "SELECT * FROM membres";

                $result = mysqli_query($connection, $sql_mbr);
                if ($result->num_rows > 0) {
                    $membres = $result->fetch_all(MYSQLI_ASSOC);
                    $i = 1;
                    foreach ($membres as $membre) {
                        $id_mbr = $membre['id_membre'];
                        $nom_mbr = $membre['nom_membre'];
                        $pren_mbr = $membre['pren_membre'];

                        $an = $_POST['year'];
                        $total = 0;
                        ?>
                        <tr>
                            <td class="text-center text-primary font-weight-light">
                            <span class="" id="numero">
                                <?php echo $i++; ?>
                            </span>
                            </td>
                            <td class="">
                            <span class="text-uppercase">
                                <?php echo $nom_mbr . " " . $pren_mbr; ?>
                            </span>
                            </td>

                            <?php

                                /* Debut liste cotisations annuelles */
                                for ($j = 1; $j <= 12; $j++) {

                                    $id_mois = ($j < 10) ? "M0" . $j : "M". $j;

                                    $sql_cotisations = "SELECT * FROM operations WHERE id_membre = '{$id_mbr}' AND annee_operation = '{$an}' AND id_mois = '{$id_mois}' AND id_categorie = 'CAT02'";
                                    $res = mysqli_query($connection, $sql_cotisations);
                                    $n = $res->num_rows;
                                    if ($res->num_rows > 0) {
                                        $cotisations = $res->fetch_all(MYSQLI_ASSOC);
                                        foreach ($cotisations as $cotisation) {
                                            ?>
                                            <td class="text-center">
                                        <span>
                                            <?php
                                                echo number_format($cotisation['montant_operation'], 0, ',', '.');
                                                $total += $cotisation['montant_operation'];
                                            ?>
                                        </span>
                                            </td>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <td></td>
                                        <?php
                                    }
                                }
                                /* Fin liste cotisations annuelles */
                            ?>
                            <td class="text-right text-primary font-weight-bold">
                            <span class="">
                                <?php echo number_format($total, 0, ',', '.'); ?>
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