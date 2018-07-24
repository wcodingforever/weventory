
<?php
// CREATE TABLE `help_articles`(
//     `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     `author_id` VARCHAR(11) NOT NULL,
//     `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() ,
//     `title` VARCHAR(100) NOT NULL,
//     `content` VARCHAR(1500) NOT NULL,
//     `kind` VARCHAR(25) NOT NULL,
//     `sticky` TINYINT(1) NOT NULL,
//     `parent_article_id`  INT(11) NULL,
//     `re_step` SMALLINT(2) NULL,  
//     `password` VARCHAR(4) NULL,
//     `hits` INT(11) NOT NULL,
//     `tags` VARCHAR(250) NULL,
//     `files` VARCHAR(500) NULL,
// )
//
// let obj = {
//     author_id: author_id,        
//     title: title,
//     password: password,
//     kind: kind,
//     content: content,
//     files: json_files,
//     tags: json_tags, 
// };

function convertData($input, $jsonOrNot = false){
    if($input === ""){
        return null;
    }else if($input === true){
        return 1;
    }else if($input === false){
        return 0;
    }
    else{
        if($jsonOrNot === true){
            return json_decode($input);
        }
    }
}


$json = file_get_contents("php://input");
$assArr = json_decode($json, true);

$author_id = $assArr["author_id"];
$title = $assArr["title"];
$content = $assArr["content"];
$kind = $assArr["kind"];
$sticky = convertData($assArr["sticky"]);
$parent_article_id = null;
$re_step = null;
$files = convertData($assArr["files"], true);
$password = convertData($assArr["password"]);
$tags = convertData($assArr["tags"], true);
$hits = 0;


if( $files === ""  ){

}

// $jAssoc[""]=>

// Mes





?>