<?php
session_start();
require('../../php/db_connect.php');
require('../../php/user_data.php');
require('../../php/user_data/personalData.php');
require('../../php/question/question.php');
require('../../php/sanitize/sanitize.php');
require('../../php/answer/answer.php');
$personal_data = new personalData();
$question = new question();
$answer = new answer();

?>
<!DOCTYPE html>
<html>
<head>
<title>質問</title>
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
<style type="text/css">

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
<?php

$question_id = h($_GET['question_id']);
$question_data = $question->get_question_data($question_id);
$questioner_data = $personal_data->get_personal_data($question_data['email']);

$comment_num = $answer->get_num_for_answer($question_id);

$answer_data_list = $answer->get_answer_data($question_id);
foreach ($answer_data_list as $key => $value) {
	$answer_data[$key][0] = $value;
	$answer_data[$key][1] = $personal_data->get_personal_data($value['email']);
}

?>
<?php
echo'

<div class="question_box">
	<div class="question_format">
		<div class="question_item">
			<div class="item_li left_li f_f"><small class="group_name">'.$question_data['question_to'].'</small></div>
			<div class="item_li right_li f_f"><small>08/01 20:45</small></div>
		</div>

		<div class="user_box">
			<div class="user_images f_f">
				<a href="profile.php?friend_id='.$questioner_data['id'].'"><img src="../../mypage/profile/img/thumbnail/thumbnail.jpg" style="height:60px;width:60px;"></a>
			</div>
			<div class="user_item f_f">
				<div class="user_name">
					<p><a href="profile.php?friend_id='.$questioner_data['id'].'">'.$questioner_data[0]['name'].'</a></p>
				</div>
			</div>
			<div class="list_menu f_f">
				<i class="fa fa-angle-double-right" style="font-size:30px;line-height:60px;color:#DCDCDC;"></i>
			</div>
		</div>

		<div class="question_text">
			<p style="color:black;">
				'.$question_data['question'].'	
			</p>
		</div>

		<div class="question_menu">
			<ul style="text-align:center;">
				<li class="question_menu_li">
					<div class="menu_format"><i class="fa fa-pencil-square-o"></i></div>
					<div class="menu_format"><a href="answer.php">答える</a></div>
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
					<div class="menu_format"><i class="fa fa-comment"></i>'.$comment_num.'</div>
					<div class="menu_format">コメント</div>
				</li>
			</ul>
		</div>
	</div>	
</div>
';
?>
<div class="answer_box">
	<div class="answer_format">
		<form method="post" action="../../php/answer_question.php">
			<textarea name="comment" placeholder="答えてみる"></textarea>
			<input type="hidden" name="question_id" value="<?php echo $_GET['question_id']; ?>"><br>
			<div class="answer_format_box">
				<div class="answer_item answer-btn1">
					<label for="checkbox-1">匿名にする</label> 
					<input type="checkbox" name="anonymity" id="checkbox-1" /> 
				</div>
				<div class="answer_item answer-btn2">
					<input class="btn_answer"type="submit" value="投稿する">
				</div>
			</div>
		</form>
	</div>
</div>


<?php
foreach ($answer_data as $key => $value) {
	echo '
		<div class="question_box">
			<div class="question_format">
				<div class="question_item">
					<div class="item_li left_li f_f"><small class="group_name">'.$question_data['question_to'].'</small></div>
					<div class="item_li right_li f_f"><small>08/01 20:45</small></div>
				</div>

				<div class="user_box">
					<div class="user_images f_f">
						<a href="profile.php?friend_id='.$questioner_data['id'].'"><img src="../../mypage/profile/img/thumbnail/thumbnail.jpg" style="height:50px;width:50px;"></a>
					</div>
					<div class="user_item f_f">
						<div class="user_name">
							<p><a href="profile.php?friend_id='.$questioner_data['id'].'">'.$value[1][0]['name'].'</a></p>
						</div>
					</div>
					<div class="list_menu f_f">
						<i class="fa fa-angle-double-right" style="font-size:30px;line-height:60px;color:#DCDCDC;"></i>
					</div>
				</div>

				<div class="question_text">
					<p>
						<a href="./single_question.php?question_id='.$question_data['id'].'" style="color:black;">
							'.$value[0]['answer'].'	
						</a>
					</p>
				</div>

				<div class="question_menu">
					<ul>
						<!--
						<li class="s_question_menu_li">
							<div class="menu_format"><i class="fa fa-share"></i></div>
							<div class="menu_format"><a href="answer.php">返信</a></div>
						</li>
						-->
						<li class="s_question_menu_li">
							<div class="menu_format"><i class="fa fa-thumbs-up"></i>0</div>
							<div class="menu_format">good</div>
						</li>
						<li class="s_question_menu_li">
							<div class="menu_format"><i class="fa fa-thumbs-down"></i>0</div>
							<div class="menu_format">bad</div>
						</li>
					</ul>
				</div>
				<!--返信フォーマット-->

				<!---->
			</div>
		</div>
	';
}
?>

	</div>
<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>