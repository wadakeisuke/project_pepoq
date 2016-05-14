<?php
session_start();

ini_set( 'display_errors', 1 );

//loginがクリックされた場合
$login = (isset($_POST['login']))?$_POST['login']:null;

if($login === 'ログイン'){
  $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
  $password=htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');

  for($num=0;$num<1000;$num++){
    $password = sha1($password);
    $password = md5($password);
  }
  if($email && $password){
    login($email, $password);
  }else{
    header('Location: ../login/login.php?login=error');
    exit();
  }  
}
function login($email, $password)
{
  try{
    $pdo = require('../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM acount WHERE email=:email AND password=:password');
    $sql->bindValue(':email',$email);
    $sql->bindValue(':password',$password);
    $sql->execute();
    if($data = $sql->fetch(PDO::FETCH_ASSOC)){
      $_SESSION['login']['email'] = $email;
      $_SESSION['login']['password'] = $password;
      header('Location: ../mypage/timeline/index.php');
      exit();
    }else{
      header('Location: ../login/login.php?login=error');
      exit();
    }
  }catch(Exception $e){
    echo('Error'.$e->getMessage());
    exit();
  }
}