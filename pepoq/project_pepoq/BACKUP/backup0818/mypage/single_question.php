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
}
#content{
	padding-top:75px;
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
.group_name{
border:solid 1px #FFF4F4;
border-radius: 7px;
padding:3px;
background-color:#FFF4F4;
color: #FF5959;
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
/**
 * パラメータをサニタイズ
 * @param int $value
 * @return int
 */
function h($value)
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$question_id = h($_GET['question_id']);
$question_data = get_question_data($question_id);
$questioner_data = get_personal_data($question_data['email']);

$answer_data_list = get_answer_data($question_id);
foreach ($answer_data_list as $key => $value) {
	$answer_data[$key][0] = $value;
	$answer_data[$key][1] = get_personal_data($value['email']);
}


/**
 * question_idから質問を取得
 * @param int $question_id
 * @return array $question 
 */
function get_question_data($question_id)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question WHERE id = :id');
	$sql->bindValue(':id', $question_id);
	$sql->execute();
	$question_data = $sql->fetch(PDO::FETCH_ASSOC);
	return $question_data;	
}

/**
 * question_idから回答を取得 新しい順番で
 * @param int $question_id
 * @return array $answer_data_list
 */
function get_answer_data($question_id)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM answer WHERE question_id = :question_id ORDER BY created DESC');
	$sql->bindValue(':question_id', $question_id);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$answer_data_list[] = $data;
	}
	return $answer_data_list;
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
?>

<?php
echo'
	<div style="clear:both;background-color:white;width:100%;border-bottom:solid 1px #DCDCDC;margin-bottom:10px;">
		<div style="padding:7px;">
			<div style="background-color:;height:25px;">
				<ul>
					<li style="float:left;width:25%;"><small class="group_name" style="">みんな</small></li>
					<li style="float:left;width:75%;text-align:right;color:gray;"><small>08/01 20:45</small></li>
				</ul>
			</div>		
			<div style="clear:both;background-color:;height:50px;color:gray;">
				<ul>
					<li style="float:left;background-color:;margin-left:10px;">
						<a href="profile.php?friend_id='.$questioner_data['id'].'"><img src="../img/thumbnail/group.jpg" style="height:40px;width:40px;"></a>
					</li>
					<li style="float:left;background-color:;margin-left:10px;">
						<a href="profile.php?friend_id='.$questioner_data['id'].'">'.$questioner_data[0]['name'].'</a>
					</li>					
				</ul>
			</div>
			<div style="clear:both;padding:5px 0;width:90%;margin:0 auto;background-color:;min-height:50px;">
				<a href="./single_question.php?question_id='.$question_data['id'].'" style="color:black;">
					'.$question_data['question'].'	
				</a>
			</div>
			<div style="background-color:;height:30px;color:gray;">
				<ul style="text-align:center;">
					<li style="float:left;width:25%;"><a href="answer.php">答える</a></li>
					<li style="float:left;width:25%;"><i class="fa fa-thumbs-up"></i>111</li>
					<li style="float:left;width:25%;"><i class="fa fa-thumbs-down"></i>111</li>
					<li style="float:left;width:25%;"><i class="fa fa-comment"></i>0</li>
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
foreach ($answer_data as $key => $value) {
	echo '
		<div style="width:80%;margin:0 auto;">
			<div style="position:absolute;top:0;right:20px;color:gray;"><small>6分前</small></div>
			<div id="user_image" style="float:left;width:20%;height:100%;padding-top:10px;">
				<img src="../img/thumbnail/man.jpg" height="45px;" style="max-width:100%;">
			</div>
			<div class="user_question" style="width:80%;height:100%;float:left;padding-bottom:30px;">
				<div style="width:95%;margin:0 auto;">
					<div id="user_name" style="height:40px;padding-top:10px;">'.$value[1][0]['name'].'</div>
					'.$value[0]['answer'].'	
				</div>
			</div>
			<div style="text-align:center;clear:both;width:100%;background-color:;color:gray;height:30px;border-top:1px dotted gray;">
				<div>
					<ul>
						<li style="float:left;width:50%;"><a href="../mypage/reply.php?answer_id='.$value[0]['id'].'"><i class="fa fa-reply"></i><small style="padding-left:5px;"></small></a></li>
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