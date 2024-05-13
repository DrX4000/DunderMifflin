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
            <h1>Connection</h1>
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