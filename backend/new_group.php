<?php
    include 'functions.php';

    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'weventory'; 
    
    if (isset($receive->group_name)){
        try{
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $stmt = $connection->prepare("
                INSERT INTO `group`
                    (`name`,`category`,`description`,`tags`,`picture`,`group_country`, `group_city`)
                VALUES
                    (:grn,:grc,:grdesc,:grtags,:grpic,:grcountry,:group_city);");
            $lowerCase = strtolower($receive->group_name);
            $stmt->bindParam(':grn', $lowerCase);
            $stmt->bindParam(':grc', $receive->group_category);
            $stmt->bindParam(':grdesc', $receive->group_description);
            $stmt->bindParam(':grtags', $receive->group_tags);
            $stmt->bindParam(':grpic', $receive->gruop_pic);
            $stmt->bindParam(':grcountry', $receive->group_country);
            $stmt->bindParam(':group_city', $receive->group_city);
            
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
    else if(isset($receive->edit_group)){

    }
    else if(isset($receive->filtered_by)){
        try{
            if ($receive->filtered_by === "city"){
                $receive->filtered_val;
                $connection = new PDO("mysql:host=$servername;dbname=$dbname,$username,$password");
                $stmt = $connection->prepare("
                    SELECT *
                    FROM `group`
                    WHERE `group_city` = :grCity");
                $stmt->bindParam(':grCity', $receive->filtered_val);

                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);


                $connection = null;
                $stmt = null;
                
            }
        }
        else if($receive->filtered_by === "country"){
                $stmt->bindParam(':grCountry', $$receive->filtered_val);
                $receive->filtered_val
        }
        else if($receive->filtered_by === "popularity"){
            $receive->filtered_val
        }
        else if($receive->filtered_by === "created"){
            $receive->filtered_val
        }
        else if($receive->filtered_by === "tags"){
            $receive->filtered_val
        }
        else if($receive->filtered_by === "default"){
            $receive->filtered_val
        }
    }
    
    
    
?>