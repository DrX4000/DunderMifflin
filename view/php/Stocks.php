<?php
    include_once __DIR__ . '/includes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
    <link rel="stylesheet" href="view/css/style2.css">
</head>
<body>
    
    <?php include_header(); ?>

    <main>
        <h2>Stocks</h2>
        </style>
        
        <ul>
            <li><button onclick="window.location.href = '/tai/tai_app_2023_2024_mouse/project/view/php/FB.php'">Fourniture de bureau</button></li>
            <li><button onclick="window.location.href = '/tai/tai_app_2023_2024_mouse/project/view/php/Pap.php'">Papèterie</button></li>
            <li><button onclick="window.location.href = '/tai/tai_app_2023_2024_mouse/project/view/php/FA.php'">Fourniture artisanats</button></li>
            <li><button onclick="window.location.href = '/tai/tai_app_2023_2024_mouse/project/view/php/ME.php'">Matériaux d'emballage</button></li>
        </ul>  
    </main>

    <?php include_footer(); ?>

</body>
</html>
