<?php
    /**
     * Created by PhpStorm.
     * User: NCARE
     * Date: 8/26/2019
     * Time: 10:19 PM
     */
    if (isset($_POST['info'])) : ?>
        <div class="border border-primary rounded">
            <table class="table table-sm table-hover bg-light" id="arr_membres">
                <thead class="bg-primary text-light">
                <tr class="row mx-0">
                    <th class="col-05 text-center">N°</th>
                    <th class="col">Membre</th>
                    <th class="col-3 ">Date d'Adhésion</th>
                    <th class="col-2 text-right">Montant</th>
                </tr>
                </thead>
                <tbody id="liste_membres">
                <?php
                    require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');
                    $info = $_POST['info'];
                    if ($info)
                        $sql_mbr = "SELECT * FROM membres m INNER JOIN operations o ON o.id_membre = m.id_membre WHERE id_categorie = 'CAT01' AND (nom_membre LIKE '%{$info}%' OR pren_membre LIKE '%{$info}%') ORDER BY nom_membre, pren_membre";
                    else
                        $sql_mbr = "SELECT * FROM membres m INNER JOIN operations o ON o.id_membre = m.id_membre WHERE id_categorie = 'CAT01' ORDER BY nom_membre, pren_membre";

                    $result = mysqli_query($connection, $sql_mbr);
                    if ($result->num_rows > 0) {
                        $membres = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 1;

                        foreach ($membres as $membre) {
                            $id_mbr = $membre['id_membre'];
                            $nom_pren_mbr = $membre['nom_membre'] . " " . $membre['pren_membre'];
                            $date_adhe = $membre['date_operation'];
                            $mtt = $membre['montant_operation'];
                            ?>
                            <tr class="row mx-0">
                                <td class="col-05 text-center font-weight-light text-primary">
                                    <?php echo $i++; ?>
                                </td>
                                <td class="col">
                                    <?php echo $nom_pren_mbr; ?>
                                </td>
                                <td class="col-3  font-weight-bold text-primary">
                                    <?php echo date("d-m-Y", strtotime($date_adhe)); ?>
                                </td>
                                <td class="col-2 text-right">
                                    <?php echo number_format($mtt, 0, "", "."); ?>
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
    <?php endif; ?>