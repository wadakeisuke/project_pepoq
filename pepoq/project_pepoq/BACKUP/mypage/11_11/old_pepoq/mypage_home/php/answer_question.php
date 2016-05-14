<?php
session_start();
require('./db_connect.php');
$question_id = htmlspecialchars($_POST['question_id'],ENT_QUOTES,'UTF-8');
$email = $_SESSION['mypage']['email'];
$answer = htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8');

$sql = $pdo -> prepare("INSERT INTO answer (question_id, email, answer) VALUES (:question_id, :email, :answer)");
$sql->bindValue(':question_id', $question_id);
$sql->bindValue(':email', $email);
$sql->bindValue(':answer', $answer);
$sql->execute();

header('Location: ../single_question.php?question_id='.$question_id);
exit();
