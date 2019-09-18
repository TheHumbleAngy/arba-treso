<?php
    /**
     * Created by PhpStorm.
     * User: angem
     * Date: 27-Aug-19
     * Time: 4:02 PM
     */

    if (sizeof($_POST)) {
        $sql = "SELECT DISTINCT o2.id_operation, c.id_typ_op, date_operation, obs_operation, nom_interlocuteur, pren_interlocuteur, montant_operation, obs_operation FROM interlocuteurs i INNER JOIN operations o2 on i.id_interlocuteur = o2.id_interlocuteur INNER JOIN categories c on o2.id_categorie = c.id_categorie INNER JOIN types_operation to2 on c.id_typ_op = to2.id_typ_op";
        if (isset($_POST['info']) && $_POST['info'] != '') {
            $date = $_POST['info'];
            $sql .= " WHERE date_operation = '{$date}'";
        }
        ?>

        <div class="border border-primary rounded">
            <table class="table table-sm table-hover bg-light" id="">
                <thead class="bg-primary text-light">
                <tr class="row mx-0">
                    <th class="col-05 text-center">N°</th>
                    <th class="col-2">Date</th>
                    <th class="col">Commentaire</th>
                    <th class="col-2 text-center">Montant</th>
                    <th class="col-2">Interlocuteur</th>
                </tr>
                </thead>
                <tbody id="liste_mouvements">
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');
                    $result = mysqli_query($connection, $sql);
                    if ($result->num_rows > 0) {
                        $mouvements = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 1;

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
                                <td class="col">
                                    <?php echo $obs_ope; ?>
                                </td>
                                <?php
                                    if ($type_ope) { ?>
                                <td class="col-2 text-center font-weight-bold text-success">
                                    <?php
                                        }
                                        else { ?>
                                <td class="col-2 text-center font-weight-bold text-danger">
                                    <?php
                                        }
                                        echo number_format($mtt, 0, "", ".");
                                    ?>
                                </td>
                                <td class="col-2">
                                    <?php echo $inter; ?>
                                </td>
                            </tr>
                            <?php
                        }

                        $result->free();
                        $connection->close();
                    }
                ?>

                </tbody>
            </table>
        </div>
        <?php
    }
?>