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
    header('Location: ../signup/thanks/thanks/thanks.html');
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
// email, password, thumbnail, name, comment, sex, age, blood_type, settlement, school, job, place_of_work, hobby, special_skill, my_boom, dream, favorite_sports, favolite_singer, favorite_book, favorite_movie, favorite_animation
// :email, :password, :thumbnail, :name, :comment, :sex, :age, :blood_type, :settlement, :school, :job, :place_of_work, :hobby, :special_skill, :my_boom, :dream, :favorite_sports, :favorite_singer, :favorite_book, :favorite_movie, :favorite_animation)');
  $sql->bindValue(':email', $email);
  //personla_dataの追加
  $sql = $pdo -> prepare('INSERT INTO personal_data (email, password, thumbnail, name, comment, sex, age, blood_type, settlement, school, job, place_of_work, hobby, special_skill, my_boom, dream, favorite_sports, favorite_singer, favorite_book, favorite_movie, favorite_animation) VALUES (:email, :password, :thumbnail, :name, :comment, :sex, :age, :blood_type, :settlement, :school, :job, :place_of_work, :hobby, :special_skill, :my_boom, :dream, :favorite_sports, :favorite_singer, :favorite_book, :favorite_movie, :favorite_animation)');
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->bindValue(':thumbnail', 'thumbnail.jpg');
  $sql->bindValue(':name', $name);
  $sql->bindValue(':comment', $value);
  $sql->bindValue(':sex', $value);
  $sql->bindValue(':age', $value);
  $sql->bindValue(':blood_type', $value);
  $sql->bindValue(':settlement', $value);
  $sql->bindValue(':school', $value);
  $sql->bindValue(':job', $value);
  $sql->bindValue(':place_of_work', $value);
  $sql->bindValue(':hobby', $value);
  $sql->bindValue(':special_skill', $value);
  $sql->bindValue(':my_boom', $value);
  $sql->bindValue(':dream', $value);
  $sql->bindValue(':favorite_sports', $value);
  $sql->bindValue(':favorite_singer', $value);
  $sql->bindValue(':favorite_book', $value);
  $sql->bindValue(':favorite_movie', $value);
  $sql->bindValue(':favorite_animation', $value);
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
