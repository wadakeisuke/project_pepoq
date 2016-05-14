<?php
try{
  //login DB personal_data　を取得
  $sql=$pdo->prepare('SELECT * FROM personal_data WHERE email = :email AND password = :password');
  $sql->bindValue(':email',$_SESSION['login']['email']);
  $sql->bindValue(':password',$_SESSION['login']['password']);
  $sql->execute();
  //mypageのpersonal_dataをsessionに保存 
  if($data=$sql->fetch(PDO::FETCH_ASSOC)){
    $_SESSION['mypage'] = $data;
  }
}catch(PDOException $e){
  echo('Error'.$e->getMessage());
  die();
}