<?php
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');

require ('../php/not_login.php');
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
<title>pepoQ</title>

<link rel="stylesheet" type="text/css" media="all" href="style/css/mypage.css">
<link rel="stylesheet" type="text/css" href="style/css/blue.css">
<link rel="stylesheet" type="text/css" media="all" href="style/css/friend_edit.php">
<!--box 移動-->
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<script src="../../style/js/jquery.hoverintent.r7.js"></script>
<script src="../../style/js/jquery.mnmenu.js"></script>
<script>
$(document).ready(function() {
  $('#idmenu').mnmenu();
})
</script>
<script type='text/javascript' src='../style/js/jquery.masonry.min.js'></script>
<script type='text/javascript' src='../style/js/masonry-style.js'></script>
<script src="../../style/js/jquery.leanModal.min.js" type="text/javascript"></script><!--commentedit-->
<!--box 移動-->
<!--背景画像-->
<script type="text/javascript" src="../../style/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
  $.backstretch("../../img/background/<?php echo($_SESSION['mypage']['background']); ?>");
</script>
<!--背景画像-->
<!--leanModal popupwindow (friend)-->
<script type="text/javascript">
$(function() {
    $( 'a[rel*=leanModal]').leanModal({
        top: 50,                     // モーダルウィンドウの縦位置を指定
        overlay : 0.7,               // 背面の透明度 
        closeButton: ".modal_close"  // 閉じるボタンのCSS classを指定
    });
}); 
</script>
<!--leanModal popupwindow (friend)-->
<style type="text/css">
.modal_close{ 
  position: absolute;
  top: 12px;
  right: 12px;
  display: block; 
  width: 14px;
  height: 14px; 
  z-index: 2;
  background-repeat: no-repeat;
  background-image:url(".././img/batu.gif");

}
</style>
<!--入力必須項目などのアラート-->
<script src="style/js/angular.min.js"></script>
<script language="javascript">
  angular.module("standby", [])
  .directive("match", ["$parse", function($parse) {
    return {
      require: 'ngModel',
        link: function(scope, elem, attrs, ctrl) {
          scope.$watch(function() {
            var target = $parse(attrs.match)(scope);  // 比較対象となるモデルの値
            return !ctrl.$modelValue || target === ctrl.$modelValue;
          }, function(currentValue) {
              ctrl.$setValidity('mismatch', currentValue);
            });
        }
    }
  }]);
</script>
<!--入力必須項目などのアラート-->
</head>
<body ng-app="standby">
<!--begin page_all-->
<div id="page_all">
<?php
//header
require('../mypage/m.header.php');
?>

  
  <!--begin content-->
  <div id="upper_content">
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

    <!--begin quesiton-->
    <div class="box">
      <div style="background-color:;float:left;margin-bottom:10px;min-width:300px;max-width:300px;word-wrap:break-word;">
        '.$data['question'].'
      </div>
      <a id="go" rel="leanModal" href="#edit_question'.$i.'">    
        <div class="link_edit">    
          <span class="meta-nav-prev">Answer the question</span>
        </div>
      </a>
    </div>
    <!--end quesiton-->



  <!--begin popup window-->
  <div id="edit_question'.$i.'" class="popup_window" style="width:550px;height:550px;">
  <a class="modal_close"  href="javascript:void(0)"></a>
    <div class="edit_format">
      <div style="padding-top:20px;padding-right:20px;">
        <form method="post" action="../php/question_edit.php">
          <input name="delete_id" type="hidden" value="'.$data['id'].'">
          <input style="width:50px;" type="submit" value="削除">          
        </form>
      </div>
      <p style="text-align:center;">回答するとプロフィールに追加されます</p>
      <div style="word-wrap:break-word;font-size:15px;color:black;">
        '.$data['question'].'  
      </div>
      <form method="post" action="../php/question_edit.php">
        <div style="background-color:;">
        <textarea name="answer" style="font-size:15px;width:100%;min-height:200px;padding:5px;" placeholder="answer" required></textarea>
        </div>
        <input name="question_id" type="hidden" value="'.$data['id'].'">
        <input class="edit_button" type="submit" value="Answer">
      </form>
    </div>
  </div>
  <!--end popup window-->
';
$i++;
}
?>
  </div>
  <!--end content-->
  <!--begin footer_all-->
  <div id="footer_all" style="position:absolute;bottom:0;">
      <div id="copyright">
        <small>COPYRIGHT ©　pepoQ ALL RIGHTS RESERVED. 2015 -</small>
      </div>
  </div>
  <!--end footer-->
</div>
<!--end page_all-->
</body>
</html>