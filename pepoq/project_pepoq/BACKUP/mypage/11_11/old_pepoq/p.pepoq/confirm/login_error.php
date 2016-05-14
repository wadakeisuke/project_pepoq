<?php
session_start();
//begin class Login
class Login
{
  private $email;
  private $password;

  public function setEmail($email)
  {
    $this->email=$email;
  }
  public function setPassword($password)
  {
    $this->hash($password);
  }
  public function hash($password)
  {
    for($num=0;$num<1000;$num++){
        $password=sha1($password);
        $password=md5($password);
    }
    $this->password=$password;
  }
  public function login_sb()
  {
    try{
      $email=$this->email;
      $password=$this->password;
      $pdo = require('../../php/db_connect.php');
      $sql=$pdo->prepare('SELECT * FROM acount WHERE email=:email AND password=:password');
      $sql->bindValue(':email',$email);
      $sql->bindValue(':password',$password);
      $sql->execute();
      if($data=$sql->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['login']['email']=$email;
        $_SESSION['login']['password']=$password;
        header('Location: ../mypage/mypage.php');
        exit();
      }else{
        header('Location: ../confirm/login_error.php');
        exit();
      }
    }
    catch(PDOException $e){
      echo('Error'.$e->getMessage());
      die();
    }
    $pdo=null;
  }
}
//end class login

//begin loginがPOSTされた場合
$login=(isset($_POST['login']))?$_POST['login']:null;
if($login=='login'){
  $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
  $password=htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');
  if($email&&$password){
    $login=new Login();
    $login->setEmail($email);
    $login->setPassword($password);
    $login->login_sb();
  }else{
    header('Location: ./login_error.php');
    exit();
  }
}
//end loginがPOSTされた場合
?>
<!DOCTYPE html>
<html lang="ja" ng-app="SbM_top">
<head>
<meta charset="UTF-8">
<title>STAND BY</title>
<link rel="stylesheet" type="text/css" href="style/css/login_error.css">
<link rel="stylesheet" type="text/css" href="style/css/blue.css">
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<script src="../../style/js/jquery.hoverintent.r7.js"></script>
<script src="../../style/js/jquery.mnmenu.js"></script>
<script>
$(document).ready(function() {
  $('#idmenu').mnmenu();
})
</script>
<script src="style/js/angular.min.js"></script>
<script src="style/js/script.js"></script>
<script language="javascript">
  angular.module("SbM_top", [])
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
</head>
<body>
<div id="pageall">
<section>
  <!--begin header_all-->
  <div id="header_all">
    <div id="header">
      <div id="logo">
        <a href="../php/logout.php"><img src="../../img/logo.png"><img src="../../img/standby_letter.png" style="width:150px;"></a>
      </div>
      <!--
      <div id="serch_form">
        <form method="post" action="../search/search.php">
          <input name="serch" type="text" placeholder="Serch Friends" maxlength="20">
        </form>
      </div>
      <div id="menu">
        <ul id="idmenu" class="bluemenu">
          <li><a href="../mypage/mypage.php">mypage</a></li>
          <li><a href="../profile/profile.php">profile</a></li>
          <li>friends
            <ul>     
              <li><a href="../mypage/mypage.php#lower_content">全て<span class="friends_num">(<?php echo $f_all_num; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">友達リクエスト<span class="friends_num">(<?php echo $f_request_num; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">家族<span class="friends_num">(<?php echo $f_type_num[0]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">恋人<span class="friends_num">(<?php echo $f_type_num[1]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">小・中学校<span class="friends_num">(<?php echo $f_type_num[2]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">高校<span class="friends_num">(<?php echo $f_type_num[3]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">大学・専門<span class="friends_num">(<?php echo $f_type_num[4]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_content">勤務先<span class="friends_num">(<?php echo $f_type_num[5]; ?>)</span></a></li>
              <li><a href="../mypage/mypage.php#lower_contentt">その他<span class="friends_num">(<?php echo $f_type_num[6]; ?>)</span></a></li>
            </ul>
          </li>
          <li>Questions
            <ul>
              <li><a href="../question/question.php">New Question</a></li>
            </ul>
          </li>
          <li>Other
            <ul>
                <li><a href="../logout.php"><div class="friends_type">ログアウト</div><span class="friends_num"></span></a></li>
                <li><a href="#"><div class="friends_type">StandByについて</div><span class="friends_num"></span></a></li>
                <li><a href="../rules_etc/rules.html"><div class="friends_type">利用規約</div><span class="friends_num"></span></a></li>
                <li><a href="../rules_etc/help.html"><div class="friends_type">ヘルプ</div><span class="friends_num"></span></a></li>
                <li><a href="../rules_etc/contact.php"><div class="friends_type">お問い合わせ</div><span class="friends_num"></span></a></li>
                <li><a id="go" rel="leanModal" href="#delete_acount"><div class="friends_type">アカウントの削除</div><span class="friends_num"></span></a></li>
            </ul>
          </li>
        </ul>
      </div>
      -->
    </div>
  </div>
  <!--end header_all-->
  <!--begin content-->
  <div style="background-color:;padding-top:100px;">
  <div id="content" style="padding:20px;border:solid 2px #a9a9a9;-moz-border-radius: 1em;-webkit-border-radius: 1em;-o-border-radius: 1em;-ms-border-radius: 1em; width:650px;margin-left:auto;margin-right:auto;">
    <!--begin wellcome comment-->
    <div id="wellcome" style="background-color:;text-align:center;">
      <p style="margin-bottom:30px;padding-top:15px;padding-bottom:10px;color:white;background-color:red; font-size:15px; font-weight:bold;"><span style="font-size:18px;">入力されたメールアドレスまたはパスワードが正しくありません。</span><br><br>
    The email or the password you entered does not belong to any account.<br>
    正しいメールアドレス、パスワードで再度お試しください。</p><hr>
    </div>
    <!--end wellcome comment-->
    <!--begin form-->
    <div style="background-color:;" id="form">
      <form id="login_form" method="post" action="./login_error.php" novalidate name="myForm">     
        <div>
          <input style="width:300px;" type="email" name="email" ng-model="email" autocomplete="off" placeholder="Eamil" required class="inputing">
          <span class="text-danger" ng-show="myForm.email.$error.email">正しいメールアドレスを入力して下さい</span>
        </div>
        <div>
          <input style="width:300px;" type="password" name="password" ng-model="password" placeholder="Password" required ng-minlength="6" ng-maxlength="50" class="inputing">
          <span class="text-denger" ng-show="myForm.password.$error.maxlength">パスワードが長すぎます</span>
        </div>
        <div>
          <input style="width:200px;" name="login" type="submit" value="login" ng-disabled="!myForm.$valid" class="submit"><span style="padding-left:10px;font-family:sans-serif;font-weight:bold;font-size:15px;background-color:;color:black">登録は</span><span id="here"><a href="../confirm/confirm.php">こちら</a></span><br>
        </div>
      </form>
    </div>
    <!--end form-->
  </div>
  </div>
  <!--end content-->
</section>
</div>
<!--end pageall-->
</body>
</html>