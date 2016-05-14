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
<link rel="stylesheet" type="text/css" href="./css/style.css">

<!--drawer format===================================================================================-->
<!----><link rel="stylesheet" href="../../common/style/css/drawer.css"><!--=========================-->
<!----><link rel="stylesheet" type="text/css" href="../../common/style/css/header_style.css"><!--===-->
<!----><script type="text/javascript" src="../../common/style/js/jquery-1.7.2.min.js"></script><!--=-->
<!--================================================================================================-->
<!--loading-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(function() {
  var h = $(window).height();
 
  $('#wrap').css('display','none');
  $('#loader-bg ,#loader').height(h).css('display','block');
});
 
$(window).load(function () { //全ての読み込みが完了したら実行
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
  $('#wrap').css('display', 'block');
});
 
//10秒たったら強制的にロード画面を非表示
$(function(){
  setTimeout('stopload()',10000);
});
 
function stopload(){
  $('#wrap').css('display','block');
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
				<img src="./img/thumbnail/' . $_SESSION['mypage']['thumbnail'] . '" width="100px" height="90px">
				';
				?>
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
			
			<div class="prof_category"><p></p></div>
			
				<div class="basic_data">
				
					<div class="basic_data_box">
						<div class="user_message">
							<div class="user_message_item">
								<p><?php echo($_SESSION['mypage']['comment']); ?></p>
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
						<div class="basic_data_item"><p><strong>性別：</strong><?php echo $_SESSION['mypage']['sex']; ?></p></div>
						<div class="basic_data_item"><p><strong>年代：</strong><?php echo $_SESSION['mypage']['age']; ?></p></div>
						<div class="basic_data_item"><p><strong>血液型：</strong><?php echo $_SESSION['mypage']['blood_type']; ?></p></div>
					</div>

					<div class="basic_data_box">
						<div class="basic_data_item"><p><strong>住んでいるところ：</strong><?php echo $_SESSION['mypage']['settlement']; ?></p></div>
						<div class="basic_data_item"><p><strong>学校：</strong><?php echo $_SESSION['mypage']['school']; ?></p></div>
						<div class="basic_data_item"><p><strong>仕事：</strong><?php echo $_SESSION['mypage']['job']; ?></p></div>
						<div class="basic_data_item"><p><strong>働いているところ：</strong><?php echo $_SESSION['mypage']['place_of_work']; ?></p></div>									
					</div>

					<div class="basic_data_box">
						<div class="basic_data_item"><p><strong>趣味：</strong><?php echo $_SESSION['mypage']['hobby']; ?></p></div>
						<div class="basic_data_item"><p><strong>特技：</strong><?php echo $_SESSION['mypage']['special_skill']; ?></p></div>
						<div class="basic_data_item"><p><strong>マイブーム：</strong><?php echo $_SESSION['mypage']['my_boom']; ?></p></div>
						<div class="basic_data_item"><p><strong>夢：</strong><?php echo $_SESSION['mypage']['dream']; ?></p></div>									
					</div>

					<div class="basic_data_box">
						<div class="basic_data_item"><p><strong>好きなスポーツ：</strong><?php echo $_SESSION['mypage']['favorite_sports']; ?></p></div>
						<div class="basic_data_item"><p><strong>好きな歌手：</strong><?php echo $_SESSION['mypage']['favorite_singer']; ?></p></div>
						<div class="basic_data_item"><p><strong>好きな本：</strong><?php echo $_SESSION['mypage']['favorite_book']; ?></p></div>
						<div class="basic_data_item"><p><strong>好きな映画：</strong><?php echo $_SESSION['mypage']['favorite_movie']; ?></p></div>
						<div class="basic_data_item"><p><strong>好きなアニメ：</strong><?php echo $_SESSION['mypage']['favorite_animation']; ?></p></div>
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
