<?php
    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'weventory'; 

    include 'functions.php';
    if (isset($receive->user_bday)){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                INSERT INTO `account`
                    (`user_login`, `password`, `f_name`, `l_name`, `b_day`, `email`, `bio`, `pic`,`interests`)
                VALUES
                    (:un, :pw, :firn, :famn, :birthday, :email, :bio, :pic, :interests);");
            $lowerCase = strtolower($receive->user_login);
            $salt = "ThisIsRealSaltyIlya";
            $hashedPswrd = hash('sha256', $salt.$receive->user_pswrd);
            $stmt->bindParam(':un', $lowerCase);
            $stmt->bindParam(':pw', $hashedPswrd);
            $stmt->bindParam(':firn', $receive->user_firstName);
            $stmt->bindParam(':famn', $receive->user_lastName);
            $stmt->bindParam(':birthday', $receive->user_bday);
            $stmt->bindParam(':email', $receive->user_email);
            $stmt->bindParam(':bio', $receive->user_bio);
            $stmt->bindParam(':pic', $receive->user_pic);
            $stmt->bindParam(':interests', $receive->user_inetersts);
        
            $stmt->execute();
            // $affectedRows = mysql_affected_rows($stmt);
            // echo($affectedRows);
            echo("tried");

            // if (!$affectedRows){
            //     // echo("Success")
            // }
            // else{
            //     // echo("Fail")
            // }

            $connection = null;
            $stmt = null;
            
        }
        catch(PDOException $e) {
            echo($e);
        }
    }
    else if(isset($receive->loginCheck)){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                    SELECT `user_login` 
                    FROM `account`
                    WHERE `user_login` = :uc;");
            $lowerCase = strtolower($receive->loginCheck);
            $stmt->bindParam(':uc', $lowerCase);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(isset($result['user_login'])){
                echo 'exists';
            }
    
            $connection = null;
            $stmt = null;
        }
        catch(PDOException $e) {
        }
    }
    else if(isset($receive->user_login)){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                    SELECT `id`, `user_login`, `password` 
                    FROM `account`
                    WHERE `user_login` = :uc AND `password` = :pw;");
            $lowerCase = strtolower($receive->user_login);
            $salt = "ThisIsRealSaltyIlya";
            $hashedForCheck = hash('sha256', $salt.$receive->user_pswrd);
            $stmt->bindParam(':uc', $lowerCase);
            $stmt->bindParam(':pw', $hashedForCheck);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (isset($result['user_login'])){
                session_start();
                $_SESSION['session'] = GUID();
                $stmt2 = $connection2->prepare("
                    INSERT INTO `sessions`
                        (`user_id`, `user_login`, `password`, `session_id`, `expir_date`)
                    VALUES
                        (:userid, :user_login, :password, :session_id, NOW() + INTERVAL 1 DAY;");
                
                $currentIp = get_client_ip_server();
                $hashWithIp = hash('sha256', $currentIp.$_SESSION['session']);
                $stmt->bindParam(':userid', $result['id']);
                $stmt->bindParam(':user_login', $result['user_login']);
                $stmt->bindParam(':password', $result['password']);
                $stmt->bindParam(':session_id', $hashWithIp);
                $stmt->execute();
                echo 'YAY';
            }
            else{
                echo 'OI';
            }
            
            
        }
        catch(PDOException $e) {
        }
    }
    else
        echo("Wrong request")
    


?>