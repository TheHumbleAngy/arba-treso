<?php
    /**
     * Created by PhpStorm.
     * User: ange-marius.kouakou
     * Date: 19/08/2019
     * Time: 17:51
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

            <input type="hidden" id="head_title" value="encaissement">
            <input type="hidden" id="cate" value="<?php echo $id_categorie; ?>">
            <div class="row">
                <div class="col-auto mx-auto">
                    <div id="wrapper_param" class="shadow gradient mt-5">
                        <div id="param_title" class="mb-md-4">
                            <h2 class="">Fiche d'Encaissement <span class="badge badge-primary"><?php echo $libelle ?></span></h2>
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
                                        <label for="mtt_encaisse" class="font-weight-bold">Montant encaissé</label>
                                    </div>
                                    <div class="col col-xl-auto">
                                        <input type="text" class="form-control form-control-sm text-right" id="mtt_encaisse"
                                               placeholder="0">
                                    </div>
                                </div>
                                <div class="row my-4 col">
                                    <div class="col">
                                        <h5 class="cadre-titre-search font-weight-bolder">Le Donateur...</h5>
                                        <div class="form-group">
                                            <label for="nom_don" class="">Nom</label>
                                            <input type="text" class="form-control form-control-sm text-uppercase" id="nom_don"
                                                   placeholder="Nom">
                                        </div>
                                        <div class="form-group">
                                            <label for="pren_don" class="">Prénoms</label>
                                            <input type="text" class="form-control form-control-sm text-uppercase" id="pren_don"
                                                   placeholder="Prenoms">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col">
                                                <label for="titre_don" class="">Titre</label>
                                                <input type="text" class="form-control form-control-sm text-uppercase" id="titre_don"
                                                       placeholder="Titre">
                                            </div>
                                            <div class="form-group col">
                                                <label for="tel_don" class="">Contact</label>
                                                <input type="text" class="form-control form-control-sm text-uppercase" id="tel_don"
                                                       placeholder="Contact">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="commune" class="">Commune</label>
                                            <input type="text" class="form-control form-control-sm text-uppercase" id="commune"
                                                   placeholder="Commune">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4 col">
                                    <div class="col">
                                        <h5 class="cadre-titre-search font-weight-bolder">Réceptionné par...</h5>
                                        <div class="row">
                                            <div class="form-group col-auto col-lg">
                                                <label for="mbr_inter" class="">Membre</label>
                                                <input type="text" class="form-control form-control-sm text-uppercase" id="mbr_inter"
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
                            <button class="btn btn-primary faa-parent animated-hover col-auto px-4 mx-auto"
                                    id="enregistrer" onclick="saveEncaissement()">
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
                                                <p class="mb-0">L'encaissement a bien été enregistré 👍</p>
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