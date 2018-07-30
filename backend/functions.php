<?php
// If the function com_create_guid() exists, it will use it. Otherwise it will generate its own using random numbers.
function GUID(){
    if (function_exists('com_create_guid') === true){
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function get_client_ip_server() {
    $ipaddress = '';
    // if ($_SERVER['HTTP_CLIENT_IP'])
    //     $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    // else if($_SERVER['HTTP_X_FORWARDED_FOR'])
    //     $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    // else if($_SERVER['HTTP_X_FORWARDED'])
    //     $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    // else if($_SERVER['HTTP_FORWARDED_FOR'])
    //     $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    // else if($_SERVER['HTTP_FORWARDED'])
    //     $ipaddress = $_SERVER['HTTP_FORWARDED'];
    // else
    if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];

    return $ipaddress;
}

// Use the geoplugin API to get location (country, city).
// TODO: Reconnect after deployment on remote server to get valid IP addresses.
function get_client_location(){
    // $ipaddress = get_client_ip_server();
    // $ipaddress = getenv('REMOTE_ADDR');
    // $ipaddress = $_SERVER['REMOTE_ADDR'];
    // $ipaddress = $_SERVER['HTTP_HOST'];
    // $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    // $json  = file_get_contents("http://www.geoplugin.net/php.gp?ip=$ipaddress");
    // $json  =  json_decode($json ,true);
    // $country =  $json['geoplugin_countryName'];
    // $city = $json['geoplugin_city'];
    // $location = array($country, $city);
    // return $location;
    return ["USA", "Chicago"];
    // var_dump($ipaddress);
}

// Generate 5 digit random PIN number for email validation.
function generatePIN($digits = 4){
    $i = 0;
    $pin = "";
    while($i < $digits){ // TODO: Or use mt_rand(1000, 9999);
        if($i === 0){
            $pin .= mt_rand(1, 9);
        }
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

//Haversine formula
// $stmt = $dbh->prepare("SELECT  name, lat, lng, ( 3959 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distance FROM mytable HAVING distance < ? ORDER BY distance LIMIT 0 , 20");
//     // Assign parameters
//     $stmt->bindParam(1,$center_lat);//lat coordinate of user
//     $stmt->bindParam(2,$center_lng);//lng coordinate of user
//     $stmt->bindParam(3,$center_lat);
//     $stmt->bindParam(4,$radius);//Radius in miles
// 
// UPDATE FOR UNIQUE KEY
// INSERT INTO AggregatedData (datenum,Timestamp)
// VALUES ("734152.979166667","2010-01-14 23:30:00.000")
// ON DUPLICATE KEY UPDATE 
// 
?>