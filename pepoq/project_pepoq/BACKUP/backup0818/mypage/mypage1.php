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
<style>
p{font-size:14px;}
#page_all{
	background:#bdc3c7;
	width:100%;
	height:100%;
}
.float_left{float:left;}
.content{
	position:absolute;
	top:80px;
	width:100%;
}
/*サムネイル*/
.thumbnail{
	width:40%;
	height:90px;
	padding-top:10px;
	text-align:center;
	background:white;
}
.tumbnail img{
	border:0px;
	width:100px;
	height:90px;
}
/*サムネイル*/
/*名前*/
.user_name{
	width:60%;
	height:100px;
	background:white;
	text-align:center;
}
.user_name p{
	font-size:18px;
}
/*名前*/
/*一言*/
.user_message{
	clear:both;
	width:100%;
	height:100%;
	background:white;
}
.user_message_item{
	border-top:1px;
	margin:5%;
	width:90%;
	height:90%;
}

/*一言*/
.menu ul{
	width:100%;
	height:30px;
	background:red;
}
.menu ul li{
	width:33.333333333333333333%;
	float:left;
	text-align:center;
	background:red;
	font-size:12px;
}
.lower_content{
	clear:both;
	position:absolute;
	width:94%;
	margin:0 3%;
	height:100%;
}
.basic_data{

}
.basic_data_box{
	background:white;
	width:100%;
	height:100%;
	margin:10px 0;
}
.basic_data_item{}
</style>
</head>
<body>
<div id="page_all">
	<!--begin header-->
	<?php
		include('../common/header.html');
	?>
	<!--end header-->
	<!--begin content-->
	<div class="content">
		<!--bigin user info -->
		<div class="user_content">
			<div class="thumbnail float_left">
				<img src="../img/thumbnail/misako.jpg" width="100px" height="90px">
			</div>
			<div class="user_name float_left">
				<p><?php echo($_SESSION['mypage']['name']); ?>　ケイスケ</p>
			</div>
			<div class="user_message">
				<div class="user_message_item">
					<p>lorem ipsum（ロレム・イプサム、略してリプサム lipsum ともいう）とは、出版、ウェブデザイン、グラフィックデザインなどの...<a>more</a></p>
				</div>
			</div>
			<div class="user_info_item">
			</div>
		</div>
		<!--end user info -->
		<!--begin menu -->
		<div class="menu">
			<ul>
				<li>タイムライン</li>
				<li>友達</li>
				<li>基本データ</li>
			</ul>
		</div>
		<!--end menu -->

		<div class="lower_content">		
			<div class="basic_data">
				<div class="basic_data_box">
					<div class="bacic_data_item">勤務先：株式会社　pepoQ　代表取締役</div>
					<div class="bacic_data_item">出身校：早稲田大学　社会科学部</div>
					<div class="bacic_data_item">長野県　在住</div>
					<div class="bacic_data_item">埼玉県さいたま市　出身</div>
				</div>
			</div>
		<div class="friend_all"></div>
		<div class="timeline"></div>
	</div>
	</div>
	<!--end content-->


</div>
</body>
</html>
