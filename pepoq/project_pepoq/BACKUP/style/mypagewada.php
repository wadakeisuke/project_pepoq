<?php
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
require ('../php/m.not_login.php');
require ('../../php/db_connect.php');
require ('../../php/mypage_data.php');
require ('../../php/friend_num.php');
require ('../../php/question_num.php');
require ('../../php/friend_info.php');
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>StandBy</title>
<!--font awesome--> 
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="style/css/drawer.css">
<link rel="stylesheet" type="text/css" href="style/css/mobile.css">
<link rel="stylesheet" type="text/css" href="style/css/style.php">
<script type="text/javascript" src="style/js/jquery-ui-1.8.12.custom.min.js"></script>
<!--js-->
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<!--ポップアップ関連--><script src="style/js/jquery.leanModal.min.js" type="text/javascript"></script>
<!--背景画像-->
<script type="text/javascript" src="../../style/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
  $.backstretch("./img/background/background.jpg");
</script>
<!--end 背景画像-->
<script type="text/javascript" src="style/js/tab.js"></script>
<!--end 背景画像-->
<!--begin ポップアップウィンドウ-->
<script type="text/javascript">
$(function() {
    $( 'a[rel*=leanModal]').leanModal({
        top: 50,                     // モーダルウィンドウの縦位置を指定
        overlay : 0.7,               // 背面の透明度 
        closeButton: ".modal_close",  // 閉じるボタンのCSS classを指定
    });
}); 
</script><!--end ポップアップウィンドウ-->
<script>
$( ".selector" ).tabs({
  active: 2
});
</script>
<style type="text/css">
body{
   overflow: scroll;
}
  .popup_window_li{
    margin:0 auto 10px;
  }
</style>
<style type="text/css">
textarea{
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  -o-border-radius: 5px;
  -ms-border-radius: 5px;
  border:#a9a9a9 1px solid;
  -moz-box-shadow: inset 0 0 5px rgba(0,0,0,0.2),0 0 2px rgba(0,0,0,0.3);
  -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2),0 0 2px rgba(0,0,0,0.3);
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2),0 0 2px rgba(0,0,0,0.3);
  width:100%;
  height:180px;
  background:;
}
input[type=text]{
   border-radius: 5px;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   -o-border-radius: 5px;
   -ms-border-radius: 5px;
   border:#a9a9a9 1px solid;
   -moz-box-shadow: inset 0 0 5px rgba(0,0,0,0.2),0 0 2px rgba(0,0,0,0.3);
   -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2),0 0 2px rgba(0,0,0,0.3);
   box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2),0 0 2px rgba(0,0,0,0.3);
   width:;
   height:30px;
   padding:0 3px;
   color:#333;
   font-weight:bold;
   background:#f5f5f5;
   text-shadow:1px 1px 0px #fff;"
}
input[type=submit]{
   border-radius: 5px;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   -o-border-radius: 5px;
   -ms-border-radius: 5px;
   border:#a9a9a9 1px solid;
   -moz-box-shadow: inset 0 0 5px rgba(0,0,0,0.2),0 0 2px rgba(0,0,0,0.3);
   -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2),0 0 2px rgba(0,0,0,0.3);
   box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2),0 0 2px rgba(0,0,0,0.3);
   width:100%;
   height:30px;
   padding:0 3px;
   cursor:pointer;
   color:#333;
   font-weight:bold;
   background:#f5f5f5;
   text-shadow:1px 1px 0px #fff;"
}
/*--------------------------------------------------------------------
/////comment/////
--------------------------------------------------------------------*/
.devil{
width:100%;
}
.tab-head {
  width: 100%;
  height:20%;
  overflow: hidden;
  bottom:0px;
  position:absolute;
}
.tab-head ul{
  width:100%;
  height:20%;
}
.tab-head li {
  float: left;
  font-size:30px;
  width:24.4%;
  height:100%;
}
.tab-head a {
 display: block;
 cursor:pointer;
}
.tab-head a:hover {
 background-color: #555;
 color: #fff;
}
.tab-body {
  width: 90%;
  height:80%;
  margin:5%;
  position: relative;
  top: -1px;
  z-index: -1;
}
.tab_item{
  width:100%;
  height:100%;
  /*min-height:200px;*/
  background:skyblue;
  font-size:16px;
}
.hidden{
  display:none;
}
/*--------------------------------------------------------------------
/////edit/////
--------------------------------------------------------------------*/
.e_devil{
width:100%;
height:100%;
background-color:;
padding-top:30px;

}
.e_tab-head {
  width: 100%;
  height:20px;
  overflow: hidden;
  bottom:0px;
  position:absolute;
}
.e_tab-head ul{
  width:100%;
}
.e_tab-head li {
  float: left;
  font-size:30px;
  width:25%;
  height:60px;
}
.e_tab-head a {
 display: block;
}
.e_tab-head a:hover {
 background-color: #555;
 color: #fff;
 height:60px;
}
.e_tab-body {
  width: 90%;
  margin-right:5%;margin-left:5%;
  position: relative;
  bottom:45px;
}
.e_relation{
  top:30px;
  width:100%;
  position:absolute;
}
.e_tab_item{
  width:100%;
  height:100%;
  font-size:16px;
}
.hidden{display:none;}

/*--------------------------------------------------------------------
/////standby/////
--------------------------------------------------------------------*/
.s_devil{
  width:100%;
  height:100%;
  padding-top:100px;
}
.s_tab-head {
  width: 100%;
  overflow: hidden;
  bottom:0px;
  position:absolute;
}
.s_tab-head ul{
  width:100%;
}
.s_tab-head li {
  float: left;
  font-size:30px;
  width:20%;
  height:60px;
}
.s_tab-head a {
 display: block;
}
.s_tab-head a:hover {
 background-color: #555;
 color: #fff;
 height:60px;
}
.s_tab-body {
  width: 90%;
  margin:5%;
  position: relative;
  bottom:40px;
}
.s_relation{
  top:30px;
  width:100%;
  position:absolute;
}
.s_tab_item{
  width:100%;
  height:100%;
  font-size:16px;
}
.hidden{
  display:none;
}
.ceg_popup_window{
 position:relative;
}

/**/
.f_sel{
  width:100%;
  height:40px;
  margin:0px;
  background:red;
}
.f_relation_sel{
  width:50%;
  height:40px;
  background:green;

}
.f_sel_inp{
  width:50%;
  height:30px;
  background:;
}
.clear{clear:both;}
/**/
/*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/
#fr_comment0{
width: 100%;
min-width: 100%;
height: 100%;
min-height: 100%;
text-align: center;
padding:0px 0 20px 0;
margin:0px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
}
#fr_standby0{
width: 100%;
min-width: 100%;
height: 100%;
min-height: 100%;
text-align: center;
padding:0px 0 20px 0;
margin:0px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
}
#fr_goodby0{/*これが本当のSTANDBY!!!!!!*/
width: 100%;
min-width: 100%;
height: 100%;
min-height: 100%;
text-align: center;
padding:0px 0 20px 0;
margin:0px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
}
#fr_byby0{/*これが本当のGOODBY*/
width: 100%;
min-width: 100%;
height: 100%;
min-height: 100%;
text-align: center;
padding:0px 0 20px 0;
margin:0px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
}
/*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/
/*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/
#fr_comment1{
width: 100%;
min-width: 100%;
height: 100%;
min-height: 100%;
text-align: center;
padding:0px 0 20px 0;
margin:0px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
}
#fr_standby1{
width: 100%;
min-width: 100%;
height: 100%;
min-height: 100%;
text-align: center;
padding:0px 0 20px 0;
margin:0px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
}
#fr_goodby1{/*これが本当のSTANDBY!!!!!!*/
width: 100%;
min-width: 100%;
height: 100%;
min-height: 100%;
text-align: center;
padding:0px 0 20px 0;
margin:0px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
}
#fr_byby1{/*これが本当のGOODBY*/
width: 100%;
min-width: 100%;
height: 100%;
min-height: 100%;
text-align: center;
padding:0px 0 20px 0;
margin:0px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
}
/*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/
a#cancel{
  color: steelblue;
}

.modal_close{ 
  position: absolute;
  top: 45px;
  right: 6px;
  display: block; 
  width: 14px;
  height: 14px; 
  z-index: 2;
  background-repeat: no-repeat;
  background-image:url("../../../img/batu.gif");
}
</style>
</head>

<body>
<!--begin page_all-->
<div id="page_all">
<div id="content" class="snap-content">
  <!--begin header-->
  <header>
    <div class="tophead f_float">
      <span class="logo"><p><a href="../php/logout.php"><img src="../../img/logo.png" width="40px" height="40px"></a></p></span>
    </div>
    <!--start sidemenu-->
    <div class="drawer drawer-right f_float">
      <header role="banner">
        <div class="drawer-header" style="width:33px;heright:33px;">
          <button type="button" class="drawer-toggle drawer-hamburger">
            <span class="sr-only">navigation</span><span class="drawer-hamburger-icon"></span>
          </button>
        </div>
        <div class="drawer-main drawer-default">
          <nav class=" drawer-nav" role="navigation">
            <div class="drawer-brand">
              <a href="../"></a>
            </div>
            <ul class="drawer-menu">
              <li class="drawer-menu-item">
                <ul class="drawer-submenu">
                  <li class="drawer-submenu-item">
                    <div class="search_boxs">
                      <label for="search" class="off-left">Keyword</label>
                      <form action="../serch/serch.php" method="post" style="margin-bottom:30px;">
                        <input style="float:left;" type="text" name="serch" id="search" placeholder="Keyword">
                        <button type="submit" style="float:left;background-color:;">
                          <i class="fa fa-search"></i>
                        </button>
                      </form>
                    </div>
                  </li>
                  <table>
                    <tr>
                      <td style="background-color:;"><i class="fa fa-home"></i></td>
                      <td style="padding-left:10px;font-family:meiryo;"><a href="../mypage/mypage.php">mypage</a></td>
                    </tr>
                    <tr>
                      <td style="background-color:;"><i class="fa fa-eye"></i></td>
                      <td style="padding-left:10px;font-family:meiryo;v"><a href="../profile/profile.php">you</a></td>
                    </tr>
                    <tr>
                      <td style="background-color:;"><i class="fa fa-frown-o"></i></td>
                      <td style="padding-left:10px;font-family:meiryo;"><a href="../mypage/mypage.php#friends_all">friend</a></td>
                    </tr>
                    <tr>
                      <td style="background-color:;"><i class="fa fa-question"></i></td>
                      <td style="padding-left:10px;font-family:meiryo;"><a href="../question/question.php">question</a></td>
                    </tr>

                  </table>
                </ul>
              </li>
              <li class="drawer-menu-item"><i class="fa fa-users" style="text-align:center"></i>
                <ul class="drawer-submenu">
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=#friends_all">すべて<span style="margin-left:5px;">(<?php echo $f_all_num; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=new#friends_all">友達リクエスト<span style="margin-left:5px;">(<?php echo $f_request_num; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=family#friends_all">家族<span style="margin-left:5px;">(<?php echo $f_type_num[0]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=lover#friends_all">恋人<span style="margin-left:5px;">(<?php echo $f_type_num[1]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=school#friends_all">小・中学校<span style="margin-left:5px;">(<?php echo $f_type_num[2]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=high_school#friends_all">高校<span style="margin-left:5px;">(<?php echo $f_type_num[3]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=college#friends_all">大学・専門<span style="margin-left:5px;">(<?php echo $f_type_num[4]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=works#friends_all">勤務先<span style="margin-left:5px;">(<?php echo $f_type_num[5]; ?>)</span></a></li>
                  <li class="drawer-submenu-item"><a href="../mypage/mypage.php?friend_type=other#friends_all">その他<span style="margin-left:5px;">(<?php echo $f_type_num[6]; ?>)</span></a></li>
                </ul>
              </li>
              <li class="drawer-menu-item" style="background:#111;"><i class="fa fa-cogs"></i>
                <ul class="drawer-submenu">
                  <li class="drawer-submenu-item"><a href="../php/logout.php">ログアウト</a></li>
                  <li class="drawer-submenu-item"><a href="#">StandByについて</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/rules.html">利用規約</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/privacy.html">プライバシー</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/cookie.html">クッキー</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/help.html">ヘルプ</a></li>
                  <li class="drawer-submenu-item"><a href="../rules_etc/contact.php">コンタクト</a></li>
                  <li class="drawer-submenu-item"><a id="go" rel="leanModal" href="#popup_delete_account">アカウントの削除</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div><!-- /.drawer-main -->
      </header><!-- /.site-header -->
    </div><!--end sidemenu-->
  </header>
  <!--end header-->



<!--begin upper_content-->
<div id="upper_content" class="centered">


  <!--begin thumbnail_and _comment-->
  <div class="box" style="">
      <!--begin thumbnail-->
      <div id="thumbnail" style="">
        <a id="go" rel="leanModal" href="#edit_img"><img src="../../img/thumbnail/<?php echo($_SESSION['mypage']['thumbnail']); ?>"></a>
      </div>
      <!--end thumbnail-->
      <!--begin icon_and_name-->
      <div class="user">
        <div class="user_name">
          <p style="margin:0px; padding:0px"><?php echo($_SESSION['mypage']['name']); ?></p>
        </div>

        <div class="social_icons">
          <ul>
            <li><a href="<?php echo($_SESSION['mypage']['twitter']); ?>"><i class="fa fa-twitter-square"></i></a></li>
            <li><a href="<?php echo($_SESSION['mypage']['facebook']); ?>"><i class="fa fa-facebook-square"></i></a></li>
            <li><a href="<?php echo($_SESSION['mypage']['google_plus']); ?>"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="<?php echo($_SESSION['mypage']['instagram']); ?>"><i class="fa fa-instagram"></i></a></li>
          </ul>
        </div>    
      </div>
    <!--end icon_and_name-->
    <div style="text-align:center;clear:both;">
      <a id="go" rel="leanModal" href="#edit_name_and_links">    
        <div class="link_edit">
          <span><i class="fa fa-pencil-square"></i>Edit your name and links</i></span>
        </div>
      </a>
    </div>
  </div><!--end thumbnail_and _comment-->

  <!--begin basic_data-->
  <div id="comment" style="clear:both;" class="box">
    <span class="data_title"><i class="fa fa-file-text" style="font-size:40px; padding:20px 10px"></i></span><br>
    <p><?php echo($_SESSION['mypage']['comment']); ?>
    <br><cite>-Comment</cite></p>
    <div class="details" style="text-align:center;">
      <a id="go" rel="leanModal" href="#edit_comment"><div class="link_edit"><span><i class="fa fa-pencil-square"></i>Edit your comment</span></div></a>
    </div>
  </div>
  <!--end basic_data-->
  <!--begin basic_data-->
  <div id="basic_data" class="box">
    <div style="background-color:;padding:10px;">
      <span class="data_title"><i class="fa fa-user" style="font-size:40px"></i>BASIC DATA</span><br> 
      <ul>
        <li><strong>Age:</strong><span class="data"><?php echo($_SESSION['mypage']['age']); ?></span></li><hr>
        <li><strong>Birthday:</strong><span class="data"><?php echo($_SESSION['mypage']['birthday']); ?></span></li><hr>
        <li><strong>From:</strong><span class="data"><?php echo($_SESSION['mypage']['come_from']); ?></span></li><hr>
        <li><strong>Educational background:</strong><span class="data"><?php echo($_SESSION['mypage']['educational_background']); ?></span></li><hr>
        <li><strong>Works:</strong><span class="data"><?php echo($_SESSION['mypage']['works']); ?></span></li>
      </ul>
    </div>
    <a id="go" rel="leanModal" href="#edit_basicdata" style="text-align:center;">    
    <div class="link_edit">    
      <span class="meta-nav-prev"><i class="fa fa-pencil-square" style="font-size:20px"></i>Edit your basicdata</span>
    </div>
    </a>
  </div>
  <!--end basic_data-->

  <!--begin love and likes-->
  <div id="love_and_likes" class="box">
    <div style="background-color:;padding:10px;">
      <span class="data_title"><i class="fa fa-heart" style="font-size:40px"></i>LOVE AND LIKES</span><br> 
      <ul style="margin-bottom:30px;">
        <li><strong>Lover:</strong><br><span class="data"><?php echo($_SESSION['mypage']['lover']); ?></span></li><hr>
        <li><strong>Singer:</strong><br><span class="data"><?php echo($_SESSION['mypage']['singer']); ?></span></li><hr>
        <li><strong>Writer:</strong><br><span class="data"><?php echo($_SESSION['mypage']['writer']); ?></span></li><hr>
        <li><strong>Movie:</strong><br><span class="data"><?php echo($_SESSION['mypage']['movie']); ?></span></li>
      </ul>
    </div>
    <div class="details" style="text-align:center;">
      <a id="go" rel="leanModal" href="#edit_love_and_likes">    
        <div class="link_edit">    
          <span class="meta-nav-prev"><i class="fa fa-pencil-square"></i>Edit your love and likes</span>
        </div>
      </a>
    </div>
  </div>
  <!--end love and likes-->

  <!--tuika-->
<?php
$sql=$pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type','all');
$sql->bindValue(':ac_email',$_SESSION['mypage']['email']);
$sql->execute();
$i=0;
while($quesiton = $sql->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
echo '
<div class="box">
  <div class="ballon">
    <div class="ballon-item">
      <div class="ballon-text">
        <p>'.$quesiton['question'].'</p>
      </div>
    </div>

    <div class="ballon-item is-reverse">
      <div class="ballon-text">
        <p>'.$quesiton['answer'].'</p>
      </div>
    </div>
  </div>
      <div class="details" style="text-align:center;">
      <a id="go" rel="leanModal" href="#edit_question'.$i.'">    
        <div class="link_edit">    
          <span class="meta-nav-prev"><i class="fa fa-pencil-square"></i>Edit your Question</span>
        </div>
      </a>
    </div>
</div>
<!--tuika-->
';
$i++;
}
?>

<!--tuika-->
<!--
<div class="box">
  <div class="ballon">
    <div class="ballon-item">
      <b class="ballon-image"><img src="http://placehold.it/100x100"width="50"height="50"></b>
      <div class="ballon-text">
        <p>jfkadjfklajfakjdfklaj;fkjakdvmaklafnkladnsvlakrjknk</p>
      </div>
    </div>

    <div class="ballon-item is-reverse">
    <div class="ballon-text">
      <p>jfkadjfklajfakjdfklaj;fkjakdvmaklafnkladnsvlakrjknk</p>
    </div>
    <b class="ballon-image"><img src="http://placehold.it/100x100"width="50"height="50"></b>
    </div>
  </div>
</div>--><!--tuika-->
  <!--begin love and likes-->
  <!--
  <div id="love_and_likes" class="box">
    <div style="background-color:;padding:10px;">
      <form name="frm1" method="GET" action="./mypage.php#friends_all">
      <select onChange="document.forms['frm1'].submit()" name="friend_type" style="color:white;width:100%;background-color:rgba(20,20,20,0.7);border:none;">
        <option value="" <?php if(@$_GET['friend_type'] == ''){ echo 'selected';} ?> >全て</option>
        <option value="new" <?php if(@$_GET['friend_type'] == 'new'){ echo 'selected';} ?> >友達リクエスト</option>
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
  -->
  <!--end love and likes-->

</div><!--end upper_content-->

















<!--begin lower_content-->

<!------------------------->
<!------------------------->
<!------------------------->
<!------------------------->
<!------------------------->
<!------------------------->
<!--0502-->
<!--ここから編集してください-->
<div class="lower_content"><!--begin friends_all-->  
  <div id="friends_all" class="ff" style="">
    <div class="fbox">
      <div class="friends-image">
        <img src="../img/thumbnail/thumbnail.jpg">
      </div>
      <div class="f_info">
        <div class="friends_name">
          <form name="#" method="post" action="../m.profile/profile.php">
            <input type="hidden" name="profile_id" value="">
            <p><input class="fr_tab_name" type="submit" value=""></p>
          </form>
        </div>
        <div class="friends-category">
          <ul>
            <li><a id="go" rel="leanModal" href="#fr_comment0"><i class="fa fa-comment"></i>Comment</a></li>
            <li><a id="go" rel="leanModal" href="#fr_goodby0"><i class="fa fa-user-plus"></i>standby</a></li>
            <li ><a id="go" rel="leanModal" href="#fr_byby0"><i class="fa fa-trash-o"></i>GoodBy</a></li>
          </ul>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div><!--end friends_all-->

    <div id="friends_all" class="ff" style="">
    <div class="fbox">
      <div class="friends-image">
        <img src="../img/thumbnail/thumbnail.jpg">
      </div>
      <div class="f_info">
        <div class="friends_name">
          <form name="#" method="post" action="../m.profile/profile.php">
            <input type="hidden" name="profile_id" value="">
            <p><input class="fr_tab_name" type="submit" value=""></p>
          </form>
        </div>
        <div class="friends-category">
          <ul>
            <li><a id="go" rel="leanModal" href="#fr_comment1"><i class="fa fa-comment"></i>Comment</a></li>
            <li><a id="go" rel="leanModal" href="#fr_goodby1"><i class="fa fa-user-plus"></i>standby</a></li>
            <li ><a id="go" rel="leanModal" href="#fr_byby1"><i class="fa fa-trash-o"></i>GoodBy</a></li>
          </ul>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div><!--end friends_all-->

    <div id="friends_all" class="ff" style="">
    <div class="fbox">
      <div class="friends-image">
        <img src="../img/thumbnail/thumbnail.jpg">
      </div>
      <div class="f_info">
        <div class="friends_name">
          <form name="#" method="post" action="../m.profile/profile.php">
            <input type="hidden" name="profile_id" value="">
            <p><input class="fr_tab_name" type="submit" value=""></p>
          </form>
        </div>
        <div class="friends-category">
          <ul>
            <li><a id="go" rel="leanModal" href="#fr_comment"><i class="fa fa-comment"></i>Comment</a></li>
            <li><a id="go" rel="leanModal" href="#fr_goodby"><i class="fa fa-user-plus"></i>edit</a></li>
            <li ><a id="go" rel="leanModal" href="#fr_byby"><i class="fa fa-trash-o"></i>GoodBy</a></li>
          </ul>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div><!--end friends_all-->

    <div id="friends_all" class="ff" style="">
    <div class="fbox">
      <div class="friends-image">
        <img src="../img/thumbnail/thumbnail.jpg">
      </div>
      <div class="f_info">
        <div class="friends_name">
          <form name="#" method="post" action="../m.profile/profile.php">
            <input type="hidden" name="profile_id" value="">
            <p><input class="fr_tab_name" type="submit" value=""></p>
          </form>
        </div>
        <div class="friends-category">
          <ul>
            <li><a id="go" rel="leanModal" href="#fr_comment"><i class="fa fa-comment"></i>Comment</a></li>
            <li><a id="go" rel="leanModal" href="#fr_goodby"><i class="fa fa-user-plus"></i>edit</a></li>
            <li ><a id="go" rel="leanModal" href="#fr_byby"><i class="fa fa-trash-o"></i>GoodBy</a></li>
          </ul>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div><!--end friends_all-->
</div><!--end lower_content-->

<!--0502-->
<!--ここまで編集してください-->
<!------------------------->
<!------------------------->
<!------------------------->
<!------------------------->
<!------------------------->
<!------------------------->
<!------------------------->
</div><!--end page_all-->


















<!--================================POPUPWINDOWS===============================-->

<!--begin delete_acount-->
<div id="popup_delete_account">
  <a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format">
    <h2>アカウントの削除</h2>
    <div style="width:80%;margin:0 auto;">
      <p>アカウントを削除すると友達からもらったコメントや質問、あなたのコメントや質問が消えてしまいます。</p>
      <p>アカウントが削除されると、ご登録されたメールアドレスで別のアカウントを作成することはできません。</p>
    </div>
    <div style="width:80%;margin:0 auto;">
    <h3 style="color:black;">アカウントを削除しますか？</h3>
    <form method="post" action="../delete_acount.php">
      <input type="checkbox" value="ok" style="width:10px;" autocomplete="off" required><small style="color:black;">はい、削除します</small><br>
      <input type="submit" value="削除する" style="width:100px;">
    </form>
    </div>
  </div>
</div>
<!--end delete_acount-->
<!--begin edit_img-->
<div id="edit_img">
  <div class="edit_format">
    <a class="modal_close"  href="javascript:void(0)"></a>
    <form method="post" action="../m.edit.php" enctype="multipart/form-data">
      <ul>
        <li class="popup_window_li"><h2>Thumbnail</h2></li>
        <li class="popup_window_li"><input name="file[]" type="file"></li>
        <li class="popup_window_li"><h2>Background</h2></li>
        <li class="popup_window_li"><input name="file[]" type="file"></li>
        <li><input class="edit_button" type="submit" value="Edit"></li>
      </ul>      
    </form>
  </div>
</div>
<!--end edit_img-->
<!--begin edit_name_and_links-->
<div id="edit_name_and_links">
  <div class="edit_format">
  <a class="modal_close"  href="javascript:void(0)"></a>
    <form method="post" action="../m.edit.php">
      <h2>Name and Links</h2><hr>
          <ul>
            <li class="popup_window_li" style="width:90%;"><i class="fa fa-user"></i><input style="margin-left:10px;" type="text" maxlength="50" name="name" placeholder="user name"></li>
            <li class="popup_window_li" style="width:90%;"><i class="fa fa-twitter-square"></i><input style="margin-left:10px;" type="text" maxlength="50" name="twitter" placeholder="Twitter"></li>
            <li class="popup_window_li" style="width:90%;"><i class="fa fa-facebook-square"></i><input style="margin-left:10px;" type="text" maxlength="50" name="facebook" placeholder="Facebook"></li>
            <li class="popup_window_li" style="width:90%;"><i class="fa fa-google-plus"></i><input style="margin-left:10px;" type="text" maxlength="50" name="google_plus" placeholder="Google+"></li>
            <li class="popup_window_li" style="width:90%;"><i class="fa fa-instagram"></i><input style="margin-left:10px;" type="text" maxlength="50" name="instagram" placeholder="Instagram"></li>
            <li class="popup_window_li" style="width:90%;margin-left:20px;"><input style="" type="submit" value="Edit"></li>
          </ul>
    </form>
  </div>
</div>
<!--end edit_name_and_links-->
<!--begin edit_comment-->
<div id="edit_comment">
  <div class="edit_format">
  <a class="modal_close"  href="javascript:void(0)"></a>
    <form method="post" action="../m.edit.php">
      <h2>Comment</h2><hr>
      <ul>
        <li class="popup_window_li">
          <textarea style="font-size:18px;" name="comment" placeholder="<?php echo($_SESSION['mypage']['comment']); ?>"><?php echo($_SESSION['mypage']['comment']); ?></textarea>
        </li>
        <li>
          <input style="" type="submit" value="Edit">
        </li>
      </ul>
    </form>
  </div>  
</div>
<!--end edit_comment-->
<div id="edit_question">
  <div class="edit_format">
    <a class="modal_close"  href="javascript:void(0)"></a>
      <div class="ballon">
    <div class="ballon-item">
      <b class="ballon-image"><img src="http://placehold.it/100x100"width="50"height="50"></b>
      <div class="ballon-text">
        <p>jfkadjfklajfakjdfklaj;fkjakdvmaklafnkladnsvlakrjknk</p>
      </div>
    </div>
    <textarea name="answer"></textarea>
      <button class="add_btnq g_f"><i class="fa fa-user-plus" style="color:white">answer</i></button>
      <button class="add_btnq f_f"><i class="fa fa-user-plus" style="color:white">delite</i></button>
    </div>

  </div>
</div>
<div id="edit_basicdata">
  <div class="edit_format" style="color:black;">
  <a class="modal_close"  href="javascript:void(0)"></a>
    <form method="post" action="../m.edit.php">
      <h2>Basic Data</h2><hr>
      <ul>
      <li class="popup_window_li">
      Birth
              <select name="year">
              <option value="">--</option>
                <?php
                $age=$_SESSION['mypage']['birthday'];
                $birthday=explode('/',$age);
                $year=$birthday[0];
                $month=$birthday[1];
                $day=$birthday[2];

                  for($id=1900;$id<=2020;$id++){
                    if($id==$year){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }elseif($id==1990){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }else{
                      echo('<option name="year" value="'.$id.'">'.$id.'</option>');
                    }
                  }
                ?>
              </select>年
              <select name="month">
                <option value="">--</option>
                <?php
                  for($id=1;$id<=12;$id++){
                    if($id==$month){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }else{
                      echo('<option name="month" value="'.$id.'">'.$id.'</option>');
                    }
                  }
                ?>
              </select>月
              <select name="day">
                <option value="">--</option>
                <?php
                  for($id=1;$id<=31;$id++){
                    if($id==$day){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }else{  
                      echo('<option name="day" value="'.$id.'">'.$id.'</option>');
                    }
                  }
                ?>
              </select>日            
      </li>
      <li class="popup_window_li">
            Age
              <select name="age">
                <option value="" selected>--</option>
                <?php
                  for($id=1;$id<=120;$id++){
                    if($id==$_SESSION['mypage']['age']){
                      echo('<option name="age" value="'.$id.'" selected>'.$id.'</option>');
                    }else{
                    echo('<option name="age" value="'.$id.'">'.$id.'</option>');
                    }
                  }
                ?>
              </select>歳
                 
      </li>
         
      <li class="popup_window_li">
              From
              <input type="text"maxlength="20" name="from" value="<?php echo $_SESSION['mypage']['come_from']; ?>" placeholder="<?php echo $_SESSION['mypage']['come_from']; ?>">
   
      </li>
      
      <li class="popup_window_li">
            School
              <input type="text" maxlength="20" name="educational background" value="<?php echo $_SESSION['mypage']['educational_background']; ?>" placeholder="<?php echo($_SESSION['mypage']['educational_background']); ?>">
            

      </li>
      
      <li class="popup_window_li">
          Works
              <input type="text" name="works" value="<?php echo $_SESSION['mypage']['works']; ?>" placeholder="<?php echo $_SESSION['mypage']['works']; ?>">
            
      </li>

      <li>
            <input class="edit_button" type="submit" value="Edit">
      </li>
      </ul>
        </form>
      </div>
</div>
<div id="edit_love_and_likes" class="popup_window">
<a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format" style="color:black;">
      <form method="post" action="../m.edit.php">
        <h2>Love and Likes</h2>
        <ul>
          <li class="popup_window_li">
            Lover<textarea name="lover" style="width:70%;height:35px;" placeholder="<?php echo($_SESSION['mypage']['lover']); ?>"><?php echo($_SESSION['mypage']['lover']); ?></textarea>
          </li>
          <li class="popup_window_li">
            Singer<textarea name="singer" style="width:70%;height:35px;" placeholder="<?php echo($_SESSION['mypage']['singer']); ?>"><?php echo($_SESSION['mypage']['singer']); ?></textarea>
          </li>
          <li class="popup_window_li">
            Writer<textarea name="writer" style="width:70%;height:35px;" placeholder="<?php echo($_SESSION['mypage']['writer']); ?>"><?php echo($_SESSION['mypage']['writer']); ?></textarea>
          </li>
          <li class="popup_window_li">
            Movie<textarea name="movie" style="width:70%;height:35px;" placeholder="<?php echo($_SESSION['mypage']['movie']); ?>"><?php echo($_SESSION['mypage']['movie']); ?></textarea>
          </li>
          <li>
            <input class="edit_button" type="submit" value="Edit">
          </li>
        </ul>        
    </form>
  </div>
</div>

<div id="edit_love_and_likes">
  <div class="edit_format">
  <a class="modal_close"  href="javascript:void(0)"></a>
    <form method="post" action="../m.edit.php">
      <h2>Love and Likes</h2><hr>
      <p>Lover:<br><textarea name="lover"></textarea></p>
      <p>Singer:<br><textarea name="singer"></textarea></p>
      <p>Writer:<br><textarea name="writer"></textarea></p>
      <p>Movie:<br><textarea name="movie"></textarea></p>
      <input style="" type="submit" value="edit">
    </form>
  </div>
</div>

<?php
$sql=$pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type','all');
$sql->bindValue(':ac_email',$_SESSION['mypage']['email']);
$sql->execute();
$i=0;
while($question = $sql->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
echo '


<div id="edit_question'.$i.'" class="popup_window">
  <a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format">
    
      <div class="ballon">
    <div class="ballon-item" style="margin-bottom:20px;">
      <div class="ballon-text">
        <p>'.$question['question'].'</p>
      </div>
    </div>
    <form method="post" action="../m.question_edit.php">
      <textarea style="width:90%;height:100px;" name="answer" placeholder="'.$question['answer'].'">'.$question['answer'].'</textarea>
      <input name="question_id" type="hidden" value="'.$question['id'].'">
      <button class="add_btnq g_f"><i class="fa fa-user-plus" style="color:white">answer</i></button>
    </form>
    <form method="post" action="../m.question_edit.php">
      <input name="delete_id" type="hidden" value="'.$question['id'].'">
      <button type="submit" class="add_btnq f_f"><i class="fa fa-user-plus" style="color:white">delite</i></button>
    </form>
    </div>

  </div>
</div>

';
$i++;
}
?>
<!--============================END POPUPWINDOWS===============================-->
<!--friend popup window-->
<!--begin fr_c_s_g-->
<div class="fr_c_s_g">
  <!--begin fr_comment-->
  <div id="fr_comment0" class="ceg_popup_window">
    <div style="height:0px;">      
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
          <img src="img/batu.gif">
        </a>
      </div>   
      <div class="f_relationa" style="position:absolute;top:40px;width:100%;text-align:center;">
        <p style="color:black;font-size:18px;">サークル仲間</p>
      </div>
    </div>
    <div class="devil" style="background-color:;position:absolute;top:80px;">
      <div class="tab-body">
        <div id="tab-b1-0" class="tab_item" style="background-color:orange;height100px;position:relative;">
          <p style="">
        　タブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよ
        タブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよ
        タブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよ
          </p>
          楽しかった思いで
        </div>
        <div id="tab-b2-0" class="tab_item hidden">
          <p>
         タブの２だよ
          </p>
          かっこいいところ
        </div>
        <div id="tab-b3-0" class="tab_item hidden first-first">
          <p>
          タブの３だよ
          </p>
          直してほしいところ
        </div>
        <div id="tab-b4-0" class="tab_item hidden">
          <p>
            タブの４だよ
          </p>
          伝えたいこと
        </div>
      </div>
      <!--end tab-body-->
    </div>
    <ul class="tab-head" style="background-color:black;position:absolute;bottom:0px;">
      <li id="tab-h1-0" style=""><a href="#tab-b1-0">1</a></li>
      <li id="tab-h2-0" style=""><a href="#tab-b2-0">2</a></li>
      <li id="tab-h3-0" style=""><a href="#tab-b3-0">3</a></li>
      <li id="tab-h4-0"class="select" class="def-def" style=""><a href="#tab-b4-0">4</a></li>
      <li class="clear"></li>
    </ul>
    <!--end tab-->
  </div>
  <!--end fr_comment-->
  <!--begin fr_standby-->
  <div id="fr_goodby0" class="ceg_popup_window">
    
    <div class="cancel">
      <a class="modal_close" href="javascript:void(0)">
        <img src="img/batu.gif">
      </a>
    </div>

    <div class="s_devil" style="position:relative;">
      <div class="s_relation">
        <div class="e_re_item e_re_sel" style="width:45%;float:left;background-color:;">
          <select class="f_relation_sel" name="relation" style="height:30px;width:80%;" autocomplete="off" required>
            <option value="" selected>関係</option>
            <option value="家族">家族</option>
            <option value="恋人">恋人</option>
            <option value="小・中学校">小・中学校</option>
            <option value="高校">高校</option>
            <option value="大学・専門">大学・専門</option>
            <option value="勤務先">勤務先</option>
            <option value="その他">その他</option>
          </select>
        </div>
        <div class="e_re_item e_re_inp"style="width:45%;float:left;background-color:;">
          <input class="f_sel_inp" name="more_relation" type="text" style="height:30px;width:80%;" placeholder="詳しい関係" required>
        </div>
      </div>


      <div class="s_tab-body">
        <div id="tab-s1-0" class="e_tab_item">
          <select class="f_sel" name="c_type1" style="width:100%;" autocomplete="off" required>
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
          <textarea lang="ja">-1-</textarea>
        </div>
        <div id="tab-s2-0" class="e_tab_item hidden">
          <select class="f_sel" name="c_type1" style="width:100%;" autocomplete="off" required>
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
          <textarea>-2-</textarea>
        </div>
        <div id="tab-s3-0" class="e_tab_item hidden">
          <select class="f_sel" name="c_type1" style="width:100%;" autocomplete="off" required>
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
          <textarea>-3-</textarea>
        </div>
        <div id="tab-s4-0" class="e_tab_item hidden">
          <select class="f_sel" name="c_type1" style="width:100%;" autocomplete="off" required>
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
          <textarea>-4-</textarea>
        </div>


        <div id="tab-s5-0" class="e_tab_item hidden">
          <select class="f_sel" name="c_type1" style="">
            <option value="" selected>質問</option>
          </select>
          <textarea placeholder="例:好きな映画は何ですか？"></textarea>
        </div>
        <input class="edit_button" type="submit" value="Edit">
      </div>
        <!--tab-body-->

      <!--tab-head-->
    </div>
          <ul class="s_tab-head"  style="background-color:black;position:absolute;bottom:0px;">
        <li id="tab-s1-0"><a href="#tab-s1-0">1</a></li>
        <li id="tab-s2-0"><a href="#tab-s2-0">2</a></li>
        <li id="tab-s3-0"><a href="#tab-s3-0">3</a></li>
        <li id="tab-s4-0"><a href="#tab-s4-0">4</a></li>
        <li id="tab-s5-0" class="def-def"><a href="#tab-s5-0">5</a></li>
        <li class="clear"></li>
      </ul>
    <!--tab-->
  </div>
  <!--end fr_standby-->
  <div id="fr_byby0" class="ceg_popup_window">    
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
          <img src="img/batu.gif">
        </a>
      </div>
      <p>本当に'.$db_friends_data_all[$a]['name'].'さんとGoodByしますか？</p>
    <p>GoodByすると</p>
    <p>書いてもらったコメントが消えてしましまいます。</p>
    <div style="background-color:;height:50px;margin:0 auto;">
      <form name="d'.$a.'" method="post" action="../php/friend_edit.php">
        <input type="hidden" name="delete_id" value="'.$db_friends_data_all[$a]['id'].'">
        <a id="" href="javascript:d'.$a.'.submit()"><button class="goodby">GoodBy</button></a>
      </form>
    </div> 

 
  </div>
  <!--end fr_goodby-->
</div>
<!--end fr_c_s_g010101010101-->
<!--begin fr_c_s_g020202020202-->
<div class="fr_c_s_g">
  <!--begin fr_comment-->
  <div id="fr_comment1" class="ceg_popup_window">
    <div style="height:0px;">      
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
          <img src="img/batu.gif">
        </a>
      </div>   
      <div class="f_relationa" style="position:absolute;top:40px;width:100%;text-align:center;">
        <p style="color:black;font-size:18px;">サークル仲間</p>
      </div>
    </div>
    <div class="devil" style="background-color:;position:absolute;top:80px;">
      <div class="tab-body">
        <div id="tab-b1-1" class="tab_item" style="background-color:orange;height100px;position:relative;">
          <p style="">
        　タブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよ
        タブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよ
        タブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよタブの１だよ
          </p>
          楽しかった思いで
        </div>
        <div id="tab-b2-1" class="tab_item hidden">
          <p>
         タブの２だよ
          </p>
          かっこいいところ
        </div>
        <div id="tab-b3-1" class="tab_item hidden">
          <p>
          タブの３だよ
          </p>
          直してほしいところ
        </div>
        <div id="tab-b4-1" class="tab_item hidden">
          <p>
            タブの４だよ
          </p>
          伝えたいこと
        </div>
      </div>
      <!--end tab-body-->
    </div>
    <ul class="tab-head" style="background-color:black;position:absolute;bottom:0px;">
      <li id="tab-h1-1" style=""><a href="#tab-b1-1">1</a></li>
      <li id="tab-h2-1" style=""><a href="#tab-b2-1">2</a></li>
      <li id="tab-h3-1" style=""><a href="#tab-b3-1">3</a></li>
      <li id="tab-h4-1" style=""><a href="#tab-b4-1">4</a></li>
      <li class="clear"></li>
    </ul>
    <!--end tab-->
  </div>
  <!--end fr_comment-->
  <!--begin fr_standby-->
  <div id="fr_goodby1" class="ceg_popup_window">
    
    <div class="cancel">
      <a class="modal_close" href="javascript:void(0)">
        <img src="img/batu.gif">
      </a>
    </div>

    <div class="s_devil" style="position:relative;">
      <div class="s_relation">
        <div class="e_re_item e_re_sel" style="width:45%;float:left;background-color:;">
          <select class="f_relation_sel" name="relation" style="height:30px;width:80%;" autocomplete="off" required>
            <option value="" selected>関係</option>
            <option value="家族">家族</option>
            <option value="恋人">恋人</option>
            <option value="小・中学校">小・中学校</option>
            <option value="高校">高校</option>
            <option value="大学・専門">大学・専門</option>
            <option value="勤務先">勤務先</option>
            <option value="その他">その他</option>
          </select>
        </div>
        <div class="e_re_item e_re_inp"style="width:45%;float:left;background-color:;">
          <input class="f_sel_inp" name="more_relation" type="text" style="height:30px;width:80%;" placeholder="詳しい関係" required>
        </div>
      </div>


      <div class="s_tab-body">
        <div id="tab-s1-1" class="e_tab_item">
          <select class="f_sel" name="c_type1" style="width:100%;" autocomplete="off" required>
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
          <textarea lang="ja">-1-</textarea>
        </div>
        <div id="tab-s2-1" class="e_tab_item hidden">
          <select class="f_sel" name="c_type1" style="width:100%;" autocomplete="off" required>
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
          <textarea>-2-</textarea>
        </div>
        <div id="tab-s3-1" class="e_tab_item hidden">
          <select class="f_sel" name="c_type1" style="width:100%;" autocomplete="off" required>
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
          <textarea>-3-</textarea>
        </div>
        <div id="tab-s4-1" class="e_tab_item hidden">
          <select class="f_sel" name="c_type1" style="width:100%;" autocomplete="off" required>
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
          <textarea>-4-</textarea>
        </div>


        <div id="tab-s5-1" class="e_tab_item hidden">
          <select class="f_sel" name="c_type1" style="">
            <option value="" selected>質問</option>
          </select>
          <textarea placeholder="例:好きな映画は何ですか？"></textarea>
        </div>
        <input class="edit_button" type="submit" value="Edit">
      </div>
        <!--tab-body-->

      <!--tab-head-->
    </div>
          <ul class="s_tab-head"  style="background-color:black;position:absolute;bottom:0px;">
        <li id="tab-s1-1"><a href="#tab-s1-1">1</a></li>
        <li id="tab-s2-1"><a href="#tab-s2-1">2</a></li>
        <li id="tab-s3-1"><a href="#tab-s3-1">3</a></li>
        <li id="tab-s4-1"><a href="#tab-s4-1">4</a></li>
        <li id="tab-s5-1"><a href="#tab-s5-1">5</a></li>
        <li class="clear"></li>
      </ul>
    <!--tab-->
  </div>
  <!--end fr_standby-->
  <div id="fr_byby1" class="ceg_popup_window">    
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">
          <img src="img/batu.gif">
        </a>
      </div>
      <p>本当に'.$db_friends_data_all[$a]['name'].'さんとGoodByしますか？</p>
    <p>GoodByすると</p>
    <p>書いてもらったコメントが消えてしましまいます。</p>
    <div style="background-color:;height:50px;margin:0 auto;">
      <form name="d'.$a.'" method="post" action="../php/friend_edit.php">
        <input type="hidden" name="delete_id" value="'.$db_friends_data_all[$a]['id'].'">
        <a id="" href="javascript:d'.$a.'.submit()"><button class="goodby">GoodBy</button></a>
      </form>
    </div> 

 
  </div>
  <!--end fr_goodby-->
</div>
<!--end fr_c_s_g-->
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