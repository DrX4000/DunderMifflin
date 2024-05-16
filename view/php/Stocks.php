<?php
    include_once __DIR__ . '/includes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    
    <?php include_header(); ?>

    <main>
        <h2>Stocks</h2>
        
        <ul>
            <li><button type="button" onclick="window.location.href = 'FB.php'">Fourniture de bureau</button></li>
            <li><button type="button" onclick="window.location.href = 'Pap.html'">Papèterie</button></li>
            <li><button type="button" onclick="window.location.href = 'FA.html'">Fourniture artisanats</button></li>
            <li><button type="button" onclick="window.location.href = 'ME.html'">Matériaux d'emballage</button></li>
        </ul>
        <?php
        // Set up database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "niveaudestock";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$category = isset($_GET['category']) ? $_GET['category'] : 'bureau'; // Default to 'bureau' if no category is specified

// This is a basic example. You should map your categories to specific SQL queries or tables.
switch ($category) {
    case 'bureau':
        $sql = "SELECT * FROM stock WHERE category_id = 1"; // Adjust the SQL query based on your database schema
        break;
    case 'papeterie':
        $sql = "SELECT * FROM stock WHERE category_id = 2";
        break;
    case 'artisanats':
        $sql = "SELECT * FROM stock WHERE category_id = 3";
        break;
    case 'emballage':
        $sql = "SELECT * FROM stock WHERE category_id = 4";
        break;
    default:
        $sql = "SELECT * FROM stock";
        break;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['product_name'] . " - Quantity: " . $row['quantity'] . "</li>"; // Adjust based on your table columns
    }
    echo "</ul>";
} else {
    echo "No items found in this category.";
}

$conn->close();
?>

    </main>

    <?php include_footer(); ?>

</body>
</html>
