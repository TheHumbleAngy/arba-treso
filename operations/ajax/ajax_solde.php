<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');
    
    if (isset($_POST['status']) && isset($_POST['day'])) {
        $status = $_POST['status'];
        $day = $_POST['day'];

        switch ($status) {
            case 1:
                /* solde des cotisations à une date donnee */
                $sql = "
SELECT SUM(montant_operation) total_cotisations
FROM operations o
WHERE id_categorie = 'CAT02' AND YEAR(date_operation) = 2019 AND date_operation <= '{$day}'";
                break;

            case 2:
                /* solde des adhesions à une date donnee */
                $sql = "
SELECT SUM(montant_operation) total_adhesions
FROM operations o
WHERE id_categorie = 'CAT01' AND date_operation <= '{$day}'
                ";
                break;

            case 3:
                /* solde des mouvements à une date donnee */
                $sql = "
SELECT (
            (
                SELECT SUM(montant_operation) total_entrees
                FROM operations o
                         INNER JOIN categories c on o.id_categorie = c.id_categorie
                         INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op
                WHERE t.id_typ_op = 1 AND o.id_categorie <> 'CAT01' AND o.id_categorie <> 'CAT02' AND date_operation <= '{$day}'
            ) - (
                SELECT SUM(montant_operation) total_sorties
                FROM operations o
                         INNER JOIN categories c on o.id_categorie = c.id_categorie
                         INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op
                WHERE t.id_typ_op = 0 AND date_operation <= '{$day}'
            )
) AS solde_mouvements
                ";
                break;

            default:
                /* solde general à une date donnee = total entree - total sortie */
                $sql = "
SELECT (
            (
                SELECT SUM(montant_operation) total_entrees
                FROM operations o
                         INNER JOIN categories c on o.id_categorie = c.id_categorie
                         INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op
                WHERE t.id_typ_op = 1 AND date_operation <= '{$day}'
            ) - (
                SELECT SUM(montant_operation) total_sorties
                FROM operations o
                         INNER JOIN categories c on o.id_categorie = c.id_categorie
                         INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op
                WHERE t.id_typ_op = 0 AND date_operation <= '{$day}'
            )
) AS solde_general
                ";
                break;
        }
        
        if (isset($sql)) {
            $result = mysqli_query($connection, $sql);
            if ($result->num_rows) {
                $res = $result->fetch_all(MYSQLI_NUM);
                foreach ($res as $tot) {
                    $solde = $tot[0];
                }
                $arr = [$sql, number_format($solde, 0, "", ".")];
                echo json_encode($arr);
            }
            else
                echo "Void";
        }
        else echo "Void";
    }
    else echo "Void";