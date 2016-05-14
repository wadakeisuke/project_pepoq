<?php
session_start();

ini_set( 'display_errors', 1 );

include('../php/login_check.php');
include('../php/db_connect.php');
include('../php/user_data.php');
?>
<?php
if(isset($_POST['friend_id'])){
	$friend_id = $_POST['friend_id'];
	$friend_data = get_friend_data($friend_id);
}

/**
 * personal_dataのidからfriendデータの取得
 * @param int $friend_id
 * @return array $friend_data
 */
function get_friend_data($friend_id)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE id = :friend_id');
	$sql->bindValue(':friend_id', $friend_id);
	$sql->execute();
	$friend_data = $sql->fetch(PDO::FETCH_ASSOC);
	return $friend_data;	
}

if(isset($_POST['submit'])){
	$anonymity = $_POST['anonymity'];
	$friend_data = get_friend_data($_POST['friend_id']);
	$question_to = $friend_data['email'];
	$email = $_SESSION['mypage']['email'];
	$question = $_POST['question'];
	//var_dump($anonymity, $to, $email, $question);exit;

	to_ask_a_question($anonymity, $question_to, $email, $question);
	header('Location: ../mypage/index.php');
	exit();
}
/**
 * questionに追加
 * @param string $anonymity
 * @param string $to
 * @param string $email
 * @param string $question
 * @return 
 */
function to_ask_a_question($anonymity, $question_to, $email, $question)
{
	include('../php/db_connect.php');
	$sql = $pdo -> prepare("INSERT INTO question (anonymity, question_to, email, question) VALUES (:anonymity, :question_to, :email, :question)");
	if(isset($anonymity)){
		$sql->bindValue(':anonymity', 'anonymity');
	}else{
		$sql->bindValue(':anonymity', 'register');
	}
	$sql->bindValue(':question_to', $question_to);
	$sql->bindValue(':email', $email);
	$sql->bindValue(':question', $question);
	$sql->execute();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>トーク</title>
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
</style>
</head>
<body>
<div id="page_all" style="">

	<div id="content">


<div style="position:fixed;width:100%;">
	<div style="padding-top:10px;padding-bottom:10px;background-color:#34495E;color:white;height:30px;">
		<div style="float:left;margin-left:5%;"><a onclick="history.back()"><i class="fa fa-angle-left icon"></i></a></div>
		<div id="user_name" style="float:left;font-size:16px;margin-left:20%;"><?php echo $friend_data['name']; ?></div>
	</div>
</div>


		<div style="padding-top:50px;">

			<div style="margin:0 auto;background-color:white;position:relative;width:100%;border-top:solid 1px gray;border-bottom:solid 1px #DCDCDC;padding:30px 0 30px;">
				<div style="width:95%;margin:0 auto;">			
					<div style="text-align:center;">
						<form method="post" action="talk.php">
							<textarea name="question" placeholder="<?php echo $friend_data['name']; ?>に質問してみる"></textarea><br>
							<input type="hidden" name="question_id" value="<?php echo $_GET['question_id']; ?>">
							<input type="hidden" name="friend_id" value="<?php echo $friend_data['id'] ?>">
							<span style="color:gray;"><input name="anonymity" type="checkbox">匿名にする</span>
							<input name="submit" type="submit" value="投稿する">
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</body>
</html>