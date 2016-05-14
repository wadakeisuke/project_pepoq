<?php
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
require('../php/not_login.php');
require('../../php/db_connect.php');
require('../../php/friend_num.php');
try
{
  //lower contentのfriend から飛んだ場合
  if(@$_POST['profile_id']){
    $profile=$pdo->prepare('SELECT * FROM personal_data WHERE id=:id');
    $profile->bindValue(':id',$_POST['profile_id']);
    $profile->execute();
    $data=$profile->fetch(PDO::FETCH_ASSOC);
    $_SESSION['profile'] = $data;
    require ('../../php/fr_profile_friend_num.php');
  }else{
    //mypage_to_profile();
    $_SESSION['profile']= $_SESSION['mypage'];
    require ('../../php/profile_friend_num.php');   
  }
}catch(PDOException $e){
  echo('Error'.$e->getMessage());
  die();
}
require ('../../php/question_num.php');

//friends data
//全ての友達を取得
$allf_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_password=:ac_password AND accepter_email=:ac_email');
$allf_data->bindValue(':w_friend','all');
$allf_data->bindValue(':ac_password',$_SESSION['profile']['password']);
$allf_data->bindValue(':ac_email',$_SESSION['profile']['email']);
$allf_data->execute();
$allf_profile_data_all=array();
$allf_data_all=array();
$i=0;
while($friends = $allf_data->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
  //プロフィールに飛ぶための情報
  $f_profile=$pdo->prepare('SELECT * FROM personal_data WHERE email=:email');
  $f_profile->bindValue(':email',$friends['sender_email']);
  $f_profile->execute();
  $f_profile_data=$f_profile->fetch(PDO::FETCH_ASSOC);
  $allf_profile_data_all[$i]=array_merge($allf_profile_data_all,$f_profile_data);
  $allf_data_all[$i]=array_merge($allf_data_all,$friends);
  //プロフィールに飛ぶための情報
  $i++;
}

//全ての友達に対する自分のコメント等を取得
/*
$allf_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND sender_password=:sender_password AND sender_email=:sender_email');
$allf_data->bindValue(':w_friend','all');
$allf_data->bindValue(':sender_password',$_SESSION['profile']['password']);
$allf_data->bindValue(':sender_email',$_SESSION['profile']['email']);
$allf_data->execute();
$allf_my_data_all=array();
$i=0;
while($friends = $allf_data->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
  $allf_my_data_all[$i]=array_merge($allf_data_all,$friends);
  $i++;
}
*/


//friends_typeに連想配列で友達の種類を代入
$friends_type=array('family'=>'家族','lover'=>'恋人','school'=>'小・中学校','high_school'=>'高校','college'=>'大学・専門','works'=>'勤務先','other'=>'その他',);

$ar_data=array('id'=>'0','name'=>'kuma','email'=>'kuma@kuma.com','password'=>'kumakuma',);

$db_friends_data_all=array();
foreach($friends_type as $name => $value){
  $db_friends_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_password=:ac_password AND accepter_email=:ac_email AND relation=:relation');
  $db_friends_data->bindValue(':w_friend','all');//そのまま
  $db_friends_data->bindValue(':ac_password',$_SESSION['profile']['password']);//そのまま
  $db_friends_data->bindValue(':ac_email',$_SESSION['profile']['email']);//そのまま
  $db_friends_data->bindValue(':relation',$value);//変える
  $db_friends_data->execute();//そのまま
  $i=0;
  while($friends = $db_friends_data->fetch(PDO::FETCH_ASSOC)){ //$friendsにfriendsのDB情報を代入
    foreach($friends as $fr_data_name => $fr_data_value){
      $fr_ar[$name][$i][$fr_data_name]=$fr_data_value;
    }    
    array_push($db_friends_data_all,$friends);//$db_friends_data_allにDB friendsのデータを代入
    //プロフィールに飛ぶための情報
    $f_personal_data=$pdo->prepare('SELECT * FROM personal_data WHERE email=:email');
    $f_personal_data->bindValue(':email',$friends['sender_email']);
    $f_personal_data->execute();
    $f_personal_data=$f_personal_data->fetch(PDO::FETCH_ASSOC);

    foreach($f_personal_data as $data_name => $data_value){
      $ar[$name][$i][$data_name]=$data_value;
    }
    $i++;
  }
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>pepoQ</title>
<link rel="stylesheet" type="text/css" media="all" href="style/css/profile.css">
<link rel="stylesheet" type="text/css" media="all" href="style/css/friend_edit.php">
<link rel="stylesheet" type="text/css" href="style/css/blue.css">

<!--box 移動-->
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>

<script src="../../style/js/jquery.hoverintent.r7.js"></script>
<script src="../../style/js/jquery.mnmenu.js"></script>
<script>
$(document).ready(function() {
  $('#idmenu').mnmenu();
})
</script>

<script type='text/javascript' src='../../style/js/jquery.masonry.min.js'></script>
<script type='text/javascript' src='../../style/js/masonry-style.js'></script>
<script type="text/javascript" src="../../style/js/jquery.leanModal.min.js"></script>
<script type='text/javascript' src='../../style/js/leanmodal_style.js'></script>
<!--box 移動-->
<!--背景画像-->
<script type="text/javascript" src="../../style/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
  $.backstretch("../../img/background/<?php echo($_SESSION['profile']['background']); ?>");
</script>
<!--背景画像-->
<style type="text/css">
.modal_close{ 
  position: absolute;
  top: 12px;
  right: 12px;
  display: block; 
  width: 14px;
  height: 14px; 
  z-index: 2;
  background-repeat: no-repeat;
  background-image:url("../../../../img/batu.gif");
}
.tab_wrapper{
  position: relative;
  line-height: 1.8;
  margin:0 auto;
  height: 400px;
}
.tabContainer ul.controls,
.tabContainer .controls li {
  list-style: none;
  margin: 0;
  padding: 0;
}
.tabContainer .controls li {
  display: inline-block;
  word-wrap: break-word;
}
.tabContainer .controls li a {
  display: block;
  padding: 0.5em 1em;
  background-color: rgba(20, 20, 20, 0.6);
  color: #fff;
  border-radius: 8px 8px 0 0 ;
  behavior: url(PIE.htc);
}
.tabContainer .controls li.current a,
.tabContainer .controls li a:hover {
  color: steelblue;
   background-color: rgba(20, 20, 20, 0.7);
}
#lower_content .post {
  overflow: hidden;
  background-color: rgba(20, 20, 20, 0.7);
  min-height: 260px;
  padding:10px;
}
.post {
  overflow: hidden;
  background-color: rgba(20, 20, 20, 0.7);
  height: 260px;
  padding:10px;
}
/*popup window standby*/
.popup_select{
  width:210px;
  height:20px;
}
input.fr_tab_name{
  cursor:pointer;border:none;outline:none;font-family:;color:white;background-color:rgba(20,20,20,0.3);height:40px;font-size:18px;font-weight:normal;
}
</style>
<style type="text/css">
  .data{
    line-height: 50px;}
  #user_name{
    padding-top:40px;

  }
  #user_name p{
    background-color:;width:300px;word-wrap: break-word;
  }
</style>
<!--入力必須項目などのアラート-->
<script src="../../style/js/angular.min.js"></script>
<script language="javascript">
  angular.module("standby", [])
  .directive("match", ["$parse", function($parse) {
    return {
      require: 'ngModel',
        link: function(scope, elem, attrs, ctrl) {
          scope.$watch(function() {
            var target = $parse(attrs.match)(scope);  // 比較対象となるモデルの値
            return !ctrl.$modelValue || target === ctrl.$modelValue;
          }, function(currentValue) {
              ctrl.$setValidity('mismatch', currentValue);
            });
        }
    }
  }]);
</script>
<!--入力必須項目などのアラート-->
</head>
<body>
<!--begin page_all-->
<div id="page_all">
  <!--begin header_all-->
<?php
//header
require('../mypage/m.header.php');
?>

  
  <!--begin upper_content-->
  <div id="upper_content">
    <!--begin thumbnail_and _comment-->
    <div class="box">
      <!--begin thumbnail-->
      <div id="thumbnail">
            <img src="../../img/thumbnail/<?php echo($_SESSION['profile']['thumbnail']); ?>">
      </div>
      <!--end thumbnail-->
      <!--begin icon_and_name-->
      <div id="icon_and_name">
        <div id="social_icon">
          <ul>
            <li><a href="<?php echo($_SESSION['profile']['twitter']); ?>"><img src="img/sns_icon/twitter.jpg"></a></li>
            <li><a href="<?php echo($_SESSION['profile']['facebook']); ?>"><img src="img/sns_icon/facebook.jpg"></a></li>
            <li><a href="<?php echo($_SESSION['profile']['instagram']); ?>"><img src="img/sns_icon/instagram.jpg"></a></li>
            <li><a href="<?php echo($_SESSION['profile']['google_plus']); ?>"><img src="img/sns_icon/google_plus.jpg"></a></li>
          </ul>
        </div>
        <div id="user_name" style="background-color:;">
          <p style=""><?php echo($_SESSION['profile']['name']); ?><br></p>
          <cite style="">-User Name</cite>
        </div>
        <?php require('../php/friend_check.php'); ?>
      </div>
      <!--end icon_and_name-->
    </div>
    <!--end thumbnail_and _comment-->

    <!--begin comment-->
    <div id="comment" class="box">
      <p style="word-wrap:break-word;"><?php echo($_SESSION['profile']['comment']); ?><br><br><cite>-Comment</cite>
      </p>
    </div>
    <!--end comment-->
    <!--begin basic_data-->
    <div id="basic_data" class="box">
      <span class="data_title">BASIC DATA</span><br> 
      <ul>
        <li><strong>Age:</strong><span class="data"><?php echo($_SESSION['profile']['age']); ?></span></li><hr>
        <li><strong>Birthday:</strong><span class="data"><?php echo($_SESSION['profile']['birthday']); ?></span></li><hr>
        <li><strong>From:</strong><span class="data"><?php echo($_SESSION['profile']['come_from']); ?></span></li><hr>
        <li><strong>School:</strong><span class="data"><?php echo($_SESSION['profile']['educational_background']); ?></span></li><hr>
        <li><strong>Works:</strong><span class="data"><?php echo($_SESSION['profile']['works']); ?></span></li>
      </ul>
    </div>
    <!--end basic_data-->

    <!--begin love and likes-->
    <div id="love_and_likes" class="box">
    <span class="data_title">LOVE AND LIKES</span><br> 
      <ul style="margin-bottom:30px;">
        <li><strong>Lover:</strong><br><span class="data"><?php echo(nl2br($_SESSION['profile']['lover'])); ?></span></li><hr>
        <li><strong>Singer:</strong><br><span class="data"><?php echo(nl2br($_SESSION['profile']['singer'])); ?></span></li><hr>
        <li><strong>Book:</strong><br><span class="data"><?php echo(nl2br($_SESSION['profile']['writer'])); ?></span></li><hr>
        <li><strong>Movie:</strong><br><span class="data"><?php echo(nl2br($_SESSION['profile']['movie'])); ?></span></li>
      </ul>
    </div>
    <!--end love and likes-->

    <!--begin quesiton-->
<?php
$sql=$pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type','all');
$sql->bindValue(':ac_email',$_SESSION['profile']['email']);
$sql->execute();
$i=0;
while($quesiton = $sql->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
echo '
    <!--begin quesiton-->
    <div class="box">
      <div class="balloon-1-left" style="float:left; margin:10px 0 20px 20px;min-width:420px;max-width:420px;word-wrap:break-word;">
     '.$quesiton['question'].'
      </div>
      <div class="balloon-1-right" style="margin:0px 0 20px 20px;word-wrap:break-word;max-width:420px;min-width:420px;">
        '.$quesiton['answer'].'
      </div>
    </div>
    <!--end quesiton-->
';
$i++;
}
?>
    <!--end quesiton-->
  </div>
  <!--end upper_content-->

  <!--begin lower_content-->
  <div id="lower_content" style="">
<!--begin contentContainer-->
<div id="contentContainer" class="" style="background-color:;">
<!--begin tabContainer1-->
<div id="category_tab" class="jQdmtab tabContainer">
    <ul class="controls">
      <li style="background-color:;"><a href="#tab1_1">すべて</a></li>
      <li><a href="#tab1_3">家族</a></li>
      <li><a href="#tab1_4">恋人</a></li>
      <li><a href="#tab1_5">小・中学校</a></li>
      <li><a href="#tab1_6">高校</a></li>
      <li><a href="#tab1_7">大学・専門</a></li>
      <li><a href="#tab1_8">勤務先</a></li>
      <li><a href="#tab1_9">その他</a></li>
    </ul>
      <!--begin tabContentsContainer-->
      <div class="tabContentsContainer">

        <article id="tab1_1" class="post">
          <div class="tab_content">
            <div class="">
<?php
//全て
$count = count($allf_data_all);
if ( $count !== 0 ) {
  for ( $a=0; $a<$pr_f_all_num; $a++ ) {
    echo '
    <div class="fbox">
      <div class="friends-image">
        <img src="../../img/thumbnail/'.$allf_data_all[$a]['thumbnail'].'">
      </div>
      <div class="friends-c_e_g">
        <p>
          <a id="go" rel="leanModal" href="#comment_all'.$a.'">Comment</a>
        </p>
      </div>         
      <div class="friends_name" style="height:40px;">
        <form method="post" action="../profile/profile.php">
          <input type="hidden" name="profile_id" value="'.$allf_profile_data_all[$a]['id'].'">
          <input class="fr_tab_name" type="submit" value="'.$allf_data_all[$a]['name'].'">
        </form>
      </div>
    </div>
    ';
  }
}

?>
            </div>
          </div>
        </article>

<?php
$friends_type=array('family'=>'家族','lover'=>'恋人','school'=>'小・中学校','high_school'=>'高校','college'=>'大学・専門','works'=>'勤務先','other'=>'その他',);
$key=0;
foreach($friends_type as $name => $value){


//for($i=3;$i<=9;$i++){
echo'
<article id="tab1_'.$i.'" class="post">
  <div class="tab_content">
';

    for($a=0;$a<$pr_f_type_num[$key];$a++){
    echo '
    <div class="fbox">
      <div class="friends-image">
        <img src="../../img/thumbnail/'.$ar[$name][$a]['thumbnail'].'">
      </div>
      <div class="friends-c_e_g">
        <p>
          <a id="go" rel="leanModal" href="#comment_'.$name.'_'.$a.'">Comment</a>
        </p>
      </div>         
      <div class="friends_name" style="height:40px;">
        <form name="a'.$key.'" method="post" action="../profile/profile.php">
          <input type="hidden" name="profile_id" value="'.$ar[$name][$a]['id'].'">
          <input class="fr_tab_name" type="submit" value="'.$ar[$name][$a]['name'].'">
        </form>
      </div>
    </div>
    ';
 // }
    }
echo '
  </div>
</article>
';
$key++;
}
?>

      </div>
      <!--end tabContentsContainer-->
  </div>
  <!--end tabContainer1-->
</div>
<!--end contentContainer-->

  </div>
  <!--end lower_content-->

  <!--begin footer_all-->
  <div id="footer_all">
      <div id="copyright">
        <small>COPYRIGHT ©　pepoQ ALL RIGHTS RESERVED. 2015 -</small>
      </div>
  </div>
  <!--end footer-->
</div>
<!--end page_all-->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--------------------------------------------------------------------->
<!--begin popupwindow (StandBy)-->
<div id="question" class="popup_window" style="width:550px;height:600px;">
<a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format">
      <div class="qfriend_img" style="float:left;margin:20px 0 20px 20px;">
        <p>Question <br>何か質問してみましょう</p>
      </div>
    <form method="post" action="../php/question_request.php">
      <div style="margin-bottom:20px;">
        <textarea name="question" style="font-size:15px;width:100%;min-height:200px;padding:5px;" placeholder="好きな歌手は誰ですか？　趣味はなんですか？ etc."></textarea>
      </div>
      <input class="edit_button" type="submit" value="Question">
    </form>
  </div>
</div>

<div id="standby" class="popup_window"  ng-app="standby">
  <a class="modal_close"  href="javascript:void(0)"></a>
  <div id="edit-ct">
    <!--begin lower_content-->

    <div class="tab_wrapper" style="height:100%;background-color:rgba(225,225,255,0);">
<form class="confirm_form" action="../php/friend_request.php" method="post" novalidate name="myForm">
  <div style="background-color:;height:60px;width:130px;float:left;">
    <select name="relation" ng-model="relation" autocomplete="off" required>
      <option value="" selected>関係</option>
      <option value="家族">家族</option>
      <option value="恋人">恋人</option>
      <option value="小・中学校">小・中学校</option>
      <option value="高校">高校</option>
      <option value="大学・専門">大学・専門</option>
      <option value="勤務先">勤務先</option>
      <option value="その他">その他</option>
    </select>
    <div style="font-size:15px;background-color:;color:red;font-family:;">
      <span class="text-danger" ng-show="myForm.relation.$error.required">選択してください</span>
    </div>
  </div>
  <div style="background-color:;height:60px;width:100px;float:left;">
    <input type="text" style="width:200px;height:18px;padding:3px;font-size:14px;" name="more_relation" ng-model="more_relation" ng-maxlength="10" autocomplete="off" placeholder="詳しい関係  (例：サークル仲間)" required>
    <div style="font-size:15px;background-color:;width:200px;color:red;font-family:;">
      <span class="text-danger" ng-show="myForm.more_relation.$error.required">入力してください</span>
      <span class="text-denger" ng-show="myForm.more_relation.$error.maxlength">Too long!</span>
    </div>
  </div>
<!--begin tab_content-->
<div id="standby_tab" class="jQdmtab tabContainer">
<section id="tab_content" class="inner" style="background-color:;clear:both;">

<!--begin tabContainer1-->
<section id="tabContainer1" class="jQdmtab tabContainer">
  <ul class="controls">
    <li><a href="#tab1_1">紹介カテゴリ1</a></li>
    <li><a href="#tab1_2">紹介カテゴリ2</a></li>
    <li><a href="#tab1_3">紹介カテゴリ3</a></li>
    <li><a href="#tab1_4">紹介カテゴリ4</a></li>
    <li><a href="#tab1_5">紹介カテゴリ5</a></li>
  </ul>
<div class="tabContentsContainer">
<article id="tab1_1" class="post">
  <div class="tab">
    <header class="entry-header">   
      <div class="entry-title">
        <div name="meet_trigger" style="padding:0 10px;background-color:;">
          <div style="float:left;">
            <select class="popup_select" name="c_type1" ng-model="c_type1" autocomplete="off" required>
              <option value="" selected>コメントの種類</option>
              <optgroup label="繋がり">
                <option value="出会いのきっかけ">出会いのきっかけ</option>
                <option value="たのしかった思い出">たのしかった思い出</option>
                <option value="最後に会ったときのこと">最後に会ったときのこと</option>
                <option value="忘れられないこと">忘れられないこと</option>
                <option value="もう一度したいこと">もう一度したいこと</option>
              </optgroup>
              <optgroup label="外見">
                <option value="チャームポイント">チャームポイント</option>
                <option value="カッコいいところ">カッコいいところ</option>
                <option value="似ている芸能人">似ている芸能人</option>
                <option value="動物に例えると">動物に例えると</option>
                <option value="どんな服装">どんな服装</option>
              </optgroup>
              <optgroup label="内面">
                <option value="尊敬するところ">尊敬するところ</option>
                <option value="凄いところ">凄いところ</option>
                <option value="直してほしいところ">直してほしいところ</option>
                <option value="面白いところ">面白いところ</option>
                <option value="羨ましいところ">羨ましいところ</option>
                <option value="将来していそうなこと">将来していそうなこと</option>
              </optgroup>
            </select>
          </div>
          <div style="margin-left:10px;font-size:15px;background-color:;float:left;color:red;font-family:'メイリオ';">
            <span class="text-danger" ng-show="myForm.c_type1.$error.required">選択してください</span>
          </div>
          <br>
          <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment1" ng-model="comment1" autocomplete="off" required 　ng-minlength="1" ng-maxlength="125"></textarea>
          <div style="font-size:15px;background-color:;color:red;font-family:'メイリオ';">
            <span class="text-danger" ng-show="myForm.comment1.$error.required">入力してください</span>
            <span class="text-danger" ng-show="myForm.comment1.$error.name">正しい名前を入力して下さい</span>
            <span class="text-denger" ng-show="myForm.comment1.$error.minlength">Too short!</span>
            <span class="text-denger" ng-show="myForm.comment1.$error.maxlength">Too long!</span>
          </div>
        </div>    
      </div>
    </header>
  </div>
</article>

<article id="tab1_2" class="post">
  <div class="tab">
    <header class="entry-header">
      <div class="entry-title">
        <div class="entry-title">
          <div name="meet_trigger" style="padding:0 10px;background-color:;">
            <div style="float:left;">
            <select class="popup_select" name="c_type2" ng-model="c_type2" autocomplete="off" required>
              <option value="" selected>コメントの種類</option>
              <optgroup label="繋がり">
                <option value="出会いのきっかけ">出会いのきっかけ</option>
                <option value="たのしかった思い出">たのしかった思い出</option>
                <option value="最後に会ったときのこと">最後に会ったときのこと</option>
                <option value="忘れられないこと">忘れられないこと</option>
                <option value="もう一度したいこと">もう一度したいこと</option>
              </optgroup>
              <optgroup label="外見">
                <option value="チャームポイント">チャームポイント</option>
                <option value="カッコいいところ">カッコいいところ</option>
                <option value="似ている芸能人">似ている芸能人</option>
                <option value="動物に例えると">動物に例えると</option>
                <option value="どんな服装">どんな服装</option>
              </optgroup>
              <optgroup label="内面">
                <option value="尊敬するところ">尊敬するところ</option>
                <option value="凄いところ">凄いところ</option>
                <option value="直してほしいところ">直してほしいところ</option>
                <option value="面白いところ">面白いところ</option>
                <option value="羨ましいところ">羨ましいところ</option>
                <option value="将来していそうなこと">将来していそうなこと</option>
              </optgroup>
            </select>
            </div>
            <div style="background-color:;margin-left:10px;font-size:15px;background-color:;float:left;color:red;font-family:'メイリオ';">
              <span class="text-danger" ng-show="myForm.c_type2.$error.required">選択してください</span>
            </div>
            <br>
            <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment2" ng-model="comment2" autocomplete="off" required 　ng-minlength="1" ng-maxlength="125"></textarea>
            <div style="font-size:15px;background-color:;color:red;font-family:'メイリオ';">
              <span class="text-danger" ng-show="myForm.comment2.$error.required">入力してください</span>
              <span class="text-danger" ng-show="myForm.comment2.$error.name">正しい名前を入力して下さい</span>
              <span class="text-denger" ng-show="myForm.comment2.$error.minlength">Too short!</span>
              <span class="text-denger" ng-show="myForm.comment2.$error.maxlength">Too long!</span>
            </div>
          </div>   
        </div>
      </div>
    </header>
  </div>
</article>
<article id="tab1_3" class="post">
  <div class="tab">
    <header class="entry-header">
      <div class="entry-title">
        <div class="entry-title">
          <div name="meet_trigger" style="padding:0 10px;background-color:;">
            <div style="float:left;">
            <select class="popup_select" name="c_type3" ng-model="c_type3" autocomplete="off" required>
              <option value="" selected>コメントの種類</option>
              <optgroup label="繋がり">
                <option value="出会いのきっかけ">出会いのきっかけ</option>
                <option value="たのしかった思い出">たのしかった思い出</option>
                <option value="最後に会ったときのこと">最後に会ったときのこと</option>
                <option value="忘れられないこと">忘れられないこと</option>
                <option value="もう一度したいこと">もう一度したいこと</option>
              </optgroup>
              <optgroup label="外見">
                <option value="チャームポイント">チャームポイント</option>
                <option value="カッコいいところ">カッコいいところ</option>
                <option value="似ている芸能人">似ている芸能人</option>
                <option value="動物に例えると">動物に例えると</option>
                <option value="どんな服装">どんな服装</option>
              </optgroup>
              <optgroup label="内面">
                <option value="尊敬するところ">尊敬するところ</option>
                <option value="凄いところ">凄いところ</option>
                <option value="直してほしいところ">直してほしいところ</option>
                <option value="面白いところ">面白いところ</option>
                <option value="羨ましいところ">羨ましいところ</option>
                <option value="将来していそうなこと">将来していそうなこと</option>
              </optgroup>
            </select>
            </div>
            <div style="background-color:;margin-left:10px;font-size:15px;background-color:;float:left;color:red;font-family:'メイリオ';">
              <span class="text-danger" ng-show="myForm.c_type3.$error.required">選択してください</span>
            </div>
            <br>
            <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment3" ng-model="comment3" autocomplete="off" required 　ng-minlength="1" ng-maxlength="125"></textarea>
            <div style="font-size:15px;background-color:;color:red;font-family:'メイリオ';">
              <span class="text-danger" ng-show="myForm.comment3.$error.required">入力してください</span>
              <span class="text-danger" ng-show="myForm.comment3.$error.name">正しい名前を入力して下さい</span>
              <span class="text-denger" ng-show="myForm.comment3.$error.minlength">Too short!</span>
              <span class="text-denger" ng-show="myForm.comment3.$error.maxlength">Too long!</span>
            </div>
          </div>  
        </div>
      </div>
    </header>
  </div>
</article>
<article id="tab1_4" class="post">
  <div class="tab">
    <header class="entry-header">
      <div class="entry-title">
        <div class="entry-title">
          <div style="padding:0 10px;background-color:;color:gray;"><span style="background-color:;height:20px;font-size:15px;">伝えたいこと</span>
            <textarea style="font-size:15px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment4" ng-model="comment4" autocomplete="off" required 　ng-minlength="1" ng-maxlength="125"></textarea>
            <div style="font-size:15px;color:red;font-family:'メイリオ';">
            <span class="text-danger" ng-show="myForm.comment4.$error.required">入力してください</span>
            <span class="text-danger" ng-show="myForm.comment4.$error.name">正しい名前を入力して下さい</span>
            <span class="text-denger" ng-show="myForm.comment4.$error.minlength">Too short!</span>
            <span class="text-denger" ng-show="myForm.comment4.$error.maxlength">Too long!</span>
            </div>
          </div> 
        </div>
      </div>
    </header>
  </div>
</article>
<article id="tab1_5" class="post">
  <div class="tab">
    <header class="entry-header">
      <div class="entry-title">
        <div class="entry-title">
          <div style="padding:0 10px;background-color:;font-size:15px;color:gray;clear:both;float:left;width:360px;min-height:185px;">質問:<span style="padding-left:20px;color:gray;font-size:15px;">何か質問してみましょう</span>
            <textarea name="question" style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="question" ng-model="question" autocomplete="off" required 　ng-minlength="10" ng-maxlength="125"></textarea>
            <div style="font-size:15px;background-color:;color:red;font-family:'メイリオ';">
            <span class="text-danger" ng-show="myForm.question.$error.required">入力してください</span>
            <span class="text-denger" ng-show="myForm.question.$error.minlength">Too short!</span>
            <span class="text-denger" ng-show="myForm.question.$error.maxlength">Too long!</span>
            </div>
          </div>     
        </div>
      </div>
    </header>
  </div>
</article>

</div>
</section>
<!--end tabContainer1 -->
<div style="padding:10px 0;background-color:;text-align:center;">          
    <input style="width:170px;height:33px;" value="Follow" type="submit" class="standby_button" ng-disabled="!myForm.$valid">     
</div>
</section>
<!--end tab_content-->
</form>
</div>
</div>
</div>
</div>

<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////begin 全ての友達のポップアップウィンドウ/////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
for($a=0;$a<$f_all_num;$a++){
echo '
<div class="c_e_g">
  <!--begin comment-->
  <div id="comment_all'.$a.'" style="padding-top:10px;background-color:;">
    <a class="modal_close"  href="javascript:void(0)"></a>
    <!--begin tab_wrapper-->
    <div class="tab_wrapper" style="font-family:meiryo;height:100%;background-color:rgba(225,225,255,0);">
      <div style="background-color:;height:30px;float:left;color:gray;background-color:;">
        '.$allf_data_all[$a]['relation'].'
      </div>
      <div style="background-color:;height:30px;margin-left:20px;float:left;color:gray;background-color:;">
        '.$allf_data_all[$a]['more_relation'].'
      </div>
      <!--begin contentContainer-->
      <div id="contentContainer" class="">
        <!--begin tabContainer-->
        <div id="comment_all_tab'.$a.'" class="jQdmtab1 tabContainer" style="clear:both;">
          <ul class="controls">
            <li><a href="#tab1_1">'.$allf_data_all[$a]['comment1_type'].'</a></li>
            <li><a href="#tab1_2">'.$allf_data_all[$a]['comment2_type'].'</a></li>
            <li><a href="#tab1_3">'.$allf_data_all[$a]['comment3_type'].'</a></li>
            <li><a href="#tab1_4">伝えたいこと</a></li>
          </ul>
          <!--begin tabContentsContainer-->
          <div class="tabContentsContainer">

            <!--begin tab1_1-->
            <article id="tab1_1" class="post" style="background-color:;">
              <div class="tab_content" style="">
                <div class="" style="">
                  '.$allf_data_all[$a]['comment1'].'
                </div>
              </div>
            </article>
            <!--end tab1_1-->

            <!--begin tab1_2-->
            <article id="tab1_2" class="post">
              <div class="tab_content">
                <div class="" style="background-color:;">
                  '.$allf_data_all[$a]['comment2'].'
                </div>
              </div>
            </article>
            <!--begin tab1_2-->

            <!--begin tab1_3-->
            <article id="tab1_3" class="post">
              <div class="tab_content">
                <div class="" style="background-color:;">
                  '.$allf_data_all[$a]['comment3'].'
                </div>
              </div>
            </article>
            <!--end tab1_3-->

            <!--begin tab1_4-->
            <article id="tab1_4" class="post">
              <div class="tab_content">
                <div class="" style="background-color:;">
                  '.$allf_data_all[$a]['comment4'].'
                </div>
              </div>
            </article>
            <!--begin tab1_4-->

          </div>
          <!--end tabContentsContainer-->
        </div>
        <!--end tabContainer-->
      </div>
      <!--end contentContainer-->
    </div>
    <!--end tab_wrapper-->
  </div>
  <!--end comment-->
</div>
';
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////end 全ての友達のポップアップウィンドウ///////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////begin 友達の種類毎のポップアップウィンドウ///////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$friends_type=array('family'=>'家族','lover'=>'恋人','school'=>'小・中学校','high_school'=>'高校','college'=>'大学・専門','works'=>'勤務先','other'=>'その他',);
$num=0;
foreach($friends_type as $name => $value){

for($a=0;$a<$pr_f_type_num[$num];$a++){
  echo '
    <div class="c_e_g">
      <div id="comment_'.$name.'_'.$a.'" style="padding-top:10px;background-color:;">
        <a class="modal_close"  href="javascript:void(0)"></a>
        <!--begin lower_content-->
        <div class="tab_wrapper" style="height:100%;background-color:rgba(225,225,255,0);">
                <div style="background-color:;height:60px;float:left;color:gray;">
                  
                </div>
                <div style="background-color:;height:60px;margin-left:20px;float:left;color:gray;">
                  
                </div>
          <!--begin contentContainer-->
          <div id="contentContainer" class="">
            <!--begin tabContainer2-->
            <div id="comment_tab'.$a.'" class="jQdmtab1 tabContainer" style="clear:both;">
                <ul class="controls">
                  <li><a href="#tab1_1">'.$fr_ar[$name][$a]['comment1_type'].'</a></li>
                  <li><a href="#tab1_2">'.$fr_ar[$name][$a]['comment2_type'].'</a></li>
                  <li><a href="#tab1_3">'.$fr_ar[$name][$a]['comment3_type'].'</a></li>
                  <li><a href="#tab1_4">伝えたいこと</a></li>
                </ul>
                  <!--begin tabContentsContainer-->
                  <div class="tabContentsContainer">

                    <article id="tab1_1" class="post" style="background-color:;">
                      <div class="tab_content" style="">
                        <div class="" style="">
                          '.$fr_ar[$name][$a]['comment1'].'
                        </div>
                      </div>
                    </article>

                    <article id="tab1_2" class="post">
                      <div class="tab_content">
                        <div class="" style="background-color:;">
                          '.$fr_ar[$name][$a]['comment2'].'
                        </div>
                      </div>
                    </article>
                    <article id="tab1_3" class="post">
                      <div class="tab_content">
                        <div class="" style="background-color:;">
                          '.$fr_ar[$name][$a]['comment3'].'
                        </div>
                      </div>
                    </article>
                    <article id="tab1_4" class="post">
                      <div class="tab_content">
                        <div class="" style="background-color:;">
                          '.$fr_ar[$name][$a]['comment4'].'
                        </div>
                      </div>
                    </article>
                  </div>
                  <!--end tabContentsContainer-->
              </div>
              <!--end tabContainer2-->
          </div>
          <!--end contentContainer-->
        </div>
        <!--end tab_wrapper-->
      </div>
</div>
';

}
$num++;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////end 友達の種類毎のポップアップウィンドウ/////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>



<!--end popupwindow (StandBy)-->
<!--end popup window-->
<script type="text/javascript">
;(function(d,$){

  // 変数のデフォルト値
  var jQdmtab_defaults = {
    tabContentsContainer: '.tabContentsContainer',
    tabEventAction: 'click',
   current: 0,
    currentSelector: 'current',
  };

  $.fn.jQdmtab = function(options){

    // 変数を設定
    var defaults = jQdmtab_defaults;
    var setting = $.extend( defaults, options);

    var _$obj = $(this.get(0)),
    _s = $.data( $(this), setting ),
    _p = {
      tabs: _$obj.find('li'),
      tabCn: _$obj.find(_s.tabContentsContainer),
      tabCnHeight: function(){
        var _$cns = _p.tabCn.children(),
        _len = _$cns.length,
        _hi = 0;
        while(_len > 0){
          _hi = Math.max( _hi, _$cns.eq(--_len).height());
        }
        return _hi + 40;
      },
      current: _s.current
    };

    // ページ表示時に最初に設定したタブを開く
    tabChangeCurrent(_p.current);
    _p.tabCn.children().not(':eq('+ _p.current +')').css({
      display: 'none',
      opacity: 0
    });
    _p.tabCn.css({
      position: 'relative',
      overflow: 'hidden',
      background: '',
      height: _p.tabCnHeight()
    });

    // タブにクリックイベントを追加
    _p.tabs.on( _s.tabEventAction, function(e){
      if(typeof e.preventDefault() === 'function') {
        e.preventDefaut();
      }

      var _$t = $(this),
      _index = _$t.index();
      _current = _p.current;

      if(_index != _current && !_p.isAnimate) {
        hideTabContent(_current);
        _p.current = _index;
        showTabContent(_index);
      }
    });

    // タブコンテンツの非表示処理
    function hideTabContent(_current){

      var _$target = _p.tabCn.children().eq(_current);
      tabChangeCurrent(_current);

     _$target.css({
        left: 0,
        opacity: 0,
        display: 'none',
        position: 'relative'
      });
    }

    // タブコンテンツの表示処理
    function showTabContent(_t){

      var _$target = _p.tabCn.children().eq(_t);
      tabChangeCurrent(_t);
      _$target.css({
        display: 'block',
        position: 'relative',
        opacity: 1
      });
    }

    // クリックされたタブをカレント（現在）のタブに変更する
    function tabChangeCurrent(_t){
      _p.tabs.eq(_t).toggleClass(_s.currentSelector);
    }

  }
    //lower_contentの友達カテゴリー
    $('#category_tab').jQdmtab();
    $('#standby_tab').jQdmtab();

//全て(友達)のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_all_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#standby_all_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//家族のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_family_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_family_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//恋人のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_lover_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_lover_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//小・中学校のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//高校のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_high_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_high_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//大学・専門のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_college_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_college_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//勤務先のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_works_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_works_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//その他のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_other_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_other_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//友達リクエストのタブ
for (var i=0; i<<?php echo $f_request_num;?>; i++) {
  $('#comment_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#standby_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}


})(document, jQuery);
</script>
<script type="text/javascript">
/*
;(function(d,$){

  // 変数のデフォルト値
  var jQdmtab_defaults = {
    tabContentsContainer: '.tabContentsContainer',
    tabEventAction: 'click',
   current: 0,
    currentSelector: 'current',
  };

  $.fn.jQdmtab = function(options){

    // 変数を設定
    var defaults = jQdmtab_defaults;
    var setting = $.extend( defaults, options);

    var _$obj = $(this.get(0)),
    _s = $.data( $(this), setting ),
    _p = {
      tabs: _$obj.find('li'),
      tabCn: _$obj.find(_s.tabContentsContainer),
      tabCnHeight: function(){
        var _$cns = _p.tabCn.children(),
        _len = _$cns.length,
        _hi = 0;
        while(_len > 0){
          _hi = Math.max( _hi, _$cns.eq(--_len).height());
        }
        return _hi + 40;
      },
      current: _s.current
    };

    // ページ表示時に最初に設定したタブを開く
    tabChangeCurrent(_p.current);
    _p.tabCn.children().not(':eq('+ _p.current +')').css({
      display: 'none',
      opacity: 0
    });
    _p.tabCn.css({
      position: 'relative',
      overflow: 'hidden',
      background: '',
      height: _p.tabCnHeight()
    });

    // タブにクリックイベントを追加
    _p.tabs.on( _s.tabEventAction, function(e){
      if(typeof e.preventDefault() === 'function') {
        e.preventDefaut();
      }

      var _$t = $(this),
      _index = _$t.index();
      _current = _p.current;

      if(_index != _current && !_p.isAnimate) {
        hideTabContent(_current);
        _p.current = _index;
        showTabContent(_index);
      }
    });

    // タブコンテンツの非表示処理
    function hideTabContent(_current){

      var _$target = _p.tabCn.children().eq(_current);
      tabChangeCurrent(_current);

     _$target.css({
        left: 0,
        opacity: 0,
        display: 'none',
        position: 'relative'
      });
    }

    // タブコンテンツの表示処理
    function showTabContent(_t){

      var _$target = _p.tabCn.children().eq(_t);
      tabChangeCurrent(_t);
      _$target.css({
        display: 'block',
        position: 'relative',
        opacity: 1
      });
    }

    // クリックされたタブをカレント（現在）のタブに変更する
    function tabChangeCurrent(_t){
      _p.tabs.eq(_t).toggleClass(_s.currentSelector);
    }

  }

    //lower_contentの友達カテゴリー
    $('#category_tab').jQdmtab();

  //全て(友達)のタブ
  for (var i=0; i<<?php echo $pr_f_all_num;?>; i++) {
    $('#standby').jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#standby_all_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
  //全て(友達)のタブ
  for (var i=0; i<<?php echo $pr_f_all_num;?>; i++) {
    $('#comment_all_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#standby_all_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
  //家族のタブ
  for (var i=0; i<<?php echo $pr_f_type_num[0];?>; i++) {
    $('#comment_family_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#edit_family_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
  //恋人のタブ
  for (var i=0; i<<?php echo $pr_f_type_num[1];?>; i++) {
    $('#comment_lover_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#edit_lover_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
  //小・中学校のタブ
  for (var i=0; i<<?php echo $pr_f_type_num[2];?>; i++) {
    $('#comment_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#edit_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
  //高校のタブ
  for (var i=0; i<<?php echo $pr_f_type_num[3];?>; i++) {
    $('#comment_high_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#edit_high_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
  //大学・専門のタブ
  for (var i=0; i<<?php echo $pr_f_type_num[4];?>; i++) {
    $('#comment_college_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#edit_college_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
  //勤務先のタブ
  for (var i=0; i<<?php echo $pr_f_type_num[5];?>; i++) {
    $('#comment_works_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#edit_works_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
  //その他のタブ
  for (var i=0; i<<?php echo $pr_f_type_num[6];?>; i++) {
    $('#comment_other_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
    $('#edit_other_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  }
})(document, jQuery);*/
</script>

</body>
</html>