<?php
    include 'functions.php';
    require '../setup.php';

    session_start();

    // Used globally.
    $user_login = "";
    $user_id = "";

    // Check to see if the session exists in the session cookie.
    function checkSession($redirect = False) {
        global $connection,
            $user_login,
            $user_id,
            $servername,
            $dbname,
            $username,
            $password;

        $user_login = "";
        $user_id = "";

        if (isset($_SESSION['session'])){
            try{
                // Get the client ip address (functions.php).
                $currentIp = get_client_ip_server();

                // Hash the current client IP with the cookie session value.
                $hashWithIp = hash('sha256', $currentIp . $_SESSION['session']);

                $stmt = $connection->prepare("
                    SELECT `user_id`, `user_login`, `password`, `session_id`, `expir_date`
                    FROM `sessions`
                    WHERE `session_id`=:sesn AND `expir_date`>NOW();");
                $stmt->bindParam(':sesn', $hashWithIp);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                // The $user_login can be a string (if found) or False (not found).
                if (isset($result['user_login'])) {
                    $user_login = $result['user_login'];
                    $user_id = $result['user_id'];
                }
            }
            catch(PDOException $e){
                // TODO: What if an error?
            }
        }

        if ($user_login === "" && $redirect) {
            header("Location: ../templates/login.php");
        }
    }
?>