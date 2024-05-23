<?php
    include_once __DIR__ . '/includes.php';
    include_once __DIR__ . '/tai/tai_app_2023_2024_mouse/project/model/php/env_settings.php';

    // Informations de connexion à la base de données
    $host = "localhost";
    $user = "tai_app_2023_2024_mouse";
    $pwd = "RLWNNSO3OO";
    $dbname = "tai_app_2023_2024_mouse";

    // Créer une connexion
    $conn = new mysqli($host, $user, $pwd, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Récupération de la quantité pour id_produit = 10
    $id_produit_10 = 10;
    $sql_stock10 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_10";
    $result_stock10 = $conn->query($sql_stock10);
    if ($result_stock10 && $result_stock10->num_rows > 0) {
        $row_stock10 = $result_stock10->fetch_assoc();
        $stock10 = $row_stock10['quantite'];
    } else {
        $stock10 = 0; // Stock par défaut si aucun résultat trouvé
    }

    // Récupération de la quantité pour id_produit = 11
    $id_produit_11 = 11;
    $sql_stock11 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_11";
    $result_stock11 = $conn->query($sql_stock11);
    if ($result_stock11 && $result_stock11->num_rows > 0) {
        $row_stock11 = $result_stock11->fetch_assoc();
        $stock11 = $row_stock11['quantite'];
    } else {
        $stock11 = 0; // Stock par défaut si aucun résultat trouvé
    }

    // Récupération de la quantité pour id_produit = 12
    $id_produit_12 = 12;
    $sql_stock12 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_12";
    $result_stock12 = $conn->query($sql_stock12);
    if ($result_stock12 && $result_stock12->num_rows > 0) {
        $row_stock12 = $result_stock12->fetch_assoc();
        $stock12 = $row_stock12['quantite'];
    } else {
        $stock12 = 0; // Stock par défaut si aucun résultat trouvé
    }

    function updateStockQuantity($conn, $id_produit, $newQuantity) {
        $sql_update_stock = "UPDATE stock SET quantite = ? WHERE id_produit = ?";
        $stmt = $conn->prepare($sql_update_stock);
        $stmt->bind_param("ii", $newQuantity, $id_produit);
        $stmt->execute();
        $stmt->close();
    }   

    // Fermeture de la connexion
    $conn->close();


    // Stocks maximum
    $stock_max10 = 60000;
    $stock_max11 = 60000;
    $stock_max12 = 30000;

    $pourcentage_stock10 = ($stock10 / $stock_max10) * 100;
    $pourcentage_stock11 = ($stock11 / $stock_max11) * 100;
    $pourcentage_stock12 = ($stock12 / $stock_max12) * 100;
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
                    <button class="ajouter" data-produit="10">Ajouter</button>
                    <button class="supprimer" data-produit="10">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress10" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock10; ?>%;"></div>
                </div>
                <div class="stock10" id="stockValue10">Stock actuel: <?php echo $stock10; ?></div>
            </div>
            <div class="produit">
                <h3>Sac en papier</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="11">Ajouter</button>
                    <button class="supprimer" data-produit="11">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress11" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock11; ?>%;"></div>
                </div>
                <div class="stock11" id="stockValue11">Stock actuel: <?php echo $stock11; ?></div>
            </div>
            <div class="produit">
                <h3>Papier d'emballage</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="12">Ajouter</button>
                    <button class="supprimer" data-produit="12">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress12" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock12; ?>%;"></div>
                </div>
                <div class="stock12" id="stockValue12">Stock actuel: <?php echo $stock12; ?></div>
            </div>

        </section>
    </main>

    <?php include_footer(); ?>

    <script>
    // Récupérer les boutons et ajouter des écouteurs d'événements
    const ajouterBoutons = document.querySelectorAll('.ajouter');
    const supprimerBoutons = document.querySelectorAll('.supprimer');

    // Stocks maximums en JavaScript
    const stockMax10 = <?php echo $stock_max10; ?>;
    const stockMax11 = <?php echo $stock_max11; ?>;
    const stockMax12 = <?php echo $stock_max12; ?>;

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
            if (produit === '10') {
                stockMax = stockMax10;
            } else if (produit === '11') {
                stockMax = stockMax11;
            } else if (produit === '12') {
                stockMax = stockMax12;
            }

            // Extraire la largeur actuelle en tant que nombre
            let currentWidth = parseFloat(pourcentageStock.style.width.replace('%', ''));

            // Vérifier si currentWidth est un nombre valide
            if (isNaN(currentWidth)) {
                currentWidth = 0;
            }

            let currentStock = parseInt(stockValue.textContent.match(/\d+/)[0]);

            if (event.target.classList.contains('ajouter')) {
                if (currentStock + parseInt(montant) <= stockMax) {
                    const nouveauPourcentage = currentWidth + (parseInt(montant) * 100 / stockMax);
                    pourcentageStock.style.width = `${nouveauPourcentage}%`;
                    stockValue.textContent = `Stock actuel: ${currentStock + parseInt(montant)}`;

                    // Envoyer la nouvelle quantité à PHP pour mise à jour de la base de données
                    fetch('/tai/tai_app_2023_2024_mouse/project/model/php/update_stock.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            produit: produit,
                            nouvelleQuantite: currentStock + parseInt(montant)
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur lors de la mise à jour du stock.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Stock mis à jour avec succès:', data);
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        alert('Une erreur est survenue lors de la mise à jour du stock.');
                    });
                } else {
                    alert("La quantité ajoutée dépasse le stock maximum.");
                }
            } else {
                const nouveauPourcentage = currentWidth - (parseInt(montant) * 100 / stockMax);
                if (nouveauPourcentage >= 0) {
                    pourcentageStock.style.width = `${nouveauPourcentage}%`;
                    stockValue.textContent = `Stock actuel: ${currentStock - parseInt(montant)}`;

                    // Envoyer la nouvelle quantité à PHP pour mise à jour de la base de données
                    fetch('/tai/tai_app_2023_2024_mouse/project/model/php/update_stock.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            produit: produit,
                            nouvelleQuantite: currentStock - parseInt(montant)
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur lors de la mise à jour du stock.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Stock mis à jour avec succès:', data);
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        alert('Une erreur est survenue lors de la mise à jour du stock.');
                    });
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

    div.stock10, div.stock11, div.stock12 {
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

