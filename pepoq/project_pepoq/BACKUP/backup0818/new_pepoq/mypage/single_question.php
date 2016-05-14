<?php
session_start();
require('../php/db_connect.php');
require('../php/user_data.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>質問</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../common/style/css/common_header.css">
<style type="text/css">
.icon{
	font-size: 25px;
	color: white;
}
#content{
	padding-top:70px;
	background-color:#FFFFE0;
	height:100%;
}
#single_question{
	margin:0 auto;
	background-color:white;
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
</style>
</head>
<body>
<div id="page_all" style="">
	<!--begin header-->
	<?php
include('../common/header.html');
	?>
	<!--end header-->
	<div id="content" style="">
		<div style="padding-top:10px;">


			<div id="single_question">
<?php
$question_id = htmlspecialchars($_GET['question_id'], ENT_QUOTES, 'UTF-8');
$sql = $pdo->prepare('SELECT * FROM question WHERE id = :id');
$sql->bindValue(':id', $question_id);
$sql->execute();
$question = $sql->fetch(PDO::FETCH_ASSOC);

$questioner = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
$questioner->bindValue(':email', $question['email']);
$questioner->execute();
$data = $questioner->fetch(PDO::FETCH_ASSOC);

$anonymity = $question['anonymity'];
if($anonymity == 'anonymity'){
	$questioner_name = '匿名希望';
}else{
	$questioner_name = $data['name'];
}


$comment_num = $pdo->prepare('SELECT COUNT(*) FROM answer WHERE question_id = :question_id');
$comment_num->bindValue(':question_id', $question['id']);
$comment_num->execute();
$comment_num = $comment_num->fetch(PDO::FETCH_ASSOC);
$comment_num = $comment_num['COUNT(*)'];

echo'
	<div id="question_content">
		<div class="comment_date"><small>6分前</small></div>
		<div class="user_image">
			<img src="../img/thumbnail/man.jpg" height="60px;" style="max-width:100%;">
		</div>
		<div id="user_question">
			<div id="user_question_content">
				<div id="user_name">'.$questioner_name.'</div>
				'.$question['question'].'	
			</div>
		</div>
		<div style="text-align:center;clear:both;width:100%;background-color:;color:gray;height:30px;border-top:1px dotted gray;">
			<div>
				<ul>
					<li style="float:left;width:33%;"><a href="#"><i class="fa fa-reply"></i><small style="padding-left:5px;"></small></a></li>
					<li style="float:left;width:33%;"><a href="#"><i class="fa fa-thumbs-up"></i><small style="padding-left:5px;">327</small></a></li>
					<li style="float:left;width:34%;"><a href="#"><i class="fa fa-comment"></i><small style="padding-left:5px;">'.$comment_num.'</small></a></li>
				</ul>
			</div>
		</div>
	</div>
';


?>


			</div>

			<div style="margin:0 auto;background-color:white;position:relative;width:100%;border-top:solid 1px gray;border-bottom:solid 1px #DCDCDC;padding:30px 0 30px;">
				<div style="width:95%;margin:0 auto;">			
					<div style="text-align:center;">
					<form method="post" action="../php/answer_question.php">
						<textarea name="comment" placeholder="答えてみる"></textarea>
						<input type="hidden" name="question_id" value="<?php echo $_GET['question_id']; ?>"><br>
						<span style="color:gray;"><input name="anonymity" type="checkbox">匿名にする</span>
						<input type="submit" value="投稿する">
					</form>
					</div>
				</div>
			</div>

			<div style="margin:0 auto;background-color:white;position:relative;width:100%;border-bottom:solid 1px #DCDCDC;">
<?php
$answer = $pdo->prepare('SELECT * FROM answer WHERE question_id = :question_id ORDER BY id DESC');
$answer->bindValue(':question_id', $question_id);
$answer->execute();
while($answer_data = $answer->fetch(PDO::FETCH_ASSOC)){
	$answer_man = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
	$answer_man->bindValue(':email', $answer_data['email']);
	$answer_man->execute();
	$answer_man_data = $answer_man->fetch(PDO::FETCH_ASSOC);

	$anonymity = $answer_data['anonymity'];
	if($anonymity == 'anonymity'){
		$answer_man_name = '匿名希望';
	}else{
		$answer_man_name = $answer_man_data['name'];
	}


	echo '
		<div style="width:80%;margin:0 auto;">
			<div style="position:absolute;top:0;right:20px;color:gray;"><small>6分前</small></div>
			<div id="user_image" style="float:left;width:20%;height:100%;padding-top:10px;">
				<img src="../img/thumbnail/man.jpg" height="45px;" style="max-width:100%;">
			</div>
			<div class="user_question" style="width:80%;height:100%;float:left;padding-bottom:30px;">
				<div style="width:95%;margin:0 auto;">
					<div id="user_name" style="height:40px;padding-top:10px;">'.$answer_man_name.'</div>
					'.$answer_data['answer'].'	
				</div>
			</div>
			<div style="text-align:center;clear:both;width:100%;background-color:;color:gray;height:30px;border-top:1px dotted gray;">
				<div>
					<ul>
						<li style="float:left;width:50%;"><a href="../mypage/single_question.php?question_id='.$answer_data['id'].'"><i class="fa fa-reply"></i><small style="padding-left:5px;"></small></a></li>
						<li style="float:left;width:50%;"><a href="#"><i class="fa fa-comment"></i><small style="padding-left:5px;">16</small></a></li>
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
</div>
</body>
</html>