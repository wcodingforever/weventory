<?php

    require '../setup.php';

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
$jsonObj = null;

if ($requiredArticles !== "") $jsonObj = json_decode($requiredArticles);

$result = "";

if ($jsonObj !== null) {
    try {
        //To create a bullutine board, send only data of needed cols! 
        if ($jsonObj->type === "id") {
            $id = $jsonObj->id;
            $stmt_3 = $connection->prepare("SELECT `id`, `date`, `author_id`, `title`, `hits`, `sticky`, 
            `kind`, `password`, `content`, `tags`, `files`
            FROM `help_articles` WHERE `id` = :id;");

            $stmt_3->bindParam(":id", $id);
            $stmt_3->execute();

            $result = $stmt_3->fetch(PDO::FETCH_ASSOC);
        }

    } catch(PDOException $e) {
        $result = "ERORR: PDO Exception.";
    }

} else {
    $result = "ERORR: Failed to get the order from front-end.";
}

echo json_encode($result);

?>