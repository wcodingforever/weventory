<?php
    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'weventory';

    if (isset($receive->user_bday)){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                INSERT INTO `users`
                    (`username`, `password`, `firstname`, `lastname`, `birthday`, `email`, `bio`, `pic`,`interests`)
                VALUES
                    (:un, :pw, :firn, :famn, :birthday, :email, :bio, :pic, :interests);");
            $lowerCase = strtolower($receive->user_bday);
            $stmt->bindParam(':un', $lowerCase);
            $stmt->bindParam(':pw', $receive->user_pswrd);
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
        }
    }
    // else{
    //     try{
    //         session_start()

    //     }
    //     catch(PDOException $e) {
    //     }
    // }


?>