<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-Aug-19
     * Time: 4:02 PM
     */

    if (sizeof($_POST)) {
        $sql = "
SELECT *
    FROM operations o
        INNER JOIN categories c on o.id_categorie = c.id_categorie
        INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op
        INNER JOIN interlocuteurs i on o.id_interlocuteur = i.id_interlocuteur
        ";
        if (isset($_POST['info']) && $_POST['info'] != '') {
            $date = $_POST['info'];
            $sql .= " WHERE date_operation = '{$date}'";
        }
        $sql .= " ORDER BY date_operation";
        ?>

        <div id="added_div" class="row justify-content-end my-4 mx-0 container-fluid">
            <form class="form-inline">
                <label for="montant_total" class="mr-2 font-weight-bolder">Montant Total</label>
                <input type="text" id="montant_total"
                        class="form-control form-control-sm text-right font-weight-bold text-primary">
            </form>
        </div>
        <div class="border border-primary rounded">
            <table class="table table-sm table-hover bg-light" id="">
                <thead class="bg-primary text-light">
                <tr class="row mx-0">
                    <th class="col-05 text-center">N°</th>
                    <th class="col-2">Date</th>
                    <th class="col">Commentaire</th>
                    <th class="col-2">Interlocuteur</th>
                    <th class="col-2 col-lg-1 text-center">Montant</th>
                </tr>
                </thead>
                <tbody id="liste_mouvements">
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');
                    $result = mysqli_query($connection, $sql);
                    if ($result->num_rows > 0) {
                        $mouvements = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        $total = 0;

                        foreach ($mouvements as $mouvement) {
                            $id_ope = $mouvement['id_operation'];
                            $type_ope = $mouvement['id_typ_op'];
                            $date_ope = $mouvement['date_operation'];
                            $obs_ope = $mouvement['obs_operation'];
                            $mtt = $mouvement['montant_operation'];
                            $inter = $mouvement['nom_interlocuteur'] . " " . $mouvement['pren_interlocuteur'];
                            ?>
                            <tr class="row mx-0">
                                <td class="col-05 text-center text-primary font-weight-light">
                                    <?php echo $i++; ?>
                                </td>
                                <td class="col-2">
                                    <?php echo date("d-m-Y", strtotime($date_ope)); ?>
                                </td>
                                <td class="col text-truncate">
                                    <?php echo $obs_ope; ?>
                                </td>
                                <td class="col-2 text-truncate">
                                    <?php echo $inter; ?>
                                </td>
                                <?php
                                    if ($type_ope) { ?>
                                <td class="col-2 col-lg-1 text-right font-weight-bold text-success">
                                    <?php
                                        $total += $mtt;
                                        }
                                        else { ?>
                                <td class="col-2 col-lg-1 text-right font-weight-bold text-danger">
                                    <?php
                                        $total -= $mtt;
                                        }
                                        echo number_format($mtt, 0, "", ".");
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }

                        $result->free();
                        $connection->close();
                    }
                ?>
                <input type="hidden" id="total" value="<?php echo number_format($total, 0, "", ".");?>">
                </tbody>
            </table>
        </div>
        <?php
    }
?>