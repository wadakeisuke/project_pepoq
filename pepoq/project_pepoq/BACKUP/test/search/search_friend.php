<?php
include('../php/search_friend.php');
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
	line-height:30px;
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
	height:30px;
	clear:both;
	background-color:gray;
	width:100%;
	clear:both;
	text-align:center;
}
#menu_search_friend{
	float:left;width:33%;height:20px;padding-top:5px;padding-bottom:5px;background-color:dimgray;
}
#menu_search_group{
	float:left;width:34%;height:20px;padding-top:5px;padding-bottom:5px;background-color:;
}
#menu_search_question{
	float:left;width:33%;height:20px;padding-top:5px;padding-bottom:5px;background-color:;
}
.icon{
	font-size: 20px;
	color: white;
}
.menu_icon{
	font-size: 20px;
	color:silver;
}
#search_form{
	padding:5px 10px 5px 10px;background-color:#585858;
}
#search_form input{
	border:none;padding:5px 3px 5px 3px;color:black;background-color:#BDC3C7;font-size:16px;width:95%;
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
				<a href="#"><i class="fa fa-user menu_icon active"></i></a>
			</div>
			<div id="menu_search_group">
				<a href="search_group.php"><i class="fa fa-users menu_icon"></i></a>
			</div>
			<div id="menu_search_question">
				<a href="search_question.php"><i class="fa fa-question menu_icon"></i></a>
			</div>
		</div>
		<div id="search_form">
			<form action="search_friend.php" method="get">
				<input type="text" name="search_word" placeholder="検索/人物名を入力">
			</form>
		</div>
	</div>
	<!--end header_all-->




	<!--begin content-->
	<div id="content">
<?php
foreach ($result_friend as $key => $value) {
	echo'
		<div class="search_result_box">
			<div class="result_box">
				<div class="user_image">
					<img src="../img/thumbnail/man.jpg">
				</div>
				<div class="user_name_and_request">
					<div class="user_name">
						<a href="more.php">'.$value['name'].'</a>
					</div>
					<div class="friend_request">
						<form action="../php/search.php" method="post">
							<input type="hidden" name="friend_id" value="'.$value['id'].'">
							<input type="submit" value="友達申請">
						</form>
					</div>
				</div>	
			</div>		
		</div>
	';
}
?>
	</div>
	<!--end content-->

</div>
</body>
</html>