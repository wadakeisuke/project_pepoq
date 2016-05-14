<?php
session_start();
require('../php/db_connect.php');
require('../php/mypage_data.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>header</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="common.css">
<link rel="stylesheet" type="text/css" href="common_header.css">
<style type="text/css">
.icon{
	font-size: 25px;
	color: white;
}
</style>
</head>
<body>
<div id="page_all" style="">
	<!--begin header-->
	<?php
include('./header.html');
	?>
	<!--end header-->
	<div id="content" style="padding-top:70px;background-color:#FFFFE0;height:1000px;">
		<div style="padding-top:10px;">



<?php
$sql=$pdo->prepare('SELECT * FROM question');
$sql->execute();
while($question = $sql->fetch(PDO::FETCH_ASSOC)){
$questioner = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
$questioner->bindValue(':email',$question['email']);
$questioner->execute();
$data = $questioner->fetch(PDO::FETCH_ASSOC);
echo'
			<div style="margin:0 auto;background-color:white;position:relative;width:100%;border-bottom:solid 1px #DCDCDC;">
				<div style="width:95%;margin:0 auto;">
					<div style="position:absolute;top:0;right:10px;color:gray;"><small>6分前</small></div>
					<div id="user_image" style="float:left;width:20%;height:100%;padding-top:10px;">
						<img src="'.$data['thumbnail'].'" height="60px;" style="max-width:100%;">
					</div>
					<div class="user_question" style="width:80%;height:100%;float:left;padding-bottom:30px;">
						<div style="width:95%;margin:0 auto;">
							<div id="user_name" style="height:40px;padding-top:10px;">'.$data['name'].'</div>
							<a href="./single_question.php" style="color:black;">
							'.$question['question'].'
							</a>
						</div>
					</div>
					<div style="text-align:center;clear:both;width:100%;background-color:;color:gray;height:30px;border-top:1px dotted gray;">
						<div>
							<ul>
								<li style="float:left;width:50%;"><a href="#"><i class="fa fa-thumbs-up"></i><small style="padding-left:5px;">327</small></a></li>
								<li style="float:left;width:50%;"><a href="./single_question.php"><i class="fa fa-comment"></i><small style="padding-left:5px;">16</small></a></li>
							</ul>
						</div>
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