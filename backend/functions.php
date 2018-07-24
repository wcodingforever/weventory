<?php 
function GUID(){
    if (function_exists('com_create_guid') === true){
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function get_client_location(){
    $PublicIP = get_client_ip(); 
    $json  = file_get_contents("https://freegeoip.net/json/$PublicIP");
    $json  =  json_decode($json ,true);
    $country =  $json['country_name'];
    $city = $json['city'];
    $lat = $json['latitude'];
    $lon = $json['longtitude'];
    $location = array($country, $city, $lat, $lon);
    return $location;
}
function generatePIN($digits = 4){
    $i = 0;
    $pin = "";
    while($i < $digits){
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
?>