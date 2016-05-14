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
/*.icon{
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
	
}*/
.content{
	width:100%;
	height:100%;
	background-color:#bdc3c7;
	position:relative;
	top:80px;
}
.user_content{
	width:100%;
	height:100%;
}
/*サムネイル*/
.thumbnail{
	width:100%;
	height:200px;
}
.user_thumbnail{
	width:50%;
	height:200px;
	background:;
}
.user_thumbnail img{
	margin-top:80px;
	margin-bottom:20px;
	margin-left:20px;
}
/*サムネイル*/
/*名前　一言コメント*/
.user_format{
}
.user_name{
}
/*名前　一言コメント*/
.follow_form{}

.user_sns_icon{
	width:100%;
	height:50px;
	text-align:center;
	font-size:30px;
	color:red;
}
.user_sns_icon ul{
	width:100%;
	height:50px;
}
.user_sns_icon ul li{
	width:25%;
	height:50px;
	float:left;
	background:white;
}
.icon{
	margin:0;padding:0;
}

.profile_menu li{
	background-color: pink;
	float:left;
	text-align: center;
}
li.profile_menu_li{
	width:33.33333333%;
}
.profile_box{
	width:94%;
	height:100%;
	margin:5px 3% 5px 3%;
	background:white;
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
	<div class="user_content">
		<div class="thumbnail">
			<img src="../img/thumbnail/man.jpg" width="100px" height="100px">
		</div>
		<div class="user_name">
			<?php echo($_SESSION['mypage']['name']); ?>
		</div>
		<div class="user_message">
		<p>lorem ipsum（ロレム・イプサム、略してリプサム lipsum ともいう）とは、出版、ウェブデザイン、グラフィックデザインなどの諸分野において使用されている典型的なダミーテキスト</p>
		</div>
	</div>
	</div>





		<div class="user_sns_icon">
			<ul>
				<li><p class="icon"><i class="fa fa-facebook-official icon"></i></p></li>
				<li><p class="icon"><i class="fa fa-twitter icon"></i></p></li>
				<li><p class="icon"><i class="fa fa-instagram icon"></i></p></li>
				<li><p class="icon"><i class="fa fa-google-plus icon"></i></p></li>
			</ul>
		</div>

		<div class="profile_menu">
			<ul>
				<li class="profile_menu_li"><a href="">情報</a></li>
				<li class="profile_menu_li"><a href="">質問</a></li>
				<li class="profile_menu_li"><a href="">友達</a></li> 
			</ul>
		</div>
	</div>

	<div class="profile_box">
		<p><?php echo($_SESSION['mypage']['comment']); ?></p>
	</div>

	<div class="profile_box">
	<ul>
		<li><i class="fa fa-square-o"></i>年齢:<?php echo($_SESSION['mypage']['age']); ?></li>
		<li><i class="fa fa-square-o"></i>誕生日:<?php echo($_SESSION['mypage']['birthday']); ?></li>
		<li><i class="fa fa-square-o"></i>住んでいる場所:<?php echo($_SESSION['mypage']['come_from']); ?></li>
		<li><i class="fa fa-square-o"></i>学歴:<?php echo($_SESSION['mypage']['educational_background']); ?></li>
		<li><i class="fa fa-square-o"></i>就職先:<?php echo($_SESSION['mypage']['works']); ?></li>
	</ul>
	</div>

			<div>
				<a href="../mypage/edit_mypage.php">編集</a>
			</div>
			
		</div>		
	</div>
</div>
</body>
</html