<?php
session_start();
//include('../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/user_data.php');


/**
 * 自分の質問を取得
 */
$my_question_data_list = get_my_question_data_list($pdo);

foreach ($my_question_data_list as $key => $value) {
	$data[$key][0] = $value;
	$data[$key][0]['genre'] = get_genre($value['genre']);
	$data[$key][0]['category'] = get_category($data[$key][0]['genre'], $value['category']);
}

function get_my_question_data_list($pdo) {
	$sql = $pdo->prepare('SELECT * FROM question WHERE email = :email');
	$sql->bindValue(':email', $_SESSION['mypage']['email']);
	$sql->execute();

	while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
		$my_question_data_list[] = $data;
	}

	return $my_question_data_list;
}



/**
 * ジャンルを取得
 */
function get_genre($id) {
	include('../../php/db_connect.php');
	$sql = $pdo->prepare('SELECT DISTINCT category_name FROM category_and_genre');
	$sql->execute();

	while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
		$genre_list[] = $data['category_name'];
	}
	return $genre_list[$id];
}

function get_category($genre, $id) {
	include('../../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM category_and_genre WHERE category_name = :category_name');
	$sql->bindValue(':category_name', $genre);
	$sql->execute();

	while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
		$category_list[] = $data;
	}
	return $category_list[$id]['genre_name'];
}

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
<style>
/*======================================================
==========3.question normal box==========start==========
=======================================================*/
/*question box*/
.question_box{
	clear:both;
	background-color:white;
	width:96%;
	margin:0 2%;
	border-bottom:solid 1px #DCDCDC;
	margin-bottom:10px;
	border-radius:3px;
}
.question_format{
	padding:7px;
}
.item_li{
	width:50%;
	height:30px;
	background:white;
}
.question_item{
	background:white;
	height:25px;
	width:90%;
	margin:0 5%;
}
.question_user{
	clear:both;
	background-color:bcompiler_write_included_filename(filehandle, filename);
	height:50px;
	color:#757575;
}
.group_name{
	border:solid 1px #FFF4F4;
	border-radius: 7px;
	padding:3px;
	background-color:#FFF4F4;
	color: #FF5959;
}
.question_text{
	clear:both;
	padding:5px 0;
	width:96%;
	margin:0 2%;
	background-color:white;
	min-height:50px;
}
.question_menu{
	background-color:white;
	height:30px;
	color:gray;
	border-top:dotted 1px #DCDCDC;
}
/*question box*/
/*question user infomation*/
.user_box{
	clear:both;
	width:96%;
	height:60px;
	margin:0 2%;
	padding-bottom:10px;
	background:white;
	border-bottom:dotted 1px #DCDCDC;
}
.user_images{
	width:30%;
	height:60px;
	background:white;
	text-align:center;
}
.user_images img{
	width:60px;
	height:60px;
	border:none;
}
.user_item{
	width:56%;
	height:60px;
	background:white;
}
.user_name{
	width:95%;
	padding-left:5%;
	background:white;
	color:gray;
}
/*question user infomation*/
/*question box menu*/
.question_menu_li{
	float:left;
	width:25%;
	height:30px;
}
.menu_format{
	width:100%;
	font-size:12px;
	height:15px;
}
.left_li{text-align:left;}
.right_li{text-align:right;}
/*question box menu*/

/*======================================================
==========3.question normal box==========end============
=======================================================*/


</style>
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
		<!--begin menu-->
		<div class="menu">
			<ul>
				<li>
					<div class="menu_icons"><i class="fa fa-pencil-square-o"></i></div>
					<a href="profile_question.php">タイムライン</a>
				</li>
				<li>
					<div class="menu_icons"><i class="fa fa-pencil-square-o"></i></div>
					<a href="profile.php">基本データ</a>
				</li>
			</ul>
		</div>
		<!--end menu -->
		<div class="lower_content">

			<?php
			foreach ($data as $key => $value) {
				echo '
					<div class="question_box">
						<div class="question_format">
							<div class="question_item">
								<div class="item_li left_li f_f"><small class="group_name">'.$value[0]['genre'].' / '.$value[0]['category'].'</small></div>
								<div class="item_li right_li f_f"><small>'.$value[0]['created'].'</small></div>
							</div>

							<div class="user_box">
								<a href="../../friend_page/profile/profile.php?friend_id='.$value[0]['id'].'">
									<div class="user_images f_f">
										<img src="../profile/img/thumbnail/'.$value[0]['thumbnail'].'" style="width:60px;height:60px;">
									</div>
									<div class="user_item f_f">
										<div class="user_name">
											<p>'.$value[0]['name'].'</p>
										</div>
									</div>
								</a>
									<div class="list_menu f_f">
										<i class="fa fa-angle-double-right" style="font-size:30px;line-height:60px;color:#DCDCDC;"></i>
									</div>
							</div>

							<div class="question_text">
								<p>
									<a href="../../single_question/single_question/single_question.php?question_id='.$value[0]['id'].'">
										'.$value[0]['question'].'
									</a>
								</p>
							</div>

							<div class="question_menu">
								<ul style="text-align:center;">
									<li class="question_menu_li">
										<div class="menu_format"><i class="fa fa-pencil-square-o"></i></div>
										<div class="menu_format"><a href="../../single_question/single_question/single_question.php?question_id='.$value[0]['id'].'">答える</a></div>
									</li>
									<li class="question_menu_li">
										<div class="menu_format"><a href="../../php/question/question_point.php?point_type=good&question_id='.$value[0]['id'].'"><i class="fa fa-thumbs-up"></i></a></div>
										<div class="menu_format">good</div>
									</li>
									<li class="question_menu_li">
										<div class="menu_format"><a href="../../php/question/question_point.php?point_type=bad&question_id='.$value[0]['id'].'"><i class="fa fa-thumbs-down"></i></a></div>
										<div class="menu_format">bad</div>
										</li>
									<li class="question_menu_li">
										<div class="menu_format"><a href="../../single_question/single_question/single_question.php?question_id='.$value[0]['id'].'"><i class="fa fa-comment"></i></a></div>
										<div class="menu_format">コメント</div>
									</li>
								</ul>
							</div>
						</div>	
					</div>				
				';
			}
			?>




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
