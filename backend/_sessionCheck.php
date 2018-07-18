<?php
    include 'functions.php';

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'weventory'; 

    session_start();
    if (isset($_SESSION['session'])){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                SELECT `user_id`, `user_login`, `password`, `session_id`, `expir_date`
                FROM `sessions`
                WHERE `session_id`=:sesn; AND `expir_date`>:currdate");

            $currentIp = get_client_ip_server();
            $hashWithIp = hash('sha256', $currentIp.$_SESSION['session']);
            $stmt->bindParam(':sesn', $_SESSION['session']);
                        
        }
        catch(PDOException $e){
        }
    }

?>