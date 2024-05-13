<?php
    // do all necessary includes first
    // __DIR__ allows you to use relative paths explicitly
    // here, the file is in the same folder as the includes.php file (view/)
    include_once __DIR__ . '/includes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/example1.css">
    <title>Welcome</title>
</head>
<body>

    <main>
        <img src="Images/logo.png" alt="Logo de l'entreprise"></img>
        <h1>Welcome</h1>
        <button onclick="window.location.href = 'logInOut.php'">LogIn</button>
    </main>
    <?php include_footer(); ?>
</body>
</html>
