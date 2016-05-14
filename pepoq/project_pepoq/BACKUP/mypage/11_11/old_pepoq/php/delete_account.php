<?php
session_start();
$pdo = require('../php/db_connect.php');

//session(login)した人のemail password
$email = $_SESSION['mypage']['email'];
$password = $_SESSION['mypage']['password'];
//postをサニタイジング

try{
  //DB acountを削除
  $sql = $pdo -> prepare('UPDATE acount SET password = "" WHERE email = :email AND password = :password');
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();

  //DB personal_dataを削除
  $sql = $pdo->prepare('DELETE FROM personal_data WHERE email = :email AND password = :password');
  $sql->execute(array(':email'=>$email, ':password'=>$password,));

  //DB friendsを削除
  $sql = $pdo->prepare('DELETE FROM friends WHERE accepter_email = :email AND accepter_password = :password');
  $sql->execute(array(':email'=>$email, ':password'=>$password,));
  $sql = $pdo->prepare('DELETE FROM friends WHERE sender_email = :email AND sender_password = :password');
  $sql->execute(array(':email'=>$email, ':password'=>$password,));

  //DB questionを削除
  $sql = $pdo->prepare('DELETE FROM question WHERE accepter_email=:email');
  $sql->execute(array(':email'=>$email,));
  $sql = $pdo->prepare('DELETE FROM question WHERE sender_email=:email');
  $sql->execute(array(':email'=>$email,));

  $pdo = null;
  header('Location: ../../index.php');
  exit();
}catch(PDOException $e){
  echo('Error'.$e->getMessage());
  die();
}