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

            <input type="hidden" id="head_title" value="sortie">
            <div class="row">
                <div class="col-auto mx-auto">
                    <div id="wrapper_param" class="shadow gradient">
                        <h3 class="mb-4 rounded-left border-left border-bottom border-primary px-2 pb-1">Formulaire <?php echo $libelle ?></h3>
                        <div class="row my-3 mx-0">
                            <form>
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
                                        <textarea id="commentaires" class="form-control" cols="40"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }
?>