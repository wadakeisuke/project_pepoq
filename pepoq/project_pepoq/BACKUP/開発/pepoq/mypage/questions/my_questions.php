<?php
session_start();
//include('../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/user_data.php');


require('../../php/user_data/personalData.php');
require('../../php/question/question.php');
require('../../php/answer/answer.php');
require('../../php/time_and_date/time_and_date.php');
require('../../php/genre_and_category/genre_and_category.php');


$genre_and_category = new GenreAndCategory();
$personal_data = new personalData();
$question = new question();
$answer = new answer();
$time_and_date = new TimeAndDate();

// // ジャンル
// $genre = $genre_and_category->get_genre($question_data['genre']);
// // カテゴリ
// $category = $genre_and_category->get_category($genre, $question_data['category']);


//投稿した質問
$my_post_question_list = $question->get_my_post_question();

foreach ($my_post_question_list as $key => $value) {
	$data[$key]['personal_data'] = $personal_data->get_personal_data($value['question_to']);
	if(count($data[$key]['personal_data']) == 0){
		$data[$key]['personal_data'][0]['name'] = $value['question_to'];

	}
	$data[$key]['question_data'] = $value;
	if(240 < strlen($value['question'])){
		$data[$key]['question_data']['question'] = mb_strimwidth($value['question'], 0, 40, "...", 'UTF-8');
	}
  $data[$key]['question_data']['genre'] = $value['genre'];
  $data[$key]['question_data']['category'] = $value['category'];
  $data[$key]['question_data']['created'] = $time_and_date->getPostTimeDate($value['created']);
	$data[$key]['comment_num'] = $answer->get_num_for_answer($data[$key]['question_data']['id']); 
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;
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
.pepoq3{
  background:#89003F;
}
.pepoq3 i{
  color:#d61e44;
}
</style>

<!--list swipe-->
<link href="./css/style.css" rel="stylesheet">
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery.swipeList.js"></script>
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
	<!--begin header-->
	<?php
		include('../../common/header.html');
	?>
	<!--end header-->
	<div class="content">
	
  <!--<div class="question_menu">
		<ul>
			<li><a href="#">投稿一覧</a></li>
			<li class="hover_li"><a href="my_answers.php">あなたへの質問</a></li>	
		</ul>
	</div>
  -->
  <div class="segmented theme-segmented">
    <a href="#" class="cell is-current">投稿一覧</a>
    <a href="my_answers.php"class="cell">あなたへの質問</a>
  </div>

	<?php
foreach ($data as $key => $value) {
	echo '
<div class="swipe-list theme-swipe-list" style="clear:both">
  <div class="list js-swipeList">
    <div class="list-body js-swipeListTarget">
      <div class="list-contents list-cell">
      	<div id="user_image" style="height:60px;float:left;width:25%;">
			<img src="../profile/img/thumbnail/thumbnail.jpg" style="height:60px;width:60px;">
		</div>
		<div class="format_question">
			<div class="group_name f_f"><small>' . $value['question_data']['genre'] . ' / ' . $value['question_data']['category'] . '</small></div>
			<div class="time f_f"><small>'.$value['question_data']['created'].'</small></div>
			<div class="question_num_question"><small>('.$value['comment_num'].')</small></div>
		</div>

		<div class="question_item">
        	<p class="titile"></p>
        	<p class="inner">
        	<a href="../../single_question/single_question/single_question.php?question_id='.$value['question_data']['id'].'">
        	'.$value['question_data']['question'].'
        	</a>
        	</p>
        </div>
      
      </div>

      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
    </div>

    <div class="list-btn js-swipeListBtn">
      <ul>
        <li><a href="../../single_question/single_question/single_question.php?question_id='.$value['question_data']['id'].'"><i class="fa fa-edit"></i></a></li>
        <li><a href="../../php/question/delete_question.php?question_type=to_other&question_id='.$value['question_data']['id'].'"><i class="fa fa-trash"></i></a></li>
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