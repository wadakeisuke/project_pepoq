<?php
session_start();
include('../php/login_check.php');
include('../php/db_connect.php');
include('../php/user_data.php');

if($_GET['search_word'] && $_GET['search_word'] !== ''){
	$search_word = h($_GET['search_word']);
	$result_question = search_question($search_word);
}else{
	$result_question = get_all_question();
}

foreach ($result_question as $key => $value) {
	$data[$key][] = $value;
	$data[$key][] = get_personal_data($value['email']);
}

/**
 * パラメータをサニタイズ
 * @param string $value
 * @return string $sanitize_result;
 */
function h($value)
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * 質問を検索
 * @param array $search_word
 * @return 
 */
function search_question($search_word)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question WHERE question LIKE :question');
	$sql->bindValue(':question', $search_word);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$result_question[] = $data;
	}
	return $result_question;
}

/**
 * 全ての質問を表示
 *
 */
function get_all_question()
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question WHERE question_to = "all"');
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$result_question[] = $data;
	}
	return $result_question;
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
	while($personal_data = $sql->fetch(PDO::FETCH_ASSOC)){
		$result[] = $personal_data;
	}
	return $result;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>検索</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../common/style/css/common_header.css">
<style type="text/css">

::-webkit-input-placeholder {
    color: #ECF0F1;
}

/*begin header*/
#header_all{
	position:fixed;
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
	float:left;width:33%;height:30px;padding-top:5px;padding-bottom:5px;background-color:;
}
#menu_search_group{
	float:left;width:34%;height:30px;padding-top:5px;padding-bottom:5px;background-color:;color:red;
}
#menu_search_question{
	float:left;width:33%;height:30px;padding-top:5px;padding-bottom:5px;background-color:dimgray;color:silver;
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

/*begin content*/
#content{
	padding-top:110px;
}
.search_result_box{
	padding:20px 0 10px;clear:both;background-color:white;width:100%;height:60px;border-bottom:solid 1px #DCDCDC;
}
.user_image{
	height:60px;background-color:;float:left;width:25%;
}
.user_image img{
	height:60px;width:60px;
}
.user_name_and_request{
	height:60px;background-color:;width:75%;float:left;
}
.user_name{
	font-size:16px;background-color:;
}
.friend_request{
	text-align:right;
}
.result_box{
	padding:0 10px 0 10px;
}
/*end content*/
</style>
</head>
<body>
<div id="page_all" style="">

	<div id="content">

	<!-- begin header_all-->
	<div id="header_all">			
		<div id="upper_header">
			<div id="page_back">
				<a onclick="history.back()"><i class="fa fa-angle-left icon"></i></a>
			</div>
			<div id="page_title">検索する</div>
		</div>

		<div id="header_menu">
			<div id="menu_search_friend">
				<a href="#"><i class="fa fa-user menu_icon menu_icon"></i></a>
			</div>
			<div id="menu_search_group">
				<a href="search_group.php"><i class="fa fa-users menu_icon"></i></a>
			</div>
			<div id="menu_search_question">
				<a href="search_question.php"><i class="fa fa-question menu_icon active"></i></a>
			</div>
		</div>
		<div id="search_form">
			<form action="search_question.php" method="get">
				<input type="text" name="search_word" placeholder="質問を入力">
			</form>
		</div>
	</div>
	<!--end header_all-->

		<div style="padding-top:30px;">


<?php
foreach ($data as $key => $value) {
	echo'
		<div style="padding:10px 0 10px;clear:both;background-color:white;width:100%;height:60px;border-bottom:solid 1px #DCDCDC;">
			<div style="padding:0 10px 0 10px;">
				<div id="user_image" style="height:60px;background-color:;float:left;width:25%;">
					<img src="../img/thumbnail/man.jpg" style="height:60px;width:60px;">
				</div>
				<div class="user_question" style="height:60px;background-color:;width:75%;float:left;">
					<div id="user_name" style="font-size:16px;background-color:;"><a href="more.php">'.$value[1][0]['name'].'</a></div>
					<div id="user_name" style="font-size:13px;background-color:;">'.$value[0]['question'].'</div>
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