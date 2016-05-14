<?php
// TODO
// good bad point
session_start();
header('Content-type: text/html; charset=utf-8');
require('../../php/db_connect.php');
require('../../php/user_data.php');
require('../../php/user_data/personalData.php');
require('../../php/question/question.php');
require('../../php/sanitize/sanitize.php');
require('../../php/answer/answer.php');
require('../../php/question/question_point_num.php');
require('../../php/genre_and_category/genre_and_category.php');
require('../../php/check/check.php');
require('../../php/time_and_date/time_and_date.php');

$genre_and_category = new GenreAndCategory();
$personal_data = new personalData();
$question = new question();
$answer = new answer();
$question_point_num = new QuestionPointNum();
$time_and_date = new TimeAndDate();
$check = new check();

// 質問ID
$question_id = h($_GET['question_id']);

// 質問のデータ
$question_data = $question->get_question_data($question_id);

// ジャンル
$genre = $question_data['genre'];
// カテゴリ
$category = $question_data['category'];

// 質問者のデータ
$questioner_data = $personal_data->get_personal_data($question_data['email']);

// 回答者のデータ
$answer_data_list = $answer->get_answer_data($question_id);

// その他のデータ
// 回答数
$good_point = $question_point_num->get_good_point_num($question_id);
$bad_point = $question_point_num->get_bad_point_num($question_id);
$number_of_responses = $answer->get_num_for_answer($question_id);
// good
// bad


// 質問と質問者のデータ
$data['question_data']['question'] = $question_data['question'];
$data['question_data']['created'] = $time_and_date->getPostTimeDate($question_data['created']);
$data['question_data']['genre'] = $genre;
$data['question_data']['category'] = $category;


$data['question_data']['good_point'] = $good_point;
$data['question_data']['bad_point'] = $bad_point;
$data['question_data']['number_of_responses'] = $number_of_responses;


$data['question_data']['questioner']['id'] = $questioner_data[0]['id'];
$data['question_data']['questioner']['name'] = $check->check_anonimity_for_name($question_data['anonymity'], $questioner_data[0]['name']);
$data['question_data']['questioner']['thumbnail'] = $check->check_anonimity_for_thumbnail($question_data['anonymity'], $questioner_data[0]['thumbnail']);


// 回答と回答者のデータ
foreach ($answer_data_list as $key => $value) {
	$data['answer_data'][$key]['id'] = $value['id'];
	$data['answer_data'][$key]['answer'] = $value['answer'];
	$data['answer_data'][$key]['created'] = $time_and_date->getPostTimeDate($value['created']);

	$respondent_data = $personal_data->get_personal_data($value['email']);
	$data['answer_data'][$key]['respondent']['id'] = $respondent_data[0]['id'];
	$data['answer_data'][$key]['respondent']['name'] = $check->check_anonimity_for_name($value['anonymity'], $respondent_data[0]['name']);
	$data['answer_data'][$key]['respondent']['thumbnail'] = $check->check_anonimity_for_thumbnail($value['anonymity'], $respondent_data[0]['thumbnail']);
}


/**
 * 匿名かチェックする
 * @param string $anonimity 匿名:anonymity 記名:register
 */
function check_anonimity($anonymity, $register_name)
{
	if ($anonymity == 'anonymity') {
		$name = '匿名さん';
	} else if($anonymity == 'register') {
		$name = $register_name;
	}
	return $name;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta property="og:title" content="pepoQ" />
<meta property="og:type" content="Q&Aサイト" />
<meta property="og:image" content="https://www.facebook.com/1656059267965751/photos/a.1656062504632094.1073741825.1656059267965751/1656070564631288/?type=3&theater" />
<meta property="og:url" content="" />
<meta property="og:site_name" content="pepoq.com" />
<meta property="og:description" content="あなたの答えを待ってる人がいます。「答え」が一番近くにある新感覚ソーシャルネットワークpepoQ(ピポック)で気になることを質問しよう！" />
<meta property="fb:admins" content="ボタンを発行したユーザーID" />
<script type="text/javascript">
function next(){
location.replace("ボタンが設置されているURL(※1)");
}
</script>
<title>質問</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common.css">
<link rel="stylesheet" type="text/css" href="../../common/style/css/common_header.css">
<link rel="stylesheet" type="text/css" href="./css/style.css">

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
<style>
/*sns*/
iframe.twitter-share-button {
  width: 65px !important;
}
.fb_iframe_widget_lift {
    bottom:50px;
}
/*facebookのコメントが切れるので対処*/
.social_menu{
	width:100%;
	height:25px;
	background:red;
}
ul.social_menu_ul{
	width:100%;

}
li.social_menu_li{
	float:left;
}
</style>
<!--SNS-->
<!-- [head]内や、[body]の終了直前などに配置 -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: "ja"}
</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<script>
//はてなブックマーク
var scriptTag = document.createElement("script");
scriptTag.type = "text/javascript"
scriptTag.src = "https://b.st-hatena.com/js/bookmark_button.js";
scriptTag.async = true;
document.getElementsByTagName("head")[0].appendChild(scriptTag);
</script>
<!--SNS-->
</head>
<body>
<!--facebook plugin begin-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--facebook plugin end-->

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

<div class="question_box">
<p><?php echo $question_id ?></p>
	<div class="question_format">
		<div class="question_item">
			<div class="item_li_1 left_li f_f"><small class="group_name"><?php echo $data['question_data']['genre'] . ' / ' . $data['question_data']['category']; ?></small></div>
			<div class="item_li_2 right_li f_f"><small><?php echo $data['question_data']['created']; ?></small></div>
		</div>

		<a href="../../friend_page/profile/profile.php?friend_id=<?php echo $data['question_data']['questioner']['id']; ?>">
			<div class="user_box">
				<div class="user_images f_f">
					<img src="../../mypage/profile/img/thumbnail/<?php echo $data['question_data']['questioner']['thumbnail']; ?>" style="height:60px;width:60px;">
				</div>
				<div class="user_item f_f">
					<div class="user_name">
						<p>
							<?php echo $data['question_data']['questioner']['name']; ?>
						</p>
					</div>
				</div>
				<div class="list_menu f_f">
					
				</div>
			</div>
		</a>

		<div class="question_text">
			<p style="color:black;">
				<?php echo $data['question_data']['question']; ?>
			</p>
		</div>
		<div class="social_menu">
			<ul class="social_menu_ul">
				<li class="social_menu_li">
					<div class="fb-like" data-href="http://pepoq.com/wada/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false">
				</li>
				<li class="social_menu_li">
					<div class="fb-share-button" data-href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>" data-layout="button_count">
				</li>
				<li class="social_menu_li">
					<div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>"></div>
				</li>
				<li class="social_menu_li">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="PepoqQ" data-count="none">Tweet</a>
				</li>
			</ul>
		</div>
	</div>	
</div>

<div class="answer_box">
	<div class="answer_format">
		<form method="post" action="../../php/answer_question.php">
			<textarea name="comment" placeholder="答えてみる"></textarea>
			<input type="hidden" name="question_id" value="<?php echo $_GET['question_id']; ?>"><br>
			<div class="answer_format_box">
				<div class="answer_item answer-btn1">
					<label for="checkbox-1">匿名にする</label> 
					<input type="checkbox" name="anonymity" id="checkbox-1" /> 
				</div>
				<div class="answer_item answer-btn2">
					<input class="btn_answer"type="submit" value="投稿する">
				</div>
			</div>
		</form>
	</div>
</div>
<!--
<div class="answer_box_not">ログインしてない時はこっちを表示して
	<div class="answer_format">
	<p>ログインすると回答を見ることができます。質問に答えたい方や、回答を見たい方はログインしてみましょう！</p>
		<form method="post" action="#">
			<div class="answer_format_box">
				<div class="answer_item answer-btn3">
					<input class="btn_answer"type="submit" value="ログインして答える">
				</div>
				<div class="answer_item answer-btn4">
					<input class="btn_answer"type="submit" value="登録はこちらから">
				</div>
			</div>
		</form>
	</div>
</div>
-->

<?php
foreach ($data['answer_data'] as $key => $value) {
?>
		<div class="question_box" id="ans_<?php echo $value['respondent']['id']; ?>">
		<p>質問ID:<?php echo $question_id ?>+<?php echo $value['respondent']['id']; ?></p>
			<div class="question_format">
				<div class="question_item">
					<div class="item_li_1 left_li f_f"><small class="group_name"><?php echo $data['question_data']['genre'] . ' / ' . $data['question_data']['category']; ?></small></div>
					<div class="item_li_2 right_li f_f"><small><?php echo $value['created']; ?></small></div>
				</div>

				<div class="user_box">
					<div class="user_images f_f">
						<a href="/pepoq/friend_page/profile/profile.php?friend_id=<?php echo $value['respondent']['id']; ?>"><img src="../../mypage/profile/img/thumbnail/<?php echo $value['respondent']['thumbnail']; ?>" style="height:50px;width:50px;"></a>
					</div>
					<div class="user_item f_f">
						<div class="user_name">
							<p><a href="/pepoq/friend_page/profile/profile.php?friend_id=<?php echo $value['respondent']['id']; ?>"><?php echo $value['respondent']['name']; ?></a></p>
						</div>
					</div>
					<div class="list_menu f_f">
						
					</div>
				</div>

				<div class="question_text non_login_filter"><div onMouseDown="return false;" onSelectStart="return false">
					<p>
						<?php echo $value['answer']; ?>
					</p>
				</div></div>
<!--
				<div class="question_menu">
					<ul style="text-align:center;">
						<li class="question_menu_li">
							<div class="fb-like" data-href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>#ans_<?php echo $value['respondent']['id']; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false">
						</li>				
						<li class="question_menu_li">
							<div class="fb-share-button" data-href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>#ans_<?php echo $value['respondent']['id']; ?>" data-layout="button_count">
						</li>
						<li class="question_menu_li">
							<div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>#ans_<?php echo $value['respondent']['id']; ?>"></div>
						</li>
					</ul>
					<ul style="text-align:center;">
						<li class="question_menu_li">
							<a href="https://twitter.com/share" class="twitter-share-button" data-via="PepoqQ" data-count="none">Tweet</a>
						</li>
						<li class="question_menu_li">
							<a href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>#ans_<?php echo $value['respondent']['id']; ?>" class="hatena-bookmark-button"  data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border:none;" /></a>
						</li>
						<li class="question_menu_li">
							<a href="http://line.me/R/msg/text/?{message}"><img src="./img/linebutton_36x60.png" width="30" height="30" alt="LINEで送る" /></a>
						</li>			
					</ul>
				</div>
-->
				<div class="social_menu">
					<ul class="social_menu_ul">
						<li class="social_menu_li">
							<div class="fb-like" data-href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>#ans_<?php echo $value['respondent']['id']; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false">
						</li>
						<li class="social_menu_li">
							<div class="fb-share-button" data-href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>#ans_<?php echo $value['respondent']['id']; ?>" data-layout="button_count">
						</li>
						<li class="social_menu_li">
							<div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://pepoq.com/pepoq/single_question/single_question/single_question.php?question_id=<?php echo $question_id ?>#ans_<?php echo $value['respondent']['id']; ?>"></div>
						</li>
						<li class="social_menu_li">
							<a href="https://twitter.com/share" class="twitter-share-button" data-via="PepoqQ" data-count="none">Tweet</a>
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
<!--drawer format===========================================================-->
<!----><script src="../../common/style/js/iscroll-min.js"></script><!--=====-->
<!----><script src="../../common/style/js/jquery.drawer.js"></script><!--===-->
<!----><script src="../../common/style/js/side_menu.js"></script><!--=======-->
<!--========================================================================-->
</body>
</html>