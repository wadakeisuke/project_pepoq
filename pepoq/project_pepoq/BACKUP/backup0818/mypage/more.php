<?php
session_start();
include('../php/login_check.php');
include('../php/db_connect.php');
include('../php/user_data.php');
?>
<?php
if(isset($_GET['friend_id'])){
	$friend_id = $_GET['friend_id'];
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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../common/style/css/common_header.css">
<title>profile_or_question</title>
<style>
.icon{
	font-size: 25px;
	color: white;
}
.content{
	padding-top:80px;
	width:100%;
	height:100%;
	text-align:center;
	background-color: white;
}
.thumbnail_box{
	width:100%;
	height:100px;

}
.thumbnail_box img{
	width:100px;
	height:100px;
}
.float_left{
	float:left;
}
.submit_box{
	width:50%;
	height:50px;
	background:steelblue;
}
.submit_box input[type="submit"]{
	webkit-appearence:none;
	border:none;
	background:steelblue;

}
</style>
</head>
<body>
<div id="page_all">
	<!--begin header-->
	<?php
		include('../common/header.html');
	?>
	<!--end header-->
	<div class="content">
		<input type="button" value="キャンセル" onclick="history.back()">
		<div class="thumbnail_box">
			<img src="../img/thumbnail/man.jpg">
		</div>
		<div class="user_name">
			<p>
				<?php
					echo $friend_data['name'];
				?>
			</p>
		</div>
		<div class="submit_box float_left">
			<form action="profile.php" method="get">
				<input type="hidden" name="friend_id" value="<?php echo $friend_data['id']; ?>">
				<input type="submit" value="プロフィール">
			</form>
		</div>
		<div class="submit_box float_left">
			<form action="talk.php" method="post">
				<input type="hidden" name="friend_id" value="<?php echo $friend_data['id']; ?>">
				<input type="submit" value="質問">
			</form>
		</div>
	</div>
</div>
</body>
</html>