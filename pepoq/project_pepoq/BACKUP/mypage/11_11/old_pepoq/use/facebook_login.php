<?php
//Facebook SDK for PHP の src/ にあるファイルを
//サーバ内の適当な場所にコピーしておく
require_once("facebook.php");
$config = array(
    'appId'  => '1591688234429114',
    'secret' => 'b89c0b2fd7c4d628331967e1ecf14eea'
);
 
$facebook = new Facebook($config);

$loginUrl = $facebook->getLoginUrl();
echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
$userId = $facebook->getUser();

$params = array('redirect_uri' => 'aaa.php');
$loginUrl = $facebook->getLoginUrl($params);
$user = $facebook->api('/me', 'GET');
print_r($user);
?>