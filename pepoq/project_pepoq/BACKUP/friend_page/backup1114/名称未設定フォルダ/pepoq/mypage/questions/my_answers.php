<?php
session_start();
header("Content-type: text/html; charset=utf-8");
//include('../php/login_check.php');
include('../../php/db_connect.php');
include('../../php/user_data.php');

require('../../php/user_data/personalData.php');
require('../../php/question/question.php');
require('../../php/answer/answer.php');
require('../../php/time_and_date/time_and_date.php');

$personal_data = new personalData();
$question = new question();
$answer = new answer();
$time_and_date = new TimeAndDate();

$question_list = get_question_list_to_me();

function get_question_list_to_me()
{
  include('../../php/db_connect.php');
  $sql = $pdo->prepare('SELECT * FROM question 
    WHERE
      email != :email AND
      category = :category_1 OR
      category = :category_2 OR
      category = :category_3 OR
      category = :category_4 OR
      category = :category_5 OR
      category = :category_6 OR
      category = :category_7 OR
      category = :category_8 OR
      category = :category_9 OR
      category = :category_10 OR
      category = :category_11 OR
      category = :category_12 OR
      category = :category_13 OR
      category = :category_14 OR
      category = :category_15 OR
      category = :category_16
  ');
  $sql->bindValue(':email', $_SESSION['mypage']['email']);
  $sql->bindValue(':category_1', $_SESSION['mypage']['sex']);
  $sql->bindValue(':category_2', $_SESSION['mypage']['age']);
  $sql->bindValue(':category_3', $_SESSION['mypage']['blood_type']);
  $sql->bindValue(':category_4', $_SESSION['mypage']['settlement']);
  $sql->bindValue(':category_5', $_SESSION['mypage']['school']);
  $sql->bindValue(':category_6', $_SESSION['mypage']['job']);
  $sql->bindValue(':category_7', $_SESSION['mypage']['place_of_work']);
  $sql->bindValue(':category_8', $_SESSION['mypage']['hobby']);
  $sql->bindValue(':category_9', $_SESSION['mypage']['special_skill']);
  $sql->bindValue(':category_10', $_SESSION['mypage']['my_boom']);
  $sql->bindValue(':category_11', $_SESSION['mypage']['dream']);
  $sql->bindValue(':category_12', $_SESSION['mypage']['favorite_sports']);
  $sql->bindValue(':category_13', $_SESSION['mypage']['favorite_singer']);
  $sql->bindValue(':category_14', $_SESSION['mypage']['favorite_book']);
  $sql->bindValue(':category_15', $_SESSION['mypage']['favorite_movie']);
  $sql->bindValue(':category_16', $_SESSION['mypage']['favorite_animation']);
  $sql->execute();
  while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    $question_list[] = $data;
  }
  return $question_list;
}

// あなたへの質問
foreach ($question_list as $key => $value) {
	$data[$key]['personal_data'] = $personal_data->get_personal_data($value['email']);
  
	$data[$key]['question_data'] = $value;

  if ($data[$key]['question_data']['anonymity'] == 'anonymity') {
    $data[$key]['personal_data'][0]['name'] = '匿名さん';
    $data[$key]['personal_data'][0]['thumbnail'] = 'thumbnail.jpg';
  }

  $data[$key]['question_data']['created'] = $time_and_date->getPostTimeDate($value['created']);
	$data[$key]['comment_num'] = $answer->get_num_for_answer($data[$key]['question_data']['id']); 
}

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
.pepoq3{
  background:#89003F;
}
.pepoq3 i{
  color:#d61e44;
}

</style>
<!--list swipe-->
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
	<!--begin header-->
	<?php
		include('../../common/header.html');
	?>
	<!--end header-->
	<div class="content">
  <div class="segmented theme-segmented">
    <a href="my_questions.php" class="cell">投稿一覧</a>
    <a href="#"class="cell is-current">あなたへの質問</a>
  </div>


<?php foreach ($data as $key => $value) { ?>
<div class="swipe-list theme-swipe-list">
  <div class="list js-swipeList">
    <div class="list-body js-swipeListTarget">
      <div class="list-contents list-cell">
      	<div id="user_image" style="height:60px;float:left;width:25%;">
			<img src="../profile/img/thumbnail/<?php echo $value['personal_data'][0]['thumbnail']; ?>" style="height:60px;width:60px;">
		</div>
		<div class="format_question">
      <div class="group_name f_f"><small><?php echo $value['question_data']['genre']; ?> / <?php echo $value['question_data']['category']; ?></small></div>

			<div class="time f_f"><small><?php echo $value['question_data']['created']; ?></small></div>

			<div class="user_name f_f"><small><?php echo $value['personal_data'][0]['name']; ?></small></div>
			<div class="question_num_answer f_f"><smallsss>(<?php echo $value['comment_num']; ?>)</small></div>
		</div>

		<div class="question_item">
        	<p class="titile"></p>
        	<p class="inner">
        	<a href="../../single_question/single_question/single_question.php?question_id=<?php echo $value['question_data']['id']; ?>">
        	 <?php echo $value['question_data']['question']; ?>
        	</a>
        	</p>
        </div>
      
      </div>

      <div class="list-arrow list-cell"><i class="fa fa-angle-double-left"></i></div>
    </div>

    <div class="list-btn js-swipeListBtn">
      <ul>
        <li><a href="../../single_question/single_question/single_question.php?question_id=<?php echo $value['question_data']['id']; ?>"><i class="fa fa-edit"></i></a></li>
        <li><a href="../../php/question/delete_question.php?question_type=to_me&question_id=<?php echo $value['question_data']['id']; ?>"><i class="fa fa-trash"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<?php } ?>

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
