<?php
session_start();
$_SESSION = array();
if(isset($_COOKIE['PHPSESSID'])){
	setcookie('PHPSESSID','',time() - 1800,'/');
}
session_destroy();
header('Location: ../pepoq/m.pepoq/top/top.php');
exit();