<?php
 
    require_once(__DIR__."/model/php/F8.php");



    
    if (isset($_SESSION['prenom'])) {
        require_once(__DIR__."/view/php/Stocks.php");
    }
    else {
        require_once(__DIR__."/view/php/loginExample.php");
    }
