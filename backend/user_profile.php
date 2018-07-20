<?php
    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $toSend = array(
        'user_login'=>'login',
        'password'=>'pswrd',
        'thisFirstName'=>'first name',
        'thisLastName'=>'last name',
        'b_day'=>'bday',
        'thisEmail'=>'email',
        'thisBio'=>'a bit more infoa bit more infoa bit more infoa bit more infoa bit more info',
        'thisPic'=>'picLINK'
    );
    echo(JSON_encode($toSend));

?>