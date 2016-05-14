<?php
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
require ('../php/not_login.php');
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
<title>pepoQ</title>
<link rel="stylesheet" type="text/css" media="all" href="style/css/mypage.css">
<link rel="stylesheet" type="text/css" media="all" href="style/css/friend_edit.php">
<link rel="stylesheet" type="text/css" href="style/css/blue.css">
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<script src="../../style/js/jquery.hoverintent.r7.js"></script>
<script src="../../style/js/jquery.mnmenu.js"></script>
<script>
$(document).ready(function() {
  $('#idmenu').mnmenu();
})
</script>
<!--box 移動-->

<script type='text/javascript' src='../../style/js/jquery.masonry.min.js'></script>
<script type='text/javascript' src='../../style/js/masonry-style.js'></script>
<script type="text/javascript" src="../../style/js/jquery.leanModal.min.js"></script>
<script type='text/javascript' src='../../style/js/leanmodal_style.js'></script>
<!--box 移動-->
<!--背景画像-->
<script type="text/javascript" src="../../style/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
  $.backstretch("../../img/background/<?php echo($_SESSION['mypage']['background']); ?>");
</script>
<!--背景画像-->
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
<style type="text/css">
  .data{
    line-height: 50px;
  }
  #user_name{
    padding-top:40px;

  }
  #user_name p{
    background-color:;width:300px;word-wrap: break-word;
  }
</style>
</head>
<body ng-app="standby">
  <!--begin page_all-->
  <div id="page_all">
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
        <a id="go" rel="leanModal" href="#edit_img">
          <figure>
            <img src="../../img/thumbnail/<?php echo($_SESSION['mypage']['thumbnail']); ?>">
              <figcaption>
                <img id="more" src="img/icon-more.png">
              </figcaption>
          </figure>
        </a>
      </div>
      <!--end thumbnail-->
      <!--begin icon_and_name-->
      <div id="icon_and_name">
        <div id="social_icon">
          <ul>
            <li><a href="<?php echo($_SESSION['mypage']['twitter']); ?>"><img src="img/sns_icon/twitter.jpg"></a></li>
            <li><a href="<?php echo($_SESSION['mypage']['facebook']); ?>"><img src="img/sns_icon/facebook.jpg"></a></li>
            <li><a href="<?php echo($_SESSION['mypage']['instagram']); ?>"><img src="img/sns_icon/instagram.jpg"></a></li>
            <li><a href="<?php echo($_SESSION['mypage']['google_plus']); ?>"><img src="img/sns_icon/google_plus.jpg"></a></li>
          </ul>
        </div>
        <div id="user_name">
          <p><?php echo($_SESSION['mypage']['name']); ?></p>
          <cite>-User Name</cite>
        </div>
      </div>
      <!--end icon_and_name-->
      <a id="go" rel="leanModal" href="#edit_name">    
        <div class="link_edit">    
          <span>Edit your name and links</span>
        </div>
      </a>
    </div>
    <!--end thumbnail_and _comment-->

    <!--begin comment-->
    <div id="comment" class="box">
      <p><?php echo($_SESSION['mypage']['comment']); ?><br><br><cite>-Comment</cite></p>
      <a id="go" rel="leanModal" href="#edit_comment">    
        <div class="link_edit">    
          <span>Edit your comment</span>
        </div>
      </a>
    </div>
    <!--end comment-->
    <!--begin basic_data-->
    <div id="basic_data" class="box">
      <span class="data_title">BASIC DATA</span><br> 
      <ul>
        <li><strong>Age:</strong><span class="data"><?php echo($_SESSION['mypage']['age']); ?></span></li><hr>
        <li><strong>Birthday:</strong><span class="data"><?php echo($_SESSION['mypage']['birthday']); ?></span></li><hr>
        <li><strong>From:</strong><span class="data"><?php echo($_SESSION['mypage']['come_from']); ?></span></li><hr>
        <li><strong>School:</strong><span class="data"><?php echo($_SESSION['mypage']['educational_background']); ?></span></li><hr>
        <li><strong>Works:</strong><span class="data"><?php echo($_SESSION['mypage']['works']); ?></span></li>
      </ul>
      <a id="go" rel="leanModal" href="#edit_basicdata">    
        <div class="link_edit">    
          <span>Edit your basicdata</span>
        </div>
      </a>
    </div>
    <!--end basic_data-->

    <!--begin love and likes-->
    <div id="love_and_likes" class="box">
      <span class="data_title">LOVE AND LIKES</span><br> 
      <ul>
        <li style="font-size:20px;padding:10px 0;">Lover</li>
        <div style="padding-left:20px;">
          <span style="line-height:30px;padding-bottom:10px;"><?php echo(nl2br($_SESSION['mypage']['lover'])); ?></span>
        </div><hr>
        <li style="font-size:20px;padding:10px 0;">Singer</li>
        <div style="padding-left:20px;">
          <span style="line-height:30px;"><?php echo(nl2br($_SESSION['mypage']['singer'])); ?></span>
        </div><hr>
        <li style="font-size:20px;padding:10px 0;">Book</li>
        <div style="padding-left:20px;">
          <span style="line-height:30px;"><?php echo(nl2br($_SESSION['mypage']['writer'])); ?></span>
        </div><hr>
        <li style="font-size:20px;padding:10px 0;">Movie</li>
        <div style="padding-left:20px;">
          <span style="line-height:30px;"><?php echo(nl2br($_SESSION['mypage']['movie'])); ?></span>
        </div><hr>
      </ul>
      <a id="go" rel="leanModal" href="#edit_love_and_likes">    
        <div class="link_edit">    
          <span>Edit your love and likes</span>
        </div>
      </a>
    </div>
    <!--end love and likes-->

<?php
$sql=$pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type','all');
$sql->bindValue(':ac_email',$_SESSION['mypage']['email']);
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
      <a id="go" rel="leanModal" href="#edit_question'.$i.'">    
        <div class="link_edit">    
          <span>Edit the answer</span>
        </div>
      </a>
    </div>
    <!--end quesiton-->
';
$i++;
}
?>
  </div>
  <!--end upper_content-->
<!--begin lower_content-->
<div id="lower_content" class="tab_wrapper">
<!--begin contentContainer-->
<div id="contentContainer">
<!--begin tabContainer1-->
<div id="category_tab" class="jQdmtab tabContainer">
    <ul class="controls">
      <li style="background-color:;"><a href="#tab1_1">すべて</a></li>
      <li><a href="#tab1_2">友達リクエスト</a></li>
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
            <?php //全て
            for($a=0;$a<$f_all_num;$a++){
            echo '
            <div class="fbox">
              <div class="friends-image">
                <img src="../../img/thumbnail/'.$allf_data_all[$a]['thumbnail'].'">
              </div>
              <div class="friends-c_e_g">
                <p>
                  <a id="go" rel="leanModal" name="test" href="#comment_all'.$a.'">Comment</a> |
                  <a id="go" rel="leanModal" name="edit" href="#edit_all'.$a.'">Edit</a> |
                  <a id="go" rel="leanModal" name="goodby1" href="#goodby_all'.$a.'">GoodBy</a>
                </p>
              </div>         
              <div class="friends_name" style="height:40px;background-color:;">
                <form method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="'.$allf_profile_data_all[$a]['id'].'">
                  <input style="border:none;height:40px;" class="fr_tab_name" type="submit" value="'.$allf_data_all[$a]['name'].'">
                </form>
              </div>
            </div>
            ';
          }
            ?>
            </div>
          </div>
        </article>

        <!--友達リクエスト-->        
        <article id="tab1_2" class="post">
          <div class="tab_content">
            <div class="" style="background-color:blue;">
            <?php
            for($a=0;$a<$f_request_num;$a++){
            echo '
            <div class="fbox">
              <div class="friends-image">
                <img src="../../img/thumbnail/'.$newf_data_all[$a]['thumbnail'].'">
              </div>
              <div class="friends-c_e_g">
                <p>
                  <a id="go" rel="leanModal" name="test" href="#comment'.$a.'">Comment</a> |
                  <a id="go" rel="leanModal" name="edit" href="#edit'.$a.'">Follow</a> |
                  <a id="go" rel="leanModal" name="goodby1" href="#goodby'.$a.'">GoodBy</a>
                </p>
              </div>         
              <div class="friends_name" style="height:40px;">
                <form name="a'.$a.'" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="'.$newf_profile_data_all[$a]['id'].'">
                  <input style="border:none;height:40px;" class="fr_tab_name" type="submit" value="'.$newf_data_all[$a]['name'].'">                
                </form>
              </div>
            </div>
            ';
          }
            ?>
            </div>
          </div>
        </article>

<?php
$friends_type=array('family'=>'家族','lover'=>'恋人','school'=>'小・中学校','high_school'=>'高校','college'=>'大学・専門','works'=>'勤務先','other'=>'その他',);
$key=0;
foreach($friends_type as $name => $value){
        echo'
        <article id="tab1_'.$i.'" class="post">
          <div class="tab_content">
        ';
          for($a=0;$a<$f_type_num[$key];$a++){
            echo '
            <div class="fbox">
              <div class="friends-image">
                <img src="../../img/thumbnail/'.$ar[$name][$a]['thumbnail'].'">
              </div>
              <div class="friends-c_e_g">
                <p>
                  <a id="go" rel="leanModal" href="#comment_'.$name.'_'.$a.'">Comment</a> |
                  <a id="go" rel="leanModal" href="#edit_'.$name.'_'.$a.'">Edit</a> |
                  <a id="go" rel="leanModal" href="#goodby_'.$name.'_'.$a.'">GoodBy</a>
                </p>
              </div>         
              <div class="friends_name" style="height:40px;">
                <form name="a'.$key.'" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="'.$ar[$name][$a]['id'].'">
                  <input style="border:none;height:40px;" class="fr_tab_name" type="submit" value="'.$ar[$name][$a]['name'].'">
                </form>
              </div>
            </div>
            ';
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





<!--begin popup window-->
<div id="delete_account" class="popup_window">
<a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format" style="background-color:;">
    <h2>アカウントの削除</h2>
    <div style="float:left;width:200px;">
      <p>アカウントを削除すると友達からもらったコメントや質問、<?php echo $_SESSION['mypage']['name'] ?>さんのコメントや質問が消えてしまいます。</p>
      <p>アカウントが削除されると、ご登録されたメールアドレスで別のアカウントを作成することはできません。</p>
    </div>
    <div style="float:left;width:260px;background-color:;margin-left:50px;">
    <h3 style="color:black;">アカウントを削除しますか？</h3>
    <form method="post" action="../php/delete_account.php">
      <input type="checkbox" value="ok" style="margin-left:;width:10px;" required><small style="color:black;">はい、削除します</small><br>
      <input type="submit" value="削除する" style="margin-left:;width:100px;">
    </form>
    </div>
  </div>
</div>
<div id="edit_img" class="popup_window">
<a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format">
    <h2>Thumbnail</h2>
    <form method="post" action="../php/edit.php" enctype="multipart/form-data">
      <input name="file[]" type="file"><br><br><hr>
      <h2>Background</h2>
      <input name="file[]" type="file"><br><br>
      <input class="edit_button" type="submit" value="Edit">
    </form>
  </div>
</div>
<div id="edit_name" class="popup_window">
<a class="modal_close"  href="javascript:void(0)"></a>
      <div class="edit_format" style="background-color:;">
        <form method="post" action="../php/edit.php">
          <h2>Name and Links</h2>
          <p>User name<br><input type="text" maxlength="25" name="name" placeholder="<?php echo $_SESSION['mypage']['name']; ?>" value="<?php echo $_SESSION['mypage']['name']; ?>"></p>
          <p><img style="width:28px;" class="social_icon" src="img/sns_icon/twitter.jpg">Twitter<br><input type="text" name="twitter" placeholder="<?php echo($_SESSION['mypage']['twitter']); ?>" value="<?php echo($_SESSION['mypage']['twitter']); ?>"></p>
          <p><img style="width:28px;" class="social_icon" src="img/sns_icon/facebook.jpg">Facebook<br><input type="text" name="facebook" placeholder="<?php echo($_SESSION['mypage']['facebook']); ?>" value="<?php echo($_SESSION['mypage']['facebook']); ?>"></p>       
          <p><img style="width:28px;" class="social_icon" src="img/sns_icon/instagram.jpg">Instagram<br><input type="text" name="instagram" placeholder="<?php echo($_SESSION['mypage']['instagram']); ?>" value="<?php echo($_SESSION['mypage']['instagram']); ?>"></p>
          <p><img style="width:28px;" class="social_icon" src="img/sns_icon/google_plus.jpg">Google+<br><input type="text" name="google_plus" placeholder="<?php echo($_SESSION['mypage']['google_plus']); ?>" value="<?php echo($_SESSION['mypage']['google_plus']); ?>"></p>
          <input class="edit_button" style="width:100%" type="submit" value="Edit">
        </form>
      </div>
</div>
<div id="edit_comment" class="popup_window">
<a class="modal_close"  href="javascript:void(0)"></a>
      <div class="edit_format">
        <form method="post" action="../php/edit.php">
        <h2>Comment</h2>
        <textarea maxlength="10000" style="width:490px;height:300px;" name="comment" placeholder="<?php $remove_br=str_replace("<br />","",$_SESSION['mypage']['comment']); echo($remove_br); ?>"><?php echo($remove_br); ?></textarea><br><br>
        <input class="edit_button" type="submit" value="Edit">
        </form>
      </div>  
</div>
<div id="edit_basicdata" class="popup_window">
<a class="modal_close"  href="javascript:void(0)"></a>
      <div class="edit_format">
        <form method="post" action="../php/edit.php">
          <h2>Basic Data</h2>
            <p>Birthday<br>
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
                    }
                    echo('<option name="year" value="'.$id.'">'.$id.'</option>');
                  }
                ?>
              </select>年
              <select name="month">
                <option value="">--</option>
                <?php
                  for($id=1;$id<=12;$id++){
                    if($id==$month){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }
                    echo('<option name="month" value="'.$id.'">'.$id.'</option>');
                  }
                ?>
              </select>月
              <select name="day">
                <option value="">--</option>
                <?php
                  for($id=1;$id<=31;$id++){
                    if($id==$day){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }
                    echo('<option name="day" value="'.$id.'">'.$id.'</option>');
                  }
                ?>
              </select>日
            </p> 
            <p>Age<br>
              <select name="age">
                <option value="" selected>--</option>
                <?php
                  for($id=1;$id<=120;$id++){
                    if($id==$_SESSION['mypage']['age']){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'歳</option>');
                    }
                    echo('<option name="age" value="'.$id.'">'.$id.'歳</option>');
                  }
                ?>
              </select>
            </p>
            <p>From<br>
              <input type="text"maxlength="20" name="from" value="<?php echo $_SESSION['mypage']['come_from']; ?>" placeholder="<?php echo $_SESSION['mypage']['come_from']; ?>">
            </p>
            <p>School<br>
              <input type="text" maxlength="20" name="educational background" value="<?php echo $_SESSION['mypage']['educational_background']; ?>" placeholder="<?php echo($_SESSION['mypage']['educational_background']); ?>">
            </p>
            <p>Works<br>
              <input type="text" name="works" value="<?php echo $_SESSION['mypage']['works']; ?>" placeholder="<?php echo $_SESSION['mypage']['works']; ?>">
            </p>
            <input class="edit_button" type="submit" value="edit">
        </form>
      </div>
</div>
<div id="edit_love_and_likes" class="popup_window">
<a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format">
      <form method="post" action="../php/edit.php">
        <h2>Love and Likes</h2>
        <p>Lover<br><textarea name="lover" style="width:200px;height:50px;" placeholder="<?php echo($_SESSION['mypage']['lover']); ?>"><?php echo($_SESSION['mypage']['lover']); ?></textarea></p>
        <p>Singer<br><textarea name="singer" style="width:200px;height:50px;" placeholder="<?php echo($_SESSION['mypage']['singer']); ?>"><?php echo($_SESSION['mypage']['singer']); ?></textarea></p>
        <p>Writer<br><textarea name="writer" style="width:200px;height:50px;" placeholder="<?php echo($_SESSION['mypage']['writer']); ?>"><?php echo($_SESSION['mypage']['writer']); ?></textarea></p>
        <p>Movie<br><textarea name="movie" style="width:200px;height:50px;" placeholder="<?php echo($_SESSION['mypage']['movie']); ?>"><?php echo($_SESSION['mypage']['movie']); ?></textarea></p>
        <input class="edit_button" type="submit" value="edit">
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
<div id="edit_question'.$i.'" class="popup_window" style="width:550px;height:600px;">
<a class="modal_close"  href="javascript:void(0)"></a>
  <div class="edit_format">
    <div style="padding-top:20px;padding-right:20px;float:left;background-color:;position:absolute;right:0;">
      <form method="post" action="../php/question_edit.php">
        <input name="delete_id" type="hidden" value="'.$question['id'].'">
        <input style="width:50px;" type="submit" value="削除">          
      </form>
    </div>
    <div class="balloon-1-left" style="margin:10px 0 20px 20px;min-width:420px;max-width:420px;word-wrap:break-word;font-size:15px;">
      '.$question['question'].'
    </div>
    <form method="post" action="../php/question_edit.php">
      <div style="margin-bottom:20px;">
        <input name="question_id" type="hidden" value="'.$question['id'].'">
        <textarea name="answer" style="font-size:15px;width:100%;min-height:200px;padding:5px;" placeholder="'.$question['answer'].'">'.$question['answer'].'</textarea>
      </div>
      <input class="edit_button" type="submit" value="Edit">
    </form>
  </div>
</div>
';
$i++;
}
?>
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

  <div id="edit_all'.$a.'" style="background-color:#dadada;">
    <a class="modal_close"  href="javascript:void(0)"></a>
    <div id="edit-ct">
      <!--begin lower_content-->
      <div class="tab_wrapper" style="height:100%;background-color:rgba(225,225,255,0);">
      <form class="confirm_form" action="../php/friend_edit.php" method="post">
        <div style="padding-bottom:10px;float:left;">
          <select name="relation">
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
        <div style="background-color:;height:60px;width:100px;float:left;margin-left:20px;">
          <input type="text" style="width:200px;height:18px;padding:3px;font-size:14px;" name="more_relation" placeholder="'.$allf_my_data_all[$a]['more_relation'].'">
        </div>
        <!--begin contentContainer-->
        <div id="contentContainer" style="clear:both;">
          <!--begin tabContainer3-->
          <div id="standby_all_tab'.$a.'" class="jQdmtab1 tabContainer" style="">
            <ul class="controls">
              <li><a href="#tab1_1">'.$allf_my_data_all[$a]['comment1_type'].'</a></li>
              <li><a href="#tab1_2">'.$allf_my_data_all[$a]['comment2_type'].'</a></li>
              <li><a href="#tab1_3">'.$allf_my_data_all[$a]['comment3_type'].'</a></li>
              <li><a href="#tab1_4">伝えたいこと</a></li>
            </ul>
            <!--begin tabContentsContainer-->
            <div class="tabContentsContainer">

              <!--begin tab1_1-->
              <article id="tab1_1" class="post" style="background-color:;">
                <div class="tab_content" style="">
                  <div name="" style="padding:0 10px;background-color:;">
                    <div style="float:left;">
                      <select class="popup_select" name="comment1_type">
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
                    <br>
                    <textarea name="comment1" style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" placeholder="'.$allf_my_data_all[$a]['comment1'].'">'.$allf_my_data_all[$a]['comment1'].'</textarea>
                  </div>  
                </div>
              </article>
              <!--end tab1_1-->

              <!--begin tab1_2-->
              <article id="tab1_2" class="post">
                <div class="tab_content">              
                  <div name="" style="padding:0 10px;background-color:;">
                    <div style="float:left;">
                      <select class="popup_select" name="comment2_type">
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
                    <br>
                    <textarea name="comment2" style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" placeholder="'.$allf_data_all[$a]['comment2'].'">'.$allf_my_data_all[$a]['comment2'].'</textarea>
                  </div> 
                </div>
              </article>
              <!--end tab1_2-->

              <!--begin tab1_3-->
              <article id="tab1_3" class="post">
                <div class="tab_content">                
                  <div name="" style="padding:0 10px;background-color:;">
                    <div style="float:left;">
                      <select class="popup_select" name="comment3_type">
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
                    <br>
                    <textarea name="comment3"  style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" placeholder="'.$allf_my_data_all[$a]['comment3'].'">'.$allf_my_data_all[$a]['comment3'].'</textarea>
                  </div> 
                </div>
              </article>
              <!--end tab1_3-->

              <!--begin tab1_4-->
              <article id="tab1_4" class="post">
                <div class="tab_content">             
                  <div style="padding:0 10px;background-color:;color:#ccc;"><span style="height:20px;font-size:15px;">伝えたいこと</span>
                    <textarea name="comment4" style="font-size:15px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" placeholder="'.$allf_my_data_all[$a]['comment4'].'">'.$allf_my_data_all[$a]['comment4'].'</textarea>
                  </div> 
                </div>
              </article>
              <!--end tab1_4-->


            </div>
            <!--end tabContentsContainer-->
            <div style="padding:10px 0;background-color:;text-align:center;">
              <input type="hidden" name="friend_id" value="'.$allf_my_data_all[$a]['id'].'">       
              <input name="comment_edit" style="width:170px;height:33px;" value="Edit" type="submit" class="standby_button">     
            </div>

          </div>
          <!--end tabContainer3-->
        </div>
        <!--end contentContainer-->
      </form>
    </div>
    <!--end tab_wrapper-->
  </div>
</div>

  <div id="goodby_all'.$a.'" style="text-align:center;">
    <h2>本当に'.$allf_data_all[$a]['name'].'さんとGoodByしますか？</h2>
    <p>GoodByすると</p>
    <p>書いたコメントが消えてしまい、</p>
    <p>書いてもらったコメントも消えてしましまいます。</p>
    <div style="background-color:;height:50px;margin:0 auto;">
      <form method="post" action="../php/friend_edit.php">
        <input type="hidden" name="friend_id" value="'.$allf_data_all[$a]['id'].'">
        <input type="hidden" name="delete" value="delete">
        <button type="submit" class="goodby">GoodBy</button>
      </form>
    </div>
  </div>
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
//////////////////////////////////////////////////////////////begin 友達リクエストのポップアップウィンドウ/////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
for($a=0;$a<$f_request_num;$a++){
  echo '
    <div class="c_e_g">
            <div id="comment'.$a.'" style="padding-top:10px;background-color:;">
              <a class="modal_close"  href="javascript:void(0)"></a>
              <!--begin lower_content-->
              <div class="tab_wrapper" style="height:100%;background-color:rgba(225,225,255,0);">
                <div style="background-color:;height:30px;float:left;color:gray;background-color:;">
                  '.$newf_data_all[$a]['relation'].'
                </div>
                <div style="background-color:;height:30px;margin-left:20px;float:left;color:gray;background-color:;">
                  '.$newf_data_all[$a]['more_relation'].'
                </div>
                <!--begin contentContainer-->
                <div id="contentContainer" class="">
                  <!--begin tabContainer2-->
                  <div id="comment_tab'.$a.'" class="jQdmtab1 tabContainer" style="clear:both;">
                      <ul class="controls">
                        <li><a href="#tab1_1">'.$newf_data_all[$a]['comment1_type'].'</a></li>
                        <li><a href="#tab1_2">'.$newf_data_all[$a]['comment2_type'].'</a></li>
                        <li><a href="#tab1_3">'.$newf_data_all[$a]['comment3_type'].'</a></li>
                        <li><a href="#tab1_4">伝えたいこと</a></li>
                      </ul>
                        <!--begin tabContentsContainer-->
                        <div class="tabContentsContainer">

                          <article id="tab1_1" class="post" style="background-color:;">
                            <div class="tab_content" style="">
                              <div class="" style="">
                                '.$newf_data_all[$a]['comment1'].'
                              </div>
                            </div>
                          </article>

                          <article id="tab1_2" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                '.$newf_data_all[$a]['comment2'].'
                              </div>
                            </div>
                          </article>
                          <article id="tab1_3" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                '.$newf_data_all[$a]['comment3'].'
                              </div>
                            </div>
                          </article>
                          <article id="tab1_4" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                '.$newf_data_all[$a]['comment4'].'
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

  <div id="edit'.$a.'" style="background-color:#dadada;">
    <a class="modal_close"  href="javascript:void(0)"></a>
    <div id="edit-ct">
              <!--begin lower_content-->
              <div class="tab_wrapper" style="height:100%;background-color:rgba(225,225,255,0);">
              <form class="confirm_form" action="../php/friend_edit.php" method="post" novalidate name="myForm">
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
                <!--begin contentContainer-->
                <div id="contentContainer" style="clear:both;">
                  <!--begin tabContainer3-->
                  <div id="standby_tab'.$a.'" class="jQdmtab1 tabContainer" style="">
                      <ul class="controls">
                        <li><a href="#tab1_1">紹介カテゴリー</a></li>
                        <li><a href="#tab1_2">紹介カテゴリー</a></li>
                        <li><a href="#tab1_3">紹介カテゴリー</a></li>
                        <li><a href="#tab1_4">伝えたいこと</a></li>
                        <li><a href="#tab1_5">質問</a></li>
                      </ul>
                        <!--begin tabContentsContainer-->
                        <div class="tabContentsContainer">

                          <article id="tab1_1" class="post" style="background-color:;">
                            <div class="tab_content" style="">
                              <div class="" style="">
                                <div name="meet_trigger" style="padding:0 10px;background-color:;">

                                  <div style="float:left;">
                                  <select class="popup_select" name="comment1_type" ng-model="c_type1" autocomplete="off" required>
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
                                  <div style="background-color:;margin-left:10px;font-size:15px;background-color:;float:left;color:red;font-family:;">
                                    <span class="text-danger" ng-show="myForm.c_type1.$error.required">選択してください</span>
                                  </div>
                                  <br>
                                  <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment1" ng-model="comment1" autocomplete="off" required 　ng-minlength="1" ng-maxlength="125"></textarea>
                                  <div style="font-size:15px;background-color:;color:red;font-family:;">
                                    <span class="text-danger" ng-show="myForm.comment1.$error.required">入力してください</span>
                                    <span class="text-denger" ng-show="myForm.comment1.$error.maxlength">Too long!</span>
                                  </div>
                                </div>  
                              </div>
                            </div>
                          </article>

                          <article id="tab1_2" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                <div name="meet_trigger" style="padding:0 10px;background-color:;">
                                  <div style="float:left;">
                                  <select class="popup_select" name="comment2_type" ng-model="c_type2" autocomplete="off" required>
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
                                  <div style="background-color:;margin-left:10px;font-size:15px;background-color:;float:left;color:red;font-family:;">
                                    <span class="text-danger" ng-show="myForm.c_type2.$error.required">選択してください</span>
                                  </div>
                                  <br>
                                  <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment2" ng-model="comment2" autocomplete="off" required 　ng-minlength="1" ng-maxlength="125"></textarea>
                                  <div style="font-size:15px;background-color:;color:red;font-family:;">
                                    <span class="text-danger" ng-show="myForm.comment2.$error.required">入力してください</span>
                                    <span class="text-danger" ng-show="myForm.comment2.$error.name">正しい名前を入力して下さい</span>
                                    <span class="text-denger" ng-show="myForm.comment2.$error.minlength">Too short!</span>
                                    <span class="text-denger" ng-show="myForm.comment2.$error.maxlength">Too long!</span>
                                  </div>
                                </div> 
                              </div>
                            </div>
                          </article>
                          <article id="tab1_3" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                <div name="meet_trigger" style="padding:0 10px;background-color:;">
                                  <div style="float:left;">
                                  <select class="popup_select" name="comment3_type" ng-model="c_type3" autocomplete="off" required>
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
                                  <div style="background-color:;margin-left:10px;font-size:15px;background-color:;float:left;color:red;font-family:;">
                                    <span class="text-danger" ng-show="myForm.c_type3.$error.required">選択してください</span>
                                  </div>
                                  <br>
                                  <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment3" ng-model="comment3" autocomplete="off" required 　ng-minlength="1" ng-maxlength="125"></textarea>
                                  <div style="font-size:15px;background-color:;color:red;font-family:;">
                                    <span class="text-danger" ng-show="myForm.comment3.$error.required">入力してください</span>
                                    <span class="text-danger" ng-show="myForm.comment3.$error.name">正しい名前を入力して下さい</span>
                                    <span class="text-denger" ng-show="myForm.comment3.$error.minlength">Too short!</span>
                                    <span class="text-denger" ng-show="myForm.comment3.$error.maxlength">Too long!</span>
                                  </div>
                                </div> 
                              </div>
                            </div>
                          </article>
                          <article id="tab1_4" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                <div style="padding:0 10px;background-color:;color:#ccc;"><span style="height:20px;font-size:15px;">伝えたいこと</span>
                                  <textarea style="font-size:15px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment4" ng-model="comment4" autocomplete="off" required 　ng-minlength="1" ng-maxlength="125"></textarea>
                                  <div style="font-size:15px;color:red;font-family:;">
                                  <span class="text-danger" ng-show="myForm.comment4.$error.required">入力してください</span>
                                  <span class="text-danger" ng-show="myForm.comment4.$error.name">正しい名前を入力して下さい</span>
                                  <span class="text-denger" ng-show="myForm.comment4.$error.minlength">Too short!</span>
                                  <span class="text-denger" ng-show="myForm.comment4.$error.maxlength">Too long!</span>
                                  </div>
                                </div> 
                              </div>
                            </div>
                          </article>
                          <article id="tab1_5" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                <div style="padding:0 10px;color:#ccc;clear:both;float:left;"><span style="height:20px;font-size:15px;">質問:  何か質問してみましょう</span>
                                  <textarea name="question" style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="question" ng-model="question" autocomplete="off" required 　ng-minlength="10" ng-maxlength="125" placeholder="例：好きな食べ物はなんですか？"></textarea>
                                  <div style="font-size:15px;background-color:;color:red;font-family:;">
                                  <span class="text-danger" ng-show="myForm.question.$error.required">入力してください</span>
                                  <span class="text-denger" ng-show="myForm.question.$error.minlength">Too short!</span>
                                  <span class="text-denger" ng-show="myForm.question.$error.maxlength">Too long!</span>
                                  </div>
                                </div>    
                              </div>
                            </div>
                          </article>
                        </div>
                        <!--end tabContentsContainer-->
                          <div style="padding:10px 0;background-color:;text-align:center;">
                            <input type="hidden" name="friend_id" value="'.$newf_data_all[$a]['id'].'">       
                            <input name="accept_friend" style="width:170px;height:33px;" value="StandBy" type="submit" class="standby_button" ng-disabled="!myForm.$valid">     
                          </div>

                    </div>
                    <!--end tabContainer3-->
                </div>
                <!--end contentContainer-->
                  </form>
              </div>
              <!--end tab_wrapper-->
    </div>
  </div>

  <div id="goodby'.$a.'" style="text-align:center;">
    <h2>本当に'.$newf_data_all[$a]['name'].'さんとGoodByしますか？</h2>
    <p>GoodByすると</p>
    <p>書いてもらったコメントが消えてしましまいます。</p>
    <div style="background-color:;height:50px;margin:0 auto;">
      <form name="d'.$a.'" method="post" action="../php/friend_edit.php">
        <input type="hidden" name="delete" value="delete">
        <input type="hidden" name="friend_id" value="'.$newf_data_all[$a]['id'].'">
        <a id="" href="javascript:d'.$a.'.submit()"><button class="goodby">GoodBy</button></a>
      </form>
    </div>
  </div>
</div>
';
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////end 友達リクエストのポップアップウィンドウ///////////////////////////////////////////////////////////////
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

for($a=0;$a<$f_type_num[$num];$a++){
  echo '
    <div class="c_e_g">
            <div id="comment_'.$name.'_'.$a.'" style="padding-top:10px;background-color:;">
              <a class="modal_close"  href="javascript:void(0)"></a>
              <!--begin lower_content-->
              <div class="tab_wrapper" style="height:100%;background-color:rgba(225,225,255,0);">
                <div style="background-color:;height:30px;float:left;color:gray;background-color:;">
                  '.$db_friends_data_all[$a]['relation'].'
                </div>
                <div style="background-color:;height:30px;margin-left:20px;float:left;color:gray;background-color:;">
                  '.$db_friends_data_all[$a]['more_relation'].'
                </div>
                <!--begin contentContainer-->
                <div id="contentContainer" class="">
                  <!--begin tabContainer2-->
                  <div id="comment_tab'.$a.'" class="jQdmtab1 tabContainer" style="clear:both;">
                      <ul class="controls">
                        <li><a href="#tab1_1">'.$db_friends_data_all[$a]['comment1_type'].'</a></li>
                        <li><a href="#tab1_2">'.$db_friends_data_all[$a]['comment2_type'].'</a></li>
                        <li><a href="#tab1_3">'.$db_friends_data_all[$a]['comment3_type'].'</a></li>
                        <li><a href="#tab1_4">伝えたいこと</a></li>
                      </ul>
                        <!--begin tabContentsContainer-->
                        <div class="tabContentsContainer">

                          <article id="tab1_1" class="post" style="background-color:;">
                            <div class="tab_content" style="">
                              <div class="" style="">
                                '.$db_friends_data_all[$a]['comment1'].'
                              </div>
                            </div>
                          </article>

                          <article id="tab1_2" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                '.$db_friends_data_all[$a]['comment2'].'
                              </div>
                            </div>
                          </article>
                          <article id="tab1_3" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                '.$db_friends_data_all[$a]['comment3'].'
                              </div>
                            </div>
                          </article>
                          <article id="tab1_4" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                '.$db_friends_data_all[$a]['comment4'].'
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

  <div id="edit_'.$name.'_'.$a.'" style="background-color:#dadada;">
    <a class="modal_close"  href="javascript:void(0)"></a>
    <div id="edit-ct">
              <!--begin lower_content-->
              <div class="tab_wrapper" style="height:100%;background-color:rgba(225,225,255,0);">
              <form class="confirm_form" action="../php/friend_edit.php" method="post">
        <div style="background-color:;height:60px;width:130px;float:left;">
          <select name="relation">
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
        <div style="background-color:;height:60px;width:100px;float:left;">
            <input type="text" style="width:200px;height:18px;padding:3px;font-size:14px;" name="more_relation" placeholder="'.$db_friends_my_data_all[$a]['more_relation'].'">
        </div>
                <!--begin contentContainer-->
                <div id="contentContainer" style="clear:both;">
                  <!--begin tabContainer3-->
                  <div id="standby_tab'.$a.'" class="jQdmtab1 tabContainer" style="">
                      <ul class="controls">
                        <li><a href="#tab1_1">'.$db_friends_my_data_all[$a]['comment1_type'].'</a></li>
                        <li><a href="#tab1_2">'.$db_friends_my_data_all[$a]['comment2_type'].'</a></li>
                        <li><a href="#tab1_3">'.$db_friends_my_data_all[$a]['comment3_type'].'</a></li>
                        <li><a href="#tab1_4">伝えたいこと</a></li>
                      </ul>
                        <!--begin tabContentsContainer-->
                        <div class="tabContentsContainer">

                          <article id="tab1_1" class="post" style="background-color:;">
                            <div class="tab_content" style="">
                              <div class="" style="">
                                <div name="meet_trigger" style="padding:0 10px;background-color:;">

                                  <div style="float:left;">
                                  <select class="popup_select" name="comment1_type">
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
                                  <br>
                                  <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment1" placeholder="'.$db_friends_my_data_all[$a]['comment1'].'">'.$db_friends_my_data_all[$a]['comment1'].'</textarea>
                                </div>  
                              </div>
                            </div>
                          </article>

                          <article id="tab1_2" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                <div name="meet_trigger" style="padding:0 10px;background-color:;">
                                  <div style="float:left;">
                                  <select class="popup_select" name="comment2_type">
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
                                  <br>
                                  <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment2" placeholder="'.$db_friends_my_data_all[$a]['comment2'].'">'.$db_friends_my_data_all[$a]['comment2'].'</textarea>
                                </div> 
                              </div>
                            </div>
                          </article>
                          <article id="tab1_3" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                <div name="meet_trigger" style="padding:0 10px;background-color:;">
                                  <div style="float:left;">
                                  <select class="popup_select" name="comment3_type">
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
                                  <br>
                                  <textarea style="font-size:14px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment3" placeholder="'.$db_friends_my_data_all[$a]['comment3'].'">'.$db_friends_my_data_all[$a]['comment3'].'</textarea>
                                </div> 
                              </div>
                            </div>
                          </article>
                          <article id="tab1_4" class="post">
                            <div class="tab_content">
                              <div class="" style="background-color:;">
                                <div style="padding:0 10px;background-color:;color:#ccc;"><span style="height:20px;font-size:15px;">伝えたいこと</span>
                                  <textarea style="font-size:15px;max-width:700px;width:700px;max-height:150px;height:150px;" type="text" name="comment4" placeholder="'.$db_friends_my_data_all[$a]['comment4'].'">'.$db_friends_my_data_all[$a]['comment4'].'</textarea>
                                </div> 
                              </div>
                            </div>
                          </article>
                        </div>
                        <!--end tabContentsContainer-->
                          <div style="padding:10px 0;background-color:;text-align:center;">
                            <input type="hidden" name="friend_id" value="'.$db_friends_my_data_all[$a]['id'].'">       
                            <input name="comment_edit" style="width:170px;height:33px;" value="Follow" type="submit" class="standby_button">     
                          </div>

                    </div>
                    <!--end tabContainer3-->
                </div>
                <!--end contentContainer-->
                  </form>
              </div>
              <!--end tab_wrapper-->
    </div>
  </div>

  <div id="goodby_'.$name.'_'.$a.'" style="text-align:center;">
    <h2>本当に'.$db_friends_data_all[$a]['name'].'さんとGoodByしますか？</h2>
    <p>GoodByすると</p>
    <p>書いてもらったコメントが消えてしましまいます。</p>
    <div style="background-color:;height:50px;margin:0 auto;">
      <form name="d'.$a.'" method="post" action="../php/friend_edit.php">
        <input type="hidden" name="delete_id" value="'.$db_friends_data_all[$a]['id'].'">
        <a id="" href="javascript:d'.$a.'.submit()"><button class="goodby">GoodBy</button></a>
      </form>
    </div>
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

//全て(友達)のタブ
for (var i=0; i<<?php echo $f_all_num;?>; i++) {
  $('#comment_all_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#standby_all_tab'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//家族のタブ
for (var i=0; i<<?php echo $f_type_num[0];?>; i++) {
  $('#comment_family_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_family_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//恋人のタブ
for (var i=0; i<<?php echo $f_type_num[1];?>; i++) {
  $('#comment_lover_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_lover_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//小・中学校のタブ
for (var i=0; i<<?php echo $f_type_num[2];?>; i++) {
  $('#comment_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//高校のタブ
for (var i=0; i<<?php echo $f_type_num[3];?>; i++) {
  $('#comment_high_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_high_school_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//大学・専門のタブ
for (var i=0; i<<?php echo $f_type_num[4];?>; i++) {
  $('#comment_college_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_college_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//勤務先のタブ
for (var i=0; i<<?php echo $f_type_num[5];?>; i++) {
  $('#comment_works_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
  $('#edit_works_'+i).jQdmtab(); //+iを追加　熊川 03/08 2:41
}
//その他のタブ
for (var i=0; i<<?php echo $f_type_num[6];?>; i++) {
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
</body>
</html>