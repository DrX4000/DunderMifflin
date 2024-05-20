<?php
    include_once __DIR__ . '/includes.php';
    include_once __DIR__ . '/../../model/php/env_settings.php';

    // Informations de connexion à la base de données
    $host = "dundermifflin";
    $user = "root";
    $pwd = "";
    $dbname = "niveaudestock";

    // Créer une connexion
    $conn = new mysqli($host, $user, $pwd, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Récupération de la quantité pour id_produit = 7
    $id_produit_7 = 7;
    $sql_stock7 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_7";
    $result_stock7 = $conn->query($sql_stock7);
    if ($result_stock7 && $result_stock7->num_rows > 0) {
        $row_stock7 = $result_stock7->fetch_assoc();
        $stock7 = $row_stock7['quantite'];
    } else {
        $stock7 = 0; // Stock par défaut si aucun résultat trouvé
    }

    // Récupération de la quantité pour id_produit = 8
    $id_produit_8 = 8;
    $sql_stock8 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_8";
    $result_stock8 = $conn->query($sql_stock8);
    if ($result_stock8 && $result_stock8->num_rows > 0) {
        $row_stock8 = $result_stock8->fetch_assoc();
        $stock8 = $row_stock8['quantite'];
    } else {
        $stock8 = 0; // Stock par défaut si aucun résultat trouvé
    }

    // Récupération de la quantité pour id_produit = 9
    $id_produit_9 = 9;
    $sql_stock9 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_9";
    $result_stock9 = $conn->query($sql_stock9);
    if ($result_stock9 && $result_stock9->num_rows > 0) {
        $row_stock9 = $result_stock9->fetch_assoc();
        $stock9 = $row_stock9['quantite'];
    } else {
        $stock9 = 0; // Stock par défaut si aucun résultat trouvé
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
    $stock_max7 = 10000;
    $stock_max8 = 6000;
    $stock_max9 = 15000;

    $pourcentage_stock7 = ($stock7 / $stock_max7) * 100;
    $pourcentage_stock8 = ($stock8 / $stock_max8) * 100;
    $pourcentage_stock9 = ($stock9 / $stock_max9) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fourniture d'artisanats</title>
    <link rel="stylesheet" href="view/css/style3.css">
</head>
<body>

    <?php include_header(); ?>
    
    <main>
        <section class="produits">
            <h1 class = "titre">Fourniture d'artisanats</h1>
            <h2>Articles</h2>
            <div class="produit">
                <h3>Papier construction</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="7">Ajouter</button>
                    <button class="supprimer" data-produit="7">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress7" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock7; ?>%;"></div>
                </div>
                <div class="stock7" id="stockValue7">Stock actuel: <?php echo $stock7; ?></div>
            </div>
            <div class="produit">
                <h3>Papier origami</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="8">Ajouter</button>
                    <button class="supprimer" data-produit="8">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress8" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock8; ?>%;"></div>
                </div>
                <div class="stock8" id="stockValue8">Stock actuel: <?php echo $stock8; ?></div>
            </div>
            <div class="produit">
                <h3>Papier d'art</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="9">Ajouter</button>
                    <button class="supprimer" data-produit="9">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress9" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock9; ?>%;"></div>
                </div>
                <div class="stock9" id="stockValue9">Stock actuel: <?php echo $stock9; ?></div>
            </div>

        </section>
    </main>

    <?php include_footer(); ?>

    <script>
    // Récupérer les boutons et ajouter des écouteurs d'événements
    const ajouterBoutons = document.querySelectorAll('.ajouter');
    const supprimerBoutons = document.querySelectorAll('.supprimer');

    // Stocks maximums en JavaScript
    const stockMax7 = <?php echo $stock_max7; ?>;
    const stockMax8 = <?php echo $stock_max8; ?>;
    const stockMax9 = <?php echo $stock_max9; ?>;

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
            if (produit === '7') {
                stockMax = stockMax7;
            } else if (produit === '8') {
                stockMax = stockMax8;
            } else if (produit === '9') {
                stockMax = stockMax9;
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
                    fetch('/../../model/php/update_stock.php', {
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
                    fetch('/../../model/php/update_stock.php', {
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

    div.stock7, div.stock8, div.stock9 {
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

