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
<style type="text/css">
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
			<li><a href="#">投稿した質問</a></li>
			<li><a href="my_answers.php">あなたへの質問</a></li>	
		</ul>
	</div>

	<?php
foreach ($data as $key => $value) {
	echo '
		<a href="../../single_question/single_question/single_question.php?question_id='.$value['question_data']['id'].'" style="color:black;">
		<div style="padding:10px 0 10px;clear:both;background-color:white;width:100%;height:60px;border-bottom:solid 1px #DCDCDC;">
			<div style="padding:0 10px 0 10px;">
				<div id="user_image" style="height:60px;float:left;width:25%;">
					<img src="../profile/img/thumbnail/thumbnail.jpg" style="height:60px;width:60px;">
				</div>
				<div class="user_question" style="height:60px;width:75%;float:left;position:relative;">
					<div style="color:gray;font-size:15px;position:absolute;right:5px;"><small>'.$value['question_data']['created'].'</small></div>
					<div style="color:gray;font-size:15px;position:absolute;top:25px;right:5px;"><small>('.$value['comment_num'].')</small></div>
					<div id="user_name" style="font-size:16px;">'.$value['personal_data'][0]['name'].'</div>
					<div id="user_name" style="font-size:13px;color:gray;">'.$value['question_data']['question'].'</div>
				</div>
			</div>
		</div>
	</a> 
	';		
}
?>
	</div>
</div>
</body>
</html>