<?php
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
require ('../php/m.not_login.php');
require ('../../php/db_connect.php');
require ('../../php/mypage_data.php');
require ('../../php/friend_info.php');
require ('../../php/friend_num.php');
//require ('../not_login.php');
try {
    $pdo = require('../../php/db_connect.php');
    //login DB personal_data　を取得
    $stmt = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email AND password = :password');
    $stmt->bindValue(':email', $_SESSION['login']['email']);
    $stmt->bindValue(':password', $_SESSION['login']['password']);
    $stmt->execute();
    //mypageのpersonal_dataをsessionに保存 
    if ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['mypage'] = $data;
    }
} catch (PDOException $e) {
    echo('Error' . $e->getMessage());
    die();
}
$w_friend = 'request';
$ac_email = $_SESSION['mypage']['email'];
$sql = $pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend', $w_friend);
$sql->bindValue(':ac_email', $ac_email);
$sql->execute();
$count = $sql->rowCount();
$f_request_num = $count;

$w_friend = 'all';
$ac_email = $_SESSION['mypage']['email'];
$sql = $pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend', $w_friend);
$sql->bindValue(':ac_email', $ac_email);
$sql->execute();
$count = $sql->rowCount();
$f_all_num = $count;

$array = array('家族', '恋人', '小・中学校', '高校', '大学・専門', '勤務先', 'その他',);
$f_type_num = array(); //初期化
$i = 0;
while (count($array) > $i) {
    $sql = $pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email AND relation=:relation');
    $sql->bindValue(':w_friend', $w_friend);
    $sql->bindValue(':ac_email', $ac_email);
    $sql->bindValue(':relation', $array[$i]);
    $sql->execute();
    $f_num = $sql->rowCount();
    array_push($f_type_num, $f_num);
    $i++;
}
//新しい質問の数
$sql = $pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type', 'new');
$sql->bindValue(':ac_email', $ac_email);
$sql->execute();
$new_question_num = $sql->rowCount();
?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <title>popoQ</title>
        <!--font awesome--> 
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style/css/drawer.css">
        <link rel="stylesheet" type="text/css" href="style/css/mobile.css">
        <link rel="stylesheet" type="text/css" href="style/css/header_style.css">
        <link rel="stylesheet" type="text/css" href="style/css/style.php">
        <link rel="stylesheet" type="text/css" href="style/css/fr_popup.css">
        <!--js-->
        <script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../../style/js/jquery-ui.js"></script>
        <script type="text/javascript" src="../../style/js/jquery.leanModal.min.js"></script>
        <script type="text/javascript" src="../../style/js/jquery.backstretch.min.js"></script>
        <script type="text/javascript">
            $.backstretch("../../img/background/<?php echo($_SESSION['mypage']['background']); ?>");
        </script>
        <script type="text/javascript" src="../../style/js/jquery-ui-1.8.15.custom.min.js"></script>
        <!--position fixed and static-->
        <script>
            $(document).ready(function () {
                $('.click').click(function () {
                    $("#content")
                            .css('position', 'fixed')
                    //.siblings()
                    //.css('backgroundColor','#ffffff');
                    $('.modal_close').removeAttr('disabled');
                    //$('#number').removeAttr('disabled');
                });
            });

            $(document).ready(function () {
                $('.modal_close').click(function () {
                    $("#content")
                            .css('position', 'static')
                    //.siblings()
                    //.css('backgroundColor','#ffffff');
                    //$('#number').removeAttr('disabled');

                });
            });
        </script>
        <script type="text/javascript">
            $(function () {
                $('a[rel*=leanModal]').leanModal({
                    closeButton: ".modal_close"  // 閉じるボタンのCSS classを指定
                });
            });
        </script>
        <!--
        <script type="text/javascript">
        $("#end").on('touchmove.noScroll', function(e) {
          e.preventDefault();
      });
        </script>
        -->
        <?php
        $i = 0;
        while ($i < 10) {
            echo '
    <script>
      $(function() {
        $( "#tabs' . $i . '" ).tabs();
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
        $( "#tabs_all' . $i . '" ).tabs();
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
        $( "#tabs_family' . $i . '" ).tabs();
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
        $( "#tabs_lover' . $i . '" ).tabs();
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
        $( "#tabs_school' . $i . '" ).tabs();
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
        $( "#tabs_high_school' . $i . '" ).tabs();
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
        $( "#tabs_college' . $i . '" ).tabs();
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
        $( "#tabs_work' . $i . '" ).tabs();
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
        $( "#tabs_other' . $i . '" ).tabs();
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
        $( "#tabs_standby' . $i . '" ).tabs();
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
        $( "#tabs_standby_all' . $i . '" ).tabs();
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
        $( "#tabs_standby_family' . $i . '" ).tabs();
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
        $( "#tabs_standby_lover' . $i . '" ).tabs();
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
        $( "#tabs_standby_school' . $i . '" ).tabs();
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
        $( "#tabs_standby_high_school' . $i . '" ).tabs();
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
        $( "#tabs_standby_college' . $i . '" ).tabs();
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
        $( "#tabs_standby_work' . $i . '" ).tabs();
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
        $( "#tabs_standby_other' . $i . '" ).tabs();
      });
    </script>
  ';
            $i++;
        }
        ?>
        <!--end 背景画像-->
        <!--begin ポップアップウィンドウ-->
        <script type="text/javascript">
            $(function () {
                $('a[rel*=leanModal]').leanModal({
                    top: 50, // モーダルウィンドウの縦位置を指定
                    overlay: 0.7, // 背面の透明度 
                    closeButton: ".modal_close", // 閉じるボタンのCSS classを指定
                });
            });
        </script><!--end ポップアップウィンドウ-->
        <link type="text/css" href="style/css/jquery-ui-1.8.15.custom.css" rel="stylesheet" />
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
                    <!--begin thumbnail_and _comment-->
                    <div class="thumbnail_box">
                        <!--begin thumbnail-->
                        <div id="thumbnail">
                            <a id="go" class="click" rel="leanModal" href="#edit_img"><img src="../../img/thumbnail/<?php echo($_SESSION['mypage']['thumbnail']); ?>"></a>
                        </div>
                        <!--end thumbnail-->
                        <!--begin icon_and_name-->
                        <div class="user">
                            <div class="user_name">
                                <p><?php echo($_SESSION['mypage']['name']); ?></p>
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

                        <div class="edit_format">
                            <a id="go" class="click" rel="leanModal" href="#edit_name_and_links">    
                                <div class="thumbnail_link_edit">
                                    <span><i class="fa fa-pencil-square"></i>Edit your name and links</i></span>
                                </div>
                            </a>
                        </div>
                    </div><!--end thumbnail_and _comment-->

                    <!--begin basic_data-->
                    <div id="comment" class="box">
                        <div class="format_box_pad">
                            <span class="data_title"><i class="fa fa-file-text box_icon"></i>comment</span><br>
                            <p><?php echo($_SESSION['mypage']['comment']); ?>
                                <br><cite>-Comment</cite></p>
                        </div>
                        <div class="details">
                            <a id="go" class="click" rel="leanModal" href="#edit_comment"><div class="link_edit"><span><i class="fa fa-pencil-square"></i>Edit your comment</span></div></a>
                        </div>
                    </div>
                    <!--end basic_data-->
                    <!--begin basic_data-->
                    <div id="basic_data" class="box">
                        <div class="format_box_pad">
                            <span class="data_title"><i class="fa fa-user box_icon"></i>BASIC DATA</span><br> 
                            <ul>
                                <li><strong>Age:</strong><span class="data"><?php echo($_SESSION['mypage']['age']); ?></span></li><hr>
                                <li><strong>Birthday:</strong><span class="data"><?php echo($_SESSION['mypage']['birthday']); ?></span></li><hr>
                                <li><strong>From:</strong><span class="data"><?php echo($_SESSION['mypage']['come_from']); ?></span></li><hr>
                                <li><strong>Educational background:</strong><span class="data"><?php echo($_SESSION['mypage']['educational_background']); ?></span></li><hr>
                                <li><strong>Works:</strong><span class="data"><?php echo($_SESSION['mypage']['works']); ?></span></li>
                            </ul>
                        </div>
                        <a id="go" class="click" rel="leanModal" href="#edit_basicdata">    
                            <div class="link_edit">    
                                <span class="meta-nav-prev"><i class="fa fa-pencil-square"></i>Edit your basicdata</span>
                            </div>
                        </a>
                    </div>
                    <!--end basic_data-->

                    <!--begin love and likes-->
                    <div id="love_and_likes" class="box">
                        <div class="format_box_pad">
                            <span class="data_title"><i class="fa fa-heart box_icon"></i>LOVE AND LIKES</span><br> 
                            <ul>
                                <li><strong>Lover:</strong><br><span class="data"><?php echo($_SESSION['mypage']['lover']); ?></span></li><hr>
                                <li><strong>Singer:</strong><br><span class="data"><?php echo($_SESSION['mypage']['singer']); ?></span></li><hr>
                                <li><strong>Writer:</strong><br><span class="data"><?php echo($_SESSION['mypage']['writer']); ?></span></li><hr>
                                <li><strong>Movie:</strong><br><span class="data"><?php echo($_SESSION['mypage']['movie']); ?></span></li>
                            </ul>
                        </div>
                        <div class="details">
                            <a id="go" class="click" rel="leanModal" href="#edit_love_and_likes">    
                                <div class="link_edit">    
                                    <span class="meta-nav-prev"><i class="fa fa-pencil-square"></i>Edit your love and likes</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--end love and likes-->

                    <!--tuika-->
                    <?php
                    $sql = $pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
                    $sql->bindValue(':type', 'all');
                    $sql->bindValue(':ac_email', $_SESSION['mypage']['email']);
                    $sql->execute();
                    $i = 0;
                    while ($quesiton = $sql->fetch(PDO::FETCH_ASSOC)) { //$friendsに友達の情報を代入
                        echo '
<div class="box">
  <div>
  <div class="format_box_pad">
    <ul>
        <li><strong>Question</strong><br><span class="data">' . $quesiton['question'] . '</span></li><hr>
        <li><strong>Answer</strong><br><span class="data">' . $quesiton['answer'] . '</span></li>
      </ul>
    </div>
  </div>
  <div class="details">
    <a id="go" class="click" rel="leanModal" href="#edit_question' . $i . '">    
      <div class="link_edit">    
        <span class="meta-nav-prev"><i class="fa fa-pencil-square"></i>Edit your Question</span>
      </div>
    </a>
  </div>
</div>
';
                        $i++;
                    }
                    ?>
                    <div class="box">
                        <div class="format_box_pad">
                            <form name="frm1" method="GET" action="../mypage/mypage.php#friends_all">
                                <select onChange="document.forms['frm1'].submit()" name="friend_type">
                                    <option value="all" <?php if (@$_GET['friend_type'] == 'all') {
                        echo 'selected';
                    } ?> >全て</option>
                                    <option value="new" <?php if (@$_GET['friend_type'] == 'new') {
                        echo 'selected';
                    } ?> >友達リクエスト</option>
                                    <option value="family" <?php if (@$_GET['friend_type'] == 'family') {
                        echo 'selected';
                    } ?>>家族</option>
                                    <option value="lover" <?php if (@$_GET['friend_type'] == 'lover') {
                        echo 'selected';
                    } ?>>恋人</option>
                                    <option value="school" <?php if (@$_GET['friend_type'] == 'school') {
                        echo 'selected';
                    } ?>>小・中学校</option>
                                    <option value="high_school" <?php if (@$_GET['friend_type'] == 'high_school') {
                        echo 'selected';
                    } ?>>高校</option>
                                    <option value="college" <?php if (@$_GET['friend_type'] == 'college') {
                        echo 'selected';
                    } ?>>大学・専門</option>
                                    <option value="works" <?php if (@$_GET['friend_type'] == 'works') {
                        echo 'selected';
                    } ?>>勤務先</option>
                                    <option value="other" <?php if (@$_GET['friend_type'] == 'other') {
                            echo 'selected';
                        } ?>>その他</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <!--end love and likes-->

                </div><!--end upper_content-->

                <!--begin lower_content-->
                <!--ここから編集してください-->
                <div class="lower_content"><!--begin friends_all-->
                    <div id="friends_all" class="ff">
                        <?php
                        //友達リクエスト
                        if ($_GET['friend_type'] == 'new') {
                            $i = 0;
                            while ($i < $f_request_num) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $newf_data_all[$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $newf_data_all[$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $newf_data_all[$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_comment' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_standby' . $i . '"><i class="fa fa-user-plus"></i>Follow</a></li>
                  <li class="last_li"><a id="go1" class="click" rel="leanModal" href="#fr_byby_new' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                        //友達 全て
                        if ($_GET['friend_type'] == 'all' || $_GET['friend_type'] == '') {
                            $i = 0;
                            while ($i < $f_all_num) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $allf_data_all[$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $allf_data_all[$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $allf_data_all[$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a class="click" id="go1" rel="leanModal" href="#fr_comment_all' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a class="click" id="go1" rel="leanModal" href="#fr_standby_all' . $i . '"><i class="fa fa-user-plus"></i>Edit</a></li>
                  <li class="last_li"><a class="click" id="go1" rel="leanModal" href="#fr_byby_all' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                        /*
                          $friend_type_array = array('family', 'lover', 'school', 'high_school', 'college', 'work', 'other',);
                          foreach($friend_type_array as $key => $type){
                          if($_GET['friend_type'] == $type){
                          $i = 0;
                          while($i < $f_type_num[$i]){
                          echo '
                          <div class="fbox">
                          <div class="friends-image">
                          <img src="../../img/thumbnail/'.$fr_ar[$type][$i]['thumbnail'].'">
                          </div>
                          <div class="f_info">
                          <div class="friends_name">
                          <form name="#" method="post" action="../profile/profile.php">
                          <input type="hidden" name="profile_id" value="'.$fr_ar[$type][$i]['id'].'">
                          <p><input class="fr_tab_name" type="submit" value="'.$fr_ar[$type][$i]['name'].'"></p>
                          </form>
                          </div>
                          <div class="friends-category">
                          <ul>
                          <li><a id="go1" rel="leanModal" href="#fr_comment_'.$type.''.$i.'"><i class="fa fa-comment"></i>Comment</a></li>
                          <li><a id="go1" rel="leanModal" href="#fr_standby_'.$type.''.$i.'"><i class="fa fa-user-plus"></i>Edit</a></li>
                          <li ><a id="go1" rel="leanModal" href="#fr_byby_'.$type.''.$i.'"><i class="fa fa-trash-o"></i>GoodBy</a></li>
                          </ul>
                          </div>
                          </div>
                          </div>
                          ';
                          $i++;
                          }
                          }
                          }
                         */
                        ?>
                        <?php
                        //友達 家族
                        if ($_GET['friend_type'] == 'family') {
                            $i = 0;
                            while ($i < $f_type_num[0]) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $fr_ar['family'][$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $fr_ar['family'][$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $fr_ar['family'][$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_family' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_standby_family' . $i . '"><i class="fa fa-user-plus"></i>Follow</a></li>
                  <li class="last_li"><a id="go1" class="click" rel="leanModal" href="#fr_byby_family' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                        if ($_GET['friend_type'] == 'lover') {
                            $i = 0;
                            while ($i < $f_type_num[1]) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $fr_ar['lover'][$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $fr_ar['lover'][$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $fr_ar['lover'][$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_lover' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_standby_lover' . $i . '"><i class="fa fa-user-plus"></i>Follow</a></li>
                  <li class="last_li"><a id="go1" class="click" rel="leanModal" href="#fr_byby_lover' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                        if ($_GET['friend_type'] == 'school') {
                            $i = 0;
                            while ($i < $f_type_num[2]) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $fr_ar['school'][$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $fr_ar['school'][$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $fr_ar['school'][$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_school' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_standby_school' . $i . '"><i class="fa fa-user-plus"></i>Follow</a></li>
                  <li class="last_li"><a id="go1" class="click" rel="leanModal" href="#fr_byby_school' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                        if ($_GET['friend_type'] == 'high_school') {
                            $i = 0;
                            while ($i < $f_type_num[3]) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $fr_ar['high_school'][$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $fr_ar['school'][$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $fr_ar['school'][$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_school' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_standby_school' . $i . '"><i class="fa fa-user-plus"></i>Follow</a></li>
                  <li class="last_li"><a id="go1" class="click" rel="leanModal" href="#fr_byby_hig_school' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                        if ($_GET['friend_type'] == 'college') {
                            $i = 0;
                            while ($i < $f_type_num[4]) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $fr_ar['college'][$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $fr_ar['college'][$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $fr_ar['college'][$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_college' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_standby_college' . $i . '"><i class="fa fa-user-plus"></i>Follow</a></li>
                  <li class="last_li"><a id="go1" class="click" rel="leanModal" href="#fr_byby_college' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                        if ($_GET['friend_type'] == 'work') {
                            $i = 0;
                            while ($i < $f_type_num[5]) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $fr_ar['work'][$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $fr_ar['work'][$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $fr_ar['work'][$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_work' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_standby_work' . $i . '"><i class="fa fa-user-plus"></i>Follow</a></li>
                  <li class="last_li"><a id="go1" class="click" rel="leanModal" href="#fr_byby_work' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                        if ($_GET['friend_type'] == 'other') {
                            $i = 0;
                            while ($i < $f_type_num[6]) {
                                echo '
          <div class="fbox">
            <div class="friends-image">
              <img src="../../img/thumbnail/' . $fr_ar['other'][$i]['thumbnail'] . '">
            </div>
            <div class="f_info">
              <div class="friends_name">
                <form name="#" method="post" action="../profile/profile.php">
                  <input type="hidden" name="profile_id" value="' . $fr_ar['other'][$i]['id'] . '">
                  <p><input class="fr_tab_name" type="submit" value="' . $fr_ar['other'][$i]['name'] . '"></p>
                </form>
              </div>
              <div class="friends-category">
                <ul>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_comment_other' . $i . '"><i class="fa fa-comment"></i>Comment</a></li>
                  <li><a id="go1" class="click" rel="leanModal" href="#fr_standby_other' . $i . '"><i class="fa fa-user-plus"></i>Follow</a></li>
                  <li class="last_li"><a id="go1" class="click" rel="leanModal" href="#fr_byby_other' . $i . '"><i class="fa fa-trash-o"></i>GoodBy</a></li>
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
                    <div id="end"></div>
                </div><!--end lower_content-->
            </div><!--end content-->
        </div><!--end page_all-->

        <!--0524日に以降を整理-->
        <!--================================POPUPWINDOWS===============================-->

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
                        <input type="checkbox" value="ok" autocomplete="off" required><small>はい、削除します</small><br>
                        <input type="submit" value="削除する">
                    </form>
                </div>
            </div>
        </div>
        <!--end delete_acount-->
        <!--begin edit_img-->
        <div id="edit_img">
            <div class="edit_format">
                <a class="modal_close"  href="javascript:void(0)"></a>
                <form method="post" action="../php/m.edit.php" enctype="multipart/form-data">
                    <ul>
                        <li class="popup_window_li"><p>Thumbnail</p></li>
                        <li class="popup_window_li"><input name="file[]" type="file"></li>
                        <li class="popup_window_li"><p>Background</p></li>
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
                <form method="post" action="../php/m.edit.php">
                    <ul>
                        <li class="popup_window_li"><i class="fa fa-user"></i><input type="text" maxlength="50" name="name" placeholder="user name"></li>
                        <li class="popup_window_li"><i class="fa fa-twitter-square"></i><input type="text" maxlength="50" name="twitter" placeholder="Twitter"></li>
                        <li class="popup_window_li"><i class="fa fa-facebook-square"></i><input type="text" maxlength="50" name="facebook" placeholder="Facebook"></li>
                        <li class="popup_window_li"><i class="fa fa-google-plus"></i><input  type="text" maxlength="50" name="google_plus" placeholder="Google+"></li>
                        <li class="popup_window_li"><i class="fa fa-instagram"></i><input type="text" maxlength="50" name="instagram" placeholder="Instagram"></li>
                        <li class="popup_window_li"><input class="edit_button" type="submit" value="Edit"></li>
                    </ul>
                </form>
            </div>
        </div>
        <!--end edit_name_and_links-->
        <!--begin edit_comment-->
        <div id="edit_comment">
            <div class="edit_format">
                <a class="modal_close"  href="javascript:void(0)"></a>
                <form method="post" action="../php/m.edit.php">
                    <ul>
                        <li class="popup_window_li">
                            <textarea name="comment" placeholder="<?php echo($_SESSION['mypage']['comment']); ?>"><?php echo($_SESSION['mypage']['comment']); ?></textarea>
                        </li>
                        <li>
                            <input class="edit_button" type="submit" value="Edit">
                        </li>
                    </ul>
                </form>
            </div>  
        </div>
        <!--end edit_comment-->

        <!--end edit_question-->
        <div id="edit_basicdata">
            <div class="edit_format">
                <a class="modal_close"  href="javascript:void(0)"></a>
                <form method="post" action="../php/m.edit.php">
                    <ul>
                        <li class="basic_popup_window_li">
                            Birth
                            <select name="year">
                                <option value="">--</option>
                                <?php
                                $age = $_SESSION['mypage']['birthday'];
                                $birthday = explode('/', $age);
                                $year = $birthday[0];
                                $month = $birthday[1];
                                $day = $birthday[2];

                                for ($id = 1900; $id <= 2020; $id++) {
                                    if ($id == $year) {
                                        echo('<option name="year" value="' . $id . '" selected>' . $id . '</option>');
                                    } elseif ($id == 1990) {
                                        echo('<option name="year" value="' . $id . '" selected>' . $id . '</option>');
                                    } else {
                                        echo('<option name="year" value="' . $id . '">' . $id . '</option>');
                                    }
                                }
                                ?>
                            </select>年
                            <select name="month">
                                <option value="">--</option>
                                <?php
                                for ($id = 1; $id <= 12; $id++) {
                                    if ($id == $month) {
                                        echo('<option name="year" value="' . $id . '" selected>' . $id . '</option>');
                                    } else {
                                        echo('<option name="month" value="' . $id . '">' . $id . '</option>');
                                    }
                                }
                                ?>
                            </select>月
                            <select name="day">
                                <option value="">--</option>
                                <?php
                                for ($id = 1; $id <= 31; $id++) {
                                    if ($id == $day) {
                                        echo('<option name="year" value="' . $id . '" selected>' . $id . '</option>');
                                    } else {
                                        echo('<option name="day" value="' . $id . '">' . $id . '</option>');
                                    }
                                }
                                ?>
                            </select>日            
                        </li>
                        <li class="basic_popup_window_li">
                            Age
                            <select name="age">
                                <option value="" selected>--</option>
<?php
for ($id = 1; $id <= 120; $id++) {
    if ($id == $_SESSION['mypage']['age']) {
        echo('<option name="age" value="' . $id . '" selected>' . $id . '</option>');
    } else {
        echo('<option name="age" value="' . $id . '">' . $id . '</option>');
    }
}
?>
                            </select>歳

                        </li>

                        <li class="basic_popup_window_li">
                            From
                            <input type="text"maxlength="20" name="from" value="<?php echo $_SESSION['mypage']['come_from']; ?>" placeholder="<?php echo $_SESSION['mypage']['come_from']; ?>">
                        </li>

                        <li class="basic_popup_window_li">
                            School
                            <input type="text" maxlength="20" name="educational background" value="<?php echo $_SESSION['mypage']['educational_background']; ?>" placeholder="<?php echo($_SESSION['mypage']['educational_background']); ?>">
                        </li>
                        <li class="basic_popup_window_li">
                            Works
                            <input type="text" name="works" value="<?php echo $_SESSION['mypage']['works']; ?>" placeholder="<?php echo $_SESSION['mypage']['works']; ?>">
                        </li>
                        <li>
                            <input class="edit_button" type="submit" value="Edit">
                        </li>
                    </ul>
                </form>
            </div>
        </div><!--wada-->
        <div id="edit_love_and_likes" class="popup_window">
            <a class="modal_close"  href="javascript:void(0)"></a>
            <div class="edit_format">
                <form method="post" action="../php/m.edit.php">
                    <ul>
                        Lover
                        <li class="popup_window_li">
                            <textarea name="lover" placeholder="<?php echo($_SESSION['mypage']['lover']); ?>"><?php echo($_SESSION['mypage']['lover']); ?></textarea>
                        </li>
                        Singer
                        <li class="popup_window_li">
                            <textarea name="singer" placeholder="<?php echo($_SESSION['mypage']['singer']); ?>"><?php echo($_SESSION['mypage']['singer']); ?></textarea>
                        </li>
                        Writer
                        <li class="popup_window_li">
                            <textarea name="writer" placeholder="<?php echo($_SESSION['mypage']['writer']); ?>"><?php echo($_SESSION['mypage']['writer']); ?></textarea>
                        </li>
                        Movie
                        <li class="popup_window_li">
                            <textarea name="movie" placeholder="<?php echo($_SESSION['mypage']['movie']); ?>"><?php echo($_SESSION['mypage']['movie']); ?></textarea>
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
                <form method="post" action="../php/m.edit.php">
                    <h2>Love and Likes</h2><hr>
                    <p>Lover:<br><textarea name="lover"></textarea></p>
                    <p>Singer:<br><textarea name="singer"></textarea></p>
                    <p>Writer:<br><textarea name="writer"></textarea></p>
                    <p>Movie:<br><textarea name="movie"></textarea></p>
                    <input class="edit_button" type="submit" value="edit">
                </form>
            </div>
        </div>

        <?php
        $sql = $pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
        $sql->bindValue(':type', 'all');
        $sql->bindValue(':ac_email', $_SESSION['mypage']['email']);
        $sql->execute();
        $i = 0;
        while ($question = $sql->fetch(PDO::FETCH_ASSOC)) { //$friendsに友達の情報を代入
            echo '
<div id="edit_question' . $i . '" class="question_popup_window">
  <div class="edit_format">
  <div class="cancel"><a class="modal_close" href="javascript:void(0)"></a></div>
      <div class="question_box">
        <div class="question-text">
            <p>' . $question['question'] . '</p>
        </div>


        <form class="question_form"method="post" action="../php/m.question_edit.php">
          <textarea class="fr_textarea" name="answer" placeholder="' . $question['answer'] . '">' . $question['answer'] . '</textarea>
          <input name="question_id" type="hidden" value="' . $question['id'] . '">
          <button class="add_btnq g_f">answer</button>
        </form>
        <form class="" method="post" action="../php/m.question_edit.php">
          <input name="delete_id" type="hidden" value="' . $question['id'] . '">
          <button type="submit" class="add_btnq g_f">delete</button>
        </form>
        <div class="g_f_clear"></div>
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
            <!--コメント ポップアップウィンドウ-->
            <!-- begin -->
            <?php
//新しい友達のポップアップウィンドウ
            if (isset($_GET['friend_type']) == 'new') {
                $i = 0;
                while ($i < $f_request_num) {
                    echo '
  <!--begin fr_comment-->
  <div id="fr_comment' . $i . '" class="ceg_popup_window">
    <div id="tabs' . $i . '" class="tab_ceg_format">
      <div class="cancel">
        <a class="modal_close close" href="javascript:void(0)"></a>
      </div>  
      <div class="more_rel_format">
        <p>あなたとの関係：' . $newf_data_all[$i]['more_relation'] . '<p></div>
      <div id="tabs-1">
        <div class="comment_format"><p>' . $newf_data_all[$i]['comment1'] . '</p></div>
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-' . $newf_data_all[$i]['comment1_type'] . '</p></div>
        </div>
      </div>
      <div id="tabs-2">
        <div class="comment_format"><p>' . $newf_data_all[$i]['comment2'] . '</p></div>
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-' . $newf_data_all[$i]['comment2_type'] . '</p></div>
        </div>
      </div>
      <div id="tabs-3">
        <div class="comment_format"><p>' . $newf_data_all[$i]['comment3'] . '</p></div>
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-' . $newf_data_all[$i]['comment3_type'] . '</p></div>
        </div>
      </div>
      <div id="tabs-4">
        <div class="comment_format"><p>' . $newf_data_all[$i]['comment4'] . '</p></div>
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えいたこと</p></div>
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
//全ての友達のポップアップウィンドウ
            if (isset($_GET['friend_type']) == 'all' || $_GET['friend_type'] == '') {
                $i = 0;
                while ($i < $f_all_num) {
                    echo '
  <!--begin fr_comment-->
  <div id="fr_comment_all' . $i . '" class="ceg_popup_window">
    <div id="tabs_all' . $i . '" class="tab_ceg_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)"></a>
      </div>
      <div class="more_rel_format">
        <p>あなたとの関係：' . $allf_data_all[$i]['more_relation'] . '<p></div>
      <div id="tabs-1">
        <div class="comment_format"><p>' . $allf_data_all[$i]['comment1'] . '</p></div>
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-' . $allf_data_all[$i]['comment1_type'] . '</p></div>
        </div>
      </div>
      <div id="tabs-2">
        <div class="comment_format"><p>' . $allf_data_all[$i]['comment2'] . '</p></div>
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-' . $allf_data_all[$i]['comment2_type'] . '</p></div>
        </div>
      </div>
      <div id="tabs-3">
        <div class="comment_format"><p>' . $allf_data_all[$i]['comment3'] . '</p></div>
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-' . $allf_data_all[$i]['comment3_type'] . '</p></div>
        </div>
      </div>
      <div id="tabs-4">
        <div class="comment_format"><p>' . $allf_data_all[$i]['comment4'] . '</p></div>
        <div class="comment_text_box">
          <div class="comment_type_format"><p>-伝えいたこと</p></div>
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
//種類ごとの友達ポップアップウィンドウ
            $friend_type_array = array('family', 'lover', 'school', 'high_school', 'college', 'work', 'other',);
            foreach ($friend_type_array as $key => $type) {
                if (isset($_GET['friend_type']) == $type) {
                    $i = 0;
                    while ($i < $f_type_num[$i]) {
                        echo '
      <!--begin fr_comment-->
      <div id="fr_comment_' . $type . '' . $i . '" class="ceg_popup_window">
        <div id="tabs_' . $type . '' . $i . '" class="tab_ceg_format">
          <div class="cancel">
            <a class="modal_close" href="javascript:void(0)">
              <img src="img/batu.gif">
            </a>
          </div>  
          <div id="tabs-1">家族Comment1Tab1だよ' . $fr_ar[$type][$i]['comment1'] . '</div>
          <div id="tabs-2">家族Comment1Tab2だよ' . $fr_ar[$type][$i]['comment2'] . '</div>
          <div id="tabs-3">家族Comment1Tab3だよ' . $fr_ar[$type][$i]['comment3'] . '</div>
          <div id="tabs-4">家族Comment1Tab4だよ' . $fr_ar[$type][$i]['comment4'] . '</div>
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
            }
            ?>
            <!-- end -->
            <!--コメント ポップアップウィンドウ-->

            <!--Edit ポップアップウィンドウ-->
            <!-- begin -->
            <?php
//新しい友達のポップアップウィンドウ
            if (isset($_GET['friend_type']) == 'new') {
                $i = 0;
                while ($i < $f_request_num) {
                    echo '
  <!--begin fr_standby-->
  <div id="fr_standby' . $i . '" class="ceg_popup_window">
    <div id="tabs_standby' . $i . '" class="tab_ceg_format">
      <div class="cancel">
        <a class="modal_close close" href="javascript:void(0)">
        </a>
      </div>
      <div class="fr_tab_box">
      <form action="../php/m.friend_edit.php" method="post">
        <div class="fr_rel_box">
          <select name="relation"autocomplete="off" required>
            <option value="" selected>関係</option>
            <option value="家族">家族</option>
            <option value="恋人">恋人</option>
            <option value="小・中学校">小・中学校</option>
            <option value="高校">高校</option>
            <option value="大学・専門">大学・専門</option>
            <option value="勤務先">勤務先</option>
            <option value="その他">その他</option>
          </select>
          <input class="fr_input" name="more_relation" type="text" placeholder="詳しい関係"> 
        </div>
            <div id="tabs-1">
              <div class="edit_item">
                <select class="f_sel_box clear" name="c_type1" autocomplete="off" required>
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
                <textarea class="fr_textarea"name="comment1"></textarea>
              </div>
            </div>
            <div id="tabs-2">
              <div class="edit_item">
                <select class="f_sel_box" name="c_type2 clear" autocomplete="off" required>
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
                <textarea class="fr_textarea"name="comment2"></textarea>
              </div>
            </div>
            <div id="tabs-3">
              <div class="edit_item">
                <select class="f_sel_box" name="c_type3 clear" autocomplete="off" required>
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
                <textarea class="fr_textarea"name="comment3"></textarea>
              </div>
            </div>
            <div id="tabs-4">
              <div class="edit_item">
                <select class="f_sel_box clear">
                  <option value="" selected>伝えたいこと</option>
                </select>
                <textarea class="fr_textarea"name="comment4"></textarea>
              </div>
            </div>
            <div id="tabs-5">
              <div class="edit_item">
                <select class="f_sel_box clear">
                  <option>質問</option>
                </select>
                <textarea class="fr_textarea" name="question"></textarea>
              </div>
            </div>
            <div class="btn_submit">
              <input name="friend_id" type="hidden" value="' . $newf_data_all[$i]['id'] . '">
              <input class="edit_button" name="accept_friend" type="submit" value="Edit">
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
  ';
                    $i++;
                }
            }
            ?>
            <?php
//全ての友達のポップアップウィンドウ
            if (isset($_GET['friend_type']) == 'all' || $_GET['friend_type'] == '') {
                $i = 0;
                while ($i < $f_all_num) {
                    echo '
  <!--begin fr_edit-->
  <div id="fr_standby_all' . $i . '" class="ceg_popup_window">
    <div id="tabs_standby_all' . $i . '" class="tab_ceg_format">
      <div class="cancel">
        <a class="modal_close" href="javascript:void(0)">

        </a>
      </div>
      <div class="fr_tab_box">
      <form action="../php/m.friend_edit.php" method="post">
        <div class="fr_rel_box">
          <select name="relation"autocomplete="off" required>
            <option value="" selected>関係</option>
            <option value="家族">家族</option>
            <option value="恋人">恋人</option>
            <option value="小・中学校">小・中学校</option>
            <option value="高校">高校</option>
            <option value="大学・専門">大学・専門</option>
            <option value="勤務先">勤務先</option>
            <option value="その他">その他</option>
          </select>
          <input class="fr_input" name="more_relation" type="text" placeholder="詳しい関係" value="' . $allf_my_data_all[$i]['more_relation'] . '"> 
        </div>
            <div id="tabs-1">
              <div class="edit_item">
                <select class="f_sel_box clear" name="c_type1" autocomplete="off" required>
                  <option value="" selected>aaaaaaaaaコメントの種類</option>
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
                <textarea class="fr_textarea"name="comment1">' . $allf_my_data_all[$i]['comment1'] . '</textarea>
              </div>
            </div>
            <div id="tabs-2">
              <div class="edit_item">
                <select class="f_sel_box clear" name="c_type2" autocomplete="off" required>
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
                <textarea class="fr_textarea" name="comment2">' . $allf_my_data_all[$i]['comment2'] . '</textarea>
              </div>
            </div>
            <div id="tabs-3">
              <div class="edit_item">
                <select class="f_sel_box clear" name="c_type3" autocomplete="off" required>
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
                <textarea class="fr_textarea" name="comment3">' . $allf_my_data_all[$i]['comment3'] . '</textarea>
              </div>
            </div>
            <div id="tabs-4">
              <div class="edit_item">
                <select class="f_sel_box clear">
                  <option value="" selected>伝えたいこと</option>
                </select>
                <textarea class="fr_textarea" name="comment4">' . $allf_my_data_all[$i]['comment4'] . '</textarea>
              </div>
            </div>
            <div class="btn_submit">
              <input name="friend_id" type="hidden" value="' . $allf_data_all[$i]['id'] . '">
              <input class="edit_button" name="comment_edit" type="submit" value="Edit">
            </div>

            <ul class="menu_edit">
                <li><a href="#tabs-1">1</a></li>
                <li><a href="#tabs-2">2</a></li>
                <li><a href="#tabs-3">3</a></li>
                <li><a href="#tabs-4">4</a></li>
            </ul>
          </form>
        </div>
    </div>
  </div>
  ';
                    $i++;
                }
            }
            ?>
            <?php
//種類ごとの友達ポップアップウィンドウ
            $friend_type_array = array('family', 'lover', 'school', 'high_school', 'college', 'work', 'other',);
            foreach ($friend_type_array as $key => $type) {
                if (isset($_GET['friend_type']) == $type) {
                    $i = 0;
                    while ($i < $f_all_num) {
                        echo '
    <!--begin fr_standby-->
    <div id="fr_standby_' . $type . '' . $i . '" class="ceg_popup_window">
      <div id="tabs_standby_' . $type . '' . $i . '" class="tab_ceg_format">
        <div class="cancel">
          <a class="modal_close" href="javascript:void(0)">
          </a>
        </div>
        <div class="fr_tab_box">
        <form action="../php/m.friend_edit.php" method="post">
          <div class="fr_rel_box">
            <select name="relation"autocomplete="off" required>
              <option value="" selected>関係</option>
              <option value="家族">家族</option>
              <option value="恋人">恋人</option>
              <option value="小・中学校">小・中学校</option>
              <option value="高校">高校</option>
              <option value="大学・専門">大学・専門</option>
              <option value="勤務先">勤務先</option>
              <option value="その他">その他</option>
            </select>
            <input class="fr_input" name="more_relation" type="text" placeholder="詳しい関係" value="' . $allf_my_data_all[$i]['more_relation'] . '"> 
          </div>
              <div id="tabs-1">
                <div class="edit_item">
                  <select class="f_sel_box clear" name="c_type1" autocomplete="off" required>
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
                  <textarea class="fr_textarea" name="comment1">' . $allf_my_data_all[$i]['comment1'] . '</textarea>
                </div>
              </div>
              <div id="tabs-2">
                <div class="edit_item">
                  <select class="f_sel_box clear" name="c_type2" autocomplete="off" required>
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
                  <textarea class="fr_textarea" name="comment2">' . $allf_my_data_all[$i]['comment2'] . '</textarea>
                </div>
              </div>
              <div id="tabs-3">
                <div class="edit_item">
                  <select class="f_sel_box clear" name="c_type3" autocomplete="off" required>
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
                  <textarea class="fr_textarea" name="comment3">' . $allf_my_data_all[$i]['comment3'] . '</textarea>
                </div>
              </div>
              <div id="tabs-4">
                <div class="edit_item">
                  <select class="f_sel_box clear">
                    <option value="" selected>伝えたいこと</option>
                  </select>
                  <textarea class="fr_textarea" name="comment4">' . $allf_my_data_all[$i]['comment4'] . '</textarea>
                </div>
              </div>
              <div class="btn_submit">
                <input name="friend_id" type="hidden" value="' . $newf_data_all[$i]['id'] . '">
                <input class="edit_button" name="accept_friend" type="submit" value="Edit">
              </div>

              <ul class="menu_standby">
                <li><a href="#tabs-1">1</a></li>
                <li><a href="#tabs-2">2</a></li>
                <li><a href="#tabs-3">3</a></li>
                <li><a href="#tabs-4">4</a></li>
              </ul>
            </form>
          </div>
      </div>
    </div>
    ';
                        $i++;
                    }
                }
            }
            ?>

            <!--GoodBy-->
            <?php
//新しい友達のポップアップウィンドウ
            $i = 0;
            while ($i < $f_request_num) {
                echo '
    <div id="fr_byby_new' . $i . '" class="ceg_popup_window">
    <a class="modal_close"  href="javascript:void(0)"></a>
    <div class="gb_alert">
    <p>本当に' . $newf_data_all[$i]['name'] . 'さんとGoodByしますか？<br>GoodByすると書いてもらったコメントが消えてしまい、あなたの書いたコメントも消えてしまいます</p><hr>
    </div>
    <form name="d' . $a . '" class="g_form g_f" method="post" action="../php/m.friend_edit.php">
      <input type="hidden" name="friend_id" value="' . $newf_data_all[$i]['id'] . '">
      <input type="hidden" name="delete" value="delete">
      <a href="javascript:d' . $a . '.submit()">
      <button class="btn"><i class="fa fa-trash-o">goodby</i></button>
      </a>
    </form>
    <div class="cancel_form g_f">
    <button class="btn"><a href="../mypage/mypage.php"><i class="fa fa-times">キャンセル</i></a></button>
    <div class="g_f_clear"></div>
    </div>
  </div>
  ';
                $i++;
            }
//全ての友達のポップアップウィンドウ
            if (isset($_GET['friend_type']) == 'all' || $_GET['friend_type'] == '') {
                $i = 0;
                while ($i < $f_all_num) {
                    echo '
    <div id="fr_byby_all' . $i . '" class="ceg_popup_window">
    <a class="modal_close"  href="javascript:void(0)"></a>
    <div class="gb_alert">
    <p>本当に' . $allf_data_all[$i]['name'] . 'さんとGoodByしますか？<br>GoodByすると書いてもらったコメントが消えてしまい、あなたの書いたコメントも消えてしまいます</p><hr>
    </div>
    <form name="d' . $a . '" class="g_form g_f" method="post" action="../php/m.friend_edit.php">
      <input type="hidden" name="friend_id" value="' . $allf_data_all[$i]['id'] . '">
      <input type="hidden" name="delete" value="delete">
      <a href="javascript:d' . $a . '.submit()">
      <button class="btn"><i class="fa fa-trash-o">goodby</i></button>
      </a>
    </form>
    <div class="cancel_form g_f">
    <button class="btn"><a href="../mypage/mypage.php"><i class="fa fa-times">キャンセル</i></a></button>
    <div class="g_f_clear"></div>
    </div>
  </div>
  ';
                    $i++;
                }
            }
//種類ごとの友達ポップアップウィンドウ
            $friend_type_array = array('family', 'lover', 'school', 'high_school', 'college', 'work', 'other',);
            foreach ($friend_type_array as $key => $type) {
                if (isset($_GET['friend_type']) == $type) {
                    $i = 0;
                    while ($i < $f_type_num[$i]) {
                        echo '
        <div id="fr_byby_' . $type . '' . $i . '" class="ceg_popup_window">
          <a class="modal_close"  href="javascript:void(0)"></a>
          <div class="gb_alert">
            <p>本当に' . $fr_ar[$type][$i]['name'] . 'さんとGoodByしますか？<br>GoodByすると書いてもらったコメントが消えてしまい、あなたの書いたコメントも消えてしまいます</p><hr>
          </div>
          <form name="d' . $a . '" class="g_form g_f" method="post" action="../php/m.friend_edit.php">
            <input type="hidden" name="friend_id" value="' . $fr_ar[$type][$i]['id'] . '">
            <input type="hidden" name="delete" value="delete">
            <a href="javascript:d' . $a . '.submit()">
              <button class="btn"><i class="fa fa-trash-o">goodby</i></button>
            </a>
          </form>
          <div class="cancel_form g_f">
          <button class="btn"><a href="../mypage/mypage.php"><i class="fa fa-times">キャンセル</i></a></button>
            <div class="g_f_clear"></div>
          </div>
        </div>
      ';
                        $i++;
                    }
                }
            }
            ?>
            <!--GoodBy-->

        </div>
        <script src="../../style/js/iscroll-min.js"></script>
        <script src="../../style/js/jquery.drawer.js"></script>
        <script src="../../style/js/side_menu.js"></script> 

    </script> 
</body>
</html>