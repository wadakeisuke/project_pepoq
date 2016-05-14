<?php
session_start();
include('../php/db_connect.php');
include('../php/user_data.php');

$user_group_data = get_user_group_data();

/**
 * ユーザーが参加しているグループのデータをを取得
 * @return array $user_group_data
 */
function get_user_group_data()
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM participating_group WHERE user_email = :user_email');
	$sql->bindValue(':user_email', $_SESSION['mypage']['email']);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$user_group_data[] = $data;
	}
	return $user_group_data;
}

$user_friend_data = get_user_friend_data();
foreach ($user_friend_data as $key => $value) {
	$friend_personal_data_list[] = get_personal_data($value['fr_email']);
}

/**
 * 
 */
function get_user_friend_data()
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM friend WHERE my_email = :my_email');
	$sql->bindValue(':my_email', $_SESSION['mypage']['email']);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$user_friend_data[] = $data;
	}
	return $user_friend_data;
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
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$personal_data[] = $data;
	}
	return $personal_data;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>コメント</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../common/style/css/common_header.css">
<link href="./css/style.css" rel="stylesheet">

</head>
<body> 
<div id="page_all" style="">
	<!-- begin header_all-->
	<div id="header_all">			
		<div id="upper_header">
			<div id="page_back">
				<a onclick="history.back()"><i class="fa fa-angle-left icon"></i></a>
			</div>
			<div id="page_title">検索する</div>
		</div>

	</div>
	<!--end header_all-->
 				
	<div class="content">
		<form method="post" action="../php/add_question.php">
			
		<select class="select-box" name="question_to">
			<optgroup label="">
				<option value="みんな">みんなに質問</option>
			</optgroup>

			<optgroup label="グループ">
			<?php
				foreach ($user_group_data as $key => $value) {
					echo '<option value="'.$value['group_name'].'">'.$value['group_name'].'</option>';
				}
			?>
			</optgroup>

			<optgroup label="友達">
			<?php
				foreach ($friend_personal_data_list as $key => $value) {
					echo '<option value="'.$value[0]['email'].'">'.$value[0]['name'].'</option>';
				}
			?>
			</optgroup>

		</select>
		<!--select 2-->
		<select class="select-box" name="question_to">
			<optgroup label="">
				<option value="みんな">みんなに質問</option>
			</optgroup>

			<optgroup label="グループ">
			<?php
				foreach ($user_group_data as $key => $value) {
					echo '<option value="'.$value['group_name'].'">'.$value['group_name'].'</option>';
				}
			?>
			</optgroup>

			<optgroup label="友達">
			<?php
				foreach ($friend_personal_data_list as $key => $value) {
					echo '<option value="'.$value[0]['email'].'">'.$value[0]['name'].'</option>';
				}
			?>
			</optgroup>

		</select>

		<div class="new_question_format">
			<textarea name="question" placeholder="何が知りたい？"></textarea>

			<div class="input-item">
				<label for="checkbox-1">名前を表示して質問</label> 
				<input style="" type="checkbox" name="register" id="checkbox-1" /> 
			</div>
			<input class="btn" type="submit" value="質問">
		</div>
		</form>
	</div>

</div>
</body>
</html>