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
<link rel="stylesheet" href="style/css/lavender.css" />
<link rel="stylesheet" href="style/css/jquery.mobile.structure-1.0rc2.min.css" />
<script src="style/js/jquery-1.6.4.min.js"></script>
<script src="style/js/jquery.mobile-1.0rc2.min.js"></script>
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
    <div id="content">
      <!--begin form-->
      <form method="get" action="#">
      <div data-role="fieldcontain">
        <p>
        <fieldset data-role="controlgroup"> 
        <label for="checkbox-1">日記</label> 
        <input type="checkbox" name="checkbox-1" id="checkbox-1" class="custom" /> 
        <label for="checkbox-2">ゲーム</label> 
        <input type="checkbox" name="checkbox-2" id="checkbox-2" class="custom" /> 
        <label for="checkbox-3">アイドル・芸能</label> 
        <input type="checkbox" name="checkbox-3" id="checkbox-3" class="custom" />
        <label for="checkbox-4">育児</label> 
        <input type="checkbox" name="checkbox-4" id="checkbox-4" class="custom" /> 
        <label for="checkbox-5">株式・投資・マネー</label> 
        <input type="checkbox" name="checkbox-5" id="checkbox-5" class="custom" /> 
        <label for="checkbox-6">コンピュータ</label> 
        <input type="checkbox" name="checkbox-6" id="checkbox-6" class="custom" /> 
        <label for="checkbox-7">スポーツ</label> 
        <input type="checkbox" name="checkbox-7" id="checkbox-7" class="custom" /> 
        <label for="checkbox-8">医学</label> 
        <input type="checkbox" name="checkbox-8" id="checkbox-8" class="custom" /> 
        <label for="checkbox-9">時事</label> 
        <input type="checkbox" name="checkbox-9" id="checkbox-9" class="custom" /> 
        <label for="checkbox-10">政治・経済</label> 
        <input type="checkbox" name="checkbox-10" id="checkbox-10" class="custom" /> 
        <label for="checkbox-11">アニメ・コミック</label> 
        <input type="checkbox" name="checkbox-11" id="checkbox-11" class="custom" /> 
        <label for="checkbox-12">車・バイク</label> 
        <input type="checkbox" name="checkbox-12" id="checkbox-12" class="custom" /> 
        <label for="checkbox-13">就職・お仕事</label> 
        <input type="checkbox" name="checkbox-13" id="checkbox-13" class="custom" /> 
        <label for="checkbox-14">ペット</label> 
        <input type="checkbox" name="checkbox-14" id="checkbox-14" class="custom" /> 
        <label for="checkbox-15">旅行</label> 
        <input type="checkbox" name="checkbox-15" id="checkbox-15" class="custom" /> 
        <label for="checkbox-16">ファイナンス</label> 
        <input type="checkbox" name="checkbox-16" id="checkbox-16" class="custom" /> 
        <label for="checkbox-17">学問・文学・芸術</label> 
        <input type="checkbox" name="checkbox-17" id="checkbox-17" class="custom" /> 
        <label for="checkbox-18">オンラインゲーム</label> 
        <input type="checkbox" name="checkbox-18" id="checkbox-18" class="custom" />
        <label for="checkbox-19">ファッション・ブランド</label> 
        <input type="checkbox" name="checkbox-19" id="checkbox-19" class="custom" /> 
        <label for="checkbox-20">アフィリエイト</label> 
        <input type="checkbox" name="checkbox-20" id="checkbox-20" class="custom" /> 
        <label for="checkbox-21">学校・教育</label> 
        <input type="checkbox" name="checkbox-21" id="checkbox-21" class="custom" />
        <label for="checkbox-22">ギャンブル</label> 
        <input type="checkbox" name="checkbox-22" id="checkbox-22" class="custom" /> 
        </fieldset> 
        </p>
      </div>

      <div class="c_box fl">
          <input name="signup2" type="submit" value="次へ" class="submit2">
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
