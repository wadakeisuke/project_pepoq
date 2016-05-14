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
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title><?php echo($_SESSION['profile']['name']); ?></title>
<meta name="description" content="<?php echo($_SESSION['profile']['name']); ?> さんのページ。popoQは人間関係をデザインし、より鮮明にする新しい形のプロフィールサイト「popoQ」。">
<meta name="keywords" content="<?php echo($_SESSION['profile']['name']); ?>,popoQ,popoQ,プロフィール,プロフィールサイト,プロフ">
<meta name="robots" content="ALL">
<link rel="stylesheet" href="../mypage/style/css/drawer.css">
<link rel="stylesheet" type="text/css" href="style/css/mobile.css">
<link rel="stylesheet" type="text/css" href="style/css/style.css">
<link rel="stylesheet" type="text/css" href="style/css/fr_popup.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="style/js/tabs.js"></script>
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<!--begin ポップアップウィンドウ-->
<script src="style/js/jquery.leanModal.min.js" type="text/javascript"></script>
<!--end ポップアップウィンドウ-->
<!--begin 背景画像-->
<script type="text/javascript" src="style/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
  $.backstretch("../../img/background/<?php echo($_SESSION['profile']['background']); ?>");
</script>
<!--end 背景画像-->
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
<style>

</style>
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
  <div class="signup_login_headcontent">
    <div class="login_signup_text">
      <p>pepoQに登録して友達をもっと詳しく知る事ができます。気になって仕方ないですよね？</p>
    </div>
    <div class="login_signup_submit f_float"><input type="submit" value="Signup"></div>
    <div class="login_signup_submit f_float"><input type="submit" value="Login"></div>
  </div>
  <!--begin thumbnail_and _comment-->
  <div  class="non_login_thumbnail_box thumbnail" style="clear:both">
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
    <span class="data_title"><i class="fa fa-file-text box_icon"></i></span><br>
    <p><?php echo($_SESSION['profile']['comment']); ?>
   <br><cite>-Comment</cite></p>
    </div>
  </div>
  <!--end comment_data-->
  <!--begin basic_data-->
  <div id="basic_data" class="box">
    <div class="format_box_pad">
      <span class="data_title"><i class="fa fa-user  box_icon"></i>BASIC DATA</span><br> 
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
      <span class="data_title"><i class="fa fa-heart  box_icon"></i>LOVE AND LIKES</span><br> 
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
<script src="style/js/iscroll-min.js"></script>
<script src="style/js/dropdown.min.js"></script>
<!-- drawer js -->
<script src="style/js/jquery.drawer.js"></script>

<script>

$(document).ready(function(){

$('.drawer').drawer();

$('.drawer-api-toggle').on(function(){
$('.drawer').drawer("open");
});

$('.drawer').on('drawer.opened',function(){
console.log('opened');
});

$('.drawer').on('drawer.closed',function(){
console.log('closed');
});

$('.drawer-dropdown-hover').hover(function(){ 
$('[data-toggle="dropdown"]', this).trigger('click');
});

});

</script> 
</body>
</html>