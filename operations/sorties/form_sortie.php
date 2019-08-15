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
        }
        ?>

        <div class="row">
            <div class="col-auto mx-auto">
                <div id="wrapper_param" class="shadow gradient">
                    <h3 class="mb-4">Formulaire <?php echo $libelle?></h3>
                    <div class="row my-3">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <label for="type_param">Destinataire</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="type_param">Montant</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="type_param">A l'ordre de</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="type_param">Commentaires</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
?>