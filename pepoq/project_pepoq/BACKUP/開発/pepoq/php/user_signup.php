<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
require('../php/sanitize/sanitize.php');

$signup = isset($_POST['signup'])?'signup':null;

if($signup === 'signup') {
  $name = h($_POST['nickname']);
  $email = h($_POST['email']);
  $password = h($_POST['password']);
  $password = password_hash($password);
  check_already_signup($email);
  if($email && $password) {
    signup($name, $email, $password);
    header('Location: ../signup/thanks/demo2/demo2.html');
    exit();
  }
  header('Location: ../signup/signup/signup.php?signup=error');
  exit;
}

function password_hash($password){
  for($num = 0; $num < 1000; $num++){
    $password = sha1($password);
    $password = md5($password);
  }
  return $password;
}

function signup($name, $email, $password)
{
  $email;
  $password;
  $created = date('Y-m-d H:i:s');
  $rand_num = rand(1,20);
  $value = '--';

  require('../php/db_connect.php');

  //acountの追加
  $sql = $pdo->prepare('INSERT INTO acount (name, email, password, created) VALUES (:name, :email, :password, :created)');
  $sql->bindValue(':name', $name);
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

  $_SESSION['mypage']['email'] = $email;
}

/**
 * 既に登録されていないか調べる
 * @param string $email
 */
function check_already_signup($email)
{
    require('../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM acount WHERE email = :email');
    $sql->bindValue(':email', $email);
    $sql->execute();
    if($data = $sql->fetch(PDO::FETCH_ASSOC)){
      header('Location: ../signup/signup.php?signup=error');
      exit();
    }
}
