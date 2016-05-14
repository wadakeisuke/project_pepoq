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
/*common css*/
*{
	-webkit-appearance: none;
}
body{
	background:#bdc3c7;
}
p{font-size:14px;}
/*common css*/
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
	margin:0 5%;
	width:90%;
	height:90%;
}

/*一言*/

.user_info_item{
	width:50%;
	height:40px;
	background:white;
}
button.btn {
	border: 1px dotted #CCC;
	color: #111;
	width: 90%;
	height:32px;
	margin:4px 5%;
	padding: 10px 0;
	background:#e74c3c;
}


/*menu*/
.menu ul{
	width:100%;
	height:40px;
	clear:both;
}
.menu ul li{
	width:33.333333%;
	float:left;
	text-align:center;
	background:#d61e44;
	font-size:12px;
}
.menu ul li p{
	padding:0;
	line-height:14px;
}
.menu_icons{
	font-size:16px;
	color:#ecf0f1;
}
/*menu*/
.lower_content{
	clear:both;
	position:absolute;
	width:94%;
	margin:0 2%;
	height:100%;
}
.basic_data{

}
.basic_data_box{
	background:white;
	width:96%;
	height:100%;
	padding:3px 3%;
	margin:10px 0;
	padding-bottom:15px;
	border-radius:3px;
}
.basic_data_item{
	border-bottom:solid 1px #CCAACD;
	width:100%;
	height:20px;
}


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
			<div class="user_info_item float_left">
				<button class="btn">編集・follow</button>
			</div>
			<div class="user_info_item float_left">
				<button class="btn">編集・follow</button>
			</div>
		</div>
		<!--end user info -->
		<!--begin menu -->
		<div class="menu">
			<ul>
				<li>
					<div class="menu_icons"><i class="fa fa-pencil-square-o"></i></div>
					<a href="#">タイムライン</a>
				</li>
				<li>
					<div class="menu_icons"><i class="fa fa-pencil-square-o"></i></div>
					<a href="#">友達</a>
				</li>
				<li>
					<div class="menu_icons"><i class="fa fa-pencil-square-o"></i></div>
					<a href="#">基本データ</a>
				</li>
			</ul>
		</div>
		<!--end menu -->

		<div class="lower_content">		
			<div class="basic_data">
				<div class="basic_data_box">
					<div class="basic_data_item"><p>勤務先：株式会社　pepoQ　代表取締役</p></div>
					<div class="basic_data_item"><p>出身校：早稲田大学　社会科学部</p></div>
					<div class="basic_data_item"><p>長野県　在住</p></div>
					<div class="basic_data_item"><p>埼玉県さいたま市　出身</p></div>
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
