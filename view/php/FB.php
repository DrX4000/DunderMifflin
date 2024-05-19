<?php
include_once __DIR__ . '/includes.php';
include_once __DIR__ . '/../../model/php/env_settings.php';

$host = 'localhost';
$dbname = 'niveaudestock';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour les stocks
    $stmt1 = $pdo->prepare("SELECT * FROM `stock` WHERE id_produit = :id_produit");
    $stmt1->execute(['id_produit' => 1]);
    $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $stock1 = $result1 ? $result1['quantite'] : 0;

    $stmt2 = $pdo->prepare("SELECT * FROM `stock` WHERE id_produit = :id_produit");
    $stmt2->execute(['id_produit' => 2]);
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $stock2 = $result2 ? $result2['quantite'] : 0;

    $stmt3 = $pdo->prepare("SELECT * FROM `stock` WHERE id_produit = :id_produit");
    $stmt3->execute(['id_produit' => 3]);
    $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $stock3 = $result3 ? $result3['quantite'] : 0;

    // Définir les stocks maximum
    $stock_max1 = 12000;
    $stock_max2 = 6000;
    $stock_max3 = 15000;

    // Calcul des pourcentages de stock
    $pourcentage_stock1 = ($stock1 / $stock_max1) * 100;
    $pourcentage_stock2 = ($stock2 / $stock_max2) * 100;
    $pourcentage_stock3 = ($stock3 / $stock_max3) * 100;

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stocks</title>
    <style>
        .progress-container {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 12px;
        }
        .progress-bar {
            height: 12px;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <main>
        <section class="produits">
            <h1 class="titre">Fourniture de bureau</h1>
            <h2>Articles</h2>
            <div class="produit">
                <h3>Papier pour imprimante</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="1">Ajouter</button>
                    <button class="supprimer" data-produit="1">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress1" style="background-color: blue; width: <?= htmlspecialchars($pourcentage_stock1); ?>%;"></div>
                </div>
                <div class="stock1" id="stockValue1">Stock actuel: <?= htmlspecialchars($stock1); ?></div>
            </div>
            <div class="produit">
                <h3>Papier coloré</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="2">Ajouter</button>
                    <button class="supprimer" data-produit="2">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress2" style="background-color: blue; width: <?= htmlspecialchars($pourcentage_stock2); ?>%;"></div>
                </div>
                <div class="stock2" id="stockValue2">Stock actuel: <?= htmlspecialchars($stock2); ?></div>
            </div>
            <div class="produit">
                <h3>Papier spéciaux</h3>
                <div class="boutons">
                    <button class="ajouter" data-produit="3">Ajouter</button>
                    <button class="supprimer" data-produit="3">Supprimer</button>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" id="stockProgress3" style="background-color: blue; width: <?= htmlspecialchars($pourcentage_stock3); ?>%;"></div>
                </div>
                <div class="stock3" id="stockValue3">Stock actuel: <?= htmlspecialchars($stock3); ?></div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Récupérer les boutons et ajouter des écouteurs d'événements
            const ajouterBoutons = document.querySelectorAll('.ajouter');
            const supprimerBoutons = document.querySelectorAll('.supprimer');

            // Stocks maximums en JavaScript
            const stockMax1 = <?= $stock_max1; ?>;
            const stockMax2 = <?= $stock_max2; ?>;
            const stockMax3 = <?= $stock_max3; ?>;

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

                    let operation; // Déterminer l'opération
                    if (event.target.classList.contains('ajouter')) {
                        operation = 'ajouter';
                    } else {
                        operation = 'supprimer';
                    }

                    // Fonction AJAX pour mettre à jour la base de données
                    function updateStock(produit, montant, operation) {
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "update_stock.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                const response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    if (operation === 'ajouter') {
                                        const nouveauPourcentage = parseFloat(pourcentageStock.style.width) + (parseInt(montant) * 100 / stockMax);
                                        pourcentageStock.style.width = `${nouveauPourcentage}%`;
                                        stockValue.textContent = `Stock actuel: ${parseInt(stockValue.textContent.split(': ')[1]) + parseInt(montant)}`;
                                    } else {
                                        const nouveauPourcentage = parseFloat(pourcentageStock.style.width) - (parseInt(montant) * 100 / stockMax);
                                        if (nouveauPourcentage >= 0) {
                                            pourcentageStock.style.width = `${nouveauPourcentage}%`;
                                            stockValue.textContent = `Stock actuel: ${parseInt(stockValue.textContent.split(': ')[1]) - parseInt(montant)}`;
                                        } else {
                                            alert("La quantité à supprimer est supérieure au stock actuel.");
                                        }
                                    }
                                } else {
                                    alert(response.message);
                                }
                            }
                        };
                        xhr.send(`produit=${produit}&montant=${montant}&operation=${operation}`);
                    }

                    updateStock(produit, montant, operation);

                } else {
                    alert("Veuillez saisir un montant valide.");
                }
            }

            // Ajouter des écouteurs d'événements aux boutons
            ajouterBoutons.forEach(bouton => {
                bouton.addEventListener('click', afficherPopup);
            });
            supprimerBoutons.forEach
        })
        </script>
    </body>
    </html>
    

    <?php include_footer(); ?>

    <?php
$host = 'localhost';
$dbname = 'niveaudestock';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $produit = intval($_POST['produit']);
        $montant = intval($_POST['montant']);
        $operation = $_POST['operation'];

        // Déterminer l'utilisateur (à remplacer par l'utilisateur actuel)
        if (isset($_SESSION['id_utilisateur'])) {
            $id_utilisateur = $_SESSION['id_utilisateur'];
        } else {
            echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
            exit;
        }

        if ($operation === 'ajouter') {
            $id_type_operation = 1; // Id pour l'opération d'ajout

            // Insérer l'opération dans la table stock
            $stmt = $pdo->prepare("INSERT INTO stock (quantite, id_type_operation, id_produit, id_utilisateur) VALUES (:quantite, :id_type_operation, :produit, :utilisateur)");
            $stmt->execute([
                ':quantite' => $montant,
                ':id_type_operation' => $id_type_operation,
                ':produit' => $produit,
                ':utilisateur' => $id_utilisateur,
            ]);

            // Mettre à jour la quantité de stock
            $stmt_update = $pdo->prepare("UPDATE stock SET quantite = quantite + :montant WHERE id_produit = :produit");
            $stmt_update->execute([
                ':montant' => $montant,
                ':produit' => $produit,
            ]);

        } elseif ($operation === 'supprimer') {
            $id_type_operation = 2; // Id pour l'opération de suppression

            // Insérer l'opération dans la table stock
            $stmt = $pdo->prepare("INSERT INTO stock (quantite, id_type_operation, id_produit, id_utilisateur) VALUES (:quantite, :id_type_operation, :produit, :utilisateur)");
            $stmt->execute([
                ':quantite' => -$montant,
                ':id_type_operation' => $id_type_operation,
                ':produit' => $produit,
                ':utilisateur' => $id_utilisateur,
            ]);

            // Mettre à jour la quantité de stock
            $stmt_update = $pdo->prepare("UPDATE stock SET quantite = quantite - :montant WHERE id_produit = :produit AND quantite >= :montant");
            $stmt_update->execute([
                ':montant' => $montant,
                ':produit' => $produit,
            ]);
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
}
?>

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

