<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');
    
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $day = $_POST['day'];

        switch ($status) {
            case 1:
                $sql = "
SELECT SUM(montant_operation) total_cotisations
FROM operations o
WHERE id_categorie = 'CAT02' AND date_operation <= '{$day}'
                ";
                break;
            case 2:
                $sql = "
SELECT SUM(montant_operation) total_adhesions
FROM operations o
WHERE id_categorie = 'CAT01' AND date_operation <= '{$day}'
                ";
                break;
            case 3:
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
        
        /*if ($_POST['status'] == 0) {
            if (isset($_POST['info']) && $_POST['info'] != "")
                $sql = "SELECT ((SELECT SUM(montant_operation) entree FROM operations o INNER JOIN membres m on o.id_membre = m.id_membre INNER JOIN categories c on o.id_categorie = c.id_categorie INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op WHERE t.id_typ_op = 1 AND (o.id_categorie = 'CAT01' OR o.id_categorie = 'CAT02') AND date_operation < '{$_POST['info']}' AND (nom_membre LIKE '%{$_POST['info']}%' OR pren_membre LIKE '%{$_POST['info']}%')) - (SELECT SUM(montant_operation) entree FROM operations o INNER JOIN categories c on o.id_categorie = c.id_categorie INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op WHERE t.id_typ_op = 0 AND (o.id_categorie = 'CAT01' OR o.id_categorie = 'CAT02') AND date_operation < '{$_POST['info']}')) AS solde";
            else
                $sql = "SELECT ((SELECT SUM(montant_operation) entree FROM operations o INNER JOIN membres m on o.id_membre = m.id_membre INNER JOIN categories c on o.id_categorie = c.id_categorie INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op WHERE t.id_typ_op = 1 AND (o.id_categorie = 'CAT01' OR o.id_categorie = 'CAT02')) - (SELECT SUM(montant_operation) entree FROM operations o INNER JOIN categories c on o.id_categorie = c.id_categorie INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op WHERE t.id_typ_op = 0 AND (o.id_categorie = 'CAT01' OR o.id_categorie = 'CAT02'))) AS solde";
        }
        elseif ($_POST['status'] == 1) {
            if (isset($_POST['mbr'])) {
                if (isset($_POST['info']) && $_POST['info'] != "")
                    $sql = "SELECT ((SELECT SUM(montant_operation) entree FROM operations o INNER JOIN categories c on o.id_categorie = c.id_categorie INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op WHERE t.id_typ_op = 1 AND (o.id_categorie = 'CAT01' OR o.id_categorie = 'CAT02') AND date_operation < '{$_POST['info']}') - (SELECT SUM(montant_operation) entree FROM operations o INNER JOIN categories c on o.id_categorie = c.id_categorie INNER JOIN types_operation t on c.id_typ_op = t.id_typ_op WHERE t.id_typ_op = 0 AND (o.id_categorie = 'CAT01' OR o.id_categorie = 'CAT02') AND date_operation < '{$_POST['info']}')) AS solde";
                else
                    $sql = "
SELECT COUNT(montant_operation) nbre_mois, SUM(montant_operation) total_paye
FROM operations o
         INNER JOIN membres m on o.id_membre = m.id_membre
         INNER JOIN mois m2 on o.id_mois = m2.id_mois
WHERE annee_operation = YEAR(CURRENT_TIMESTAMP) AND (nom_membre LIKE '%{$_POST['mbr']}%' OR pren_membre LIKE '%{$_POST['mbr']}%') AND (id_categorie = 'CAT02') ORDER BY numero_mois";
            }
        }*/

        if (isset($sql)) {
            $result = mysqli_query($connection, $sql);
            if ($result->num_rows) {
                $res = $result->fetch_all(MYSQLI_NUM);
                foreach ($res as $tot) {
                    $solde = $tot[0];
                }
                echo number_format($solde, 0, "", ".");
            }
            else
                echo "Void";
        }
        else echo "Void";
    }
    else echo "Void";