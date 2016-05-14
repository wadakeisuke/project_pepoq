<?php
session_start();
$signup = (isset($_POST['signup']))?'signup':null;
if($signup === 'signup'){
  $first_name=htmlspecialchars($_POST['firstname'],ENT_QUOTES,'UTF-8');
  $last_name=htmlspecialchars($_POST['lastname'],ENT_QUOTES,'UTF-8');
  $name = $first_name.' '.$last_name;
  $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
  $password=htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');
  for($num = 0; $num < 1000; $num++){
    $password = sha1($password);
    $password = md5($password);
  }
  if($first_name && $last_name && $email && $password){
    alreadySignup($email);
    signup($first_name, $last_name, $name, $email, $password);
  }else{
    header('Location: ../confirm/confirm.php?signup=error');
    exit();
  }
}
function signup($first_name, $last_name, $name, $email, $password)
{
  $first_name;
  $last_name;
  $email;
  $password;
  $created = date('Y-m-d H:i:s');
  $rand_num = rand(1,20);
  $value = '--';

  $pdo = require('../../php/db_connect.php');

  //acountの追加
  $sql = $pdo -> prepare('INSERT INTO acount (first_name, last_name, email, password, created) VALUES (:first_name, :last_name, :email, :password, :created)');
  $sql->bindValue(':first_name', $first_name);
  $sql->bindValue(':last_name', $last_name);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->bindValue(':created', $created);
  $sql->execute();

  //personla_dataの追加
  $sql = $pdo -> prepare('INSERT INTO personal_data (email, password, thumbnail, background, name, comment, country, come_from, age, birthday, educational_background, works, lover, singer, writer, movie, twitter, facebook, instagram, google_plus) VALUES (:email, :password, :thumbnail, :background, :name, :comment, :country, :come_from, :age, :birthday, :educational_background, :works, :lover, :singer, :writer, :movie, :twitter, :facebook, :instagram, :google_plus)');
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->bindValue(':thumbnail', 'thumbnail.jpg');
  $sql->bindValue(':background', 'background'.$rand_num.'.jpg');
  $sql->bindValue(':name', $name);
  $sql->bindValue(':comment', $value);
  $sql->bindValue(':country', $value);
  $sql->bindValue(':come_from', $value);
  $sql->bindValue(':age', $value);
  $sql->bindValue(':birthday', $value);
  $sql->bindValue(':educational_background', $value);
  $sql->bindValue(':works', $value);
  $sql->bindValue(':lover', $value);
  $sql->bindValue(':singer', $value);
  $sql->bindValue(':writer', $value);
  $sql->bindValue(':movie', $value);
  $sql->bindValue(':twitter', $value);
  $sql->bindValue(':facebook', $value);
  $sql->bindValue(':instagram', $value);
  $sql->bindValue(':google_plus', $value);
  $sql->execute();

  header('Location: ../thanks/thanks.php');
  exit();
}
/**
* alreadySignup method 既にサインアップされていた場合
**/
function alreadySignup($email)
{
  try{
    $pdo = require('../../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM acount WHERE email = :email');
    $sql->bindValue(':email', $email);
    $sql->execute();
    if($data = $sql->fetch(PDO::FETCH_ASSOC)){
      header('Location: ../confirm/confirm.php?signup=error');
      exit();
    }
  }catch(Exception $e){
    header('Location: ../top/top.php');
    exit();
  }
}
