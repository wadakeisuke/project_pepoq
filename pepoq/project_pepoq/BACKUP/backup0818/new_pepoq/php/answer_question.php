<?php
session_start();
include('../php/db_connect.php');
$question_id = htmlspecialchars($_POST['question_id'],ENT_QUOTES,'UTF-8');
$email = $_SESSION['mypage']['email'];
$answer = htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8');
$question = $answer;
if(empty($answer)){
	header('Location: ../mypage/single_question.php?question_id='.$question_id);
	exit;
}
$sql = $pdo -> prepare("INSERT INTO answer (anonymity, question_id, email, answer) VALUES (:anonymity, :question_id, :email, :answer)");

$sql->execute();
if($_POST['anonymity']){
	$sql->bindValue(':anonymity', 'anonymity');
	$sql->bindValue(':question_id', $question_id);
	$sql->bindValue(':email', $email);
	$sql->bindValue(':answer', $answer);
	$sql->execute();
}else{
	$sql->bindValue(':anonymity', 'register');
	$sql->bindValue(':question_id', $question_id);
	$sql->bindValue(':email', $email);
	$sql->bindValue(':answer', $answer);
	$sql->execute();
}

$sql = $pdo -> prepare("INSERT INTO answer (anonymity, email, question) VALUES (:anonymity, :email, :question)");
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
header('Location: ../mypage/single_question.php?question_id='.$question_id);
exit();
