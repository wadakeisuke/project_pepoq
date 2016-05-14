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
			<div style="text-align:center;">		
				<div style="width:100%;background-color:;padding-top:5px;padding-bottom:5px;">匿名にする<input name="anonymity" type="checkbox"></div>
				<textarea name="comment" placeholder="何が知りたい？"></textarea>
				<input type="submit" value="コメント">
			</div>
		</form>
	</div>
</div>
</body>
</html>