<?php
    include_once __DIR__ . '/includes.php';
    include_once __DIR__ . '/../../model/php/env_settings.php';

    // Stocks actuels
    $stock1 = 8000;
    $stock2 = 4000;
    $stock3 = 12000;

    // Stocks maximum
    $stock_max1 = 10000;
    $stock_max2 = 6000;
    $stock_max3 = 15000;

    $pourcentage_stock1 = ($stock1 / $stock_max1) * 100;
    $pourcentage_stock2 = ($stock2 / $stock_max2) * 100;
    $pourcentage_stock3 = ($stock3 / $stock_max3) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiaux d'emballage</title>
    <link rel="stylesheet" href="view/css/style3.css">
</head>
<body>

    <?php include_header(); ?>

    <main>
        <section class="produits">
            <h1 class = "titre">Materiaux d'emballage</h1>
            <h2>Articles</h2>
            <div class="produit">
                <h3>Boîte en carton</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="1">Ajouter</button>
                    <button class="supprimer" data-produit="1">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress1" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock1; ?>%;"></div>
                </div>
                <div class="stock1" id="stockValue1">Stock actuel: <?php echo $stock1; ?></div>
            </div>
            <div class="produit">
                <h3>Sac en papier</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="2">Ajouter</button>
                    <button class="supprimer" data-produit="2">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress2" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock2; ?>%;"></div>
                </div>
                <div class="stock2" id="stockValue2">Stock actuel: <?php echo $stock2; ?></div>
            </div>
            <div class="produit">
                <h3>Papier d'emballage</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="3">Ajouter</button>
                    <button class="supprimer" data-produit="3">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress3" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock3; ?>%;"></div>
                </div>
                <div class="stock3" id="stockValue3">Stock actuel: <?php echo $stock3; ?></div>
            </div>

        </section>
    </main>

    <?php include_footer(); ?>

    <script>
        // Récupérer les boutons et ajouter des écouteurs d'événements
        const ajouterBoutons = document.querySelectorAll('.ajouter');
        const supprimerBoutons = document.querySelectorAll('.supprimer');

        // Stocks maximums en JavaScript
        const stockMax1 = <?php echo $stock_max1; ?>;
        const stockMax2 = <?php echo $stock_max2; ?>;
        const stockMax3 = <?php echo $stock_max3; ?>;

        // Fonction pour afficher le popup et mettre à jour les pourcentages
        function afficherPopup(event) {
            const produit = event.target.dataset.produit;
            const montant = prompt("Entrez le montant à modifier :");

            // Vérifier si un montant valide a été saisi
            if (montant !== null && !isNaN(montant) && parseInt(montant) > 0) {
                const pourcentageStock = document.getElementById(`stockProgress${produit}`);
                const stockValue = document.getElementById(`stockValue${produit}`);
                let stockMax; // Stock maximum en fonction du produit sélectionné

                // Déterminer le stock maximum en fonction du produit sélectionné
                if (produit === '1') {
                    stockMax = stockMax1;
                } else if (produit === '2') {
                    stockMax = stockMax2;
                } else if (produit === '3') {
                    stockMax = stockMax3;
                }
                
                if (event.target.classList.contains('ajouter')) {
                    const nouveauPourcentage = parseFloat(pourcentageStock.style.width) + (parseInt(montant) * 100 / stockMax);
                    pourcentageStock.style.width = `${nouveauPourcentage}%`;
                    stockValue.textContent = `Stock actuel: ${parseInt(stockValue.textContent) + parseInt(montant)}`;
                } else {
                    const nouveauPourcentage = parseFloat(pourcentageStock.style.width) - (parseInt(montant) * 100 / stockMax);
                    if (nouveauPourcentage >= 0) {
                        pourcentageStock.style.width = `${nouveauPourcentage}%`;
                        stockValue.textContent = `Stock actuel: ${parseInt(stockValue.textContent) - parseInt(montant)}`;
                    } else {
                        alert("La quantité à supprimer est supérieure au stock actuel.");
                    }
                }
            } else {
                alert("Veuillez saisir un montant valide.");
            }
        }

        // Ajouter des écouteurs d'événements aux boutons
        ajouterBoutons.forEach(bouton => {
            bouton.addEventListener('click', afficherPopup);
        });
        supprimerBoutons.forEach(bouton => {
            bouton.addEventListener('click', afficherPopup);
        });
    </script>
</body>
</html>










<style>
    body {
        font-family: Arial, sans-serif;
    }

    main {
        padding: 50px;
    }

    section.produits {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    div.produit {
        width: 30%;
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        text-align: center;
    }

    div.stock1, div.stock2, div.stock3 {
        font-size: 2em;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
        margin : 10px;
    }

    h1.titre, h2, h3 {
        margin: 0;
    }

    h1.titre {
        font-size: 36px;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-top: 0px;
        margin-bottom: 10px;
        line-height: 1.2;
        letter-spacing: 2px;
        text-transform: uppercase;
        border-bottom: 2px solid #333;
        padding-bottom: 10px; 
    }

    h2 {
        font-size: 24px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    h3 {
        font-size: 24px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    div.boutons {
        margin-bottom: 20px;
    }

    button.ajouter {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        margin-right: 10px;
    }

    button.supprimer {
        background-color: #E83B4F;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        margin-right: 10px;
    }

    button.ajouter:hover {
        background-color: #3e8e41;
    }

    button.supprimer:hover {
        background-color: #BD1629;
    }

    div.progress-container {
        height: 12px;
        background-color: #f1f1f1;
        border-radius: 5px;
    }

    div.progress-bar {
        height: 100%;
        border-radius: 5px;
        transition: width 0.5s;
    }

