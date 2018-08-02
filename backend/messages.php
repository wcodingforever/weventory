<?php 
    require '../setup.php';
    include 'functions.php';

    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    if (isset($receive->message)){
        try{
            $stmt = $connection->prepare("
                INSERT INTO `messages`
                    (`sender_id`, `receiver_id`, `message`)
                VALUES
                    (:from, :to, :message);");
            $stmt->bindParam(':from', $receive->fromUser);
            $stmt->bindParam(':to', $receive->whoto);
            $stmt->bindParam(':message', $receive->message);

            $stmt->execute();


            $connection = null;
            $stmt = null;
        }
        catch(PDOException $e) {
        }
    }
    elseif(isset($receive->lastid)){
        $lastidint = $receive->lastid;
        $lastidint = str_replace("\"", "", $lastidint);
        $lastidint = intval($lastidint);
        try{
            session_start();
			$stmt = $connection->prepare("
                SELECT `id`, `from_user`, `to_user`, `message`
                FROM `messages`
                WHERE (`id` > :where AND `from_user` = :from)
                    OR (`id` > :where AND `to_user` = :to)
                    OR (`id` > :where AND `to_user` = 'all');");
            $stmt->bindParam(':where', );
            $stmt->bindParam(':from', );
            $stmt->bindParam(':to', );

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = json_encode($result);
            echo($result);

            $connection = null;
            $stmt = null;
        }
        catch(PDOException $e) {
        }
    }
?>