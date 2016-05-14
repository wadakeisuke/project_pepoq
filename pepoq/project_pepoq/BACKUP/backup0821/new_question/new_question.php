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
<style type="text/css">
*{
	font-family : YuGothic, '游ゴシック', sans-serif;
}
body{
	margin: 0;
	padding: 0;
	background-color:#FFFFE0;
}
textarea{
	width: 90%;
	height: 150px;
    font-size:14px;
    font-family: 'ヒラギノ角ゴ Pro W3', 'Hiragino Kaku Gothic Pro', 'Hiragino Kaku Gothic ProN', 'メイリオ', Meiryo;
    border: 1px solid #B9C9CE;
    border-radius:5px;
    padding: 12px 0.8em;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.2);
}
/*begin header*/
#header_all{
	position:fixed;
	z-index: 999999;
	width:100%;
}
#upper_header{
	background-color:#CC3333;
	height:30px;
}
#page_back{
	float:left;
	width:10%;
	text-align:center;
}

#page_title{
	color: white;
	text-align:center;
	float:left;
	font-size:16px;
	width:80%;
	padding-right:10%;
}

#header_menu{
	height:40px;
	clear:both;
	background-color:gray;
	width:100%;
	clear:both;
	text-align:center;
}
#menu_search_friend{
	float:left;width:33%;height:30px;padding-top:5px;padding-bottom:5px;background-color:dimgray;
}
#menu_search_group{
	float:left;width:34%;height:30px;padding-top:5px;padding-bottom:5px;background-color:;color:red;
}
#menu_search_question{
	float:left;width:33%;height:30px;padding-top:5px;padding-bottom:5px;background-color:;color:silver;
}
.icon{
	font-size: 25px;
	color: white;
}
.menu_icon{
	font-size: 25px;
	color:silver;
}
#search_form{
	padding:5px 10px 5px 10px;background-color:#585858;
}
#search_form input{
	border:none;padding:5px 3px 5px 3px;color:black;background-color:#BDC3C7;font-size:16px;width:95%;text-align:center;
}
.active{
	color:white;
}
/*end header*/
</style>
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
 				
	<div style="width:100%;background-color:#F5F5F5;height:300px;padding-top:30px;">
		<form method="post" action="../php/add_question.php">
			
				<select name="question_to">
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
			<div style="width:100%;text-align:center;">
				<fieldset data-role="controlgroup" style="width:90%; margin-right:auto;margin-left: auto;"> 
					<label for="checkbox-1">名前を表示して質問</label> 
					<input style="" type="checkbox" name="register" id="checkbox-1" class="custom" /> 
				</fieldset>	
				<textarea name="question" placeholder="何が知りたい？"></textarea>
				<input type="submit" value="質問">
			</div>
		</form>
	</div>
</div>
</body>
</html>