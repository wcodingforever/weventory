<?php
    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'weventory';

    if (isset($_REQUEST['user_bday'])){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                INSERT INTO `users`
                    (`username`, `password`, `firstname`, `lastname`, `birthday`, `email`, `bio`, `pic`,`interests`)
                VALUES
                    (:un, :pw, :firn, :famn, :birthday, :email, :bio, :pic, :interests);");
            $lowerCase = strtolower($_REQUEST['user_login']);
            $stmt->bindParam(':un',        $lowerCase);
            $stmt->bindParam(':pw',        $_REQUEST['user_pswrd']);
            $stmt->bindParam(':firn',      $_REQUEST['user_firstName']);
            $stmt->bindParam(':famn',      $_REQUEST['iser_lastName']);
            $stmt->bindParam(':birthday',  $_REQUEST['user_bday']);
            $stmt->bindParam(':email',     $_REQUEST['user_email']);
            $stmt->bindParam(':bio',       $_REQUEST['user_bio']);
            $stmt->bindParam(':pic',       $_REQUEST['user_pic']);
            $stmt->bindParam(':interests', $_REQUEST['user_inetersts']);
        
            $stmt->execute();
            $affectedRows = mysql_affected_rows($stmt);

            if (!$affectedRows){
                // echo("Success")
            }
            else{
                // echo("Fail")
            }

            $connection = null;
            $stmt = null;
            
        }
        catch(PDOException $e) {
        }
    }
    else{
        try{
            session_start()

        }
        catch(PDOException $e) {
        }
    }


?>