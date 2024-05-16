<?php
    include_once __DIR__ . '/includes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fourniture bureau</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>

    <?php include_header(); ?>

    <main>
        <section class="produits">
            <h1>Fourniture de bureau</h1>
            <h2>Artciles</h2>
            <div class="produit">
                <h3>Papier pour imprimante</h3>
                <div class="boutons">
                    <button class="ajouter">Ajouter</button>
                    <button class="supprimer">Supprimer</button>
                </div>
            </div>
            <div class="produit">
                <h3>Papier coloré</h3>
                <div class="boutons">
                    <button class="ajouter">Ajouter</button>
                    <button class="supprimer">Supprimer</button>
                </div>
            </div>
            <div class="produit">
                <h3>Papier spéciaux</h3>
                <div class="boutons">
                    <button class="ajouter">Ajouter</button>
                    <button class="supprimer">Supprimer</button>
                </div>
            </div>
            <div class="progress-container">
                <div class="progress-bar" id="stockProgress1" style="width: <?php echo $pourcentage_stock1; ?>%;"></div>
            </div>

            <div class="progress-container">
                <div class="progress-bar" id="stockProgress2" style="width: <?php echo $pourcentage_stock2; ?>%;"></div>
            </div>

            <div class="progress-container">
                <div class="progress-bar" id="stockProgress3" style="width: <?php echo $pourcentage_stock3; ?>%;"></div>
            </div>

            <?php

                include_once (__DIR__ . '/../../model/php/env_settings.php');

                // Récupérer les données de stock pour le produit 1
                $sql = "SELECT stock, quantite FROM produit WHERE id = 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $stock_total1 = $row["stock"];
                        $stock_restant1 = $row["quantite"];
                    }
                } else {
                    echo "0 results";
                }

                // Récupérer les données de stock pour le produit 2
                $sql = "SELECT stock_total, stock_restant FROM produits WHERE id = 2";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $stock_total2 = $row["stock_total"];
                        $stock_restant2 = $row["stock_restant"];
                    }
                } else {
                    echo "0 results";
                }

                // Récupérer les données de stock pour le produit 3
                $sql = "SELECT stock_total, stock_restant FROM produits WHERE id = 3";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $stock_total3 = $row["stock_total"];
                        $stock_restant3 = $row["stock_restant"];
                    }
                } else {
                    echo "0 results";
                }

                // Calculer le pourcentage de stock restant pour chaque produit
                $pourcentage_stock1 = ($stock_restant1 / $stock_total1) * 100;
                $pourcentage_stock2 = ($stock_restant2 / $stock_total2) * 100;
                $pourcentage_stock3 = ($stock_restant3 / $stock_total3) * 100;

                ?>



        </section>
    </main>

    <?php include_footer(); ?>

    <script src="script.js"></script>
</body>
</html>
