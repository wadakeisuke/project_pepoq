<?php
session_start();
//全ての友達の数
$w_friend='all';
$ac_email=$_SESSION['mypage']['email'];
$sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend',$w_friend);
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$count=$sql->rowCount();
$f_all_num=$count;
$_SESSION['friend_all_num'] = $f_all_num;
//友達リクエストの数
$w_friend='request';
$ac_email=$_SESSION['mypage']['email'];
$sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend',$w_friend);
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$count=$sql->rowCount();
$f_request_num=$count;
$_SESSION['friend_new_num'] = $f_request_num;

//友達のタイプ毎の数を取得
$array=array('家族','恋人','小・中学校','高校','大学・専門','勤務先','その他',);
$f_type_num=array();//初期化
$i=0;
while(count($array)>$i){
  $sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email AND relation=:relation');
  $sql->bindValue(':w_friend','all');
  $sql->bindValue(':ac_email',$ac_email);
  $sql->bindValue(':relation',$array[$i]);
  $sql->execute();
  $f_num=$sql->rowCount();
  array_push($f_type_num,$f_num);
  $i++;
}
$_SESSION['friend_type_num'] = $f_type_num;
