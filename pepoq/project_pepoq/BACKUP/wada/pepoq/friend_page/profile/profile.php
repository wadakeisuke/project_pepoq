<?php
header('Content-type: text/html; charset=UTF-8');


session_start();
//include('../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/sanitize/sanitize.php');
include('../../php/user_data/personalData.php');
require('../../php/check/check.php');
$check = new check();
$personal_data = new personalData();
$friend_id = h($_GET['friend_id']);
$data = $personal_data->get_personal_data_from_id($friend_id);

if ($data['id'] == $_SESSION['mypage']['id']) {
	header('Location: ../../mypage/profile/profile.php');
	exit;
}

$friend_type = $check->check_friend_type($_SESSION['mypage']['email'], $data['email']);


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
<!--loading-->
<script>
$(function() {
  var h = $(window).height();
 
  $('#wrap').css('display','none');
  $('#loader-bg ,#loader').height(h).css('display','inline');
});
 
$(window).load(function () { //全ての読み込みが完了したら実行
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
  $('#wrap').css('display', 'inline');
});
 
//10秒たったら強制的にロード画面を非表示
$(function(){
  setTimeout('stopload()',10000);
});
 
function stopload(){
  $('#wrap').css('display','inline');
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
}
</script>
<!--loading-->
<!--start google analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69530483-1', 'auto');
  ga('send', 'pageview');

</script>
<!--end google analytics-->
</head>
<body>
<div id="loader-bg">
  <div id="loader">
    <img src="../../img/img-loading.gif" width="80" height="80" alt="Now Loading..." />
    <p>Now Loading...</p>
  </div>
</div>
<div id="wrap">
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
				<?php if ($friend_type == 'フォロー') { ?>
					<form action="../../php/friend_edit/friend_edit.php" method="post">
						<input type="hidden" name="friend_id" value="<?php echo $friend_id; ?>">
						<input type="submit" name="request_friend" class="btn" value="フォロー">
					</form>
				<?php } ?>
				<?php if ($friend_type == 'フォローされています') { ?>
					<form action="../../php/friend_edit/friend_edit.php">
						<input type="hidden" name="friend_id" value="<?php echo $friend_id; ?>">
						<input type="submit" name="request_friend" class="btn" value="フォローされています">
					</form>
				<?php } ?>
				<?php if ($friend_type == 'フォロー中') { ?>
					<form action="../../php/friend_edit/friend_edit.php" method="post">
						<input type="hidden" name="edit_type" value="cancel">
						<input type="hidden" name="friend_id" value="<?php echo $friend_id; ?>">
						<input type="submit" name="request_friend" class="btn" value="フォロー中">
					</form>
				<?php } ?>
				</div>
			</div>
			
		</div>
		<!--end user info -->
		<!--begin menu-->
		<!--
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
		-->
		<!--end menu -->

			<div class="lower_content">
			<div class="prof_category"><p></p></div>
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
						<div class="basic_data_item"><p><strong>性別：</strong><?php echo($data['sex']); ?></p></div>
						<div class="basic_data_item"><p><strong>年代：</strong><?php echo($data['age']); ?></p></div>
						<div class="basic_data_item"><p><strong>血液型：</strong><?php echo($data['blood_type']); ?></p></div>

					</div>

					<div class="basic_data_box">
						<div class="basic_data_item"><p><strong>住んでいるところ：</strong><?php echo($data['settlement']); ?></p></div>
						<div class="basic_data_item"><p><strong>学校：</strong><?php echo($data['school']); ?></p></div>
						<div class="basic_data_item"><p><strong>仕事：</strong><?php echo($data['job']); ?></p></div>
						<div class="basic_data_item"><p><strong>働いているところ：</strong><?php echo($data['place_of_work']); ?></p></div>									
					</div>

					<div class="basic_data_box">
						<div class="basic_data_item"><p><strong>好きなスポーツ：</strong><?php echo($data['favorite_sports']); ?></p></div>
						<div class="basic_data_item"><p><strong>好きな歌手：</strong><?php echo($data['favorite_singer']); ?></p></div>
						<div class="basic_data_item"><p><strong>好きな本：</strong><?php echo($data['favorite_book']); ?></p></div>
						<div class="basic_data_item"><p><strong>好きな映画：</strong><?php echo($data['favorite_movie']); ?></p></div>
						<div class="basic_data_item"><p><strong>好きなアニメ：</strong><?php echo($data['favorite_animation']); ?></p></div>
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
</div>

<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>