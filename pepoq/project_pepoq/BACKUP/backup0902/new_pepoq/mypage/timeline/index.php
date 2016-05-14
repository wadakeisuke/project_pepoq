<?php
session_start();
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
	}

	//goodとbadの数
	$data[$key][0]['good_point_num'] = $question_point_num->get_good_point_num($question['id']);
	$data[$key][0]['bad_point_num'] = $question_point_num->get_bad_point_num($question['id']);

	$data[$key][] = $comment_num;
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
<style type="text/css">
.f_f{float:left;}
.group_name{
border:solid 1px #FFF4F4;
border-radius: 7px;
padding:3px;
background-color:#FFF4F4;
color: #FF5959;
}

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
/**/
/*user*/
.user_box{
	clear:both;
	width:96%;
	height:60px;
	margin:0 2%;
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
	width:50px;
	height:50px;
	margin:5px;
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
.question_menu{

}
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
.left_li{
	text-align:left;
}
.right_li{
	text-align:right;
}
</style>
</head>
<body>
<div id="page_all" style="">
	<!--begin header-->
	<?php
		include('../../common/header.html');
	?>
	<!--end header-->
	<div id="content" style="padding-top:85px;background-color:#DCDCDC;">

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
						<div class="item_li left_li f_f"><small class="group_name">'.$value[0]['question_to'].'</small></div>
						<div class="item_li right_li f_f"><small>'.$value[0]['created'].'</small></div>
					</div>

					<div class="user_box">
						<div class="user_images f_f">
							<img src="../profile/img/thumbnail/thumbnail.jpg" style="width:50px;height:50px;">
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
							<a href="../../single_question/single_question/single_question.php?question_id='.$value[0]['id'].'">
								'.$value[0]['question'].'
							</a>
						</p>
					</div>

					<div class="question_menu">
						<ul style="text-align:center;">
							<li class="question_menu_li">
								<div class="menu_format"><i class="fa fa-pencil-square-o"></i></div>
								<div class="menu_format"><a href="answer.php">答える</a></div>
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
</body>
</html>