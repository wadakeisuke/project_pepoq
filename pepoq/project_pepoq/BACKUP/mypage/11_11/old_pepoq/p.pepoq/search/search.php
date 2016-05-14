<?php
//friend_serch.php バックアップ
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
//ログインしていない場合、トップページへ飛ばす
if(!isset($_SESSION['login']['email'])||!isset($_SESSION['login']['password'])){
  header('Location: ../top/top.php');
  exit();
}
try{
  $pdo=require('../../php/db_connect.php');
  //login DB personal_data　を取得
  $stmt=$pdo->prepare('SELECT * FROM personal_data WHERE email = :email AND password = :password');
  $stmt->bindValue(':email',$_SESSION['login']['email']);
  $stmt->bindValue(':password',$_SESSION['login']['password']);
  $stmt->execute();
  //mypageのpersonal_dataをsessionに保存 
  if($data=$stmt->fetch(PDO::FETCH_ASSOC)){
    $_SESSION['mypage'] = $data;
  }
}catch(PDOException $e){
  echo('Error'.$e->getMessage());
  die();
}

//全ての友達の数
$w_friend='all';
$ac_email=$_SESSION['mypage']['email'];
$sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend',$w_friend);
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$count=$sql->rowCount();
$f_all_num=$count;

//友達リクエストの数
$w_friend='request';
$ac_email=$_SESSION['mypage']['email'];
$sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email');
$sql->bindValue(':w_friend',$w_friend);
$sql->bindValue(':ac_email',$ac_email);
$sql->execute();
$count=$sql->rowCount();
$f_request_num=$count;

//友達のタイプ毎の数を取得
$array=array('家族','恋人','小・中学校','高校','大学・専門','勤務先','その他',);
$f_type_num=array();//初期化
$i=0;
while(count($array)>$i){
  $sql=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:ac_email AND relation=:relation');
  $sql->bindValue(':w_friend','all');
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

//friends data
//全ての友達を取得
$allf_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_password=:ac_password AND accepter_email=:ac_email');
$allf_data->bindValue(':w_friend','all');
$allf_data->bindValue(':ac_password',$_SESSION['mypage']['password']);
$allf_data->bindValue(':ac_email',$_SESSION['mypage']['email']);
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
$allf_data->bindValue(':sender_password',$_SESSION['mypage']['password']);
$allf_data->bindValue(':sender_email',$_SESSION['mypage']['email']);
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
$newf_data->bindValue(':ac_password',$_SESSION['mypage']['password']);
$newf_data->bindValue(':ac_email',$_SESSION['mypage']['email']);
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
for($i=0;$i<10;$i++){
  foreach($ar_data as $name => $value){
    $ar['family'][$i][$name]=$value;
  }
}
foreach($ar_data as $name => $value){
  $ar['lover'][2][$name]=$value;
}
foreach($ar_data as $name => $value){
  $ar['school'][3][$name]=$value;
}
$db_friends_data_all=array();
foreach($friends_type as $name => $value){
  $db_friends_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_password=:ac_password AND accepter_email=:ac_email AND relation=:relation');
  $db_friends_data->bindValue(':w_friend','all');//そのまま
  $db_friends_data->bindValue(':ac_password',$_SESSION['mypage']['password']);//そのまま
  $db_friends_data->bindValue(':ac_email',$_SESSION['mypage']['email']);//そのまま
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
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="all" href="style/css/serch_style.css">
<link rel="stylesheet" type="text/css" media="all" href="style/css/comment_popup.php">

<link rel="stylesheet" type="text/css" href="style/css/blue.css">
<!--box 移動-->
<script type="text/javascript" src="style/js/jquery-1.7.2.min.js"></script>

<script src="style/js/jquery.hoverintent.r7.js"></script>
<script src="style/js/jquery.mnmenu.js"></script>
<script>
$(document).ready(function() {
  $('#idmenu').mnmenu();
})
</script>

<script type='text/javascript' src='style/js/jquery.masonry.min.js'></script>
<script type='text/javascript' src='style/js/masonry-style.js'></script>
<script src="style/js/jquery.leanModal.min.js" type="text/javascript"></script>

<!--box 移動-->

<script type="text/javascript">
$(document).ready(function() {
  var pagetop = $('.pagetop');
  $(window).scroll(function () {
    if ($(this).scrollTop() > 700) {
      pagetop.fadeIn();
    } else {
      pagetop.fadeOut();
    }
  });
  pagetop.click(function () {
    $('body, html').animate({ scrollTop: 0 }, 500);
    return false;
  });
});
</script>
<!--leanModal popupwindow (friend)-->
<script type="text/javascript">
$(function() {
    $( 'a[rel*=leanModal]').leanModal({
        top: 50,                     // モーダルウィンドウの縦位置を指定
        overlay : 0.7,               // 背面の透明度 
    });
}); 
</script>
<!--leanModal popupwindow (friend)-->

</head>
<body>
<!--begin page_all-->
<div id="page_all">
<?php
//header
require('../mypage/m.header.php');
?>


<div id="content">
  <!--begin serch format-->

  <!--begin serch_result_formt-->
  <div id="serch_result" style="color:black;">
  
    <!--begin friends_all-->
    <div id="friend_s">
      <form action="./search.php" method="post">
        <div style="float:left;">
        <input type="text" name="serch" placeholder="Serch Friends" value="<?php echo $_POST['serch']; ?>" maxlength="50" style="padding:5px 5px 5px 10px;font-size:30px;width:900px;height:50px;border:none;border-bottom:solid 1px rgba(20,20,20,0.4);border-right:solid 1px rgba(20,20,20,0.4);">
        </div>
        <div style="float:left;"><button type="submit" style="float:left;background-color:;width:70px;height:70px;font-size:50px;background-color:white;border:none;">
                          <i class="fa fa-search"></i>
                        </button></div>
      </form>
    </div>
    <div id="friends_all">


    
<?php
if(isset($_POST['serch'])){
  $serch_word=htmlspecialchars($_POST['serch'],ENT_QUOTES,'UTF-8');
  $word_piece = mb_convert_kana($serch_word, 'as', 'UTF-8'); //全角を半角に変換
  $word_ex=explode(' ',$word_piece); //スペース毎に区切り配列化
  $array_count=count($word_ex); //複数検索された単語の数を取得
  if($array_count>3){
    while($array_count<4){
      array_pop($array_count);
    }
  }
  try{
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
    $no_serch='no_serch';

    while($friends_all = $serch->fetch(PDO::FETCH_ASSOC)){
      $personal_id=$friends_all['id'];
      $no_serch='serch';
      $comment = trim($friends_all['comment']);
      $comment = str_replace(" ", ".", $comment);
      $comment = str_replace("　", ".", $comment);
      $comment = preg_replace('/(\s|　)/','',$comment);
      $comment = mb_substr($comment, 0, 184);
      echo('
      <div class="fbox">
        <div style="position:relative;">
        <div class="friends-image">
          <img width="300" height="300" src="../../img/thumbnail/'.$friends_all['thumbnail'].'">
        </div> 
        <div class="friends_name" style="position:absolute;bottom:7px;width:250px;">
          <form method="post" action="../profile/profile.php">
            <input type="hidden" name="profile_id" value="'.$personal_id.'">
            <input type="submit" style="border:none;color:white;" value="'.$friends_all['name'].'"> 
        </div>
        </div>
          <div class="comment" style="width:300px;max-height:150px;min-height:150px;color:black;">'.$comment.'・・・<br><span><input type="submit" style="position:absolute;bottom:0;border:none;color:black;width:100%;height:20px;" value="more"> <span></div>
          </div>
      </form>
        ');
     $link++;
    }

    if($no_serch!=='serch'){
      echo'
      <div>
      <div id="no_friends">
        <p>検索結果: '.$serch_word.' は見つかりません。</p>
        <p>違うワードで再度検索してください。</p>
      </div>
      <div>
      ';
    }
  }catch(PDOException $e){
    echo('Error'.$e->getMessage());
    die();
  }
}
//複数検索　試作
?>
 

    </div>
    <!--end friends_all-->
  </div>
</div>
<!--end content-->
</div>
<!--end page_all-->
</div>
<!--end page_all-->
  <!--begin footer_all-->
  <div id="footer_all">
      <div id="copyright">
        <small>COPYRIGHT ©　pepoQ ALL RIGHTS RESERVED. 2015 -</small>
      </div>
  </div>
  <!--end footer-->
</body>
</html>