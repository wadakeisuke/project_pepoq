<!DOCTYPE html>
<html lang="ja" ng-app="SbM_top">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>興味があるもの</title>
<script src="style/js/angular.min.js"></script>
<script language="javascript">
/*
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
*/
</script>
<link rel="stylesheet" href="style/css/style.css"　type="text/css">



<!--
<script src="style/js/jquery-1.6.4.min.js"></script>
<script src="style/js/jquery.mobile-1.0rc2.min.js"></script>
-->
</head>
<body>
<!--begin Pageall-->
<div id="pageall">
 <!--begin section-->
 <section>
  <!--begin header-->
  <header>
    <p>興味があるものにチェックしてください</p>
  </header>
  <!--end header-->
    <!--begin content-->
    <div class="signup2_content">
      <!--begin form-->
      <form method="get" action="#">
        <ul>
          <li>
          <input type="checkbox" name="sports" value="野球" id="sports_baseball">
          <label for="sports_baseball">野球</label>
          </li>
          <li>
          <input type="checkbox" name="sports" value="サッカー" id="sports_soccer">
          <label for="sports_soccer">サッカー</label>
          </li>
          <li>
          <input type="checkbox" name="sports" value="バスケ" id="sports_basketball">
          <label for="sports_basketball">バスケ</label>
          </li>
          <li>
          <input type="checkbox" name="sports" value="テニス" id="sports_tennis">
          <label for="sports_tennis">テニス</label>
          </li>
          <li>
          <input type="checkbox" name="sports" value="水泳" id="sports_swim">
          <label for="sports_swim">水泳</label>
          </li>
        </ul>
        <div class="c_box fl">
            <input class="submit_2btn"name="signup2" type="submit" value="次へ">
        </div>
      </form>
      <!--end form-->
    </div>
    <!--end content-->
  </section>
  <!--end section-->
</div>
<!-- End Pageall-->

</body>
</html>