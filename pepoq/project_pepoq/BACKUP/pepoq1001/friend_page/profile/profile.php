<?php
session_start();
//include('../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/sanitize/sanitize.php');
include('../../php/user_data/personalData.php');

$personal_data = new personalData();
$friend_id = h($_GET['friend_id']);
$data = $personal_data->get_personal_data_from_id($friend_id);

//include('../../php/user_data.php');
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
<link rel="stylesheet" type="text/css" href="./css/style.css">

<!--drawer format===================================================================================-->
<!----><link rel="stylesheet" href="../../common/style/css/drawer.css"><!--=========================-->
<!----><link rel="stylesheet" type="text/css" href="../../common/style/css/header_style.css"><!--===-->
<!----><script type="text/javascript" src="../../common/style/js/jquery-1.7.2.min.js"></script><!--=-->
<!--================================================================================================-->
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
				<?php
				echo '
				<img src="../../mypage/profile/img/thumbnail/' . $data['thumbnail'] . '" width="100px" height="90px">
				';
				?>
			</div>

			<div class="user_infomation_format float_left">
				<div class="user_name">
					<p><?php echo($data['name']); ?></p>
				</div>
				<div class="user_info_item">
					<form action="../../php/friend_edit/friend_edit.php" method="post">
						<input type="hidden" name="friend_id" value="<?php echo $friend_id; ?>">
						<input type="submit" name="request_friend" class="btn" value="フォロー">
					</form>
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
								<p><?php echo($data['comment']); ?></p>
							</div>
						</div>
					</div>

					<!--
					<div class="basic_data_box">
						<div class="basic_data_item"><p>友達の数　12</p></div>
						<div class="basic_data_item"><p>goodの数 12</p></div>
						<div class="basic_data_item"><p>badの数 12</p></div>
						<div class="basic_data_item"><p>質問の数 12</p></div>
					</div>
					-->

					<div class="basic_data_box">
						<div class="basic_data_item"><p><strong>誕生日：</strong><?php echo($data['birthday']); ?></p></div>
						<div class="basic_data_item"><p><strong>年齢：</strong><?php echo($data['age']); ?></p></div>
						<div class="basic_data_item"><p><strong>住んでいるところ：</strong><?php echo($data['come_from']); ?></p></div>
						<div class="basic_data_item"><p><strong>出身校：</strong><?php echo($data['educational_background']); ?></p></div>
						<div class="basic_data_item"><p><strong>勤務先：</strong><?php echo($data['works']); ?></p></div>
									
					</div>

					<div class="basic_data_box">
						<div class="basic_data_item"><p><strong>好きな人：</strong><?php echo($data['lover']); ?></p></div>
						<div class="basic_data_item"><p><strong>好きな歌手：</strong><?php echo($data['singer']); ?></p></div>
						<div class="basic_data_item"><p><strong>好きな小説家：</strong><?php echo($data['writer']); ?></p></div>
						<div class="basic_data_item"><p><strong>好きな映画：</strong><?php echo($data['movie']); ?></p></div>
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

<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>
