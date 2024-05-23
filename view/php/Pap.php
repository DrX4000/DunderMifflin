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

    // Récupération de la quantité pour id_produit = 4
    $id_produit_4 = 4;
    $sql_stock4 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_4";
    $result_stock4 = $conn->query($sql_stock4);
    if ($result_stock4 && $result_stock4->num_rows > 0) {
        $row_stock4 = $result_stock4->fetch_assoc();
        $stock4 = $row_stock4['quantite'];
    } else {
        $stock4 = 0; // Stock par défaut si aucun résultat trouvé
    }

    // Récupération de la quantité pour id_produit = 5
    $id_produit_5 = 5;
    $sql_stock5 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_5";
    $result_stock5 = $conn->query($sql_stock5);
    if ($result_stock5 && $result_stock5->num_rows > 0) {
        $row_stock5 = $result_stock5->fetch_assoc();
        $stock5 = $row_stock5['quantite'];
    } else {
        $stock5 = 0; // Stock par défaut si aucun résultat trouvé
    }

    // Récupération de la quantité pour id_produit = 6
    $id_produit_6 = 6;
    $sql_stock6 = "SELECT quantite FROM stock WHERE id_produit = $id_produit_6";
    $result_stock6 = $conn->query($sql_stock6);
    if ($result_stock6 && $result_stock6->num_rows > 0) {
        $row_stock6 = $result_stock6->fetch_assoc();
        $stock6 = $row_stock6['quantite'];
    } else {
        $stock6 = 0; // Stock par défaut si aucun résultat trouvé
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
        $stock_max4 = 80000;
        $stock_max5 = 50000;
        $stock_max6 = 20000;

        $pourcentage_stock4 = ($stock4 / $stock_max4) * 100;
        $pourcentage_stock5 = ($stock5 / $stock_max5) * 100;
        $pourcentage_stock6 = ($stock6 / $stock_max6) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papèterie</title>
    <link rel="stylesheet" href="view/css/style3.css">
</head>
<body>

    <?php include_header(); ?>
    
    <main>
        <section class="produits">
            <h1 class = "titre">Papèterie</h1>
            <h2>Articles</h2>
            <div class="produit">
                <h3>Cahier</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="4">Ajouter</button>
                    <button class="supprimer" data-produit="4">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress4" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock4; ?>%;"></div>
                </div>
                <div class="stock4" id="stockValue4">Stock actuel: <?php echo $stock4; ?></div>
            </div>
            <div class="produit">
                <h3>Enveloppes</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="5">Ajouter</button>
                    <button class="supprimer" data-produit="5">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress5" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock5; ?>%;"></div>
                </div>
                <div class="stock5" id="stockValue5">Stock actuel: <?php echo $stock5; ?></div>
            </div>
            <div class="produit">
                <h3>Lettres / Cartes postales</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="6">Ajouter</button>
                    <button class="supprimer" data-produit="6">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress6" style="background-color: blue; height: 12px; width: <?php echo $pourcentage_stock6; ?>%;"></div>
                </div>
                <div class="stock6" id="stockValue6">Stock actuel: <?php echo $stock6; ?></div>
            </div>

        </section>
    </main>

    <?php include_footer(); ?>

    <script>
    // Récupérer les boutons et ajouter des écouteurs d'événements
    const ajouterBoutons = document.querySelectorAll('.ajouter');
    const supprimerBoutons = document.querySelectorAll('.supprimer');

    // Stocks maximums en JavaScript
    const stockMax4 = <?php echo $stock_max4; ?>;
    const stockMax5 = <?php echo $stock_max5; ?>;
    const stockMax6 = <?php echo $stock_max6; ?>;

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
            if (produit === '4') {
                stockMax = stockMax4;
            } else if (produit === '5') {
                stockMax = stockMax5;
            } else if (produit === '6') {
                stockMax = stockMax6;
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

    div.stock4, div.stock5, div.stock6 {
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

