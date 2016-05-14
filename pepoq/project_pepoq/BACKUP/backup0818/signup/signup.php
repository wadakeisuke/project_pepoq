<!DOCTYPE html>
<html lang="ja" ng-app="SbM_top">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>登録</title>
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
<link rel="stylesheet" href="style/css/style.css"　type="text/css">
</head>
<body>
<!--begin Pageall-->
<div id="pageall">
 <!--begin section-->
 <section>
  <!--begin header-->
  <header>
    <p>sign up</p>
  </header>
  <!--end header-->
    <!--begin content-->
    <div id="content">
      <div id="alert">
        <?php
          if(isset($_GET['signup']) == 'error'){
            $alert='このメールアドレスはご登録されています';
            echo($alert);
          }
        ?>
      </div>
      <!--begin form-->
      <div id="form">
        <form class="confirm_form" method="post" action="../php/user_signup.php" novalidate name="myForm">
             <!--
          <div class="c_box">
            <div class="input">
              <input class="input_style" type="text" name="firstname" ng-model="firstname" autocomplete="off" ng-init="firstname='<?php if(isset($_SESSION['signup']['first_name'])){echo($_SESSION['signup']['first_name']);} ?>'" placeholder="First Name" required 　ng-minlength="3" ng-maxlength="20" class="inputing">
            </div>
            <div class="alert">
              <span class="text-danger" ng-show="myForm.firstname.$error.required">未入力</span>
              <span class="text-denger" ng-show="myForm.firstname.$error.minlength">Too short!</span>
              <span class="text-denger" ng-show="myForm.firstname.$error.maxlength">Too long!</span>
            </div>
          </div>-->
          <div class="c_box">
            <div class="input">
              <input class="input_style" type="text" name="lastname" ng-model="lastname" autocomplete="off" ng-init="lastname='<?php if(isset($_SESSION['signup']['last_name'])){echo($_SESSION['signup']['last_name']);} ?>'" placeholder="ニックネーム" required 　ng-minlength="1" ng-maxlength="20" class="inputing">
            </div>
            <div class="alert">
              <span class="text-danger" ng-show="myForm.lastname.$error.required">未入力</span>
              <span class="text-denger" ng-show="myForm.lastname.$error.minlength">Too short!</span>
              <span class="text-denger" ng-show="myForm.lastname.$error.maxlength">Too long!</span>
            </div>
          </div>       
          <div class="c_box fl">
            <div class="input">
              <input class="input_style" type="email" name="email" ng-model="email" autocomplete="off" ng-init="email='<?php if(isset($_SESSION['signup']['signup_email'])){echo($_SESSION['signup']['signup_email']);} ?>'" placeholder="メールアドレス" required ng-minlength="5" class="inputing">
            </div>
            <div class="alert">
              <span class="text-danger" ng-show="myForm.email.$error.required">未入力</span>
              <span class="text-danger" ng-show="myForm.email.$error.minlength">Too short!</span>
              <span class="text-danger" ng-show="myForm.email.$error.maxlength">Too long!</span>
              <span class="text-danger" ng-show="myForm.email.$error.email">@が必須です</span>
            </div>
          </div>
          <div class="c_box fl">
            <div class="input">
              <input class="input_style" type="email" name="email_cfm" ng-model="email_cfm" autocomplete="off" match="email" placeholder="メールアドレス（確認）" required class="inputing">
            </div>
            <div class="alert">
              <span class="text-danger" ng-show="myForm.email_cfm.$error.required">未入力</span>
              <span class="text-danger" ng-show="myForm.email_cfm.$error.mismatch">一致しません</span>
              <span class="text-danger" ng-show="myForm.email_cfm.$error.email">@が必須です</span>
            </div>
          </div>
          <div class="c_box fl">
            <div class="input">
              <input class="input_style" type="password" name="password" ng-model="password" ng-init="password='<?php if(isset($_SESSION['signup']['signup_password'])){echo($_SESSION['signup']['signup_password']);} ?>'" placeholder="パスワード" ng-minlength="6" ng-maxlength="30" required class="inputing">
            </div>
            <div class="alert">
              <span class="text-danger" ng-show="myForm.password.$error.required">未入力</span>
              <span class="text-danger" ng-show="myForm.password.$error.minlength">Too short!</span>
              <span class="text-danger" ng-show="myForm.password.$error.maxlength">Too long!</span>          
            </div>
          </div>
          <div class="c_box fl">
            <div class="input_style">
              <input class="input" type="password" name="password_cfm" ng-model="password_cfm"  match="password"  placeholder="パスワード（確認）" required class="inputing">
            </div>
            <div class="alert">
              <span class="text-danger" ng-show="myForm.password_cfm.$error.required">未入力</span>            
              <span class="text-danger" ng-show="myForm.password_cfm.$error.mismatch">一致していません</span>
            </div>
          </div>
          <div class="c_box fl">
            <div class="input_style">
              <input name="signup" type="submit" value="popoQに登録する" ng-disabled="!myForm.$valid" class="submit">
            </div>
          </div>
        </form>
      </div>
      <!--end form-->
      <div id="lower_content">
        <p>popoQに登録するをクリックすることで、当サイトの<a href="../rules/rules.html" target="_blank" >利用規約</a>及び<a href="../rules/cookie.html" target="_blank">Cookieの使用</a>を含む<a href="../rules/privacy.html" target="_blank">プライバシー</a>に関するポリシーに同意するものとします。</p>
      </div>
    </div>
    <!--end content-->

  </section>
  <!--end section-->
</div>
<!-- End Pageall-->

</body>