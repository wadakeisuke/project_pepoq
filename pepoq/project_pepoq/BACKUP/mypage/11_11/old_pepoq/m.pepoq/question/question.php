<?php
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');

//require ('../not_login.php');
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
<?php
require('../mypage/header.php');
?>
<!--end header-->

<!--begin upper_content-->
<div id="upper_content" class="centered">
<?php
//新しい質問の内容
$question=array();
$sql=$pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type','new');
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$i;
while($data=$sql->fetch(PDO::FETCH_ASSOC)){
echo '
<div class="fbox">
    <div class="ballon-item">
      <div class="question_item">
        <p>'.$data['question'].'</p>
      </div>
    </div>
      <div class="details" style="text-align:center;">
      <a id="go" class="click" rel="leanModal" href="#edit_question'.$i.'">    
        <div class="link_edit">    
          <span class="meta-nav-prev"><i class="fa fa-pencil-square"></i>Edit your Question</span>
        </div>
      </a>
    </div>
</div>


<div id="edit_question'.$i.'" class="popup_window">
  <div class="edit_format">
    <a class="modal_close" href="javascript:void(0)"></a>
    <div class="ballon">
      <div class="ballon-item">
          <p>'.$data['question'].'</p>
      </div>
      <form class="ballon_edit_box"method="post" action="../php/m.question_edit.php">
        <textarea class="fr_question_textarea"name="answer"></textarea>   
        <input name="question_id" type="hidden" value="'.$data['id'].'">
        <button class="add_btnq"><i class="fa fa-user-plus">answer</i></button>
        <input name="delete_id" type="hidden" value="'.$data['id'].'">
        <button class="add_btnq"><i class="fa fa-user-plus">delete</i></button>
      </form>
    </div>
  </div>
</div>
';
$i++;
}
?>
</div><!--end upper_content-->

</div><!--end page_all-->

<script src="../../style/js/iscroll-min.js"></script>
<script src="../../style/js/jquery.drawer.js"></script>
<script src="../../style/js/side_menu.js"></script> 
</body>
</html>