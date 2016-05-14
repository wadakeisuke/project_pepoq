<?php
session_start();
header("Content-type: text/html; charset=utf-8");
ini_set('display_errors', 1);
include('../../php/db_connect.php');
include('../../php/user_data.php');
require('../../php/user_data/personalData.php');
require('../../php/question/question.php');
require('../../php/question/question_point_num.php');
require('../../php/answer/answer.php');
require('../../php/time_and_date/time_and_date.php');

$personal_data = new personalData();
$question = new question();
$question_point_num = new QuestionPointNum();
$answer = new answer();
$time_and_date = new TimeAndDate();
//$time_and_date->getPostTimeDate($created_date);

$result = $question->get_question_to_all();
foreach ($result as $key => $question) {
	$user_data = $personal_data->get_personal_data($question['email']);
	$comment_num = $answer->get_num_for_answer($question['id']);
	$data[$key][0] = $question;
	$data[$key][0]['created'] = $time_and_date->getPostTimeDate($question['created']);

	if(1000 < strlen($question['question'])){
		$data[$key][0]['question'] = mb_strimwidth($question['question'], 0, 100, "...", 'UTF-8');

	}
	
	$data[$key][] = $user_data;
	if($question['anonymity'] == 'anonymity'){
		$data[$key][1][0]['name'] = '匿名さん';
		$data[$key][1][0]['thumbnail'] = 'thumbnail.jpg';
	}

	$data[$key][0]['genre'] = $question['genre'];
	$data[$key][0]['category'] = $question['category'];

	//goodとbadの数
	$data[$key][0]['good_point_num'] = $question_point_num->get_good_point_num($question['id']);
	$data[$key][0]['bad_point_num'] = $question_point_num->get_bad_point_num($question['id']);

	$data[$key][] = $comment_num;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>マイページ</title>
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
.pepoq1{
	background:#89003F;
	color:green;
}
.pepoq1 i{
	color:#d61e44;
}
</style>
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
	<!--begin header-->
	<?php
		include('../../common/header.html');
	?>
	<!--end header-->
	<div class="content">

<?php

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;
foreach ($data as $key => $value) { 
echo'
			<div class="question_box">
				<div class="question_format">
					<div class="question_item">
						<div class="item_li_1 left_li f_f"><small class="group_name">'.$value[0]['genre'].' / '.$value[0]['category'].'</small></div>
						<div class="item_li_2 right_li f_f"><small>'.$value[0]['created'].'</small></div>
					</div>

					<div class="user_box">
';
	if ($data[$key][1][0]['name'] != '匿名さん') {
		echo '<a href="../../friend_page/profile/profile.php?friend_id='.$value[1][0]['id'].'">';
	}						
echo '
							<div class="user_images f_f">
								<img src="../profile/img/thumbnail/'.$value[1][0]['thumbnail'].'" style="width:60px;height:60px;">
							</div>
							<div class="user_item f_f">
								<div class="user_name">
									<p>'.$value[1][0]['name'].'</p>
								</div>
							</div>
';

	if ($data[$key][1][0]['name'] != '匿名さん') {
		echo '</a>';
	}
echo '
							<div class="list_menu f_f">
								
							</div>
';

echo '
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
								<div class="menu_format"><a href="../../php/question/question_point.php?point_type=good&question_id='.$value[0]['id'].'"><i class="fa fa-thumbs-up"></i>'.$value[0]['good_point_num'].'</a></div>
								<div class="menu_format">good</div>
							</li>
							<li class="question_menu_li">
								<div class="menu_format"><a href="../../php/question/question_point.php?point_type=bad&question_id='.$value[0]['id'].'"><i class="fa fa-thumbs-down"></i>'.$value[0]['bad_point_num'].'</a></div>
								<div class="menu_format">bad</div>
							</li>
							<li class="question_menu_li">
								<div class="menu_format"><a href="../../single_question/single_question/single_question.php?question_id='.$value[0]['id'].'"><i class="fa fa-comment"></i>'.$value[2].'</a></div>
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