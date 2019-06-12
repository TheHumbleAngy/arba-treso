<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 24-May-19
     * Time: 9:55 AM
     */
?>

<table class="table table-sm table-hover tab_consultation bg-light" id="tab_coti_gnl">
    <thead class="bg-primary text-light">
    <tr>
        <th class="col-1 text-center">N°</th>
        <th class="col-4">Membre</th>
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
    <tbody>

    <?php
        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');

        if (isset($_POST['param'])) {
            $param = $_POST['param'];

            $sql_mbr = "SELECT * FROM membres WHERE nom_membre LIKE '%" . $param . "%' OR pren_membre LIKE '%" . $param . "%'";

            $resultat = mysqli_query($connection, $sql_mbr);
            if ($resultat->num_rows > 0) {
                $membres = $resultat->fetch_all(MYSQLI_ASSOC);
                $i = 1;
                foreach ($membres as $membre) {
                    $id_mbr = $membre['id_membre'];
                    $nom_mbr = $membre['nom_membre'];
                    $pren_mbr = $membre['pren_membre'];

                    // $an = date('Y');
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

                            /* Debut liste cotisations */
                            for ($j = 1; $j <= 12; $j++) {

                                $mois = ($j < 10) ? "M0" . $j : "M". $j;

                                $sql_cotisations = "SELECT * FROM operations WHERE id_membre = '" . $id_mbr . "' AND  annee_cotisation = '" . $an ."' AND  id_mois = '" . $mois ."'";
                                $res = mysqli_query($connection, $sql_cotisations);
                                $n = $res->num_rows;
                                if ($res->num_rows > 0) {
                                    $cotisations = $res->fetch_all(MYSQLI_ASSOC);
                                    foreach ($cotisations as $cotisation) {
                                        ?>
                                        <td class="text-center">
                                            <span >
                                                <?php
                                                    echo number_format($cotisation['montant_cotisation'], 0, ',', '.');
                                                    $total += $cotisation['montant_cotisation'];
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
        }
        else {
        $sql_mbr = "SELECT * FROM membres";

        $resultat = mysqli_query($connection, $sql_mbr);
            if ($resultat->num_rows > 0) {
                $membres = $resultat->fetch_all(MYSQLI_ASSOC);
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

                                $mois = ($j < 10) ? "M0" . $j : "M". $j;

                                $sql_cotisations = "SELECT * FROM operations WHERE id_membre = '" . $id_mbr . "' AND  annee_cotisation = '" . $an ."' AND  id_mois = '" . $mois ."'";
                                $res = mysqli_query($connection, $sql_cotisations);
                                $n = $res->num_rows;
                                if ($res->num_rows > 0) {
                                    $cotisations = $res->fetch_all(MYSQLI_ASSOC);
                                    foreach ($cotisations as $cotisation) {
                                        ?>
                                        <td class="text-center">
                                        <span>
                                            <?php
                                                echo number_format($cotisation['montant_cotisation'], 0, ',', '.');
                                                $total += $cotisation['montant_cotisation'];
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
        }
    ?>
    </tbody>
</table>
