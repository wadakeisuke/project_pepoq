<?php
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
//データベースに接続
require ('../../php/db_connect.php');
//ログインしていなかったらトップに飛ばす
if(!isset($_GET['q'])){
  require ('../php/m.not_login.php'); 
}
//友達の数を取得
require ('../../php/friend_num.php');
//質問の数を取得
require ('../../php/question_num.php');

//mypageの友達からprofileにとんだ場合
try{
  
  if(@$_POST['profile_id']){
    //profile_id
    //friends
    //id
    $profile = $pdo->prepare('SELECT sender_email FROM friends WHERE id=:id');
    $profile->bindValue(':id',$_POST['profile_id']);
    $profile->execute();

    $data = $profile->fetch(PDO::FETCH_ASSOC);
    $data = $data['sender_email'];

    $profile_data = $pdo->prepare('SELECT * FROM personal_data WHERE email=:email');
    $profile_data->bindValue(':email', $data);
    $profile_data->execute();
    $profile_data = $profile_data->fetch(PDO::FETCH_ASSOC);

    $_SESSION['profile'] = $profile_data;
    //友達のプロフィールの友達の数を取得
    require ('../../php/fr_profile_friend_num.php');
  }elseif($_POST['search_id']){ //search から profile に飛んだ場合
    $data = $_POST['search_id'];
    $profile_data = $pdo->prepare('SELECT * FROM personal_data WHERE id=:id');
    $profile_data->bindValue(':id', $data);
    $profile_data->execute();
    $profile_data = $profile_data->fetch(PDO::FETCH_ASSOC);
    $_SESSION['profile'] = $profile_data;
    require ('../../php/fr_profile_friend_num.php');
  }elseif(isset($_GET['friend_type'])){
    $_SESSION['profile'] = $_SESSION['profile'];
    require ('../../php/fr_profile_friend_num.php');
  }else{
    $_SESSION['profile'] = $_SESSION['mypage'];
    //自分のプロフィールの友達の数を取得
    require ('../../php/profile_friend_num.php');   
  }
}catch(PDOException $e){
  echo('Error'.$e->getMessage());
  die();
}
  //ログインしていないでもプロフィールの閲覧は可能にする　以下
  if(@$_GET['q']){
    $id = htmlspecialchars($_GET['q'],ENT_QUOTES,'utf-8');
    $profile = $pdo->prepare('SELECT * FROM personal_data WHERE id=:id');
    $profile->bindValue(':id',$id);
    $profile->execute();

    $data = $profile->fetch(PDO::FETCH_ASSOC);
    if($data == ''){
      header('Location: ../top/top.php');
      exit();
    }
    $_SESSION['profile'] = $data;
  }
  //以上

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

//友達リクエストを取得
$newf_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_password=:ac_password AND accepter_email=:ac_email');
$newf_data->bindValue(':w_friend','request');
$newf_data->bindValue(':ac_password',$_SESSION['profile']['password']);
$newf_data->bindValue(':ac_email',$_SESSION['profile']['email']);
$newf_data->execute();
$newf_profile_data_all=array();
$newf_data_all=array();
$i=0;
while($friends = $newf_data->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
  //プロフィールに飛ぶための情報
  $f_profile=$pdo->prepare('SELECT * FROM personal_data WHERE email=:email');
  $f_profile->bindValue(':email',$friends['sender_email']);
  $f_profile->execute();
  $f_profile_data=$f_profile->fetch(PDO::FETCH_ASSOC);
  $newf_profile_data_all[$i]=array_merge($newf_profile_data_all,$f_profile_data);
  $newf_data_all[$i]=array_merge($newf_data_all,$friends);
  //プロフィールに飛ぶための情報
  $i++;
}


//friends_typeに連想配列で友達の種類を代入
$friends_type=array('family'=>'家族','lover'=>'恋人','school'=>'小・中学校','high_school'=>'高校','college'=>'大学・専門','works'=>'勤務先','other'=>'その他',);
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
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title><?php echo($_SESSION['profile']['name']); ?></title>
<meta name="description" content="<?php echo($_SESSION['profile']['name']); ?> さんのページ。StandByは人間関係をデザインし、より鮮明にする新しい形のプロフィールサイト「StandBy」。">
<meta name="keywords" content="<?php echo($_SESSION['profile']['name']); ?>,StandBy,standby,プロフィール,プロフィールサイト,プロフ">
<meta name="robots" content="ALL">
<link rel="stylesheet" href="../mypage/style/css/drawer.css">
<link rel="stylesheet" type="text/css" href="style/css/mobile.css">
<link rel="stylesheet" type="text/css" href="style/css/style.css">
<link rel="stylesheet" type="text/css" href="../mypage/style/css/header_style.css">
<link rel="stylesheet" type="text/css" href="style/css/fr_popup.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../style/js/jquery-ui.js"></script>
<script type="text/javascript" src="../../style/js/jquery.leanModal.min.js"></script>
<script type="text/javascript" src="../../style/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
  $.backstretch("../../img/background/<?php echo($_SESSION['mypage']['background']); ?>");
</script>
<script type="text/javascript" src="../mypage/style/js/jquery-ui-1.8.15.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.click').click(function() {
        $("#page_all")
        .css('position','fixed')
        //.siblings()
        //.css('backgroundColor','#ffffff');
        $('.modal_close').removeAttr('disabled');
        //$('#number').removeAttr('disabled');
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.modal_close').click(function() {
        $("#page_all")
        .css('position','static')
        //.siblings()
        //.css('backgroundColor','#ffffff');
        $('.modal_close').removeAttr('disabled');
        //$('#number').removeAttr('disabled');
    });
});
</script>
  <!-- これでデフォルトも可能
  <script>
      $(function(){
          $("#tabs1").tabs({
              selected: 2 
          });
          
      });
  </script>
  -->
<?php
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_all'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_family'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_lover'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_school'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_high_school'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_college'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_work'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_other'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}



$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_standby'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_standby_all'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_standby_lover'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_standby_school'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_standby_high_school'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_standby_college'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_standby_work'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}
$i = 0;
while ($i < 10) {
  echo '
    <script>
      $(function() {
        $( "#tabs_standby_other'.$i.'" ).tabs();
      });
    </script>
  ';
  $i++;
}


?>
<!--begin ポップアップウィンドウ-->
<script type="text/javascript">
$(function() {
$( 'a[rel*=leanModal]').leanModal({
top: 0,                     // モーダルウィンドウの縦位置を指定
overlay : 0.7,               // 背面の透明度 
closeButton: ".modal_close",  // 閉じるボタンのCSS classを指定
});
}); 
</script><!--end ポップアップウィンドウ-->
<link type="text/css" href="../mypage/style/css/jquery-ui-1.8.15.custom.css" rel="stylesheet" />
</head>

<body>
<!--begin page_all-->
<div id="page_all">
<div id="content" class="snap-content">
<!--begin header-->
<?php
require('../mypage/header.php');
?>
<!--end header-->
<!--begin upper_content-->
<div id="upper_content" class="centered">
  <!--begin thumbnail_and _comment-->
  <div  class="thumbnail_box thumbnail">
    <!--begin thumbnail-->
    <div id="thumbnail">
      <img src="../../img/thumbnail/<?php echo($_SESSION['profile']['thumbnail']); ?>">
    </div>
    <!--end thumbnail-->
    <!--begin icon_and_name-->
    <div class="user">
      <div class="user_name">
        <p><i class="fa fa-male"></i><i class="fa fa-female"></i><?php echo($_SESSION['profile']['name']); ?></p>
      </div>
      <!--
      <div class="add_friend">
      <button class="add_btn"><a id="go" rel="leanModal" name="edit" href="#edit"><i class="fa fa-user-plus" style="color:white">standby</i>
      </a>
      </button>
      </div>
      --><?php require('../php/m.friend_check.php'); ?>
      <div class="social_icons">
        <ul>
          <li><a href="<?php echo($_SESSION['profile']['twitter']); ?>"><i class="fa fa-twitter-square"></i></a></li>
          <li><a href="<?php echo($_SESSION['profile']['facebook']); ?>"><i class="fa fa-facebook-square"></i></a></li>
          <li><a href="<?php echo($_SESSION['profile']['google_plus']); ?>"><i class="fa fa-google-plus"></i></a></li>
          <li><a href="<?php echo($_SESSION['profile']['instagram']); ?>"><i class="fa fa-instagram"></i></a></li>
        </ul>
      </div>    
    </div>
  </div>
  <!--end icon_and_name-->
  </div><!--end thumbnail_and _comment-->

  <!--begin comment_data-->
  <div id="comment"class="box">
    <div class="format_box_pad">
    <span class="data_title"><i class="fa fa-file-text box_icon"></i>COMMENT</span><br>
    <p><?php echo($_SESSION['profile']['comment']); ?>
   <br><cite>-Comment</cite></p>
    </div>
  </div>
  <!--end comment_data-->
  <!--begin basic_data-->
  <div id="basic_data" class="box">
    <div class="format_box_pad">
      <span class="data_title"><i class="fa fa-user box_icon"></i>BASIC DATA</span><br> 
      <ul>
        <li><strong>Age:</strong><span class="data"><?php echo($_SESSION['profile']['age']); ?></span></li><hr>
        <li><strong>Birthday:</strong><span class="data"><?php echo($_SESSION['profile']['birthday']); ?></span></li><hr>
        <li><strong>From:</strong><span class="data"><?php echo($_SESSION['profile']['come_from']); ?></span></li><hr>
        <li><strong>Educational background:</strong><span class="data"><?php echo($_SESSION['profile']['educational_background']); ?></span></li><hr>
        <li><strong>Works:</strong><span class="data"><?php echo($_SESSION['profile']['works']); ?></span></li>
      </ul>
    </div>
  </div>
  <!--end basic_data-->

  <!--begin love and likes-->
  <div id="love_and_likes" class="box">
    <div class="format_box_pad">
      <span class="data_title"><i class="fa fa-heart box_icon"></i>LOVE AND LIKES</span><br> 
      <ul>
        <li><strong>Lover:</strong><br><span class="data"><?php echo(nl2br($_SESSION['profile']['lover'])); ?></span></li><hr>
        <li><strong>Singer:</strong><br><span class="data"><?php echo(nl2br($_SESSION['profile']['singer'])); ?></span></li><hr>
        <li><strong>Writer:</strong><br><span class="data"><?php echo(nl2br($_SESSION['profile']['writer'])); ?></span></li><hr>
        <li><strong>Movie:</strong><br><span class="data"><?php echo(nl2br($_SESSION['profile']['movie'])); ?></span></li>
      </ul>
    </div>
  </div>
  <!--end love and likes-->
<?php
$sql=$pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type','all');
$sql->bindValue(':ac_email',$_SESSION['profile']['email']);
$sql->execute();
$i=0;
while($quesiton = $sql->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
echo '
<div class="box">
  <div>
  <div class="format_box_pad">
      <ul>
        <li><strong>Question</strong><br><span class="data">'.$quesiton['question'].'</span></li><hr>
        <li><strong>Answer</strong><br><span class="data">'.$quesiton['answer'].'</span></li>
      </ul>
    </div>
  </div>
</div>
<!--tuika-->
';
$i++;
}
?>
  <div class="box">
    <div class="format_box_pad">
      <form name="frm1" method="GET" action="../profile/profile.php?page_type=profile#friends_all">
      <select onChange="document.forms['frm1'].submit()" name="friend_type">
        <option value="" <?php if(@$_GET['friend_type'] == ''){ echo 'selected';} ?> >全て</option>
        <option value="family" <?php if(@$_GET['friend_type'] == 'family'){ echo 'selected';} ?>>家族</option>
        <option value="lover" <?php if(@$_GET['friend_type'] == 'lover'){ echo 'selected';} ?>>恋人</option>
        <option value="school" <?php if(@$_GET['friend_type'] == 'school'){ echo 'selected';} ?>>小・中学校</option>
        <option value="high_school" <?php if(@$_GET['friend_type'] == 'high_school'){ echo 'selected';} ?>>高校</option>
        <option value="college" <?php if(@$_GET['friend_type'] == 'college'){ echo 'selected';} ?>>大学・専門</option>
        <option value="works" <?php if(@$_GET['friend_type'] == 'works'){ echo 'selected';} ?>>勤務先</option>
        <option value="other" <?php if(@$_GET['friend_type'] == 'other'){ echo 'selected';} ?>>その他</option>
      </select>
      </form>
    </div>
  </div>
</div><!--end upper_content-->


<!--begin lower_content-->
<div class="lower_content">
  <!--begin friends_all-->  
  <div id="friends_all" class="ff">
<?php
//友達 全て
if($_GET['friend_type'] == 'all' || $_GET['friend_type'] ==''){
  $i = 0;
  while($i < $f_all_num){
  echo '
      <div class="fbox">
        <div class="friends-image">
          <img src="../../img/thumbnail/'.$allf_data_all[$i]['thumbnail'].'">
        </div>
        <div class="f_info">
          <div class="friends_name">
            <form name="#" method="post" action="../profile/profile.php">
              <input type="hidden" name="profile_id" value="'.$allf_data_all[$i]['id'].'">
              <p><input class="fr_tab_name" type="submit" value="'.$allf_data_all[$i]['name'].'"></p>
            </form>
          </div>
          <div class="friends-category">
            <ul>
              <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_all'.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
            </ul>
          </div>
        </div>
      </div>
  ';
  $i++;
  }
}
?>
<?php
//友達 家族
if($_GET['friend_type'] == 'family'){
  $i = 0;
  while($i < $pr_f_type_num[0]){
  echo '
      <div class="fbox">
        <div class="friends-image">
          <img src="../../img/thumbnail/'.$fr_ar['family'][$i]['thumbnail'].'">
        </div>
        <div class="f_info">
          <div class="friends_name">
            <form name="#" method="post" action="../profile/profile.php">
              <input type="hidden" name="profile_id" value="'.$fr_ar['family'][$i]['id'].'">
              <p><input class="fr_tab_name" type="submit" value="'.$fr_ar['family'][$i]['name'].'"></p>
            </form>
          </div>
          <div class="friends-category">
            <ul>
              <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_family'.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
            </ul>
          </div>
        </div>
      </div>
  ';
  $i++;
  }
}
?>
<?php
//友達 恋人
if($_GET['friend_type'] == 'lover'){
  $i = 0;
  while($i < $pr_f_type_num[1]){
  echo '
      <div class="fbox">
        <div class="friends-image">
          <img src="../../img/thumbnail/'.$fr_ar['lover'][$i]['thumbnail'].'">
        </div>
        <div class="f_info">
          <div class="friends_name">
            <form name="#" method="post" action="../profile/profile.php">
              <input type="hidden" name="profile_id" value="'.$fr_ar['lover'][$i]['id'].'">
              <p><input class="fr_tab_name" type="submit" value="'.$fr_ar['lover'][$i]['name'].'"></p>
            </form>
          </div>
          <div class="friends-category">
            <ul>
              <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_lover'.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
            </ul>
          </div>
        </div>
      </div>
  ';
  $i++;
  }
}
?>
<?php
//友達 小・中学校
if($_GET['friend_type'] == 'school'){
  $i = 0;
  while($i < $pr_f_type_num[2]){
  echo '
      <div class="fbox">
        <div class="friends-image">
          <img src="../../img/thumbnail/'.$fr_ar['school'][$i]['thumbnail'].'">
        </div>
        <div class="f_info">
          <div class="friends_name">
            <form name="#" method="post" action="../profile/profile.php">
              <input type="hidden" name="profile_id" value="'.$fr_ar['school'][$i]['id'].'">
              <p><input class="fr_tab_name" type="submit" value="'.$fr_ar['school'][$i]['name'].'"></p>
            </form>
          </div>
          <div class="friends-category">
            <ul>
              <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_school'.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
            </ul>
          </div>
        </div>
      </div>
  ';
  $i++;
  }
}
?>
<?php
//友達 高校
if($_GET['friend_type'] == 'high_school'){
  $i = 0;
  while($i < $pr_f_type_num[3]){
  echo '
      <div class="fbox">
        <div class="friends-image">
          <img src="../../img/thumbnail/'.$fr_ar['school'][$i]['thumbnail'].'">
        </div>
        <div class="f_info">
          <div class="friends_name">
            <form name="#" method="post" action="../profile/profile.php">
              <input type="hidden" name="profile_id" value="'.$fr_ar['school'][$i]['id'].'">
              <p><input class="fr_tab_name" type="submit" value="'.$fr_ar['school'][$i]['name'].'"></p>
            </form>
          </div>
          <div class="friends-category">
            <ul>
              <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_school'.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
            </ul>
          </div>
        </div>
      </div>
  ';
  $i++;
  }
}
?>
<?php
//友達 大学
if($_GET['friend_type'] == 'college'){
  $i = 0;
  while($i < $pr_f_type_num[4]){
  echo '
      <div class="fbox">
        <div class="friends-image">
          <img src="../../img/thumbnail/'.$fr_ar['college'][$i]['thumbnail'].'">
        </div>
        <div class="f_info">
          <div class="friends_name">
            <form name="#" method="post" action="../profile/profile.php">
              <input type="hidden" name="profile_id" value="'.$fr_ar['college'][$i]['id'].'">
              <p><input class="fr_tab_name" type="submit" value="'.$fr_ar['college'][$i]['name'].'"></p>
            </form>
          </div>
          <div class="friends-category">
            <ul>
              <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_college'.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
            </ul>
          </div>
        </div>
      </div>
  ';
  $i++;
  }
}
?>
<?php
//友達 勤務先
if($_GET['friend_type'] == 'work'){
  $i = 0;
  while($i < $pr_f_type_num[5]){
  echo '
      <div class="fbox">
        <div class="friends-image">
          <img src="../../img/thumbnail/'.$fr_ar['work'][$i]['thumbnail'].'">
        </div>
        <div class="f_info">
          <div class="friends_name">
            <form name="#" method="post" action="../profile/profile.php">
              <input type="hidden" name="profile_id" value="'.$fr_ar['work'][$i]['id'].'">
              <p><input class="fr_tab_name" type="submit" value="'.$fr_ar['work'][$i]['name'].'"></p>
            </form>
          </div>
          <div class="friends-category">
            <ul>
              <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_work'.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
            </ul>
          </div>
        </div>
      </div>
  ';
  $i++;
  }
}
?>
<?php
//友達 その他
if($_GET['friend_type'] == 'other'){
  $i = 0;
  while($i < $pr_f_type_num[6]){
  echo '
      <div class="fbox">
        <div class="friends-image">
          <img src="../../img/thumbnail/'.$fr_ar['other'][$i]['thumbnail'].'">
        </div>
        <div class="f_info">
          <div class="friends_name">
            <form name="#" method="post" action="../profile/profile.php">
              <input type="hidden" name="profile_id" value="'.$fr_ar['other'][$i]['id'].'">
              <p><input class="fr_tab_name" type="submit" value="'.$fr_ar['other'][$i]['name'].'"></p>
            </form>
          </div>
          <div class="friends-category">
            <ul>
              <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_other'.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
            </ul>
          </div>
        </div>
      </div>
  ';
  $i++;
  }
}
?>
  </div><!--end friends_all-->

</div><!--end lower_content-->
</div><!--end page_all-->

<!--================================POPUPWINDOWS===============================-->
<div id="question" class="question_popup_window">
  <div class="edit_format">
  <div class="cancel"><a class="modal_close" href="javascript:void(0)"></a></div>
      <div class="qfriend_img">
        <p>Question <br>何か質問してみましょう</p>
      </div>
      <form method="post" action="../php/m.question_request.php">
        <div class="question_textarea">
          <textarea name="question" style="font-size:15px;width:50%;padding:5px;" placeholder="好きな歌手は誰ですか？　趣味はなんですか？ etc."></textarea>
        </div>
        <input class="edit_button" type="submit" value="Question">
      </form>
  </div>
</div>
<!--begin delete_acount-->
<div id="popup_delete_account">
  <a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format">
    <p>アカウントの削除</p>
    <div class="delete_text">
      <p>アカウントを削除すると友達からもらったコメントや質問、あなたのコメントや質問が消えてしまいます。</p>
      <p>アカウントが削除されると、ご登録されたメールアドレスで別のアカウントを作成することはできません。</p>
    </div>
    <div>
    <p>アカウントを削除しますか？</p>
    <form method="post" action="../../php/delete_acount.php">
      <input type="checkbox" value="ok"autocomplete="off" required><small>はい、削除します</small><br>
      <input type="submit" value="削除する" style="width:100px;">
    </form>
    </div>
  </div>
</div>




<!--COMMENT EDIT GOODBY-->
<!--begin fr_c_s_g-->
<div class="fr_c_s_g">
<?php
//友達 全て
if(isset($_GET['friend_type']) == 'all' || $_GET['friends_type'] == ''){
  $i = 0;
  while($i < $f_all_num){
  echo '
  <!--begin fr_comment-->
  <div id="fr_comment_all'.$i.'" class="ceg_popup_window">
    <div id="tabs_all'.$i.'" class="tab_comment_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
        </a>
      </div>
      <div class="more_rel_format"><p>あなたとの関係：'.$allf_data_all[$i]['more_relation'].'<p></div> 
      <div id="tabs-1">
        '.$allf_data_all[$i]['comment1'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$allf_data_all[$i]['comment1_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-2">
        '.$allf_data_all[$i]['comment2'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$allf_data_all[$i]['comment2_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-3">
        '.$allf_data_all[$i]['comment3'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$allf_data_all[$i]['comment3_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-4">
        '.$allf_data_all[$i]['comment4'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えたいこと</p></div>
        </div>
      </div>
      <ul class="menu_comment">
          <li><a href="#tabs-1">1</a></li>
          <li><a href="#tabs-2">2</a></li>
          <li><a href="#tabs-3">3</a></li>
          <li><a href="#tabs-4">4</a></li>
      </ul>
    </div>
  </div>
  <!--end fr_comment-->
  ';
  $i++;
  }
}
?>
<?php
//友達 家族
if(isset($_GET['friend_type']) == 'family'){
  $i = 0;
  while($i < $f_all_num){
  echo '
  <!--begin fr_comment-->
  <div id="fr_comment_family'.$i.'" class="ceg_popup_window">
    <div id="tabs_family'.$i.'" class="tab_comment_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
        </a>
      </div>
      <div class="more_rel_format"><p>あなたとの関係：'.$fr_ar['family'][$i]['more_relation'].'<p></div> 
      <div id="tabs-1">
        '.$fr_ar['family'][$i]['comment1'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['family'][$i]['comment1_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-2">
        '.$fr_ar['family'][$i]['comment2'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['family'][$i]['comment2_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-3">
        '.$fr_ar['family'][$i]['comment3'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['family'][$i]['comment3_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-4">
        '.$fr_ar['family'][$i]['comment4'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えたいこと</p></div>
        </div>
      </div>
      <ul  class="menu_comment">
          <li><a href="#tabs-1">1</a></li>
          <li><a href="#tabs-2">2</a></li>
          <li><a href="#tabs-3">3</a></li>
          <li><a href="#tabs-4">4</a></li>
      </ul>
    </div>
  </div>
  <!--end fr_comment-->
  ';
  $i++;
  }
}
?>
<?php
//友達 恋人
if(isset($_GET['friend_type']) == 'lover'){
  $i = 0;
  while($i < $f_all_num){
  echo '
  <!--begin fr_comment-->
  <div id="fr_comment_lover'.$i.'" class="ceg_popup_window">
    <div id="tabs_lover'.$i.'" class="tab_comment_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
        </a>
      </div>
      <div class="more_rel_format"><p>あなたとの関係：'.$fr_ar['lover'][$i]['more_relation'].'<p></div> 
      <div id="tabs-1">
        '.$fr_ar['lover'][$i]['comment1'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['lover'][$i]['comment1_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-2">
        '.$fr_ar['lover'][$i]['comment2'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['lover'][$i]['comment2_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-3">
        '.$fr_ar['lover'][$i]['comment3'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['lover'][$i]['comment3_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-4">
        '.$fr_ar['lover'][$i]['comment4'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えたいこと</p></div>
        </div>
      </div>
      <ul  class="menu_comment">
          <li><a href="#tabs-1">1</a></li>
          <li><a href="#tabs-2">2</a></li>
          <li><a href="#tabs-3">3</a></li>
          <li><a href="#tabs-4">4</a></li>
      </ul>
    </div>
  </div>
  <!--end fr_comment-->
  ';
  $i++;
  }
}
?>
<?php
//友達 小・中学校
if(isset($_GET['friend_type']) == 'school'){
  $i = 0;
  while($i < $f_all_num){
  echo '
  <!--begin fr_comment-->
  <div id="fr_comment_school'.$i.'" class="ceg_popup_window">
    <div id="tabs_school'.$i.'" class="tab_comment_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
        </a>
      </div>
      <div class="more_rel_format"><p>あなたとの関係：'.$fr_ar['school'][$i]['more_relation'].'<p></div>   
      <div id="tabs-1">
        '.$fr_ar['school'][$i]['comment1'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['school'][$i]['comment1_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-2">
        '.$fr_ar['school'][$i]['comment2'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['school'][$i]['comment2_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-3">
        '.$fr_ar['school'][$i]['comment3'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['school'][$i]['comment3_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-4">
        '.$fr_ar['school'][$i]['comment4'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えたいこと</p></div>
        </div>
      </div>
      <ul  class="menu_comment">
          <li><a href="#tabs-1">1</a></li>
          <li><a href="#tabs-2">2</a></li>
          <li><a href="#tabs-3">3</a></li>
          <li><a href="#tabs-4">4</a></li>
      </ul>
    </div>
  </div>
  <!--end fr_comment-->
  ';
  $i++;
  }
}
?>
<?php
//友達 高校
if(isset($_GET['friend_type']) == 'high_school'){
  $i = 0;
  while($i < $f_all_num){
  echo '
  <!--begin fr_comment-->
  <div id="fr_comment_high_school'.$i.'" class="ceg_popup_window">
    <div id="tabs_high_school'.$i.'" class="tab_comment_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
        </a>
      </div>
      <div class="more_rel_format"><p>あなたとの関係：'.$fr_ar['high_school'][$i]['more_relation'].'<p></div> 
      <div id="tabs-1">
        '.$fr_ar['high_school'][$i]['comment1'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['high_school'][$i]['comment1_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-2">
        '.$fr_ar['high_school'][$i]['comment2'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['high_school'][$i]['comment2_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-3">
        '.$fr_ar['high_school'][$i]['comment3'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['high_school'][$i]['comment3_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-4">
        '.$fr_ar['high_school'][$i]['comment4'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えたいこと</p></div>
        </div>
      </div>
      <ul  class="menu_comment">
          <li><a href="#tabs-1">1</a></li>
          <li><a href="#tabs-2">2</a></li>
          <li><a href="#tabs-3">3</a></li>
          <li><a href="#tabs-4">4</a></li>
      </ul>
    </div>
  </div>
  <!--end fr_comment-->
  ';
  $i++;
  }
}
?>
<?php
//友達 大学
if(isset($_GET['friend_type']) == 'college'){
  $i = 0;
  while($i < $f_all_num){
  echo '
  <!--begin fr_comment-->
  <div id="fr_comment_college'.$i.'" class="ceg_popup_window">
    <div id="tabs_college'.$i.'" class="tab_comment_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
        </a>
      </div>
      <div class="more_rel_format"><p>あなたとの関係：'.$fr_ar['college'][$i]['more_relation'].'<p></div> 
      <div id="tabs-1">
        '.$fr_ar['college'][$i]['comment1'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['college'][$i]['comment1_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-2">
        '.$fr_ar['college'][$i]['comment2'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['college'][$i]['comment2_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-3">
        '.$fr_ar['college'][$i]['comment3'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['college'][$i]['comment3_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-4">
        '.$fr_ar['college'][$i]['comment4'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えたいこと</p></div>
        </div>
      </div>
      <ul  class="menu_comment">
          <li><a href="#tabs-1">1</a></li>
          <li><a href="#tabs-2">2</a></li>
          <li><a href="#tabs-3">3</a></li>
          <li><a href="#tabs-4">4</a></li>
      </ul>
    </div>
  </div>
  <!--end fr_comment-->
  ';
  $i++;
  }
}
?>
<?php
//友達 勤務先
if(isset($_GET['friend_type']) == 'work'){
  $i = 0;
  while($i < $f_all_num){
  echo '
  <!--begin fr_comment-->
  <div id="fr_comment_work'.$i.'" class="ceg_popup_window">
    <div id="tabs_work'.$i.'" class="tab_comment_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
        </a>
      </div>
      <div class="more_rel_format"><p>あなたとの関係：'.$fr_ar['work'][$i]['more_relation'].'<p></div> 
      <div id="tabs-1">
        '.$fr_ar['work'][$i]['comment1'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['work'][$i]['comment1_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-2">
        '.$fr_ar['work'][$i]['comment2'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['work'][$i]['comment2_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-3">
        '.$fr_ar['work'][$i]['comment3'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['work'][$i]['comment3_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-4">
        '.$fr_ar['work'][$i]['comment4'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えたいこと</p></div>
        </div>
      </div>
      <ul  class="menu_comment">
          <li><a href="#tabs-1">1</a></li>
          <li><a href="#tabs-2">2</a></li>
          <li><a href="#tabs-3">3</a></li>
          <li><a href="#tabs-4">4</a></li>
      </ul>
    </div>
  </div>
  <!--end fr_comment-->
  ';
  $i++;
  }
}
?>
<?php
//友達 その他
if(isset($_GET['friend_type']) == 'other'){
  $i = 0;
  while($i < $f_all_num){
  echo '
  <!--begin fr_comment-->
  <div id="fr_comment_other'.$i.'" class="ceg_popup_window">
    <div id="tabs_other'.$i.'" class="tab_comment_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
        </a>
      </div>
      <div class="more_rel_format"><p>あなたとの関係：'.$fr_ar['other'][$i]['more_relation'].'<p></div> 
      <div id="tabs-1">
        '.$fr_ar['other'][$i]['comment1'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['other'][$i]['comment1_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-2">
        '.$fr_ar['other'][$i]['comment2'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['other'][$i]['comment2_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-3">
        '.$fr_ar['other'][$i]['comment3'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-'.$fr_ar['other'][$i]['comment3_type'].'</p></div>
        </div>
      </div>
      <div id="tabs-4">
        '.$fr_ar['other'][$i]['comment4'].'
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えたいこと</p></div>
        </div>
      </div>
      <ul  class="menu_comment">
          <li><a href="#tabs-1">1</a></li>
          <li><a href="#tabs-2">2</a></li>
          <li><a href="#tabs-3">3</a></li>
          <li><a href="#tabs-4">4</a></li>
      </ul>
    </div>
  </div>
  <!--end fr_comment-->
  ';
  $i++;
  }
}
?>
  <!--begin fr_standby-->
  <div id="fr_standby" class="ceg_popup_window">
    <div id="tabs4" class="tab_comment_format">
      <div class="cancel"><a class="modal_close" href="javascript:void(0)"></a></div>
      <div class="fr_tab_box">
      <form action="../php/m.friend_request.php" method="post">
        <div class="fr_rel_box">
          <select name="relation" autocomplete="off" required>
            <option value="" selected>関係</option>
            <option value="家族">家族</option>
            <option value="恋人">恋人</option>
            <option value="小・中学校">小・中学校</option>
            <option value="高校">高校</option>
            <option value="大学・専門">大学・専門</option>
            <option value="勤務先">勤務先</option>
            <option value="その他">その他</option>
          </select>
          <input class="fr_input"name="more_relation" type="text" placeholder="詳しい関係"> 
        </div>
            <div id="tabs-1">
              <div class="edit_item">
                <select class="f_sel_box" name="c_type1" autocomplete="off" required>
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
                    <option value="これだけは勝てない！！ってところ">これだけは勝てない！！ってところ</option>
                    <option value="羨ましいところ">羨ましいところ</option>
                    <option value="将来していそうなこと">将来していそうなこと</option>
                  </optgroup>
                </select>
                <textarea class="fr_textarea" name="comment1">111</textarea>
              </div>
            </div>
            <div id="tabs-2">
              <div class="edit_item">
                <select class="f_sel_box" name="c_type2"autocomplete="off" required>
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
                    <option value="これだけは勝てない！！ってところ">これだけは勝てない！！ってところ</option>
                    <option value="羨ましいところ">羨ましいところ</option>
                    <option value="将来していそうなこと">将来していそうなこと</option>
                  </optgroup>
                </select>
                <textarea class="fr_textarea"name="comment2">222</textarea>
              </div>
            </div>
            <div id="tabs-3">
              <div class="edit_item">
                <select class="f_sel_box" name="c_type3" autocomplete="off" required>
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
                    <option value="これだけは勝てない！！ってところ">これだけは勝てない！！ってところ</option>
                    <option value="羨ましいところ">羨ましいところ</option>
                    <option value="将来していそうなこと">将来していそうなこと</option>
                  </optgroup>
                </select>
                <textarea class="fr_textarea" name="comment3">333</textarea>
              </div>
            </div>
            <div id="tabs-4">
              <div class="edit_item">
                <select class="f_sel_box">
                  <option value="" selected>伝えたいこと</option>
                </select>
                <textarea class="fr_textarea" name="comment4">444</textarea>
              </div>
            </div>
            <div id="tabs-5">
              <div class="edit_item">
                <select class="f_sel_box">
                  <option>質問</option>
                </select>
                <textarea class="fr_textarea" name="question">555</textarea>
              </div>
            </div>
            <div class="btn_submit">
              <input type="submit" value="Edit">
            </div>

            <ul class="menu_standby">
                <li><a href="#tabs-1">1</a></li>
                <li><a href="#tabs-2">2</a></li>
                <li><a href="#tabs-3">3</a></li>
                <li><a href="#tabs-4">4</a></li>
                <li><a href="#tabs-5">5</a></li>
            </ul>
          </form>
        </div>
    </div>
  </div>
</div>
<!--end fr_c_s_g-->


<!--============================END POPUPWINDOWS===============================-->
<!--friend popup window-->
<?php
/*
$a=0;
$tab_ar = array();
for ($num=0; $num<$f_all_num; $num++) {
  $tab_ar[$num] = array($a+1, $a+2, $a+3, $a+4, $a+5, $a+6, $a+7, $a+8,);
  $a = $a+8;
}
$a=0;
for($a=0;$a<$pr_f_all_num;$a++){
echo '
<div class="c_e_g">
  <div id="test">
    
    <div class="tabs" id="coment_tabs" data-default="tab_01" style=""><a class="modal_close"  href="javascript:void(0)"></a>
    <p class ="batu_friend"></p>
      <div class="tab_inner" id="tab_01" style="">
        <p>'.$allf_data_all[$a]['comment1'].'<br><cite>-'.$allf_data_all[$a]['comment1_type'].'</cite></p>
      </div>
      <div class="tab_inner" id="tab_02">
      <p>'.$allf_data_all[$a]['comment2'].'<br><cite>-'.$allf_data_all[$a]['comment2_type'].'</cite></p>
      </div>
      <div class="tab_inner" id="tab_03">
      <p>'.$allf_data_all[$a]['comment3'].'<br><cite>-'.$allf_data_all[$a]['comment3_type'].'</cite></p>

      </div>
      <div class="tab_inner" id="tab_04">
      <p>'.$allf_data_all[$a]['comment4'].'<br><cite>-伝えたいこと</cite></p>
      </div>

      <ul class="c_tab-bar coment-tabbar">
        <li><a href="#tab_01" id="button_tab_01"><i class="fa fa-home">1</i></a></li>
        <li><a href="#tab_02" id="button_tab_02"><i class="fa fa-home">2</i></a></li>
        <li><a href="#tab_03" id="button_tab_03"><i class="fa fa-home">3</i></a></li>
        <li><a href="#tab_04" id="button_tab_04"><i class="fa fa-home">4</i></a></li>
      </ul>
    </div>
  </div>
</div>
';
}
*/
?>
<script src="../../style/js/iscroll-min.js"></script>
<script src="../../style/js/jquery.drawer.js"></script>
<script src="../../style/js/side_menu.js"></script> 
</body>
</html>