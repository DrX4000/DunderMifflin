<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="includes.css">
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
        </header>
        <?php
    }


    function include_footer() {
        ?>
        <footer>
        <div class="footer-container">
            <p>Copyright © 2024 Dunder Mifflin. All rights reserved.</p>
            <a href="#">Privacy Policy</a>
            <span> | </span>
            <a href="#">Contact</a>
        </div>
    </footer>
        <?php
    }


    function include_error_message($message) {
        echo "<p class='error_message'>" . $message . "</p>";
    }


?>