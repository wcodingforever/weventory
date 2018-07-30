<?php
    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'weventory'; 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include 'functions.php';
    if (isset($receive->valid_email)){
        $email = $receive->valid_email;
        //Import PHPMailer classes into the global namespace
        $randCode = generatePIN();

        require_once '../vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';  //mailtrap SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = '02834e8a88d3a2';   //username
            $mail->Password = 'f42ad6552dc0b6';   //password
            $mail->Port = 465;                    //smtp port

            $mail->setFrom('noreply@weventory.com', 'Weventory Korea');
            $mail->addAddress("$email", 'testuser');

            $mail->isHTML(true);

            $mail->Subject = 'Verification Email';
            $mail->Body    = 'Hello '.$receive->valid_name.', <p>This is your verification code for '.$receive->valid_user.': '.$randCode.'</p><br>Thanks';

            if (!$mail->send()) {
                echo 'not sent';
            } else {
                echo 'sent';
                try{
                    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $stmtb4 = $connection->prepare("
                        DELETE FROM verification
                        WHERE NOW() > `createdate`");
                    $stmtb4->execute();
                    $stmt = $connection->prepare("
                        INSERT INTO verification
                            (`user_login`, `f_name`, `pin`, `createdate`)
                        VALUES
                            (:ul, :firn, :pin, NOW()+INTERVAL 1 DAY);");
                    $lowerCase = strtolower($receive->valid_name);
                    $stmt->bindParam(':ul', $lowerCase);
                    $stmt->bindParam(':firn', $receive->valid_name);
                    $stmt->bindParam(':pin', $randCode);
                    $stmt->execute();
        
                    $connection = null;
                    $stmt = null;
                    $stmtb4 = null;
                }
                catch(PDOException $e) {
                }
            }
        } catch (Exception $e) {
            echo 'not sent';
        }
    }
    else if (isset($receive->varif_code)){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                SELECT `user_login`
                FROM `verification`
                WHERE `user_login` = :ul AND `pin` = :pin");
            $lowerCase = strtolower($receive->varif_user);
            $stmt->bindParam(':ul', $lowerCase);
            $stmt->bindParam(':pin', $receive->varif_code);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            
            if (isset($result['user_login'])){
                echo 'true';
                $stmt2 = $connection->prepare("
                    DELETE FROM `verification`
                    WHERE `user_login` = :ul");
                $stmt2->bindParam(':ul', $lowerCase);
                $stmt2->execute();

            }
            else{
                echo 'false';
            }
            $connection = null;
            $stmt = null;
            $stmt2 = null;
        }
        catch(PDOException $e) {
        }
        
    }
    else if (isset($receive->user_bday)){
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
            $count = $stmt->rowCount();
            
            if ($count > 0){
                echo 'created';
            }


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
                $location = get_client_location(); // 0 country
                $stmt2 = $connection->prepare("
                    INSERT INTO `sessions`
                        (`user_id`, `user_login`, `password`, `session_id`, `user_country`,`expir_date`)
                    VALUES
                        (:userid, :user_login, :password, :session_id, :country, NOW()+INTERVAL 2 MINUTE);");
                
                $currentIp = get_client_ip_server();
                $hashWithIp = hash('sha256', $currentIp.$_SESSION['session']);
                $stmt2->bindParam(':userid', $result['id']);
                $stmt2->bindParam(':user_login', $result['user_login']);
                $stmt2->bindParam(':password', $result['password']);
                $stmt2->bindParam(':session_id', $hashWithIp);
                $stmt2->bindParam(':country', $location[0]);
                $stmt2->execute();
                // echo 'YAY';
                // var_dump($location);
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
