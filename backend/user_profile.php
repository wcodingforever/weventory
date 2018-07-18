<?php
    $receiveMsg = file_get_contents("php://input");
    $receive = json_decode($receiveMsg);

    $toSend = array(
        'user_login'=>'login',
        'password'=>'pswrd',
        'f_name'=>'first name',
        'l_name'=>'last name',
        'b_day'=>'bday',
        'email'=>'email',
        'bio'=>'a bit more infoa bit more infoa bit more infoa bit more infoa bit more info',
        'pic'=>'picLINK'
    );
    echo(JSON_encode($toSend))

?>