<?php

// if we are in the local environment
$host = "localhost";
$dbname = "niveaudestock";
$user = "root";
$pwd = "";

// if we are on the server
if (file_exists("C:/DunderMifflin")) {
    $host = "dundermifflin";
    $dbname = "niveaudestock";
    $user = "root";
    $pwd = "";
}




