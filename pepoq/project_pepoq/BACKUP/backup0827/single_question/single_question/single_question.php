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
<style type="text/css">
.content{
	padding-top:75px;
	background-color:#DCDCDC;
	height:100%;

}
#single_question{
	margin:0 auto;
	background-color:#DCDCDC;
	position:relative;
	width:100%;
	border-bottom:solid 1px #DCDCDC;
}
#question_content{
	width:95%;margin:0 auto;
}
.comment_date{
	position:absolute;
	top:0;
	right:10px;
	color:gray;
}
.user_image{
	float:left;width:20%;height:100%;padding-top:10px;
}
#user_question{
	width:80%;height:100%;float:left;padding-bottom:30px;
}
#user_question_content{
	width:95%;margin:0 auto;
}
#user_name{
	height:40px;padding-top:10px;
}
.group_name{
	border:solid 1px #FFF4F4;
	border-radius: 7px;
	padding:3px;
	background-color:#FFF4F4;
	color: #FF5959;
}
/**/
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
/*ba;klhgaejg:ipaqjgraklva:p*/
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
.s_question_menu_li{
	float:left;
	width:33.333333%;
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
/*ba;klhgaejg:ipaqjgraklva:p*/


/*回答フォーム*/
.answer_box{
	width:96%;
	height:100%;
	background:white;
	margin:0 2%;
	margin-bottom:10px;
	border-radius:3px;
}
.answer_format{
	width:100%;
	text-align:center;
	padding-top:10px;


}
/*回答フォーム*/

/*回答一覧*/

/*回答一覧*/
</style>
</head>
<body>
<div id="page_all" style="">
	<!--begin header-->
	<?php
include('../../common/header.html');
	?>
	<!--end header-->
	<div class="content" style="">
		<div style="padding-top:10px;">
			<div id="single_question">
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
				<a href="profile.php?friend_id='.$questioner_data['id'].'"><img src="../../mypage/profile/img/thumbnail/thumbnail.jpg" style="height:50px;width:50px;"></a>
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
			
			<span style="color:gray;"><input name="anonymity" type="checkbox">匿名にする</span>
			
			<input type="submit" value="投稿する">
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
					<ul style="text-align:center;">
						<li class="s_question_menu_li">
							<div class="menu_format"><i class="fa fa-share"></i></div>
							<div class="menu_format"><a href="answer.php">返信</a></div>
						</li>
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

			</div>	
		</div>
	';
}
?>
		</div>
	</div>
</div>

</body>
</html>