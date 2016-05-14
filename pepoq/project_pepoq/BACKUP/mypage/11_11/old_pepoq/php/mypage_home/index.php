<?php
session_start();
require('./php/db_connect.php');
require('./php/mypage_data.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>drawer</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<!-- drawer css -->
<link rel="stylesheet" href="css/drawer.min.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/question.css">
<!-- jquery & iscroll & dropdown -->
<script src="js/jquery.min.js"></script>
<script src="js/iscroll-min.js"></script>
<script src="js/dropdown.min.js"></script>

<!-- drawer js -->
<script src="js/jquery.drawer.min.js"></script>
<script>
$(document).ready(function() {
  $(".drawer").drawer();
});
</script>

</head>

<body>
<div class="pageall">
<!--bigin header-->
<?php
include('./header.html');
?>
<!--end header-->

<div class="content">

<div class="question_all">
    <div class="question_box">
      <div class="question_img_item float_left"><img src="img/img01.jpg" style="width=50px;height:50px;"></div>
      <div class="question_name_item float_left"><p>wada keisuke</p></div>
        <div class="question_text_item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="question_button">
          <ul class="question_button_ul">
            <li class="float_left">いいね</li><li class="float_left">コメント</li>
          </ul>
        </div>
    </div>
    
    <div class="question_box">
      <div class="question_img_item float_left"><img src="img/img01.jpg" style="width=50px;height:50px;"></div>
      <div class="question_name_item float_left"><p>wada keisuke</p></div>
        <div class="question_text_item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="question_button">
          <ul class="question_button_ul">
            <li class="float_left">いいね</li><li class="float_left">コメント</li>
          </ul>
        </div>
    </div>

    <div class="question_box">
      <div class="question_img_item float_left"><img src="img/img01.jpg" style="width=50px;height:50px;"></div>
      <div class="question_name_item float_left"><p>wada keisuke</p></div>
        <div class="question_text_item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="question_button">
          <ul class="question_button_ul">
            <li class="float_left">いいね</li><li class="float_left">コメント</li>
          </ul>
        </div>
    </div>
</div>
</div>
</div>



<!--begin menu-->
<?php
include('./menu.html');
?>
<!--end menu-->

</div>
<script>
// Option
$(".drawer").drawer({
  apiToggleClass: "element"
});

// Open
$('.element').on(function)() {
  $('.drawer').drawer('open');
});

// close
$('.element').on(function)() {
  $('.drawer').drawer('close');
});

// toggle
$('.element').on(function)() {
  $('.drawer').drawer('toggle');
});

// destroy
$('.element').on(function)() {
  $('.drawer').drawer('destroy');
});
</script>
</body>
</html>