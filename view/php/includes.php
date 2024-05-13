<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="view/css/includes.css">
    </head>
<?php
/**
 * Simple PHP script example to showcase hwo HTML content
 * can be re-used across multiple HTML files
 * 
 * @author: w.delamare
 * @date: Dec. 2023
 */
    function include_header() {
        ?>
        <header>
            <div class="container">
                <div class="logo">
                    <img src="Images/logo.png" alt="Company Logo">
                    <h1>Dunder Mifflin</h1>
                </div>
             <a href="index.php" class="home-button">Home</a>
             </div>
<style>
header {
    background-color: #333;
    color: #fff;
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}       

.logo {
    display: flex;
    align-items: center;
}

.logo img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.logo h1 {
    font-size: 1.5em;
    font-weight: bold;
    margin: 0;
}

.home-button {
    background-color: #fff;
    color: #333;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1em;
}

.home-button:hover {
    background-color: #ccc;
}
</style>
        </header>


        <?php
    }


    function include_footer() {
        ?>
        <footer>
        <div class="footer-container">
            <p>Copyright © 2023 Dunder Mifflin. All rights reserved.</p>
            <a href="#">Privacy Policy</a>
            <span> | </span>
            <a href="#">Contact</a>
        </div>
    </footer>
    <style>
        footer {
            background-color: #f3f3f3;
            padding: 20px 0;
            font-family: Arial, sans-serif;
        }

        .footer-container {
            max-width: 1100px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-container p {
            margin: 0;
        }

        .footer-container a {
            color: #333;
            text-decoration: none;
        }

        .footer-container a:hover {
            color: #007bff;
        }
    </style>
        <?php
    }


    function include_error_message($message) {
        echo "<p class='error_message'>" . $message . "</p>";
    }


?>