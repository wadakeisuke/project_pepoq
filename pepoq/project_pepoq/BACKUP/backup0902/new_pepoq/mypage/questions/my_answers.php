<?php
session_start();
//include('../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/user_data.php');

require('../../php/user_data/personalData.php');
require('../../php/question/question.php');
require('../../php/answer/answer.php');
$personal_data = new personalData();
$question = new question();
$answer = new answer();

/*
echo '<pre>';
print_r($my_question_data);
echo '</pre>';
exit;
*/

//私への質問
$question_to_me_list = $question->get_question_to_me();
foreach ($question_to_me_list as $key => $value) {
	$data[$key]['personal_data'] = $personal_data->get_personal_data($value['email']);
	$data[$key]['question_data'] = $value;
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

<style type="text/css">
a{
	color: white;
}
.content{
	padding-top:70px;
	height:100%;
}
.question_menu{
	width:100%;
	height:30px;
}
.question_menu ul li{
	width:50%;
	height:30px;
	float:left;
	text-align:center;
	background:#2c3e50;
	padding-top: 15px;

}

/*new question format*/
.f_f{float:left;}
.format_question{
	width:100%;
	height:60px;
}

.group_name{border:solid 0px #FFF4F4;border-radius: 7px;/*padding:3px;*/background-color:#FFF4F4;color: #FF5959;float:left;height:25px;width:35%;}
.time{text-align:right;height:30px;width:60%;width:40%;}


.user_name{/*clear:both;*/text-align:left;height:30px;width:35%;}
.question_num{text-align:right;height:30px;width:40%;}

.question_item{width:100%;clear:both;}
/*new question format*/

</style>
</head>
<body>
<div id="page_all" style="">
	<!--begin header-->
	<?php
		include('../../common/header.html');
	?>
	<!--end header-->
	<div class="content">
	<div class="question_menu">
		<ul>
			<li><a href="my_questions.php">投稿した質問</a></li>
			<li><a href="#">あなたへの質問</a></li>	
		</ul>
	</div>
<?php

foreach ($data as $key => $value) {
		echo '

<div class="swipe-list theme-swipe-list">
  <div class="list js-swipeList">
    <div class="list-body js-swipeListTarget">
      <div class="list-contents list-cell">
      	<div id="user_image" style="height:60px;float:left;width:25%;">
			<img src="../profile/img/thumbnail/thumbnail.jpg" style="height:60px;width:60px;">
		</div>
		<div class="format_question">
			<div class="group_name f_f"><small>みんな</small></div>
			<div class="time f_f"><small>'.$value['question_data']['created'].'</small></div>

			<div class="user_name f_f"><small>'.$value['personal_data'][0]['name'].'</small></div>
			<div class="question_num f_f"><small>('.$value['comment_num'].')</small></div>
		</div>

		<div class="question_item">
        	<p class="titile"></p>
        	<p class="inner">
        	<a href="../../single_question/single_question/single_question.php?question_id='.$value['question_data']['id'].'" style="color:black;">
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
        <li><a href="../../php/question/delete_question.php?question_type=to_me&question_id='.$value['question_data']['id'].'"><i class="fa fa-trash"></i></a></li>
      </ul>
    </div>
  </div>
</div>
		';
	}
?>
	</div>
</div>
</body>
</html>
