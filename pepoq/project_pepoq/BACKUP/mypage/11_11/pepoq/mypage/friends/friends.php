<?php
session_start();
include('../../php/db_connect.php');
include('../../php/user_data.php');
require('../../php/user_data/personalData.php');
require('../../php/question/question.php');
require('../../php/question/question_point_num.php');
require('../../php/answer/answer.php');
require('../../php/time_and_date/time_and_date.php');

$personal_data = new personalData();
$question = new question();
$question_point_num = new QuestionPointNum();
$answer = new answer();
$time_and_date = new TimeAndDate();
?>
<!DOCTYPE html>
<html>
<head>
<title>マイページ</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common_header.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="../../style/js/jquery-ui.js"></script>
<link rel="stylesheet" href="../../common/style/css/drawer.css">
<link type="text/css" href="../../common/style/css/jquery-ui-1.8.15.custom.css" rel="stylesheet" />

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
<style>
.pepoq2{
	background:#89003F;
}
.pepoq2 i{
	color:#d61e44;
}
</style>
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
	<!--begin header-->
	<?php
		include('../../common/header.html');
	?>
	<!--end header-->
	<div class="content">
		<!--プロフィール-->
		<div class="prof_category"><p>プロフィール</p></div>

<div class="swipe-list theme-swipe-list">
  <div class="list js-swipeList">
    <div class="list-body js-swipeListTarget">
      <div class="list-contents list-cell">
      	<div class="user_images float_left">
			<a href="../profile/profile.php">
				<img src="../profile/img/thumbnail/<?php echo $_SESSION['mypage']['thumbnail']; ?>" style="width:60px;height:60px;">
			</a>
		</div>
		<div class="user_item float_left">
			<div class="user_name">
				<p><a href="../profile/profile.php"><?php echo $_SESSION['mypage']['name']; ?></a></p>
			</div>
		</div>
      </div>

      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
    </div>

    <div class="list-btn js-swipeListBtn">
      <ul>
        <li><a href="../profile/edit_profile.php"><i class="fa fa-edit"></i></a></li>
      </ul>
    </div>
  </div>
</div>

<!--begin 新しい友達-->
<?php
// フォロワーのリストを取得
$my_follower_list = get_my_follower_list();
foreach ($my_follower_list as $key => $value) {
	$my_follower_data_list[] = $personal_data->get_personal_data($value['my_email']);
}
// フォロワーの数
$num_of_my_follower = count($my_follower_list);

// フォローのリストを取得
$my_follow_list = get_my_follow_list();
foreach ($my_follow_list as $key => $value) {
	$my_follow_data_list[] = $personal_data->get_personal_data($value['fr_email']);
}
// フォローの数
$num_of_my_follow = count($my_follow_list);


/**
 * フォロワーのリストを取得
 */
function get_my_follower_list()
{
	include('../../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM friend WHERE fr_email = :fr_email');
	$sql->bindValue(':fr_email', $_SESSION['mypage']['email']);
	$sql->execute();
	while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
		$my_follower_list[] = $data;
	}
	return $my_follower_list;
}

/**
 * フォローのリストを取得
 */
function get_my_follow_list()
{
	include('../../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM friend WHERE my_email = :my_email');
	$sql->bindValue(':my_email', $_SESSION['mypage']['email']);
	$sql->execute();
	while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
		$my_follow_list[] = $data;
	}
	return $my_follow_list;
}
?>

<div class="prof_category"><p>フォロワー(<?php echo $num_of_my_follower; ?>)</p></div>
<?php
foreach ($my_follower_data_list as $key => $value) {
?>
	<div class="swipe-list theme-swipe-list">
	  <div class="list js-swipeList">
	    <div class="list-body js-swipeListTarget">
	      <div class="list-contents list-cell">
	      	<a href="../../friend_page/profile/profile.php?friend_id=<?php echo $value[0]['id']; ?>">
		      	<div class="user_images float_left">
					<img src="../profile/img/thumbnail/<?php echo $value[0]['thumbnail']; ?>" style="width:60px;height:60px;">
				</div>
				<div class="user_item float_left">
					<div class="user_name">
						<p><?php echo $value[0]['name']; ?></p>
					</div>
				</div>
			</a>
	      </div>

	      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
	    </div>

	    <div class="list-btn js-swipeListBtn">
	      <ul>
		    <li>		    
		    	<form action="../../php/friend_edit/friend_edit.php" method="post">
		    		<input name="friend_id" type="hidden" value="<?php echo $value[0]['id']; ?>">
		    		<input name="edit_type" type="hidden" value="refuse">
		    		<button type="submit" style="border:none;"><i class="fa fa-trash"></i></button>
	      		</form>
	      	</li>
	      </ul>
	    </div>
	  </div>
	</div>
<?php
}
?>
<div class="prof_category"><p>フォロー(<?php echo $num_of_my_follow; ?>)</p></div>
<?php
foreach ($my_follow_data_list as $key => $value) {
?>
	<div class="swipe-list theme-swipe-list">
	  <div class="list js-swipeList">
	    <div class="list-body js-swipeListTarget">
	      <div class="list-contents list-cell">
	      	<a href="../../friend_page/profile/profile.php?friend_id=<?php echo $value[0]['id']; ?>">
		      	<div class="user_images float_left">
					<img src="../profile/img/thumbnail/<?php echo $value[0]['thumbnail']; ?>" style="width:60px;height:60px;">
				</div>
				<div class="user_item float_left">
					<div class="user_name">
						<p><?php echo $value[0]['name']; ?></p>
					</div>
				</div>
			</a>
	      </div>

	      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
	    </div>

	    <div class="list-btn js-swipeListBtn">
	      <ul>
		    <li>		    
		    	<form action="../../php/friend_edit/friend_edit.php" method="post">
		    		<input name="friend_id" type="hidden" value="<?php echo $value[0]['id']; ?>">
		    		<input name="edit_type" type="hidden" value="refuse">
		    		<button type="submit" style="border:none;"><i class="fa fa-trash"></i></button>
	      		</form>
	      	</li>
	      </ul>
	    </div>
	  </div>
	</div>
<?php
}
?>
		</div>
	</div>
</div>

<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>