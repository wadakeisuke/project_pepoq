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


			<div style="margin:0 auto;background-color:white;position:relative;width:100%;border-bottom:solid 1px #DCDCDC;">
				<div style="width:95%;margin:0 auto;">
					<div style="position:absolute;top:0;right:10px;color:gray;"><small>6分前</small></div>
					<div id="user_image" style="float:left;width:20%;height:100%;padding-top:10px;">
						<img src="man.jpg" height="60px;" style="max-width:100%;">
					</div>
					<div class="user_question" style="width:80%;height:100%;float:left;padding-bottom:30px;">
						<div style="width:95%;margin:0 auto;">
							<div id="user_name" style="height:40px;padding-top:10px;">早稲田大学</div>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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