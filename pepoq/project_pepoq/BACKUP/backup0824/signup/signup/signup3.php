<!DOCTYPE html>
<html lang="ja" ng-app="SbM_top">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>興味があるもの</title>
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
    <p>興味があるもの</p>
  </header>
  <!--end header-->
    <!--begin content-->
    <div id="content">
      <!--begin form-->
      <div id="form">
        <form class="confirm_form" method="post" action="../php/user_signup.php" novalidate name="myForm">
          日記<input type="checkbox"><br>
          ゲーム<input type="checkbox"><br>
          アイドル・芸能<input type="checkbox"><br>
          育児<input type="checkbox"><br>
          株式・投資・マネー<input type="checkbox"><br>
          コンピュータ<input type="checkbox"><br>
          スポーツ<input type="checkbox"><br>
          医学<input type="checkbox"><br>
          時事<input type="checkbox"><br>
          政治・経済<input type="checkbox"><br>
          アニメ・コミック<input type="checkbox"><br>
          車・バイク<input type="checkbox"><br>
          就職・お仕事<input type="checkbox"><br>
          ペット<input type="checkbox"><br>
          旅行<input type="checkbox"><br>
          ファイナンス<input type="checkbox"><br>
          学問・文学・芸術<input type="checkbox"><br>
          オンラインゲーム<input type="checkbox"><br>
          ファッション・ブランド<input type="checkbox"><br>
          アフィリエイト<input type="checkbox"><br>
          学校・教育<input type="checkbox"><br>
          ギャンブル<input type="checkbox"><br>
          <div class="c_box fl">
            <div class="input_style">
              <input name="signup" type="submit" value="次へ" class="submit">
            </div>
          </div>
        </form>
      </div>
      <!--end form-->
    </div>
    <!--end content-->
  </section>
  <!--end section-->
</div>
<!-- End Pageall-->
</body>