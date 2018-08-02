<?php
    require '../setup.php';
    include 'functions.php';

    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    if (isset($receive->group_name)){
        try{
            $grn        = strtolower($receive->group_name);
            $grc        = strtolower($receive->group_category);
            $grcountry  = strtolower($receive->group_country);
            $group_city = strtolower($receive->group_city);
            $grtags     = strtolower($receive->group_tags);
            $listTags   = explode(" ", $grtags);
            $listIds    = array();

            $check = $connection->prepare("
                SELECT `name`
                FROM `group
                WHERE `lowered_name` <> :grn" );
            $check->bindParam(':grn', $grn);
            $check->execute();
            $result = $check->fetch(PDO::FETCH_ASSOC);
            if (isset($result['name'])){
                echo'exists';
            }
            else{
                $stmt = $connection->prepare("
                    INSERT INTO `group`
                        (`name`, `lowered_name` ,`category`,`description`,`tags`,`picture`,`group_country`, `group_city`)
                    VALUES
                        (:grn,:loweredName,:grc,:grdesc,:grtags,:grpic,:grcountry,:group_city);
                    SELECT LAST_INSERT_ID();");
            
                $stmt->bindParam(':grn', $receive->group_name);
                $stmt->bindParam(':loweredName', $grn);
                $stmt->bindParam(':grc', $grc);
                $stmt->bindParam(':grdesc', $receive->group_description);
                $stmt->bindParam(':grpic', $receive->gruop_pic);
                $stmt->bindParam(':grcountry', $grcountry);
                $stmt->bindParam(':group_city', $group_city);
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count>0){
                    $groupInsertedId = $stmt->fetch(PDO::FETCH_ASSOC); //$thisId['LAST_INSERT_ID()']
                }
                else{
                    echo'error';
                }
                $stmt = null;

                foreach ($listTags as $tag) {
                    $stmt3 = $connection->prepare("
                        INSERT INTO `tags`
                            (`tag_title`)
                        VALUES
                            (:tag);
                        SELECT LAST_INSERT_ID();");
                    $stmt3->bindParam(':tag', $tag);
                    $stmt3->execute();
                    $tagInsertedId = $stmt->fetch(PDO::FETCH_ASSOC); //$thisId['LAST_INSERT_ID()']

                    array_push($listIds, $tagInsertedId['LAST_INSERT_ID()']);
                    $stmt3 = null;
                }
                foreach ($listIds as $tagid) {
                    $stmt4 = $connection->prepare("
                        INSERT INTO `group_tags`
                            (`group_id`, `tag_id`)
                        VALUES
                            (:grid,:tagid");
                    $stmt4->bindParam(':grid', $groupInsertedId);
                    $stmt4->bindParam(':tagid', $tagid);
                    $stmt4->execute();
                    $count2 = $stmt4->rowCount();
                    $stmt4 = null;
                }
                
                
            }

            if ($count > 0 && $count2 > 0){
                echo 'created';
            }
            $connection = null;
        }
        catch(PDOException $e) {
        }
    }
    else if(isset($receive->edit_name)){
        $stmt = $connection->prepare("
            UPDATE `group`
            SET `name`=:grn; `category`=:grc; `description`=:grdesc; `tags`=:grtags; `picture`=:grpic; `group_country`=:grcountry; `group_city`=:group_city
            WHERE `id` = :grID;");
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
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo($result);#TODO detach mysql with keys

        $connection = null;
        $stmt = null;
    }
    else if(isset($receive->filtered_by)){
        try{
            if ($receive->filtered_by === "city"){
                $stmt = $connection->prepare("
                    SELECT `name`,`category`,`description`,`picture`,`group_country`,`group_city`,`submitdate`
                    FROM `group`
                    WHERE `group_city` = :grCity");
                $stmt->bindParam(':grCity', $receive->filtered_val);

                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo($result);#TODO detach mysql with keys

                $connection = null;
                $stmt = null;
                
            }
            else if($receive->filtered_by === "country"){
                $stmt = $connection->prepare("
                    SELECT `name`,`category`,`description`,`picture`,`group_country`,`group_city`,`submitdate`
                    FROM `group`
                    WHERE `group_country` = :grCountry");
                $stmt->bindParam(':grCountry', $$receive->filtered_val);
                // $receive->filtered_val
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($result); $i++) { 
                    $return[$i] = [
                        "name"    => $result[$i]["name"],
                        "cat"     => $result[$i]["category"],
                        "desc"    => $result[$i]["description"],
                        "pic"     => $result[$i]["picture"],
                        "country" => $result[$i]["group_country"],
                        "city"    => $result[$i]["group_city"],
                        "submit"  => $result[$i]["submitdate"],
                    ];
                }
                echo(json_encode($return));

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
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($result); $i++) { 
                    $return[$i] = [
                        "name"    => $result[$i]["name"],
                        "cat"     => $result[$i]["category"],
                        "desc"    => $result[$i]["description"],
                        "pic"     => $result[$i]["picture"],
                        "country" => $result[$i]["group_country"],
                        "city"    => $result[$i]["group_city"],
                        "submit"  => $result[$i]["submitdate"],
                    ];
                }
                echo(json_encode($return));

                $connection = null;
                $stmt = null;
            }
            else if($receive->filtered_by === "created"){
                $stmt = $connection->prepare("
                        SELECT `name`,`category`,`description`,`picture`,`group_country`,`group_city`,`submitdate`
                        FROM `group`
                        ORDER BY `submitdate` DESC");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // echo($result);#TODO detach mysql with keys

                    for ($i=0; $i < count($result); $i++) { 
                        $return[$i] = [
                            "name"    => $result[$i]["name"],
                            "cat"     => $result[$i]["category"],
                            "desc"    => $result[$i]["description"],
                            "pic"     => $result[$i]["picture"],
                            "country" => $result[$i]["group_country"],
                            "city"    => $result[$i]["group_city"],
                            "submit"  => $result[$i]["submitdate"],
                        ];
                    }
                    echo(json_encode($return));

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
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                for ($i=0; $i < count($result); $i++) { 
                    $return[$i] = [
                        "name"    => $result[$i]["name"],
                        "cat"     => $result[$i]["category"],
                        "desc"    => $result[$i]["description"],
                        "pic"     => $result[$i]["picture"],
                        "country" => $result[$i]["group_country"],
                        "city"    => $result[$i]["group_city"],
                        "submit"  => $result[$i]["submitdate"],
                    ];
                }
                echo(json_encode($return));

                $connection = null;
                $stmt = null;
            }
            else if($receive->filtered_by === "default"){
                $stmt = $connection->prepare("
                        SELECT `name`,`category`,`description`,`picture`,`group_country`,`group_city`,`submitdate`
                        FROM `group`");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    for ($i=0; $i < count($result); $i++) { 
                        $return[$i] = [
                            "name"    => $result[$i]["name"],
                            "cat"     => $result[$i]["category"],
                            "desc"    => $result[$i]["description"],
                            "pic"     => $result[$i]["picture"],
                            "country" => $result[$i]["group_country"],
                            "city"    => $result[$i]["group_city"],
                            "submit"  => $result[$i]["submitdate"],
                        ];
                    }
                    echo(json_encode($return));
    
                    $connection = null;
                    $stmt = null;
            }
        }
        catch(PDOException $e) {
        }
        
        
    }
    
    
    
?>