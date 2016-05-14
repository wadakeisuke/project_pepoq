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
#content{
	padding-top:70px;
	background-color:#FFFFE0;
	height:1000px;
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
include('./header.html');
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
echo'
				<div id="question_content">
					<div class="comment_date"><small>6分前</small></div>
					<div class="user_image">
						<img src="man.jpg" height="60px;" style="max-width:100%;">
					</div>
					<div id="user_question">
						<div id="user_question_content">
							<div id="user_name">'.$data['name'].'</div>
							'.$question['question'].'	
						</div>
					</div>
					<div style="text-align:center;clear:both;width:100%;background-color:;color:gray;height:30px;border-top:1px dotted gray;">
						<div>
							<ul>
								<li style="float:left;width:33%;"><a href="#"><i class="fa fa-reply"></i><small style="padding-left:5px;"></small></a></li>
								<li style="float:left;width:33%;"><a href="#"><i class="fa fa-thumbs-up"></i><small style="padding-left:5px;">327</small></a></li>
								<li style="float:left;width:34%;"><a href="#"><i class="fa fa-comment"></i><small style="padding-left:5px;">16</small></a></li>
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
					<textarea placeholder="答えてみる"></textarea>
						<span style="color:gray;"><input type="checkbox">匿名にする</span>
						<input type="submit" value="投稿する">
					</div>
				</div>
			</div>

			<div style="margin:0 auto;background-color:white;position:relative;width:100%;border-bottom:solid 1px #DCDCDC;">
				<div style="width:80%;margin:0 auto;">
					<div style="position:absolute;top:0;right:20px;color:gray;"><small>6分前</small></div>
					<div id="user_image" style="float:left;width:20%;height:100%;padding-top:10px;">
						<img src="man.jpg" height="45px;" style="max-width:100%;">
					</div>
					<div class="user_question" style="width:80%;height:100%;float:left;padding-bottom:30px;">
						<div style="width:95%;margin:0 auto;">
							<div id="user_name" style="height:40px;padding-top:10px;">早稲田大学</div>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
						</div>
					</div>
					<div style="text-align:center;clear:both;width:100%;background-color:;color:gray;height:30px;border-top:1px dotted gray;">
						<div>
							<ul>
								<li style="float:left;width:50%;"><a href="#"><i class="fa fa-reply"></i><small style="padding-left:5px;"></small></a></li>
								<li style="float:left;width:50%;"><a href="#"><i class="fa fa-comment"></i><small style="padding-left:5px;">16</small></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>








		</div>
	</div>
</div>
</body>
</html>