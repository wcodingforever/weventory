<?php
    include 'functions.php';
    require '../setup.php';

    session_start();
    if (isset($_SESSION['session'])){
        try{
            $stmt = $connection->prepare("
                SELECT `user_id`, `user_login`, `password`, `session_id`, `expir_date`
                FROM `sessions`
                WHERE `session_id`=:sesn AND `expir_date`>NOW();");

            $currentIp = get_client_ip_server();
            $hashWithIp = hash('sha256', $currentIp.$_SESSION['session']);
            $stmt->bindParam(':sesn', $hashWithIp);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!isset($result['user_login'])){
                header("Location: ../templates/login.php");
            }
            else{
                $user_login = $result['user_login'];
                $user_id = $result['user_id'];
            }
                        
        }
        catch(PDOException $e){
        }
    }
    else{
        header("Location: ../templates/login.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    HTML with <?php echo($user_login);?>
</body>
</html>