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
$w_friend='request';
$ac_email=$_SESSION['mypage']['email'];
$sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend',$w_friend);
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$count=$sql->rowCount();
$f_request_num=$count;

$w_friend='all';
$ac_email=$_SESSION['mypage']['email'];
$sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend',$w_friend);
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$count=$sql->rowCount();
$f_all_num=$count;

$array=array('家族','恋人','小・中学校','高校','大学・専門','勤務先','その他',);
$f_type_num=array();//初期化
$i=0;
while(count($array)>$i){
  $sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email AND relation=:relation');
  $sql->bindValue(':w_friend',$w_friend);
  $sql->bindValue(':ac_email',$ac_email);
  $sql->bindValue(':relation',$array[$i]);
  $sql->execute();
  $f_num=$sql->rowCount();
  array_push($f_type_num,$f_num);
  $i++;
}
//新しい質問の数
$sql=$pdo->prepare('SELECT * FROM question WHERE type=:type AND accepter_email=:ac_email');
$sql->bindValue(':type','new');
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$new_question_num=$sql->rowCount();
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>popoQ</title>
<link rel="stylesheet" type="text/css" href="../mypage/style/css/header_style.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../mypage/style/css/drawer.css">

<link rel="stylesheet" type="text/css" href="style/css/mobile.css" />
<link rel="stylesheet" type="text/css" href="style/css/style.css" />

<!--js-->
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../style/js/jquery.leanModal.min.js"></script>
<script type="text/javascript" src="../../style/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
  $.backstretch("../../img/background/<?php echo($_SESSION['mypage']['background']); ?>");
</script>
<!--begin ポップアップウィンドウ-->
<script type="text/javascript">
$(function() {
$( 'a[rel*=leanModal]').leanModal({
top: 0,                     // モーダルウィンドウの縦位置を指定
overlay : 0.7,               // 背面の透明度 
});
}); 
</script><!--end ポップアップウィンドウ-->
<!--position fixed and static-->
<script>
$(document).ready(function() {
    $('.click').click(function() {
        $("#content")
        .css('position','fixed')
        //.siblings()
        //.css('backgroundColor','#ffffff');
        $('.modal_close').removeAttr('disabled');
        //$('#number').removeAttr('disabled');
    });
});

$(document).ready(function() {
    $('.modal_close').click(function() {
        $("#content")
        .css('position','static')
        //.siblings()
        //.css('backgroundColor','#ffffff');
        $('.modal_close').removeAttr('disabled');
        //$('#number').removeAttr('disabled');
    });
});
</script>

</head>

<body>
<!--begin page_all-->
<div id="page_all">
<div id="content">
 <!--begin header-->
  <?php
  require('../mypage/header.php');
  ?>
<!--end header-->
<!--begin lower_content-->

  <div class="top_search_boxs head_search">
    <label for="search" class="off-left">Keyword</label>
      <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="get">
        <input type="text" name="search_word" value="<?php echo htmlspecialchars($_GET["search_word"],ENT_QUOTES,'UTF-8'); ?>" placeholder="Serch Friends" maxlength="20">
      </form>
      <button class="top_submit" type="submit"><i class="fa fa-search"></i></button>
      <div class="clear"></div>
  </div>
<div class="lower_content">
  <div id="friends_all" class="ff" style="">
<?php
if(isset($_GET['search_word'])){
  $search_word=htmlspecialchars($_GET['search_word'],ENT_QUOTES,'UTF-8');
  $word_piece = mb_convert_kana($search_word, 'as', 'UTF-8'); //全角を半角に変換
  $word_ex=explode(' ',$word_piece); //スペース毎に区切り配列化
  $array_count=count($word_ex); //複数検索された単語の数を取得
  if ($array_count > 3) {
    while ($array_count < 4) {
      array_pop($array_count);
    }
  }
  try{
    $pdo = require('../../php/db_connect.php');
    //複数検索１つの場合
    if($array_count==1){
      $serch=$pdo->prepare('SELECT * FROM personal_data
        WHERE
        name LIKE :name1 OR
        come_from LIKE :come_from1 OR
        age LIKE :age1 OR
        works LIKE :works1 OR
        lover LIKE :lover1 OR
        singer LIKE :singer1 OR
        writer LIKE :writer1 OR
        movie LIKE :movie1 OR
        comment LIKE :comment1 OR
        educational_background LIKE :educational_background1
      ');
      $serch->bindValue(':name1',"%".$word_ex[0]."%");
      $serch->bindValue(':come_from1',"%".$word_ex[0]."%");
      $serch->bindValue(':age1',"%".$word_ex[0]."%");
      $serch->bindValue(':works1',"%".$word_ex[0]."%");
      $serch->bindValue(':lover1',"%".$word_ex[0]."%");
      $serch->bindValue(':singer1',"%".$word_ex[0]."%");
      $serch->bindValue(':writer1',"%".$word_ex[0]."%");
      $serch->bindValue(':movie1',"%".$word_ex[0]."%");
      $serch->bindValue(':comment1',"%".$word_ex[0]."%");
      $serch->bindValue(':educational_background1',"%".$word_ex[0]."%");

      $serch->execute();      
    }elseif($array_count==2){ //複数検索　２つの場合
      $serch=$pdo->prepare('SELECT * FROM personal_data
        WHERE
        name LIKE :name1 OR
        come_from LIKE :come_from1 OR
        age LIKE :age1 OR
        works LIKE :works1 OR
        lover LIKE :lover1 OR
        singer LIKE :singer1 OR
        writer LIKE :writer1 OR
        movie LIKE :movie1 OR
        comment LIKE :comment1 OR
        educational_background LIKE :educational_background1 AND

        name LIKE :name2 OR
        come_from LIKE :come_from2 OR
        age LIKE :age2 OR
        works LIKE :works2 OR
        lover LIKE :lover2 OR
        singer LIKE :singer2 OR
        writer LIKE :writer2 OR
        movie LIKE :movie2 OR
        comment LIKE :comment2 OR
        educational_background LIKE :educational_background2
      ');
      $serch->bindValue(':name1',"%".$word_ex[0]."%");
      $serch->bindValue(':come_from1',"%".$word_ex[0]."%");
      $serch->bindValue(':age1',"%".$word_ex[0]."%");
      $serch->bindValue(':works1',"%".$word_ex[0]."%");
      $serch->bindValue(':lover1',"%".$word_ex[0]."%");
      $serch->bindValue(':singer1',"%".$word_ex[0]."%");
      $serch->bindValue(':writer1',"%".$word_ex[0]."%");
      $serch->bindValue(':movie1',"%".$word_ex[0]."%");
      $serch->bindValue(':comment1',"%".$word_ex[0]."%");
      $serch->bindValue(':educational_background1',"%".$word_ex[0]."%");

      $serch->bindValue(':name2',"%".$word_ex[1]."%");
      $serch->bindValue(':come_from2',"%".$word_ex[1]."%");
      $serch->bindValue(':age2',"%".$word_ex[1]."%");
      $serch->bindValue(':works2',"%".$word_ex[1]."%");
      $serch->bindValue(':lover2',"%".$word_ex[1]."%");
      $serch->bindValue(':singer2',"%".$word_ex[1]."%");
      $serch->bindValue(':writer2',"%".$word_ex[1]."%");
      $serch->bindValue(':movie2',"%".$word_ex[1]."%");
      $serch->bindValue(':comment2',"%".$word_ex[1]."%");
      $serch->bindValue(':educational_background2',"%".$word_ex[1]."%");

      $serch->execute();      
    }elseif($array_count==3){ //複数検索　３つの場合
      $serch=$pdo->prepare('SELECT * FROM personal_data
        WHERE
        name LIKE :name1 OR
        come_from LIKE :come_from1 OR
        age LIKE :age1 OR
        works LIKE :works1 OR
        lover LIKE :lover1 OR
        singer LIKE :singer1 OR
        writer LIKE :writer1 OR
        movie LIKE :movie1 OR
        comment LIKE :comment1 OR
        educational_background LIKE :educational_background1 AND

        name LIKE :name2 OR
        come_from LIKE :come_from2 OR
        age LIKE :age2 OR
        works LIKE :works2 OR
        lover LIKE :lover2 OR
        singer LIKE :singer2 OR
        writer LIKE :writer2 OR
        movie LIKE :movie2 OR
        comment LIKE :comment2 OR
        educational_background LIKE :educational_background2 AND

        name LIKE :name3 OR
        come_from LIKE :come_from3 OR
        age LIKE :age3 OR
        works LIKE :works3 OR
        lover LIKE :lover3 OR
        singer LIKE :singer3 OR
        writer LIKE :writer3 OR
        movie LIKE :movie3 OR
        comment LIKE :comment3 OR
        educational_background LIKE :educational_background3 AND
      ');
      $serch->bindValue(':name1',"%".$word_ex[0]."%");
      $serch->bindValue(':come_from1',"%".$word_ex[0]."%");
      $serch->bindValue(':age1',"%".$word_ex[0]."%");
      $serch->bindValue(':works1',"%".$word_ex[0]."%");
      $serch->bindValue(':lover1',"%".$word_ex[0]."%");
      $serch->bindValue(':singer1',"%".$word_ex[0]."%");
      $serch->bindValue(':writer1',"%".$word_ex[0]."%");
      $serch->bindValue(':movie1',"%".$word_ex[0]."%");
      $serch->bindValue(':comment1',"%".$word_ex[0]."%");
      $serch->bindValue(':educational_background1',"%".$word_ex[0]."%");

      $serch->bindValue(':name2',"%".$word_ex[1]."%");
      $serch->bindValue(':come_from2',"%".$word_ex[1]."%");
      $serch->bindValue(':age2',"%".$word_ex[1]."%");
      $serch->bindValue(':works2',"%".$word_ex[1]."%");
      $serch->bindValue(':lover2',"%".$word_ex[1]."%");
      $serch->bindValue(':singer2',"%".$word_ex[1]."%");
      $serch->bindValue(':writer2',"%".$word_ex[1]."%");
      $serch->bindValue(':movie2',"%".$word_ex[1]."%");
      $serch->bindValue(':comment2',"%".$word_ex[1]."%");
      $serch->bindValue(':educational_background2',"%".$word_ex[1]."%");

      $serch->bindValue(':name2',"%".$word_ex[2]."%");
      $serch->bindValue(':come_from2',"%".$word_ex[2]."%");
      $serch->bindValue(':age2',"%".$word_ex[2]."%");
      $serch->bindValue(':works2',"%".$word_ex[2]."%");
      $serch->bindValue(':lover2',"%".$word_ex[2]."%");
      $serch->bindValue(':singer2',"%".$word_ex[2]."%");
      $serch->bindValue(':writer2',"%".$word_ex[2]."%");
      $serch->bindValue(':movie2',"%".$word_ex[2]."%");
      $serch->bindValue(':comment2',"%".$word_ex[2]."%");
      $serch->bindValue(':educational_background2',"%".$word_ex[2]."%");
      $kekka=$serch->execute();  
    }else{ //空文字で検索された場合
      $serch=$pdo->prepare('SELECT * FROM personal_data');
      $serch->execute(); 
    }

    $link=1;
    $no_search='no_search';
    $search_friends_data = $serch->fetch(PDO::FETCH_ASSOC);
    if(count($search_friends_data) > 0){
      while($data = $serch->fetch(PDO::FETCH_ASSOC)){
        echo '
    <div class="fbox">
      <div class="friends-image">
        <img width="200" height="200" src="../../img/thumbnail/'.$data['thumbnail'].'">
      </div>
      <div class="f_info">
        <div class="friends_name">
          <form name="" method="get" action="../profile/profile.php">
            <input type="hidden" name="q" value="'.$data['id'].'">
            <p><input class="fr_tab_name" type="submit" value="'.$data['name'].'"></p>
          </form>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    ';
      }
    }else{
      echo'
    <div class="fbox">
      <div id="no_friends">
        <p>検索結果: '.$search_word.' は見つかりません。</p>
        <p>違うワードで再度検索してください。</p>
      </div>
    </div>
      ';
    }
  }catch(PDOException $e){
    echo('Error'.$e->getMessage());
    die();
  }
}
//複数検索　試作
?>
<!--end-->
  </div><!--end friends_all-->

</div><!--end lower_content-->
</div><!--end page_all-->
</div>

<script src="../../style/js/iscroll-min.js"></script>
<script src="../../style/js/jquery.drawer.js"></script>
<script src="../../style/js/side_menu.js"></script> 
</body>
</html>