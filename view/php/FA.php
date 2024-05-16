<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fourniture artisanats</title>
    <link rel="stylesheet" href="style5.css">
</head>
<body>
    <header>
        <h1>Fourniture artisanats</h1>
    </header>
    <main>
        <section class="produits">
            <h2>Artciles</h2>
            <?php
            $servername = "localhost";
            $username = "";
            $password = "";
            $dbname = "niveaudestock";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $products = ['Papier construction', 'Papier origami', 'Papier d\'art'];

            foreach ($products as $product) {
                $sql = "SELECT quantity FROM stock WHERE product_name =Papier pour imprimante";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $product);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                
                echo '<div class="produit">
                        <h3>' . $product . '</h3>
                        <p>Quantity: ' . ($row['quantity'] ?? 'Unavailable') . '</p>
                        <div class="boutons">
                            <button class="ajouter">Ajouter</button>
                            <button class="supprimer">Supprimer</button>
                        </div>
                      </div>';
            }

            $conn->close();
            ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Dunder Mifflin-INC</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
