<?php
session_start();
//include('../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/user_data.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>header</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common_header.css">

<link rel="stylesheet" type="text/css" href="style.css">
<style>



</style>
</head>
<body>
<div id="page_all">
	<!--begin header-->
	<?php
		include('../../common/header.html');
	?>
	<!--end header-->
	<!--begin content-->
	<div class="content">
		<!--bigin user info -->
		<div class="user_content">
			<div class="thumbnail float_left">
				<img src="./img/thumbnail/thumbnail.jpg" width="100px" height="90px">
			</div>

			<div class="user_infomation_format float_left">
				<div class="user_name">
					<p><?php echo($_SESSION['mypage']['name']); ?></p>
				</div>
				<div class="user_info_item">
					<a href="edit_profile.php"><button class="btn">編集</button></a>
				</div>
			</div>
			
		</div>
		<!--end user info -->
		<!--begin menu--
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
			<div class="prof_category"><p>基本データ</p></div>
				<div class="basic_data">
					<div class="basic_data_box">
						<div class="user_message">
							<div class="user_message_item">
								<p><?php echo($_SESSION['mypage']['comment']); ?></p>
							</div>
						</div>
					</div>

					<div class="basic_data_box">
						<div class="basic_data_item"><p>友達の数　12</p></div>
						<div class="basic_data_item"><p>goodの数 12</p></div>
						<div class="basic_data_item"><p>badの数 12</p></div>
						<div class="basic_data_item"><p>質問の数 12</p></div>
					</div>

					<div class="basic_data_box">
						<div class="basic_data_item"><p>誕生日：<?php echo($_SESSION['mypage']['birthday']); ?></p></div>
						<div class="basic_data_item"><p>勤務先：<?php echo($_SESSION['mypage']['works']); ?></p></div>
						<div class="basic_data_item"><p>出身校：<?php echo($_SESSION['mypage']['educational_background']); ?></p></div>
						<div class="basic_data_item"><p>住んでいるところ：<?php echo($_SESSION['mypage']['come_from']); ?></p></div>
					</div>
				</div>
			<div class="friend_all">
				
			</div>

			<div class="timeline">
				
			</div>

		</div>
	</div>
	<!--end content-->


</div>
</body>
</html>
