<?php
session_start();
//include('../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/user_data.php');

//投稿した質問
$my_post_question_list = get_my_post_question();
foreach ($my_post_question_list as $key => $value) {
	$my_question_data[$key]['personal_data'] = get_personal_data($value['question_to']);
	if(count($my_question_data[$key]['personal_data']) == 0){
		$my_question_data[$key]['personal_data'][0]['name'] = $value['question_to'];

	}
	$my_question_data[$key]['question_data'] = $value;
	if(240 < strlen($value['question'])){
		//$my_question_data[$key]['question_data'] = mb_strimwidth($value['question'], 0, 10, "...", 'UTF-8');
		$my_question_data[$key]['question_data']['question'] = mb_strimwidth($value['question'], 0, 40, "...", 'UTF-8');
	}
}
/*
echo '<pre>';
print_r($my_question_data);
echo '</pre>';
exit;
*/

//私への質問
$question_to_me_list = get_question_to_me();
foreach ($question_to_me_list as $key => $value) {
	$question_to_me_data[$key]['personal_data'] = get_personal_data($value['email']);
	$question_to_me_data[$key]['question_data'] = $value;
}


/**
 * 投稿した質問を取得
 */
function get_my_post_question()
{
	include('../../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question WHERE email = :email ORDER BY id DESC');
	$sql->bindValue(':email', $_SESSION['mypage']['email']);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$my_post_question[] = $data;
	}
	return $my_post_question;
}

/**
 * 私への質問を取得
 */
function get_question_to_me()
{
	include('../../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question WHERE question_to = :question_to ORDER BY id DESC');
	$sql->bindValue(':question_to', $_SESSION['mypage']['email']);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$question_to_me[] = $data;
	}
	return $question_to_me;
}

/**
 * emailからプロフィールデータを取得
 * @param string $email
 * @return array $personal_data
 */
function get_personal_data($email)
{
	include('../../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
	$sql->bindValue(':email', $email);
	$sql->execute();
	while($personal_data = $sql->fetch(PDO::FETCH_ASSOC)){
		$result[] = $personal_data;
	}
	return $result;
}

/**
 * 自分の最新の質問を取得
 * @param string $question_to
 * @return array $latest_my_question
 */
/*
function get_latest_my_question($question_to)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question WHERE question_to = :question_to AND email = :email ORDER BY id DESC LIMIT 1');
	$sql->bindValue(':question_to', $question_to);
	$sql->bindValue(':email', $_SESSION['mypage']['email']);
	$sql->execute();
	$latest_my_question = $sql->fetch(PDO::FETCH_ASSOC);
	return $latest_my_question;
}
*/
//自分が受けた質問一覧
/*
$questioner_list = get_questioner();
foreach ($questioner_list as $key => $value) {
	$other_question_data[$key][] = $value['email'];
	$latest_question = get_latest_question($value['email']);
	$other_question_data[$key][] = $latest_question;
	$created = $other_question_data[$key][1]['created'];
	$created = explode(' ', $created);
	$created = explode(':', $created[1]);
	$created = $created[0].':'.$created[1];
	$other_question_data[$key][1]['created'] = $created;
}
*/

/**
 * 自分がうけた質問の相手を取得 
 * @return array $questioner
 */
/*
function get_questioner()
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT DISTINCT email FROM question WHERE question_to = :question_to');
	$sql->bindValue(':question_to', $_SESSION['mypage']['email']);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$questioner_list[] = $data;
	}
	return $questioner_list;
}
*/

/**
 * 自分がうけた最新の質問を取得
 * @param string $questioner_email
 * @return array $latest_question
 */
/*
function get_latest_question($questioner_email)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question WHERE question_to = :question_to AND email = :email ORDER BY id DESC LIMIT 1');
	$sql->bindValue(':question_to', $_SESSION['mypage']['email']);
	$sql->bindValue(':email', $questioner_email);
	$sql->execute();
	$latest_question = $sql->fetch(PDO::FETCH_ASSOC);
	return $latest_question;
}
*/

/**
 * 質問した相手から自分の質問を取得
 * @param string $question_to
 * @return array $my_question
 */
/*
function get_my_question($question_to)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question WHERE question_to = :question_to AND email = :email');
	$sql->bindValue(':question_to', $question_to);
	$sql->bindValue(':email', $_SESSION['mypage']['email']);
	$sql->execute();
	while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
		$my_question_list[] = $data;
	}
	return $my_question_list;
}
*/

/**
 * emailからプロフィールデータを取得
 * @param string $email
 * @return array $personal_data
 */
/*
function get_personal_data($email)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
	$sql->bindValue(':email', $email);
	$sql->execute();
	while($personal_data = $sql->fetch(PDO::FETCH_ASSOC)){
		$result[] = $personal_data;
	}
	return $result;
}
*/
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
.icon{
	font-size: 25px;
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
			<li><a href="#">あなたへの質問</a></li>	
		</ul>
	</div>

	<?php

foreach ($my_question_data as $key => $value) {
echo '
<a href="./single_question.php?question_id='.$value['question_data']['id'].'" style="color:black;"> 
	<div style="clear:both;background-color:white;width:100%;height:80px;border-bottom:solid 1px #DCDCDC;">
		<div style="width:95%;margin:0 auto;padding:5px 0;">
			<div id="user_image" style="width:20%;float:left;">
				<img src="../img/thumbnail/group.jpg" style="height:50px;width:50px;">
			</div>
			
			<div style="width:60%;float:left;">
				<div style="color:black;font-size:15px;">'.$value['personal_data'][0]['name'].'</div>
				<div style="color:gray;font-size:13px;">'.$value['question_data']['question'].'</div>
			</div>

			<div style="color:gray;text-align:right;height:60px;width:20%;float:left;">
				<div style="">
					<small>22:30</small>
				</div>
				<div style="">
					<small>(10)</small>
				</div>
			</div>

		</div>		
	</div>   		
</a>  
';		
	}
?>

<?php
foreach ($question_to_me_data as $key => $value) {
		echo '
		<a href="./single_question.php?question_id='.$value['question_data']['id'].'" style="color:black;">
		<div style="padding:10px 0 10px;clear:both;background-color:white;width:100%;height:60px;border-bottom:solid 1px #DCDCDC;">
			<div style="padding:0 10px 0 10px;">
				<div id="user_image" style="height:60px;float:left;width:25%;">
					<img src="../img/thumbnail/group.jpg" style="height:60px;width:60px;">
				</div>
				<div class="user_question" style="height:60px;width:75%;float:left;position:relative;">
					<div style="color:gray;font-size:15px;position:absolute;right:5px;"><small>'.$value['question_data']['created'].'</small></div>
					<div style="color:gray;font-size:15px;position:absolute;top:25px;right:5px;"><small>(0)</small></div>
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