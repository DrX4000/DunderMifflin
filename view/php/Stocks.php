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
            <li><button onclick="window.location.href = 'FB.html'">Fourniture de bureau</button></li>
            <li><button onclick="window.location.href = 'Pap.html'">Papèterie</button></li>
            <li><button onclick="window.location.href = 'FA.html'">Fourniture artisanats</button></li>
            <li><button onclick="window.location.href = 'ME.html'">Matériaux d'emballage</button></li>
        </ul>  
    </main>

    <?php include_footer(); ?>

</body>
</html>
