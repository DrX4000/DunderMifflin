<?php
// Assurez-vous que les données ont été envoyées via la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérez les données envoyées en tant que JSON
    $data = json_decode(file_get_contents("php://input"));

    // Assurez-vous que les données sont bien définies
    if (isset($data->produit) && isset($data->nouvelleQuantite)) {
        // Connexion à la base de données
        $host = "dundermifflin";
        $user = "root";
        $pwd = "";
        $dbname = "niveaudestock";

        $conn = new mysqli($host, $user, $pwd, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connexion échouée: " . $conn->connect_error);
        }

        // Mettre à jour la quantité de stock dans la base de données
        $id_produit = intval($data->produit);
        $nouvelle_quantite = intval($data->nouvelleQuantite);

        $sql_update_stock = "UPDATE stock SET quantite = ? WHERE id_produit = ?";
        $stmt = $conn->prepare($sql_update_stock);
        $stmt->bind_param("ii", $nouvelle_quantite, $id_produit);
        $stmt->execute();

        // Vérifiez si la mise à jour a réussi
        if ($stmt->affected_rows > 0) {
            // Réponse JSON pour indiquer que la mise à jour a réussi
            echo json_encode(["success" => true]);
        } else {
            // Réponse JSON pour indiquer que la mise à jour a échoué
            echo json_encode(["success" => false, "error" => "La mise à jour du stock a échoué."]);
        }

        // Fermeture de la connexion
        $stmt->close();
        $conn->close();
    } else {
        // Réponse JSON pour indiquer que les données envoyées sont incorrectes
        echo json_encode(["success" => false, "error" => "Données incorrectes envoyées au serveur."]);
    }
} else {
    // Réponse JSON pour indiquer que la méthode de requête est incorrecte
    echo json_encode(["success" => false, "error" => "Méthode de requête incorrecte. Utilisez POST."]);
}
?>
