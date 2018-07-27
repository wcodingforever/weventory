<?php
    include 'functions.php';

    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'weventory'; 

    if(isset($receive->)){
        
    }
?>