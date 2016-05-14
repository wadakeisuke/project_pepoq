<?php
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');

//require ('../not_login.php');
if(isset($_POST['delete'])){
  $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
  $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
  for($num=0;$num<1000;$num++){
    $password = sha1($password);
    $password = md5($password);
  }
  check_email_and_password($email, $password);
}

function check_email_and_password($email, $password)
{
  $pdo = require('../../php/db_connect.php');
  $sql = $pdo->prepare('SELECT * FROM acount WHERE email = :email AND password = :password');
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
  if($data = $sql->fetch(PDO::FETCH_ASSOC)){
    header('Location: ../../php/delete_account.php');
    exit();
  }else{
    header('Location: ../delete/delete_account.php?delete=error');
    exit();
  }
}
try{
  $pdo=require('../../php/db_connect.php');
  //login DB personal_data　を取得
  $stmt=$pdo->prepare('SELECT * FROM personal_data WHERE email = :email AND password = :password');
  $stmt->bindValue(':email',$_SESSION['login']['email']);
  $stmt->bindValue(':password',$_SESSION['login']['password']);
  $stmt->execute();
  //mypageのpersonal_dataをsessionに保存 
  if($data=$stmt->fetch(PDO::FETCH_ASSOC)){
    $_SESSION['mypage'] = $data;
  }
}catch(PDOException $e){
  echo('Error'.$e->getMessage());
  die();
}
$w_friend='request';
$ac_email=$_SESSION['mypage']['email'];
$sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend',$w_friend);
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$count=$sql->rowCount();
$f_request_num=$count;

$w_friend='all';
$ac_email=$_SESSION['mypage']['email'];
$sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend',$w_friend);
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$count=$sql->rowCount();
$f_all_num=$count;

$array=array('家族','恋人','小・中学校','高校','大学・専門','勤務先','その他',);
$f_type_num=array();//初期化
$i=0;
while(count($array)>$i){
  $sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email AND relation=:relation');
  $sql->bindValue(':w_friend',$w_friend);
  $sql->bindValue(':ac_email',$ac_email);
  $sql->bindValue(':relation',$array[$i]);
  $sql->execute();
  $f_num=$sql->rowCount();
  array_push($f_type_num,$f_num);
  $i++;
}
//新しい質問の数
$sql=$pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type','new');
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$new_question_num=$sql->rowCount();


?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>popoQ</title>
<!--font awesome--><link rel="stylesheet" href="style/css/font-awesome.min.css">  
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../mypage/style/css/drawer.css">
<link rel="stylesheet" href="style/css/new_question.css">
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../style/js/jquery.leanModal.min.js"></script>
<script type="text/javascript" src="../../style/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
  $.backstretch("../../img/background/<?php echo($_SESSION['mypage']['background']); ?>");
</script>
<!--begin ポップアップウィンドウ-->
<script type="text/javascript">
$(function() {
    $( 'a[rel*=leanModal]').leanModal({
        top: 50,                     // モーダルウィンドウの縦位置を指定
        overlay : 0.7,               // 背面の透明度 
        closeButton: ".modal_close",  // 閉じるボタンのCSS classを指定
    });
}); 
</script><!--end ポップアップウィンドウ-->
<!--position fixed and static-->
<script>
$(document).ready(function() {
    $('.click').click(function() {
        $("#page_all")
        .css('position','fixed')
        //.siblings()
        //.css('backgroundColor','#ffffff');
        $('.modal_close').removeAttr('disabled');
        //$('#number').removeAttr('disabled');
    });
});
</script>

<script>
$(document).ready(function() {
    $('.modal_close').click(function() {
        $("#page_all")
        .css('position','static')
        //.siblings()
        //.css('backgroundColor','#ffffff');
        $('.modal_close').removeAttr('disabled');
        //$('#number').removeAttr('disabled');
    });
});
</script>
<style type="text/css">

</style>
</head>

<body>
<!--begin page_all-->
<div id="page_all">
<div id="content" class="snap-content">
  <!--begin header-->
<!--begin header-->
<?php require('../mypage/header.php'); ?>
<!--end header-->
<div class="delete_content">
<div class="fbox">
  <div class="delete_alert">
    <span>アカウントの削除</span>
    <p>アカウントを削除すると友達からもらったコメントや質問、あなたのコメントや質問が消えてしまいます。</p>
    <p>アカウントが削除されると、ご登録されたメールアドレスで別のアカウントを作成することはできません。</p>
    <p>アカウントを削除しますか？</p>
  </div>
  <div id="login">
    <form action="../delete/delete_account.php" method="post">
      <input name="check" class=".checkbox" type="checkbox" value="ok" autocomplete="off" required>　<small>ok</small><br>
      <input name="email" class="form" type="email" placeholder="Email" required><br>
      <input name="password" class="form" type="password" placeholder="Password" required><br>
      <input name="delete" type="submit" value="delete"><!--アカウント削除のinput-->
    </form>
  </div>
</div>

</div><!--end page_all-->

<script src="../../style/js/iscroll-min.js"></script>
<script src="../../style/js/jquery.drawer.js"></script>
<script src="../../style/js/side_menu.js"></script> 
</body>
</html>