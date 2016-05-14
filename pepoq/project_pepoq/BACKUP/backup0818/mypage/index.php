<?php
session_start();
include('../php/db_connect.php');
include('../php/user_data.php');
$result = get_question_to_all();
foreach ($result as $key => $question) {
	$personal_data = get_personal_data($question['email']);
	$comment_num = get_comment_num_for_question($question['id']);
	$data[$key][0] = $question;

	
	if(1000 < strlen($question['question'])){
		$data[$key][0]['question'] = mb_strimwidth($question['question'], 0, 100, "...", 'UTF-8');;

	}
	
	
	$data[$key][] = $personal_data;
	if($question['anonymity'] == 'anonymity'){
		$data[$key][1][0]['name'] = '匿名さん';
	}
	$data[$key][] = $comment_num;
}


/**
 * みんなに向けた質問を取得する
 */
function get_question_to_all()
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question 
		WHERE 
		question_to = :question_to OR 
		question_to = :question_to1 OR
		question_to = :question_to2 OR
		question_to = :question_to3 OR
		question_to = :question_to4 OR
		question_to = :question_to5
	ORDER BY id DESC
	');
	$sql->bindValue(':question_to', 'みんな');
	$sql->bindValue(':question_to1', '日記');
	$sql->bindValue(':question_to2', 'アイドル・芸能');
	$sql->bindValue(':question_to3', '育児');
	$sql->bindValue(':question_to4', '株式・投資・マネー');
	$sql->bindValue(':question_to5', 'コンピュータ');
	$sql->execute();
	$result = [];
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		array_push($result, $data); 
	}
	return $result;
}



/**
 * emailからプロフィールデータを取得
 * @param string $email
 * @return array $personal_data
 */
function get_personal_data($email)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
	$sql->bindValue(':email', $email);
	$sql->execute();
	$result = [];
	while($personal_data = $sql->fetch(PDO::FETCH_ASSOC)){
		array_push($result, $personal_data);
	}
	return $result;
}

/**
 * 質問に対するコメントの数を取得 
 * @param int $question_id
 * @return int
 */
function get_comment_num_for_question($question_id)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM answer WHERE question_id = :question_id');
	$sql->bindValue(':question_id', $question_id);
	$sql->execute();
	$answer_data = [];
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		array_push($answer_data, $data);
	}
	return count($answer_data);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>マイページ</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../common/style/css/common_header.css">
<style type="text/css">
.f_f{float:left;}
.icon{
	font-size: 25px;
	color: white;
}
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
	text-align:center;
}
.question_item{
	background:white;
	height:25px;
	width:80%;
	margin:0 10%;
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
		include('../common/header.html');
	?>
	<!--end header-->
	<div id="content" style="padding-top:85px;background-color:#DCDCDC;">

	<div class="question_box">
		<div class="question_category f_f"></div>
		<div class="ymzhis f_f"></div>
		<div class="question_user"></div>
		<div class="question_text"></div>
	</div>

<?php
foreach ($data as $key => $value) { 
echo'



			<div style="clear:both;background-color:red;width:100%;border-bottom:solid 1px #DCDCDC;margin-bottom:10px;">
				<div style="padding:7px;">
					<div style="background-color:;height:25px;">
						<ul>
							<li style="float:left;"><small class="group_name" style="">'.$value[0]['question_to'].'</small></li>
							<li style="float:left;position:absolute;right:10px;color:gray;"><small>08/01 20:45</small></li>
						</ul>
					</div>

					<div style="clear:both;background-color:bcompiler_write_included_filename(filehandle, filename);height:50px;color:gray;">
						<ul>
							<li style="float:left;background-color:;margin-left:10px;">
								<a href="profile.php?friend_id='.$value[1][0]['id'].'"><img src="../img/thumbnail/group.jpg" style="height:40px;width:40px;"></a>
							</li>
							<li style="float:left;background-color:green;margin-left:10px;">
								<a href="profile.php?friend_id='.$value[1][0]['id'].'">'.$value[1][0]['name'].'</a>
							</li>					
						</ul>
					</div>

					<div style="clear:both;padding:5px 0;width:90%;margin:0 auto;background-color:pink;min-height:50px;">
						<a href="./single_question.php?question_id='.$value[0]['id'].'" style="color:black;">
							'.$value[0]['question'].'
						</a>
					</div>

					<div style="background-color:yellow;height:30px;color:gray;">
						<ul style="text-align:center;">
							<li style="float:left;width:25%;"><a href="answer.php">答える</a></li>
							<li style="float:left;width:25%;"><i class="fa fa-thumbs-up"></i>0</li>
							<li style="float:left;width:25%;"><i class="fa fa-thumbs-down"></i>0</li>
							<li style="float:left;width:25%;">
								<a href="single_question.php?question_id='.$value[0]['id'].'"><i class="fa fa-comment"></i>'.$value[2].'</a>
							</li>
						</ul>
					</div>
				</div>	
			</div>

			<div class="question_box">
				<div class="question_format">
					<div class="question_item">
						<div class="item_li left_li f_f"><small class="group_name">'.$value[0]['question_to'].'</small></div>
						<div class="item_li right_li f_f"><small>08/01 20:45</small></div>
					</div>

					<div class="user_box">
						<div class="user_images f_f">
							<img src="../img/thumbnail/man.jpg" style="width:50px;height:50px;">
						</div>
						<div class="user_item f_f">
							<div class="user_name">
								<p>和田　慶祐</p>
							</div>
						</div>
						<div class="list_menu f_f">
							<i class="fa fa-angle-double-right" style="font-size:30px;line-height:60px;color:#DCDCDC;"></i>
						</div>
					</div>

					<div class="question_text">
						<p>
							<a href="./single_question.php?question_id='.$value[0]['id'].'">
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
								<div class="menu_format"><i class="fa fa-thumbs-up"></i>0</div>
								<div class="menu_format">good</div>
							</li>
							<li class="question_menu_li">
								<div class="menu_format"><i class="fa fa-thumbs-down"></i>0</div>
								<div class="menu_format">bad</div>
								</li>
							<li class="question_menu_li">
								<div class="menu_format"><a href="single_question.php?question_id='.$value[0]['id'].'"><i class="fa fa-comment"></i>'.$value[2].'</a></div>
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