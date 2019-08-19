<?php
    /**
     * Created by PhpStorm.
     * User: NCARE
     * Date: 8/15/2019
     * Time: 9:27 PM
     */

    if (isset($_GET['cat'])) {
        $id_categorie = $_GET['cat'];
        $sql = "SELECT libelle_categorie FROM categories WHERE id_categorie = '{$id_categorie}'";

        $connection = mysqli_connect('localhost', 'root', '', 'gestion_treso_arba');
        $result = mysqli_query($connection, $sql);
        if ($result->num_rows > 0) {
            $set = $result->fetch_all(MYSQLI_ASSOC);

            $libelle = $set[0]['libelle_categorie'];
            mysqli_free_result($result);
            ?>

            <input type="hidden" id="head_title" value="décaissement">
            <input type="hidden" id="cate" value="<?php echo $id_categorie; ?>">
            <div class="row">
                <div class="col-auto mx-auto">
                    <div id="wrapper_param" class="shadow gradient mt-5">
                        <div id="param_title" class="mb-md-4">
                            <h2 class="">Fiche de Décaissement <span class="badge badge-primary"><?php echo $libelle ?></span></h2>
                        </div>
                        <div class="row my-3 mx-0">
                            <form>
                                <div class="row my-3">
                                    <div class="col-sm-5 col-md-4 ">
                                        <label for="date_ope">Date</label>
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control form-control-sm" id="date_ope">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-sm-5 col-md-4 ">
                                        <label for="mbr_destinataire">Destinataire</label>
                                    </div>
                                    <div class="col">
                                        <select id="mbr_destinataire"
                                                class="custom-select custom-select-sm">
                                            <option value="">Sélectionner...</option>

                                            <?php
                                                $sql = "SELECT id_membre, nom_membre, pren_membre FROM membres ORDER BY nom_membre";
                                                $result = mysqli_query($connection, $sql);
                                                if ($result->num_rows) {
                                                    $set = $result->fetch_all(MYSQLI_ASSOC);

                                                    foreach ($set as $membre) {
                                                        ?>

                                                        <option value="<?php echo $membre['id_membre']; ?>">
                                                            <?php echo $membre['nom_membre'] . " " . $membre['pren_membre']; ?>
                                                        </option>

                                                        <?php
                                                    }
                                                }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-sm-5 col-md-4 ">
                                        <label for="mtt_decaisse">Montant décaissé</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm text-right" id="mtt_decaisse"
                                               placeholder="0">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-sm-5 col-md-4 ">
                                        <label for="ordre_de">A l'ordre de</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" id="ordre_de"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-sm-5 col-md-4 ">
                                        <label for="commentaires">Commentaires</label>
                                    </div>
                                    <div class="col">
                                        <textarea id="commentaires" class="form-control" cols="30"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <button class="btn btn-primary faa-parent col-6 col-md-5 animated-hover col-lg-4 mx-auto my-4"
                                    id="enregistrer" onclick="saveDecaissement()">
                                <i class="fas fa-save mr-2 faa-pulse"></i>
                                Enregistrer
                            </button>

                            <!-- Modals -->
                            <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
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

                            <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorYearModalLabel"
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