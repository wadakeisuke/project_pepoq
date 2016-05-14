<?php
session_start();
include('../../php/db_connect.php');
include('../../php/user_data.php');
require('../../php/time_and_date/time_and_date.php');
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
</head>
<body>
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
			<img src="../profile/img/thumbnail/<?php echo $_SESSION['mypage']['thumbnail']; ?>" style="width:60px;height:60px;">
		</div>
		<div class="user_item float_left">
			<div class="user_name">
				<p><a href="more.php"><?php echo $_SESSION['mypage']['name']; ?></a></p>
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
//ログインした人のメールアドレスでDB(new_friend)からリクエストした人のデータを取得
$new_friend = $pdo->prepare('SELECT * FROM new_friend WHERE fr_email = :fr_email');
$new_friend->bindValue(':fr_email',$_SESSION['mypage']['email']);
$new_friend->execute();
echo'
<div class="prof_category"><p>新しい友達</p></div>
';
while($data = $new_friend->fetch(PDO::FETCH_ASSOC)){
	$fr_email = $data['my_email'];
	$new_friend_data = $pdo->prepare('SELECT * FROM personal_data WHERE email = :fr_email');
	$new_friend_data->bindValue(':fr_email', $fr_email);
	$new_friend_data->execute();
	$new_friend_data = $new_friend_data->fetch(PDO::FETCH_ASSOC);
	echo'
	<!--これが新しいの-->
	<div class="swipe-list theme-swipe-list">
	  <div class="list js-swipeList">
	    <div class="list-body js-swipeListTarget">
	      <div class="list-contents list-cell">
	      	<a href="../../friend_page/profile/profile.php?friend_id='.$new_friend_data['id'].'">
		      	<div class="user_images float_left">
					<img src="../profile/img/thumbnail/'.$new_friend_data['thumbnail'].'" style="width:60px;height:60px;">
				</div>
				<div class="user_item float_left">
					<div class="user_name">
						<p>'.$new_friend_data['name'].'</p>
					</div>
				</div>
			</a>
	      </div>

	      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
	    </div>

	    <div class="list-btn js-swipeListBtn">
	      <ul>
	      	<form action="../../php/friend_edit/friend_edit.php" method="post">
	      		<input name="friend_id" type="hidden" value="'.$new_friend_data['id'].'">
		      	<li><button name="accept_new_friend" type="submit" style="border:none;"><i class="fa fa-plus"></i></button></li>
		    </form>
		    <form action="../../php/friend_edit/friend_edit.php" method="post">
		    	<input name="friend_id" type="hidden" value="'.$new_friend_data['id'].'">
		    	<input name="edit_type" type="hidden" value="refuse">
		        <li><button type="submit" style="border:none;"><i class="fa fa-trash"></i></button></li>
	      	</form>
	      </ul>
	    </div>
	  </div>
	</div>
	';
}
?>
<!--end 新しい友達-->
<!--友達-->
<div class="prof_category"><p>友達</p></div>
<?php

$my_email = $_SESSION['mypage']['email'];
$my_friend = $pdo->prepare('SELECT * FROM friend WHERE my_email = :my_email');
$my_friend->bindValue(':my_email',$my_email);
$my_friend->execute();
while($my_friend = $my_friend->fetch(PDO::FETCH_ASSOC)){
$my_friend_data = $pdo->prepare('SELECT * FROM personal_data WHERE email = :fr_email');
$my_friend_data->bindValue(':fr_email', $my_friend['fr_email']);
$my_friend_data->execute();
$my_friend_data = $my_friend_data->fetch(PDO::FETCH_ASSOC);
echo '

<div class="swipe-list theme-swipe-list">
  <div class="list js-swipeList">
    <div class="list-body js-swipeListTarget">
      <div class="list-contents list-cell">
      	<a href="../../friend_page/profile/profile.php?friend_id='.$my_friend_data['id'].'">
	      	<div class="user_images float_left">
				<img src="../profile/img/thumbnail/'.$my_friend_data['thumbnail'].'" style="width:60px;height:60px;">
			</div>
			<div class="user_item float_left">
				<div class="user_name">
					<p>'.$my_friend_data['name'].'</p>
				</div>
			</div>
		</a>
      </div>

      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
    </div>

    <div class="list-btn js-swipeListBtn">
      <ul>
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
	</div>
</div>


<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>