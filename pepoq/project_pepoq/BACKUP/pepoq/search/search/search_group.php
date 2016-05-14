<!DOCTYPE html>
<html>
<head>
<title>検索</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common_header.css">

<!--drawer format===================================================================================-->
<!----><link rel="stylesheet" href="../../common/style/css/drawer.css"><!--=========================-->
<!----><link rel="stylesheet" type="text/css" href="../../common/style/css/header_style.css"><!--===-->
<!----><script type="text/javascript" src="../../common/style/js/jquery-1.7.2.min.js"></script><!--=-->
<!--================================================================================================-->

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
				<a onclick="history.back()"><i class="fa fa-angle-left icon"></i></a>
			</div>
			<div id="page_title">検索する</div>
		</div>

		<div id="header_menu">
			<div id="menu_search_friend">
				<a href="search_friend.php"><i class="fa fa-user menu_icon active"></i></a>
			</div>
			<!--
			<div id="menu_search_group">
				<a href="search_group.php"><i class="fa fa-users menu_icon"></i></a>
			</div>
			-->
			<div id="menu_search_question">
				<a href="search_question.php"><i class="fa fa-question menu_icon"></i></a>
			</div>
		</div>
		<div id="search_form">
			<form action="search_friend.php" method="get">
				<input type="text" name="search_word" placeholder="検索/グループ名を入力">
			</form>
		</div>
	</div>
	<!--end header_all-->

	<div class="content">

<?php
$group_list = [
	'日記',
	'ゲーム',
	'アイドル・芸能',
	'育児',
	'株式・投資・マネー',
	'スポーツ',
	'医学',
	'時事',
	'政治・経済',
	'アニメ・コミック',
	'車・バイク',
	'ペット',
	'旅行',
	'ファイナンス',
	'学問・文学・芸術',
	'オンラインゲーム',
	'ファッション・ブランド',
	'アフィリエイト',
	'学校・教育',
	'ギャンブル',
];
foreach ($group_list as $value) {
	echo '
		<div class="swipe-list theme-swipe-list">
		  <div class="list js-swipeList">
		    <div class="list-body js-swipeListTarget">
		      <div class="list-contents list-cell">
		      	<div class="user_images float_left">
					<img src="../img/thumbnail/man.jpg"　style="width:60px;height:60px;">
				</div>
				<div class="user_item float_left">
					<div class="user_name">
						<p><a href="more.php">'.$value.'</a></p>
					</div>
				</div>
		      </div>

		      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
		    </div>

		    <div class="list-btn js-swipeListBtn">
		      <ul>
		        <li><i class="fa fa-plus"></i></li>
		      </ul>
		    </div>
		  </div>
		</div>
		';
		$i++;
}
?>

	</div>
</div>
<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>