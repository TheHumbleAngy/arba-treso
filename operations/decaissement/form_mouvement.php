<?php
    /**
     * Created by PhpStorm.
     * User: NCARE
     * Date: 8/15/2019
     * Time: 9:27 PM
     */
    if (isset($_GET['cat'])) {
        $id_categorie = $_GET['cat'];
        $sql = "SELECT c.id_typ_op, libelle_typ_op, libelle_categorie FROM categories c INNER JOIN types_operation to2 on c.id_typ_op = to2.id_typ_op WHERE id_categorie = '{$id_categorie}'";

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');
        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $set = $result->fetch_all(MYSQLI_ASSOC);

            $id_typ = $set[0]['id_typ_op'];
            $lib_typ = $set[0]['libelle_typ_op'];
            $lib_cat = $set[0]['libelle_categorie'];
            mysqli_free_result($result);
            ?>

            <input type="hidden" id="head_title" value="mouvements ♻️">
            <input type="hidden" id="cate" value="<?php echo $id_categorie; ?>">
            <div class="row">
                <div class="col-auto mx-auto">
                    <div id="wrapper_param" class="shadow gradient mt-5">
                        <div id="param_title" class="mb-md-4">
                            <h2 class="my-2">
                                <?php
                                    if ($id_typ == 1)
                                        echo "Fiche d'Encaissement pour <span class='badge badge-primary'>" . $lib_cat . "</span>";
                                    else
                                        echo "Fiche de Décaissement pour <span class='badge badge-primary'>" . $lib_cat . "</span>";
                                ?>
                            </h2>
                        </div>
                        <div class="row my-3 mx-0">
                            <form class="col">
                                <div class="row my-3 col col-lg-10">
                                    <div class="col-5 col-xl-6">
                                        <label for="date_ope">Date</label>
                                    </div>
                                    <div class="col-auto col-xl-6">
                                        <input type="date" class="form-control form-control-sm" id="date_ope">
                                    </div>
                                </div>
                                <div class="row my-3 col col-lg-10">
                                    <div class="col-5 col-xl-6">
                                        <label for="mtt_decaisse" class="font-weight-bold">
                                            <?php
                                                if ($id_typ == 1)
                                                    echo "Montant encaissé";
                                                else
                                                    echo "Montant décaissé";
                                            ?>
                                        </label>
                                    </div>
                                    <div class="col col-xl-auto">
                                        <input type="text" class="form-control form-control-sm text-right"
                                               id="mtt"
                                               placeholder="0">
                                    </div>
                                </div>
                                <div class="row my-4 col">
                                    <div class="col">
                                        <h5 class="cadre-titre-search font-weight-bolder">
                                            <?php
                                                if ($id_typ == 1)
                                                    echo "Le Donateur...";
                                                else
                                                    echo "Le Destinataire...";
                                            ?>
                                        </h5>
                                        <div class="form-group">
                                            <label for="nom_itl" class="">Nom</label>
                                            <input type="text" class="form-control form-control-sm text-uppercase"
                                                   id="nom_itl"
                                                   placeholder="Nom">
                                        </div>
                                        <div class="form-group">
                                            <label for="pren_itl" class="">Prénoms</label>
                                            <input type="text" class="form-control form-control-sm text-uppercase"
                                                   id="pren_itl"
                                                   placeholder="Prenoms">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col">
                                                <label for="titre_itl" class="">Titre</label>
                                                <input type="text" class="form-control form-control-sm text-uppercase"
                                                       id="titre_itl"
                                                       placeholder="Titre">
                                            </div>
                                            <div class="form-group col">
                                                <label for="tel_itl" class="">Contact</label>
                                                <input type="text" class="form-control form-control-sm text-uppercase"
                                                       id="tel_itl"
                                                       placeholder="Contact">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="commune" class="">Commune</label>
                                            <input type="text" class="form-control form-control-sm text-uppercase"
                                                   id="commune"
                                                   placeholder="Commune">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4 col">
                                    <div class="col">
                                        <h5 class="cadre-titre-search font-weight-bolder">L'Intermédiaire...</h5>
                                        <div class="row">
                                            <div class="form-group col-auto col-lg">
                                                <label for="mbr_inter" class="">Membre</label>
                                                <input type="text" class="form-control form-control-sm text-uppercase"
                                                       id="mbr_inter"
                                                       placeholder="Membre">

                                            </div>
                                            <div class="form-group col-auto col-lg">
                                                <label for="commentaires" class="">Commentaires</label>
                                                <textarea id="commentaires" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <button class="btn btn-sm btn-primary faa-parent animated-hover col-auto px-4 mx-auto font-weight-bolder"
                                    id="enregistrer" onclick="saveDecaissement()">
                                <i class="fas fa-save mr-2 faa-pulse"></i>
                                Enregistrer
                            </button>

                            <!-- Modals -->
                            <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                                 aria-labelledby="successModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="successModalLabel">ARBA ✔️</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <blockquote class="blockquote">
                                                <p class="mb-0">Le décaissement a bien été enregistré 👍</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="errorModal" tabindex="-1" role="dialog"
                                 aria-labelledby="errorYearModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="errorYearModalLabel">ARBA 🚫</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <blockquote class="blockquote">
                                                <p class="mb-0"></p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
?>