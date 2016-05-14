<?php
if($_GET['search_word'] != ''){
	$search_word = h($_GET['search_word']);
	$result_friend = search_friend($search_word);
	// echo '<pre>';
	// print_r($result_friend);
	// echo '</pre>';
	// exit;
}

/**
 * 友達を検索
 * @param array $search_word
 * @return 
 */
function search_friend($search_word)
{
	include('../../php/db_connect.php');
	$search_word = '%' . $search_word . '%';
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE name LIKE :name');
	$sql->bindValue(':name', $search_word);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$result_friend[] = $data;
	}
	return $result_friend;
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

?>
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
<!--loading-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(function() {
  var h = $(window).height();
 
  $('#wrap').css('display','none');
  $('#loader-bg ,#loader').height(h).css('display','block');
});
 
$(window).load(function () { //全ての読み込みが完了したら実行
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
  $('#wrap').css('display', 'block');
});
 
//10秒たったら強制的にロード画面を非表示
$(function(){
  setTimeout('stopload()',10000);
});
 
function stopload(){
  $('#wrap').css('display','block');
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
}
</script>
<!--loading-->
<style>
.pepoq4{
  background:#89003F;
}
.pepoq4 i{
  color:#d61e44;
}
</style>

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
<!--start google analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69530483-1', 'auto');
  ga('send', 'pageview');

</script>
<!--end google analytics-->
</head>
<body>
<div id="loader-bg">
  <div id="loader">
    <img src="../../img/img-loading.gif" width="80" height="80" alt="Now Loading..." />
    <p>Now Loading...</p>
  </div>
</div>
<div id="wrap">
<div id="page_all" style="">
	<?php
		include('../../common/header.html');
	?>

	<!-- begin header_all-->
	<!--<div id="header_menu">
			<div class="menu_search_li_hover">
				<a href="#"><i class="fa fa-user lower_icon"></i></a>
				<p>友達</p>
			</div>
			<div class="menu_search_li">
				<a href="search_question.php"><i class="fa fa-question lower_icon"></i></a>
				<p>質問</p>
			</div>
		</div>-->
		<div class="upper_question_format">
			<div class="segmented theme-segmented">
			    <a href="#" class="cell is-current">友達を検索</a>
			    <a href="search_question.php"class="cell">質問を検索</a>
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
		      		<a href="../../friend_page/profile/profile.php?friend_id='.$value['id'].'">
						<img src="../../mypage/profile/img/thumbnail/'.$value['thumbnail'].'" style="width:60px;height:60px;">
					</a>
				</div>
				<div class="user_item float_left">
					<div class="user_name">
						<p>
							<a href="../../friend_page/profile/profile.php?friend_id='.$value['id'].'">'.$value['name'].'</a>
						</p>
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
</div>
<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>