<?php if (isset($_POST['entity']) && ($_POST['info'] != "empty")): ?>
    <div class="border border-primary rounded">
        <table class="table table-sm table-hover bg-light" id="arr_membres">
            <thead class="bg-primary text-light">
            <tr class="row mx-0">
                <th class="col-05 text-center">N°</th>
                <th class="col-1 text-center" title="Identifiant">Id.</th>
                <th class="col">Membre</th>
                <th class="col-1">Genre</th>
                <th class="col-2 col-xl-1">Contact</th>
                <th class="col-2 col-xl-1">Commune</th>
                <th class="col-1 col-xl-1">Ville</th>
                <th class="col-1 text-center">Actions</th>
            </tr>
            </thead>
            <tbody id="liste_membres">
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');
                $entity = $_POST['entity'];
                $info = $_POST['info'];

                if ($entity == 'membres') {
                    $sql_mbr = "SELECT id_membre, nom_membre, pren_membre, genre_membre, contact_membre, libelle_commune, libelle_ville FROM membres m INNER JOIN villes v on m.id_ville = v.id_ville INNER JOIN communes c on m.id_commune = c.id_commune WHERE (nom_membre LIKE '%{$info}%' OR pren_membre LIKE '%{$info}%') GROUP BY id_membre ORDER BY nom_membre, pren_membre ";

                    $result = mysqli_query($connection, $sql_mbr);
                    if ($result->num_rows > 0) {
                        $membres = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 1;

                        foreach ($membres as $membre) {
                            $id_mbr = $membre['id_membre'];
                            $nom_mbr = $membre['nom_membre'];
                            $pren_mbr = $membre['pren_membre'];
                            $genre_membre = $membre['genre_membre'];
                            $contact_membre = $membre['contact_membre'];
                            $libelle_commune = $membre['libelle_commune'];
                            $libelle_ville = $membre['libelle_ville'];
                            ?>

                            <tr class="row mx-0">
                                <td class="col-05 text-center text-primary font-weight-light">
                                    <?php echo $i++; ?>
                                </td>
                                <td class="col-1 text-right text-primary">
                                    <?php echo $id_mbr; ?>
                                </td>
                                <td class="col text-primary font-weight-bold text-truncate">
                                    <?php echo $nom_mbr . " " . $pren_mbr; ?>
                                </td>
                                <td class="col-1 text-truncate">
                                    <?php
                                        if ($genre_membre == "H") {
                                            echo "HOMME";
                                        } else {
                                            echo "FEMME";
                                        }
                                    ?>
                                </td>
                                <td class="col-2 col-xl-1">
                                    <?php echo $contact_membre; ?>
                                </td>
                                <td class="col-2 col-xl-1 text-truncate">
                                    <?php echo $libelle_commune; ?>
                                </td>
                                <td class="col-1 col-xl-1 text-truncate">
                                    <?php echo $libelle_ville; ?>
                                </td>
                                <td class="col-1 text-center">
                                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                            title="Modifier" data-target="#updateModal<?php echo $id_mbr; ?>">
                                        <i class="fa fa-user-edit"></i>
                                    </button>

                                    <div class="modal fade text-left" id="updateModal<?php echo $id_mbr; ?>"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="updateModalLabel<?php echo $id_mbr; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="updateModalLabel">ARBA - MEMBRE <span
                                                                class="badge badge-primary"><?php echo $id_mbr; ?></span>
                                                        <i class="fa fa-user-edit text-primary"></i></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        /*$sql_fct = "SELECT * FROM fonctions";
                                                        $sql_com = "SELECT * FROM communes";
                                                        $res_fct = mysqli_query($connection, $sql_fct);
                                                        $res_com = mysqli_query($connection, $sql_com);*/
                                                    ?>

                                                    <blockquote class="blockquote">
                                                        <form>
                                                            <div class="row mx-0">
                                                                <div class="form-group col col-lg-4">
                                                                    <label for="fct_mbr<?php echo $id_mbr; ?>" class="">Fonction</label>
                                                                    <select class="custom-select custom-select-sm text-uppercase"
                                                                            id="fct_mbr<?php echo $id_mbr; ?>">
                                                                        <option selected>-</option>
                                                                        <?php
//                                                                            while ($row = mysqli_fetch_row($res_fct)) {
//                                                                                $j = 0;
//                                                                                do { ?>
<!--                                                                                    <option value="--><?php //echo $row['id_fonction']; ?><!--">-->
<!--                                                                                        --><?php //echo $row['libelle_fonction'];
//                                                                                            $j++; ?>
<!--                                                                                    </option>-->
<!--                                                                                    --><?php
//                                                                                } while ($j < sizeof($row));
//                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mx-0">
                                                                <div class="form-group col col-lg-4">
                                                                    <label for="nom_mbr<?php echo $id_mbr; ?>" class="">Nom*</label>
                                                                    <input type="text"
                                                                           class="form-control form-control-sm text-uppercase"
                                                                           id="nom_mbr<?php echo $id_mbr; ?>"
                                                                           value="<?php echo $nom_mbr; ?>"
                                                                           placeholder="Nom">
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="pren_mbr<?php echo $id_mbr; ?>"
                                                                           class="">Prénoms</label>
                                                                    <input type="text"
                                                                           class="form-control form-control-sm text-uppercase"
                                                                           id="pren_mbr<?php echo $id_mbr; ?>"
                                                                           value="<?php echo $pren_mbr; ?>"
                                                                           placeholder="Prenoms">
                                                                </div>
                                                            </div>
                                                            <div class="row mx-0">
                                                                <div class="form-group col-auto">
                                                                    <label for="genre<?php echo $id_mbr; ?>" class="">Genre</label>
                                                                    <select class="custom-select custom-select-sm text-uppercase"
                                                                            id="genre<?php echo $id_mbr; ?>">
                                                                        <option selected>-</option>
                                                                        <option value="0">Femme</option>
                                                                        <option value="1">Homme</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-auto">
                                                                    <label for="contact<?php echo $id_mbr; ?>" class="">Contact</label>
                                                                    <input type="text"
                                                                           class="form-control form-control-sm text-uppercase"
                                                                           id="contact<?php echo $id_mbr; ?>"
                                                                           value="<?php echo $contact_membre; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row mx-0">
                                                                <div class="form-group col-auto">
                                                                    <label for="commune<?php echo $id_mbr; ?>" class="">Commune</label>
                                                                    <select class="custom-select custom-select-sm text-uppercase"
                                                                            id="commune<?php echo $id_mbr; ?>">
                                                                        <option selected>-</option>
                                                                        <?php
                                                                            /*while ($row = mysqli_fetch_row($res_com)) {
                                                                                $j = 0;
                                                                                do { */?><!--
                                                                                    <option value="<?php /*echo $row['id_commune']; */?>">
                                                                                        <?php /*echo $row['libelle_commune'];
                                                                                            $j++; */?>
                                                                                    </option>
                                                                                    --><?php
/*                                                                                } while ($j < sizeof($row));
                                                                            }*/
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-auto">
                                                                    <label for="ville<?php echo $id_mbr; ?>" class="">Ville</label>
                                                                    <select class="custom-select custom-select-sm text-uppercase"
                                                                            id="ville<?php echo $id_mbr; ?>">
                                                                        <option selected>-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </blockquote>
                                                </div>
                                                <div class="modal-footer">
                                                    <div id="alert_msg" class="mr-auto"></div>
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary faa-parent animated-hover col-auto px-4 font-weight-bolder"
                                                            id="btn_save"
                                                            onclick="">
                                                        <i class="fa fa-save mr-2 faa-pulse"></i>
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<?php elseif (isset($_POST['entity']) && ($_POST['info'] == "empty")): ?>
    <div class="border border-primary rounded">
        <table class="table table-sm table-hover bg-light" id="arr_membres">
            <thead class="bg-primary text-light">
            <tr class="row mx-0">
                <th class="col-05 text-center">N°</th>
                <th class="col-1 text-center" title="Identifiant">Id.</th>
                <th class="col">Membre</th>
                <th class="col-1">Genre</th>
                <th class="col-2 col-xl-1">Contact</th>
                <th class="col-2 col-xl-1">Commune</th>
                <th class="col-1 col-xl-1">Ville</th>
                <th class="col-1 text-center">Actions</th>
            </tr>
            </thead>
            <tbody id="liste_membres">
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');
                $entity = $_POST['entity'];

                if ($entity == 'membres') {
                    $sql_mbr = "SELECT id_membre, nom_membre, pren_membre, genre_membre, contact_membre, libelle_commune, libelle_ville FROM membres m INNER JOIN villes v on m.id_ville = v.id_ville INNER JOIN communes c on m.id_commune = c.id_commune GROUP BY id_membre ORDER BY nom_membre, pren_membre ";

                    $result = mysqli_query($connection, $sql_mbr);
                    if ($result->num_rows > 0) {
                        $membres = $result->fetch_all(MYSQLI_ASSOC);
                        $i = 1;

                        foreach ($membres as $membre) {
                            $id_mbr = $membre['id_membre'];
                            $nom_mbr = $membre['nom_membre'];
                            $pren_mbr = $membre['pren_membre'];
                            $genre_membre = $membre['genre_membre'];
                            $contact_membre = $membre['contact_membre'];
                            $libelle_commune = $membre['libelle_commune'];
                            $libelle_ville = $membre['libelle_ville'];
                            ?>

                            <tr class="row mx-0">
                                <td class="col-05 text-center text-primary font-weight-light">
                                    <?php echo $i++; ?>
                                </td>
                                <td class="col-1 text-right text-primary">
                                    <?php echo $id_mbr; ?>
                                </td>
                                <td class="col text-primary font-weight-bold text-truncate">
                                    <?php echo $nom_mbr . " " . $pren_mbr; ?>
                                </td>
                                <td class="col-1 text-truncate">
                                    <?php
                                        if ($genre_membre == "H") {
                                            echo "HOMME";
                                        } else {
                                            echo "FEMME";
                                        }
                                    ?>
                                </td>
                                <td class="col-2 col-xl-1">
                                    <?php echo $contact_membre; ?>
                                </td>
                                <td class="col-2 col-xl-1 text-truncate">
                                    <?php echo $libelle_commune; ?>
                                </td>
                                <td class="col-1 col-xl-1 text-truncate">
                                    <?php echo $libelle_ville; ?>
                                </td>
                                <td class="col-1 text-center">
                                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                            title="Modifier" data-target="#updateModal<?php echo $id_mbr; ?>">
                                        <i class="fa fa-user-edit"></i>
                                    </button>

                                    <div class="modal fade text-left" id="updateModal<?php echo $id_mbr; ?>"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="updateModalLabel<?php echo $id_mbr; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="updateModalLabel">ARBA - MEMBRE <span
                                                                class="badge badge-primary"><?php echo $id_mbr; ?></span>
                                                        <i class="fa fa-user-edit text-primary"></i></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        /*$sql_fct = "SELECT * FROM fonctions";
                                                        $sql_com = "SELECT * FROM communes";
                                                        $res_fct = mysqli_query($connection, $sql_fct);
                                                        $res_com = mysqli_query($connection, $sql_com);*/
                                                    ?>

                                                    <blockquote class="blockquote">
                                                        <form>
                                                            <div class="row mx-0">
                                                                <div class="form-group col col-lg-4">
                                                                    <label for="fct_mbr<?php echo $id_mbr; ?>" class="">Fonction</label>
                                                                    <select class="custom-select custom-select-sm text-uppercase"
                                                                            id="fct_mbr<?php echo $id_mbr; ?>">
                                                                        <option selected>-</option>
                                                                        <?php
                                                                            /*$functions = $res_fct->fetch_all(MYSQLI_ASSOC);
                                                                            while ($row = mysqli_fetch_row($res_fct)) {
                                                                                $j = 0;
                                                                                do { */?><!--
                                                                                    <option value="<?php /*echo $row['id_fonction']; */?>">
                                                                                        <?php /*echo $row['libelle_fonction'];
                                                                                            $j++; */?>
                                                                                    </option>
                                                                                    --><?php
/*                                                                                } while ($j < sizeof($row));
                                                                            }*/
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mx-0">
                                                                <div class="form-group col col-lg-4">
                                                                    <label for="nom_mbr<?php echo $id_mbr; ?>" class="">Nom*</label>
                                                                    <input type="text"
                                                                           class="form-control form-control-sm text-uppercase"
                                                                           id="nom_mbr<?php echo $id_mbr; ?>"
                                                                           value="<?php echo $nom_mbr; ?>"
                                                                           placeholder="Nom">
                                                                </div>
                                                                <div class="form-group col">
                                                                    <label for="pren_mbr<?php echo $id_mbr; ?>"
                                                                           class="">Prénoms</label>
                                                                    <input type="text"
                                                                           class="form-control form-control-sm text-uppercase"
                                                                           id="pren_mbr<?php echo $id_mbr; ?>"
                                                                           value="<?php echo $pren_mbr; ?>"
                                                                           placeholder="Prenoms">
                                                                </div>
                                                            </div>
                                                            <div class="row mx-0">
                                                                <div class="form-group col-auto">
                                                                    <label for="genre<?php echo $id_mbr; ?>" class="">Genre</label>
                                                                    <select class="custom-select custom-select-sm text-uppercase"
                                                                            id="genre<?php echo $id_mbr; ?>">
                                                                        <option selected>-</option>
                                                                        <option value="0">Femme</option>
                                                                        <option value="1">Homme</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-auto">
                                                                    <label for="contact<?php echo $id_mbr; ?>" class="">Contact</label>
                                                                    <input type="text"
                                                                           class="form-control form-control-sm text-uppercase"
                                                                           id="contact<?php echo $id_mbr; ?>"
                                                                           value="<?php echo $contact_membre; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row mx-0">
                                                                <div class="form-group col-auto">
                                                                    <label for="commune<?php echo $id_mbr; ?>" class="">Commune</label>
                                                                    <select class="custom-select custom-select-sm text-uppercase"
                                                                            id="commune<?php echo $id_mbr; ?>">
                                                                        <option selected>-</option>
                                                                        <?php
                                                                            /*while ($row = mysqli_fetch_row($res_com)) {
                                                                                $j = 0;
                                                                                do { */?><!--
                                                                                    <option value="<?php /*echo $row['id_commune']; */?>">
                                                                                        <?php /*echo $row['libelle_commune'];
                                                                                            $j++; */?>
                                                                                    </option>
                                                                                    --><?php
/*                                                                                } while ($j < sizeof($row));
                                                                            }*/
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-auto">
                                                                    <label for="ville<?php echo $id_mbr; ?>" class="">Ville</label>
                                                                    <select class="custom-select custom-select-sm text-uppercase"
                                                                            id="ville<?php echo $id_mbr; ?>">
                                                                        <option selected>-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </blockquote>
                                                </div>
                                                <div class="modal-footer">
                                                    <div id="alert_msg" class="mr-auto"></div>
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary faa-parent animated-hover col-auto px-4 font-weight-bolder"
                                                            id="btn_save"
                                                            onclick="">
                                                        <i class="fa fa-save mr-2 faa-pulse"></i>
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<?php endif; ?>