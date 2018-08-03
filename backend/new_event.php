<?php
    require '../setup.php';
    include 'functions.php';

    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg, TRUE);

    // $allKeys = array_keys($receive);
    // for ($i = 0; $i < count($allKeys); $i++) {
    //     $receive[$allkeys[$i]] = strtolower($receive[$allKeys[$i]]);
    // }

    foreach ($receive as $thisKey => $thisVal) {
        $receive[$thisKey] = strtolower($receive[$thisKey]);
    }
    if(isset($receive['thisEvent'])){
        try{
            $stmt = $connection->prepare("
                SELECT
                    `event`.`id`,
                    `name`,
                    `datefrom`,
                    `dateto`,
                    `category`,
                    `description`,
                    `picture`,
                    `country`,
                    `city`,
                    `address`,
                    `privacy`,
                    `group_host_id`,
                    `user_host_id`,
                    `price`,
                    `user_login`,
                    `bio` AS 'hostDescription'
                FROM `event` LEFT JOIN `account`
                    ON `event`.`user_host_id` = `account`.`id`
                WHERE `event`.`id` = :id;
                ");
            $stmt->bindParam(':id',$receive['thisEvent']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $result = json_encode($result);
            echo($result);// TODO detach mysql with keys
 
            $connection = null;
            $stmt = null;
        }
 
        catch(PDOException $e) {
            echo "SERVER PROBLEMS.";
        }
    }
    else if (isset($receive['event_name'])){
        try{
            $stmt = $connection->prepare("
                INSERT INTO `event`
                    (`name`,
                        `datefrom`,
                        `dateto`,
                        `category`,
                        `description`,
                        `picture`,
                        `country`,
                        `city`,
                        `address`,
                        `privacy`,
                        `group_host_id`,
                        `user_host_id`,
                        `price`
                        )
                VALUES
                    (:name,
                        :datefrom,
                        :dateto,
                        :category,
                        :description,
                        :picture,
                        :country,
                        :city,
                        :address,
                        :privacy,
                        :group_host_id,
                        :user_host_id,
                        :price
                    )
                ");
            $stmt->bindParam(':name', $receive['event_name']);
            $stmt->bindParam(':datefrom', $receive['event_datefrom']);
            $stmt->bindParam(':dateto', $receive['event_dateto']);
            $stmt->bindParam(':category', $receive['event_category']);
            $stmt->bindParam(':description', $receive['event_description']);
            $stmt->bindParam(':picture', $receive['event_pic']);
            $stmt->bindParam(':country', $receive['event_country']);
            $stmt->bindParam(':city', $receive['event_city']);
            $stmt->bindParam(':address', $receive['event_address']);
            $stmt->bindParam(':privacy', $receive['event_privacy']);
            $stmt->bindParam(':group_host_id', $receive['event_group_host_id']);
            $stmt->bindParam(':user_host_id', $receive['event_user_host_id']);
            $stmt->bindParam(':price', $receive['event_price']);
            
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count > 0) { echo 'YAY'; }

            $connection = null;
            $stmt = null;
        }
        catch(PDOException $e) {
            // TODO: What happens here?!
            echo (json_encode($e));
        }
    }
    else if(isset($receive['edit_name'])){
        $stmt = $connection->prepare("
            UPDATE `event`
            SET `name`=:grn; `category`=:grc; `description`=:grdesc; `tags`=:grtags; `picture`=:grpic; `group_country`=:grcountry; `group_city`=:group_city
            WHERE `id` = :evID;");

        $stmt->bindParam(':evID', $receive['filtered_val']);
        $grn = strtolower($receive['edit_name']);
        $grc = strtolower($receive['edit_category']);
        $grdesc = strtolower($receive['edit_description']);
        // $grtags = strtolower($receive['group_tags']); // list?
        $grcountry = strtolower($receive['edit_country']);
        $group_city = strtolower($receive['edit_city']);
        $stmt->bindParam(':grn', $grn);
        $stmt->bindParam(':grc', $grc);
        $stmt->bindParam(':grdesc', $grdesc);
        // $stmt->bindParam(':grtags', $receive['group_tags']); // list?
        $stmt->bindParam(':grpic', $receive['gruop_pic']);
        $stmt->bindParam(':grcountry', $grcountry);
        $stmt->bindParam(':group_city', $edit_city);
        $stmt->bindParam(':grID', $receive['edit_id']);

        $stmt->execute();
        
    }
    //TODO different filters from groups white board
    else if(isset($receive['filtered_by'])){
        try{ //json_encode for sending AND detach from mysql columns
            if ($receive['filtered_by'] === "city"){
                // $receive['filtered_val'];
                $stmt = $connection->prepare("
                    SELECT *
                    FROM `group`
                    WHERE `group_city` = :grCity");
                $stmt->bindParam(':grCity', $receive['filtered_val']);

                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo($result);// TODO detach mysql with keys

                $connection = null;
                $stmt = null;
                
            }
            else if($receive['filtered_by'] === "country"){
                $stmt = $connection->prepare("
                    SELECT *
                    FROM `group`
                    WHERE `group_country` = :grCountry");
                $stmt->bindParam(':grCountry', $$receive['filtered_val']);
                // $receive['filtered_val']
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo($result);// TODO detach mysql with keys

                $connection = null;
                $stmt = null;
            }
            else if($receive['filtered_by'] === "popularity"){
                $stmt = $connection->prepare("
                        SELECT `name`,`category`,`description`,`picture`,`group_country`,`group_city`,`submitdate`
                        FROM `group`
                        WHERE id =
                            (SELECT `group_id`
                            FROM `group_participants`
                            GROUP BY `group_id`
                            ORDER BY count(*) DESC)
                        LIMIT :limit :limitto;");
                if ($receive['filtered_val'] !== 0){
                    $stmt->bindParam(':limit', $receive['filtered_val']);
                    $stmt->bindParam(':limit', $receive['filtered_val'] + 10);
                }
                else{
                    $stmt->bindParam(':limit', "10");
                    $stmt->bindParam(':limitto', "");
                }
                    // $receive['filtered_val']
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo($result);// TODO detach mysql with keys
    
                    $connection = null;
                    $stmt = null;
            }
            else if($receive['filtered_by'] === "created"){
                $stmt = $connection->prepare("
                        SELECT *
                        FROM `group`
                        ORDER BY `submitdate` DESC");
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo($result);// TODO detach mysql with keys
    
                    $connection = null;
                    $stmt = null;
            }
            else if($receive['filtered_by'] === "tags"){
                $stmt = $connection->prepare("
                    SELECT `name`,`category`,`description`,`picture`,`group_country`,`group_city`,`submitdate`
                    FROM `group`
                    WHERE id in 
                        (SELECT group.id
                        FROM `group`
                        LEFT JOIN `group_tags` 
                        ON group_tags.group_id = group.id 
                        JOIN `tags` ON tags.id = group_tags.tag_id 
                        WHERE tags.tag_title = :tag)
                    LIMIT 10;");
                $stmt->bindParam(':grCountry', $$receive['filtered_val']);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo($result);// TODO detach mysql with keys

                $connection = null;
                $stmt = null;
            }
            else if($receive['filtered_by'] === "default") {
                $stmt = $connection->prepare("
                        SELECT
                            `event`.`id`,
                            `name`,
                            `datefrom`,
                            `dateto`,
                            `category`,
                            `description`,
                            `picture`,
                            `country`,
                            `city`,
                            `address`,
                            `privacy`,
                            `group_host_id`,
                            `user_host_id`,
                            `price`,
                            `user_login`,
                            `bio` AS 'hostDescription'
                        FROM `event` LEFT JOIN `account`
                            ON `event`.`user_host_id` = `account`.`id`
                        ");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $result = json_encode($result);
                    echo($result);// TODO detach mysql with keys
    
                    $connection = null;
                    $stmt = null;
            }
            else {
                // TODO: homepage
                echo("{}");
            }
        }
        catch(PDOException $e) {
            echo "SERVER PROBLEMS.";
        }
    }
?>