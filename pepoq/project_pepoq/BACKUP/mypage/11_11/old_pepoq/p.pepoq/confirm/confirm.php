<?php
require('../php/signup.php');
?>
<!DOCTYPE html>
<html lang="ja" ng-app="SbM_top">
<head>
<meta charset="UTF-8">
<title>STAND BY</title>
<link rel="stylesheet" type="text/css" href="style/css/confirm.css">
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
<!--begin pageall-->
<div id="pageall">
<!--begin section-->
<section>
  <!--begin header_all-->
  <div id="header_all">
    <div id="header">
      <div id="logo">
        <a href="../php/logout.php"><img src="../../img/logo.png"><img src="../../img/standby_letter.png" style="width:150px;"></a>
      </div>
    </div>
  </div>
  <!--end header_all-->
  <!--begin alert-->
  <div id="alert" style="padding:50px 0 20px;">
    <p>
    <?php
      if(isset($_GET['alert'])?true:false){
        $alert='既に、このメールアドレスは登録されています。'.PHP_EOL.'再度、他のメールアドレスでご登録ください。';
        $alert=nl2br($alert);
        echo($alert);
      }
    ?>
    </p>
  </div>
  <!--end alert-->
  <!--begin content-->
  <div id="content">
    <!--begin wellcome-->
    <div id="welcome">
      <h1>Hello, welcome to pepoQ !</h1><hr>
    </div>
    <!--end wellcome-->
    <!--begin form-->
    <div id="form">
      <form class="confirm_form" method="post" action="../php/signup.php" novalidate name="myForm">
        <div>
          <input style="width:300px;" type="text" name="first_name" ng-model="first_name" autocomplete="off" ng-init="first_name='<?php echo(isset($_POST['first_name'])?htmlspecialchars($_POST['first_name'],ENT_QUOTES,'UTF-8'):''); ?>'" placeholder="First Name" required 　ng-minlength="1" ng-maxlength="20" class="inputing">
          <span class="text-danger" ng-show="myForm.first_name.$error.required">入力必須項目です</span>
          <span class="text-danger" ng-show="myForm.first_name.$error.name">正しい名前を入力して下さい</span>
          <span class="text-denger" ng-show="myForm.first_name.$error.minlength">Too short!</span>
          <span class="text-denger" ng-show="myForm.first_name.$error.maxlength">Too long!</span>
        </div>
        <div>
          <input style="width:300px;" type="text" name="last_name" ng-model="last_name" autocomplete="off" ng-init="last_name='<?php echo(isset($_POST['last_name'])?htmlspecialchars($_POST['last_name'],ENT_QUOTES,'UTF-8'):''); ?>'" placeholder="Last Name" required 　ng-minlength="1" ng-maxlength="20" class="inputing">
          <span class="text-danger" ng-show="myForm.last_name.$error.required">入力必須項目です</span>
          <span class="text-danger" ng-show="myForm.last_name.$error.name">正しい名前を入力して下さい</span>
          <span class="text-denger" ng-show="myForm.last_name.$error.minlength">Too short!</span>
          <span class="text-denger" ng-show="myForm.last_name.$error.maxlength">Too long!</span>
        </div>       
        <div>
          <input style="width:300px;" type="email" name="email" ng-model="email" autocomplete="off" ng-init="email='<?php echo(isset($_POST['email'])?htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8'):''); ?>'" placeholder="Email" required class="inputing">
            <span class="text-danger" ng-show="myForm.email.$error.required">入力必須項目です</span>
            <span class="text-danger" ng-show="myForm.email.$error.email">正しいメールアドレスを入力して下さい</span>
        </div>
        <div>
          <input style="width:300px;" type="email" name="email_cfm" ng-model="email_cfm" autocomplete="off" match="email"  placeholder="Email confirm" required class="inputing">
            <span class="text-danger" ng-show="myForm.email_cfm.$error.required">入力必須項目です</span>
            <span class="text-danger" ng-show="myForm.email_cfm.$error.email">正しいメールアドレスを入力して下さい</span>
            <span class="text-danger" ng-show="myForm.email_cfm.$error.mismatch">メールアドレスが一致していません</span>
        </div>
        <div>
          <input style="width:300px;" type="password" name="password" ng-model="password" ng-init="password='<?php echo(isset($_POST['password'])?htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8'):''); ?>'" placeholder="Password" required ng-minlength="6" ng-maxlength="50" class="inputing">
            <span class="text-danger" ng-show="myForm.password.$error.required">入力必須項目です</span>
            <span class="text-denger" ng-show="myForm.password.$error.minlength">Too short!</span>
            <span class="text-denger" ng-show="myForm.password.$error.maxlength">Too long!</span>
            <span class="text-danger" ng-show="myForm.password.$error.password">正しいpasswordを入力して下さい</span>
        </div>
        <div>
          <input class="input" style="width:300px;" type="password" name="password_cfm" ng-model="password_cfm"  match="password"  placeholder="Password confirm" required ng-minlength="6" ng-maxlength="50" class="inputing">
            <span class="text-danger" ng-show="myForm.password_cfm.$error.required">入力必須項目です</span>
            <span class="text-danger" ng-show="myForm.password_cfm.$error.password">正しいpasswordを入力して下さい</span>
            <span class="text-denger" ng-show="myForm.password_cfm.$error.minlength">Too short!</span>
            <span class="text-denger" ng-show="myForm.password_cfm.$error.maxlength">Too long!</span>
            <span class="text-danger" ng-show="myForm.password_cfm.$error.mismatch">passwordが一致していません</span>
        </div>
        <div>
          <input style="width:305px;margin-right:100px;" name="signup" type="submit" value="Sign Up" ng-disabled="!myForm.$valid" class="submit"><br>
        </div>
      </form>
    </div>
    <!--end form-->
  </div>
  <!--end content-->
</section>
<!--end section-->
</div>
<!--end pageall-->
</body>
</html>