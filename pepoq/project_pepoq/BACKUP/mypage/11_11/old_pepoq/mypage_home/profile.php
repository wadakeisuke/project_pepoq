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
<link rel="stylesheet" href="css/profile.css">
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
<div class="user_infomation">
  <div class="thumbnail">
    <img src="../img/thumbnail/<?php echo($_SESSION['mypage']['thumbnail']); ?>" style="width:100px;height:100px;">
  </div>
  <div class="name"><p><?php echo($_SESSION['mypage']['name']); ?></p></div>
</div>

<div class="profile_menu">
<ul>
  <li>P</li>
  <li>Q</li>
  <li>F</li>
  <li>G</li>
</ul>
</div>

<div class="basicdata">
  <div class="basicdata_item"><p><?php echo($_SESSION['mypage']['age']); ?></p></div>
  <div class="basicdata_item"><p><?php echo($_SESSION['mypage']['birth_day']); ?></p></div>
  <div class="basicdata_item"><p><?php echo($_SESSION['mypage']['come_from']); ?></p></div>
  <div class="basicdata_item"><p><?php echo($_SESSION['mypage']['educational_background']); ?></p></div>
  <div class="basicdata_item"><p><?php echo($_SESSION['mypage']['works']); ?></p></div>
</div>

<div class="comment">
<p><?php echo($_SESSION['mypage']['comment']); ?></p>
<p><?php echo($_SESSION['mypage']['comment']); ?></p>
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