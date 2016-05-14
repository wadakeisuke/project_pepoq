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

<!--swipe list-->
<link href="./css/style.css" rel="stylesheet">
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery.swipeList.js"></script>
<script>
$(function(){
$(".js-swipeList").swipeList();
$(".js-swipeList2").swipeList({
direction: "right"
});
$(".js-swipeList3").swipeList({
speed: 1000
});
$(".js-swipeList4").swipeList({
easing: "ease-in"
});
});
</script>

</head>
<body>
<div id="page_all" style="">

	<!-- begin header_all-->
	<div id="header_all">			
		<div id="upper_header">
			<div id="page_back">
				<a onclick="history.back()"><i class="fa fa-angle-left back_icon"></i></a>
			</div>
			<div id="page_title">検索する</div>
		</div>

		<div id="header_menu">
			<div class="menu_search_li_hover">
				<a href="#"><i class="fa fa-user icon"></i></a>
				<p>友達</p>
			</div>
			<!--
			<div id="menu_search_group">
				<a href="search_group.php"><i class="fa fa-users menu_icon"></i></a>
			</div>
			-->
			<div class="menu_search_li">
				<a href="search_question.php"><i class="fa fa-question icon"></i></a>
				<p>質問</p>
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
	<div class="content">
<?php
foreach ($result_friend as $key => $value) {
	echo'
		<div class="swipe-list theme-swipe-list">
		  <div class="list js-swipeList">
		    <div class="list-body js-swipeListTarget">
		      <div class="list-contents list-cell">
		      	<div class="user_images float_left">
					<img src="../img/thumbnail/man.jpg"　style="width:60px;height:60px;">
				</div>
				<div class="user_item float_left">
					<div class="user_name">
						<p><a href="more.php">'.$value['name'].'</a></p>
					</div>
				</div>
		      </div>

		      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
		    </div>

		    <div class="list-btn js-swipeListBtn">
		      <ul>
		        <li><i class="fa fa-plus"></i></li>
		        <li><i class="fa fa-edit"></i></li>
		        <li><i class="fa fa-trash"></i></li>
		      </ul>
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