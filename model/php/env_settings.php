<?php

// if we are in the local environment
$host = "localhost";
$dbname = "niveaudestock";
$user = "root";
$pwd = "";

// if we are on the server
if (file_exists("/DunderMifflin")) {
    $host = "tai_app_2023_2024_mouse";
    $dbname = "tai_app_2023_2024_mouse";
    $user = "tai_app_2023_2024_mouse";
    $pwd = "RLWNNSO3OO";
}




