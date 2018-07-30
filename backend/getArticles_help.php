<?php

// CREATE TABLE `help_articles`(
//     `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     `author_id` VARCHAR(11) NOT NULL,
//     `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
//     `title` VARCHAR(100) NOT NULL,
//     `content` VARCHAR(1500) NOT NULL,
//     `kind` VARCHAR(25) NOT NULL,
//     `sticky` TINYINT(1) NOT NULL,
//     `parent_article_id` INT(11) NULL,
//     `password` VARCHAR(4) NULL,
//     `hits` INT(11) NOT NULL DEFAULT 0,
//     `tags` VARCHAR(250) NULL,
//     `files` VARCHAR(500) NULL,
// );

//This php file will give 
//                    data for 3 cases!!!
//1)(Bullutine board) To display a bullutine board.
//2)(Search bar) To get all searched articles according to a user's request. 
//3)(A article to read) To display the article which a user clicked on.

//$wantedArticles:
// Bullutine board => "all"
// Read an article => "(id)"; Number!! 
// search => json; '{"tag"/"author_id"/"content", "value/array"}'




$requiredArticles = file_get_contents("php://input");

$result = "";

if(isset($requiredArticles)){
    try{

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "weventory";

        $dataConn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        if($requiredArticles === "all"){
            //$newArr => the array to store all articles in a proper order!
            //           the order of ancestor articles and their child articles!
            $newArr = [];
            $stmt_0 = $dataConn->prepare("SELECT `id`, `date`, `author_id`, `title`, `hits`, `sticky`, 
            `kind`, `password`
            FROM `help_articles` WHERE `parent_article_id` IS NULL AND `sticky`= 1;");

            $stmt_0->execute();

            $stickyArticles = $stmt_0->fetchAll(PDO::FETCH_ASSOC);
            $newArr = array_merge($newArr, $stickyArticles);

            $stmt_1 = $dataConn->prepare("SELECT `id`, `date`, `author_id`, `title`, `hits`, `sticky`, 
            `kind`, `password`
            FROM `help_articles` WHERE `parent_article_id` IS NULL AND `sticky`!= 1;");

            $stmt_1->execute();

            $parentArticles = $stmt_1->fetchAll(PDO::FETCH_ASSOC);

            for($i = 0; $i < count($parentArticles); $i++){
                $thisParentArticle = $parentArticles[$i];
                array_push($newArr, $thisParentArticle);
                $thisParentArticleId = $thisParentArticle["id"];

                $stmt_2 = $dataConn -> prepare("SELECT (`id`, `date`, `author_id`, `title`, `hits`, `sticky`, 
                `kind`, `password`
                FROM `help_articles` WHERE `parent_article_id`=:parent_article_id;");
                
                $stmt_2->bindParam(":parent_article_id", $thisParentArticleId);
                $stmt_2->execute();

                $child_articles = $stmt_2->fetchAll(PDO::FETCH_ASSOC);

                if(count($child_articles)!== 0){
                    for($k = 0; $k < count($child_articles); $k++){
                        array_push( $newArr, $child_articles[$k]);
                    }
                }
            }
 
            $result = json_encode($newArr);
            
        }else{
            $id = $requiredArticles;
            $stmt_3 = $dataConn->prepare("SELECT `id`, `date`, `author_id`, `title`, `hits`, `sticky`, 
            `kind`, `password`
            FROM `help_articles` WHERE `id` = :id;");

            $stmt_3->bindParam(":id", $id);
            $stmt_3->execute();

            $requiredArticle = $stmt_3->fetchAll(PDO::FETCH_ASSOC);
        
            $result = json_encode($requiredArticle);
        }    

    }catch(PDOException $e){
        $result = "ERORR: PDO Exception.";
    }

}else{
    $result = "ERORR: Failed to get the order from front-end.";
}

echo $result;





?>