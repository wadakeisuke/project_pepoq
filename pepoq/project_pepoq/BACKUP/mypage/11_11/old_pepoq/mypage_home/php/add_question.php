<?php
session_start();
$email = $_SESSION['mypage']['email'];
$question = htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8');
require('./db_connect.php');
$sql = $pdo -> prepare("INSERT INTO question (email, question) VALUES (:email, :question)");
$sql->bindValue(':email', $email);
$sql->bindValue(':question', $question);
$sql->execute();

header('Location: ../index.php');
exit();
