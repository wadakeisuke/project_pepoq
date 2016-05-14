<?php
session_start();
include('../../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/user_data.php');
require('../../php/genre_and_category/genre_and_category.php');



$genre_and_category = new GenreAndCategory();

if ($_GET['search_word'] !== '') {
	$search_word = h($_GET['search_word']);
	$result_question = search_question($search_word);

	foreach ($result_question as $key => $value) {
		$data[$key][] = $value;
		//$data[$key][0]['genre'] = $value['genre'];
		//$data[$key][0]'category'] = $value['category'];
		$data[$key][] = get_personal_data($value['email']);
	}
}


/**
 * パラメータをサニタイズ
 * @param string $value
 * @return string $sanitize_result;
 */
function h($value)
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * 質問を検索
 * @param array $search_word
 * @return 
 */
function search_question($search_word)
{
	include('../../php/db_connect.php');
	$search_word = '%'.$search_word.'%';
	$sql = $pdo->prepare('SELECT * FROM question WHERE question LIKE :question');
	$sql->bindValue(':question', $search_word);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$result_question[] = $data;
	}
	return $result_question;
}

/**
 * emailからプロフィールデータを取得
 * @param string $email
 * @return array $personal_data
 */
function get_personal_data($email)
{
	include('../../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
	$sql->bindValue(':email', $email);
	$sql->execute();
	while($personal_data = $sql->fetch(PDO::FETCH_ASSOC)){
		$result[] = $personal_data;
	}
	return $result;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>検索</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common_header.css">
<!--swipe list-->
<link href="./css/style.css" rel="stylesheet">
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery.swipeList.js"></script>

<style>
.pepoq4{
  background:#89003F;
}
.pepoq4 i{
  color:#d61e44;
}
.upper_question_format{
  margin-top:45px;
  width:100%;
  height:100%;
}
</style>

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
<script>
$(function(){
$(".js-swipeList").swipeList();
$(".js-swipeList2").swipeList({
direction: "right"
});
$(".js-swipeList3").swipeList({
speed: 1000
});
$(".js-swipeList4").swipeList({
easing: "ease-in"
});
});
</script>
</head>
<body>
<div id="loader-bg">
  <div id="loader">
    <img src="../../img/img-loading.gif" width="80" height="80" alt="Now Loading..." />
    <p>Now Loading...</p>
  </div>
</div>
<div id="wrap">
<div id="page_all" style="">
	<?php
		include('../../common/header.html');
	?>
	<!-- begin header_all-->
	<!--end header_all-->
		<div class="upper_question_format">
			<div class="segmented theme-segmented">
			    <a href="search_friend.php" class="cell" >友達を検索</a>
			    <a href="#"class="cell is-current">質問を検索</a>
			</div>
			<div id="search_form">
				<form action="search_friend.php" method="get">
					<input type="text" name="search_word" placeholder="検索/人物名を入力">
				</form>
			</div>
		</div>

	<div class="content">
<?php
foreach ($data as $key => $value) {
	echo'

		<div class="question_box">
			<div class="question_format">
				<div class="question_item">
					<div class="item_li left_li f_f"><small class="group_name">' .$value[0]['genre']. ' / ' . $value[0]['category']. '</small></div>
					<div class="item_li right_li f_f"><small>'.$value[0]['created'].'</small></div>
				</div>

				<div class="user_box">
					<div class="user_images f_f">
						<img src="../../mypage/profile/img/thumbnail/'.$value[1][0]['thumbnail'].'" style="width:60px;height:60px;">
					</div>
					<div class="user_item f_f">
						<div class="user_name">
							<p>'.$value[1][0]['name'].'</p>
						</div>
					</div>
					<div class="list_menu f_f">
						<i class="fa fa-angle-double-right" style="font-size:30px;line-height:60px;color:#DCDCDC;"></i>
					</div>
				</div>

				<div class="question_text">
					<p>
						<a href="../single_question/single_question/single_question.php?question_id='.$value[0]['id'].'">
							'.$value[0]['question'].'
						</a>
					</p>
				</div>

				<div class="question_menu">
					<ul style="text-align:center;">
						<li class="question_menu_li">
							<div class="menu_format"><i class="fa fa-pencil-square-o"></i></div>
							<div class="menu_format">
								<a href="../../single_question/single_question/single_question.php?question_id='.$value[0]['id'].'">答える</a>
							</div>
						</li>
						<li class="question_menu_li">
							<div class="menu_format"><i class="fa fa-thumbs-up"></i>0</div>
							<div class="menu_format">good</div>
						</li>
						<li class="question_menu_li">
							<div class="menu_format"><i class="fa fa-thumbs-down"></i>0</div>
							<div class="menu_format">bad</div>
							</li>
						<li class="question_menu_li">
							<div class="menu_format">
								<a href="../../single_question/single_question/single_question.php?question_id='.$value[0]['id'].'"><i class="fa fa-comment"></i>'.$value[2].'</a>
							</div>
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
</div>
</div>
<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>