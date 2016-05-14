<?php
session_start();
$email = $_SESSION['mypage']['email'];
$question = htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8');
if(empty($question)){
	header('Location: ../new_question/new_question.php');
	exit;
}
include('../php/db_connect.php');
$sql = $pdo -> prepare("INSERT INTO question (anonymity, email, question) VALUES (:anonymity, :email, :question)");
if($_POST['anonymity']){
	$sql->bindValue(':anonymity', 'anonymity');
	$sql->bindValue(':email', $email);
	$sql->bindValue(':question', $question);
	$sql->execute();
}else{
	$sql->bindValue(':anonymity', 'register');
	$sql->bindValue(':email', $email);
	$sql->bindValue(':question', $question);
	$sql->execute();
}
header('Location: ../mypage/index.php');
exit();
