<?php
    include_once __DIR__ . '/includes.php';
    include_once __DIR__ . '/../../model/php/env_settings.php';
    include_header();

    $pourcentage_stock1 = 33;
    $pourcentage_stock2 = 33;
    $pourcentage_stock3 = 33;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fourniture de bureau</title>
    <link rel="stylesheet" href="C:/Users/hugo.daroux/OneDrive - ESTIA/Documents/TraAppInt/DunderMifflin/view/css/style3.css">
</head>
<body>

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
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress1" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock1; ?>%;"></div>
                </div>
            </div>
            <div class="produit">
                <h3>Papier coloré</h3>
                <div class="boutons">
                    <button class="ajouter">Ajouter</button>
                    <button class="supprimer">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress2" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock2; ?>%;"></div>
                </div>
            </div>
            <div class="produit">
                <h3>Papier spéciaux</h3>
                <div class="boutons">
                    <button class="ajouter">Ajouter</button>
                    <button class="supprimer">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress3" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock3; ?>%;"></div>
                </div>
            </div>

        </section>
    </main>

    <?php include_footer(); ?>

    <script src="script.js"></script>
</body>
</html>
