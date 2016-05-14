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

//$params = array('redirect_uri' => 'http://standby.sakura.ne.jp/SB/m.sb/top/top.php');
//$loginUrl = $facebook->getLoginUrl($params);
$user = $facebook->api('/me', 'GET');
		if (isset($user)) {
			//ログイン済みでユーザー情報が取れていれば表示
			echo '<pre>';
			print_r($user);
			echo '</pre>';
		} else {
			//未ログインならログイン URL を取得してリンクを出力
			$loginUrl = $facebook->getLoginUrl();
			echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
		}
?>