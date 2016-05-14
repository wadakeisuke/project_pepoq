<?php
session_start();
include('../php/login_check.php');
include('../php/db_connect.php');
include('../php/user_data.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>header</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../common/style/css/common_header.css">
<style type="text/css">
.icon{
	font-size: 25px;
	color: white;
}
#user_info{
background:url(../img/background/blue.jpg);
background-position:center top;
background-repeat:no-repeat;
-moz-background-size:cover;
background-size:cover;
}
#profile_menu li{
	background-color: pink;
	float: left;
	text-align: center;
}
li.profile_menu_li{
	width: 33%;
}
.content{
	padding-top:70px;
	background-color:#FFFFE0;
	height:100%;"
	width:100%;
}
.user_image{
	margin:10px auto 0;
	width:100px;
	height:100px;
}
.user_name{
	
}
</style>
</head>
<body>
<div id="page_all" style="">
	<!--begin header-->
	<?php
include('../common/header.html');
	?>
	<!--end header-->
	<div class="content">
		<div id="user_image">
			<img src="../img/thumbnail/man.jpg" width="100px" height="100px">
		</div>
		<div class="user_name">
			<div id="user_name" style="text-align:center;">
				<?php echo($_SESSION['mypage']['name']); ?>
			</div>
		<form class="follow_form">
			<input type="submit" value="フォロー">
		</form>
		</div>
		<div id="profile_menu">
			<ul>
				<li class="profile_menu_li"><a href="">情報</a></li>
				<li class="profile_menu_li"><a href="">質問</a></li>
				<li style="width:34%;" class="profile_menu_li"><a href="">友達</a></li>
			</ul>
		</div>

		<div style="width:100%;height:500px;background-color:white;">
			<div>
				<a href="../mypage/edit_mypage.php">編集</a>
			</div>
			<div id="links">
				<ul style="text-align:center;">
					<li style="width:25%;background-color:red;float:left;"><i style="color:white;" class="fa fa-facebook-official icon"></i></li>
					<li style="width:25%;background-color:red;float:left;"><i style="color:white;" class="fa fa-twitter icon"></i></li>
					<li style="width:25%;background-color:red;float:left;"><i style="color:white;" class="fa fa-instagram icon"></i></li>
					<li style="width:25%;background-color:red;float:left;"><i style="color:white;" class="fa fa-google-plus icon"></i></li>
				</ul>
			</div>
			<div id="comment" style="width:95%;margin:0 auto;">
				コメント<br>
				<?php echo($_SESSION['mypage']['comment']); ?>	
			</div>
			<div id="user_profile" style="width:95%;margin:0 auto;">
				<ul>
					<li>年齢:<?php echo($_SESSION['mypage']['age']); ?></li>
					<li>誕生日:<?php echo($_SESSION['mypage']['birthday']); ?></li>
					<li>住んでいる場所:<?php echo($_SESSION['mypage']['come_from']); ?></li>
					<li>学歴:<?php echo($_SESSION['mypage']['educational_background']); ?></li>
					<li>就職先:<?php echo($_SESSION['mypage']['works']); ?></li>
				</ul>
			</div>
			
		</div>		
	</div>
</div>
</body>
</html>