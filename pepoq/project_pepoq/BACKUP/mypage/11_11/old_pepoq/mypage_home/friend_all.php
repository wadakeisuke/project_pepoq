<!doctype>
<html>
<head>
<meta charset="utf-8">
<title>drawer</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<!-- drawer css -->
<link rel="stylesheet" href="css/drawer.min.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/friend_all.css">
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
	<div class="content friend_content">
	    <div class="fbox">
	      <div class="fbox_img_item float_left"><img src="img/img01.jpg"></div>
	      <div class="fbox_name_item float_left"><p>wada keisuke</p></div>
	    </div>
	    <div class="fbox">
	      <div class="fbox_img_item float_left"><img src="img/img01.jpg"></div>
	      <div class="fbox_name_item float_left"><p>wada keisuke</p></div>
	    </div>
	    <div class="fbox">
	      <div class="fbox_img_item float_left"><img src="img/img01.jpg"></div>
	      <div class="fbox_name_item float_left"><p>wada keisuke</p></div>
	    </div>
	    <div class="fbox">
	      <div class="fbox_img_item float_left"><img src="img/img01.jpg"></div>
	      <div class="fbox_name_item float_left"><p>wada keisuke</p></div>
	    </div>
	    <div class="fbox">
	      <div class="fbox_img_item float_left"><img src="img/img01.jpg"></div>
	      <div class="fbox_name_item float_left"><p>wada keisuke</p></div>
	    </div>
	    <div class="fbox">
	      <div class="fbox_img_item float_left"><img src="img/img01.jpg"></div>
	      <div class="fbox_name_item float_left"><p>wada keisuke</p></div>
	    </div>
	    <div class="fbox">
	      <div class="fbox_img_item float_left"><img src="img/img01.jpg"></div>
	      <div class="fbox_name_item float_left"><p>wada keisuke</p></div>
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