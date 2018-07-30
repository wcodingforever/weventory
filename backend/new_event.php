<?php
    include 'functions.php';

    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'weventory'; 

    if (isset($receive->event_name)){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                INSERT INTO `event`
                    (`name`,`category`,`description`,`tags`,`picture`,`group_country`, `group_city`)
                VALUES
                    (:grn,:grc,:grdesc,:grtags,:grpic,:grcountry,:group_city);");
            $grn = strtolower($receive->group_name);
            $grc = strtolower($receive->group_category);
            $grdesc = strtolower($receive->group_description);
            // $grtags = strtolower($receive->group_tags); // list?
            $grcountry = strtolower($receive->group_country);
            $group_city = strtolower($receive->group_city);
            $stmt->bindParam(':grn', $grn);
            $stmt->bindParam(':grc', $grc);
            $stmt->bindParam(':grdesc', $grdesc);
            // $stmt->bindParam(':grtags', $receive->group_tags); // list?
            $stmt->bindParam(':grpic', $receive->gruop_pic);
            $stmt->bindParam(':grcountry', $grcountry);
            $stmt->bindParam(':group_city', $group_city);
            
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count > 0){
                echo 'created';
            }

            $connection = null;
            $stmt = null;
        }
        catch(PDOException $e) {
        }
    }
    else if(isset($receive->edit_name)){
        $connection = new PDO("mysql:host=$servername;dbname=$dbname,$username,$password");
        $stmt = $connection->prepare("
            UPDATE `event`
            SET `name`=:grn; `category`=:grc; `description`=:grdesc; `tags`=:grtags; `picture`=:grpic; `group_country`=:grcountry; `group_city`=:group_city
            WHERE `id` = :evID;");

        $stmt->bindParam(':evID', $receive->filtered_val);
        $grn = strtolower($receive->edit_name);
        $grc = strtolower($receive->edit_category);
        $grdesc = strtolower($receive->edit_description);
        // $grtags = strtolower($receive->group_tags); // list?
        $grcountry = strtolower($receive->edit_country);
        $group_city = strtolower($receive->edit_city);
        $stmt->bindParam(':grn', $grn);
        $stmt->bindParam(':grc', $grc);
        $stmt->bindParam(':grdesc', $grdesc);
        // $stmt->bindParam(':grtags', $receive->group_tags); // list?
        $stmt->bindParam(':grpic', $receive->gruop_pic);
        $stmt->bindParam(':grcountry', $grcountry);
        $stmt->bindParam(':group_city', $edit_city);
        $stmt->bindParam(':grID', $receive->edit_id);

        $stmt->execute();
        
    }
    //TODO different filters from groups white board
    else if(isset($receive->filtered_by)){
        try{ //json_encode for sending AND detach from mysql columns
            $connection = new PDO("mysql:host=$servername;dbname=$dbname,$username,$password");
            if ($receive->filtered_by === "city"){
                // $receive->filtered_val;
                $stmt = $connection->prepare("
                    SELECT *
                    FROM `group`
                    WHERE `group_city` = :grCity");
                $stmt->bindParam(':grCity', $receive->filtered_val);

                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo($result);#TODO detach mysql with keys

                $connection = null;
                $stmt = null;
                
            }
            else if($receive->filtered_by === "country"){
                $stmt = $connection->prepare("
                    SELECT *
                    FROM `group`
                    WHERE `group_country` = :grCountry");
                $stmt->bindParam(':grCountry', $$receive->filtered_val);
                // $receive->filtered_val
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo($result);#TODO detach mysql with keys

                $connection = null;
                $stmt = null;
            }
            else if($receive->filtered_by === "popularity"){
                $stmt = $connection->prepare("
                        SELECT `name`,`category`,`description`,`picture`,`group_country`,`group_city`,`submitdate`
                        FROM `group`
                        WHERE id =
                            (SELECT `group_id`
                            FROM `group_participants`
                            GROUP BY `group_id`
                            ORDER BY count(*) DESC)
                        LIMIT :limit :limitto;");
                if ($receive->filtered_val !== 0){
                    $stmt->bindParam(':limit', $receive->filtered_val);
                    $stmt->bindParam(':limit', $receive->filtered_val + 10);
                }
                else{
                    $stmt->bindParam(':limit', "10");
                    $stmt->bindParam(':limitto', "");
                }
                    // $receive->filtered_val
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo($result);#TODO detach mysql with keys
    
                    $connection = null;
                    $stmt = null;
            }
            else if($receive->filtered_by === "created"){
                $stmt = $connection->prepare("
                        SELECT *
                        FROM `group`
                        ORDER BY `submitdate` DESC");
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo($result);#TODO detach mysql with keys
    
                    $connection = null;
                    $stmt = null;
            }
            else if($receive->filtered_by === "tags"){
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
                $stmt->bindParam(':grCountry', $$receive->filtered_val);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo($result);#TODO detach mysql with keys

                $connection = null;
                $stmt = null;
            }
            else if($receive->filtered_by === "default"){
                $stmt = $connection->prepare("
                        SELECT *
                        FROM `group`");
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo($result);#TODO detach mysql with keys
    
                    $connection = null;
                    $stmt = null;
            }
        }
        catch(PDOException $e) {
        }
        
        
    }
?>