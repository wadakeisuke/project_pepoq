<?php
session_start();

$email = isset($_SESSION['login']['email'])?$_SESSION['login']['email']:null;
$password = isset($_SESSION['login']['password'])?$_SESSION['login']['password']:null;

if(!isset($email) || !isset($password)){
	header('Location: ../top/top.php');
	exit;
}
