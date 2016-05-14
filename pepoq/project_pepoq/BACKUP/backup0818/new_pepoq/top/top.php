<?php
session_start();
//Facebook SDK for PHP の src/ にあるファイルを
//サーバ内の適当な場所にコピーしておく
include_once("../php/facebook/facebook.php");
$config = array(
    'appId'  => '1591688234429114',
    'secret' => 'b89c0b2fd7c4d628331967e1ecf14eea'
);
$facebook = new Facebook($config);
$params = array('redirect_uri' => 'http://standby.sakura.ne.jp/SB/m.sb/top/top.php');
$loginUrl = $facebook->getLoginUrl($params);

//facebookのデータ
  //ログイン済みの場合はユーザー情報を取得
  if ($facebook->getUser()) {
    try {
      $user = $facebook->api('/me','GET');
      $first_name = $user['first_name'];
      $last_name = $user['last_name'];
      $name = $first_name.' '.$last_name;
      $email = $user['id'];
      $password = $email.'-'.$first_name;
      for($num=0;$num<1000;$num++){
        $password = sha1($password);
        $password = md5($password);
      }
      $facebook = $user['link'];
      $pdo = include('../php/db_connect.php');

      //既にサインアップしている場合
      $sql = $pdo->prepare('SELECT * FROM acount WHERE email=:email AND password=:password');
      $sql->bindValue(':email',$email);
      $sql->bindValue(':password',$password);
      $sql->execute();
      if($data = $sql->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['login']['email'] = $email;
        $_SESSION['login']['password'] = $password;
        header('Location: ../mypage/mypage.php');
        exit();
      }else{
        //acountの追加
        $created = date('Y-m-d H:i:s');
        $sql = $pdo -> prepare('INSERT INTO acount (first_name, last_name, email, password, created) VALUES (:first_name, :last_name, :email, :password, :created)');
        $sql->bindValue(':first_name', $first_name);
        $sql->bindValue(':last_name', $last_name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->bindValue(':created', $created);
        $sql->execute();

        //personla_dataの追加
        $rand_num = rand(1,20);
        $value = '--';
        $sql = $pdo -> prepare('INSERT INTO personal_data (email, password, thumbnail, background, name, comment, country, come_from, age, birthday, educational_background, works, lover, singer, writer, movie, twitter, facebook, instagram, google_plus) VALUES (:email, :password, :thumbnail, :background, :name, :comment, :country, :come_from, :age, :birthday, :educational_background, :works, :lover, :singer, :writer, :movie, :twitter, :facebook, :instagram, :google_plus)');
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->bindValue(':thumbnail', 'thumbnail.jpg');
        $sql->bindValue(':background', 'background'.$rand_num.'.jpg');
        $sql->bindValue(':name', $name);
        $sql->bindValue(':comment', $value);
        $sql->bindValue(':country', $value);
        $sql->bindValue(':come_from', $value);
        $sql->bindValue(':age', $value);
        $sql->bindValue(':birthday', $value);
        $sql->bindValue(':educational_background', $value);
        $sql->bindValue(':works', $value);
        $sql->bindValue(':lover', $value);
        $sql->bindValue(':singer', $value);
        $sql->bindValue(':writer', $value);
        $sql->bindValue(':movie', $value);
        $sql->bindValue(':twitter', $value);
        $sql->bindValue(':facebook', $facebook);
        $sql->bindValue(':instagram', $value);
        $sql->bindValue(':google_plus', $value);
        $sql->execute();
        $_SESSION['login']['email'] = $email;
        $_SESSION['login']['password'] = $password;
        header('Location: ../mypage/mypage.php');
        exit();
      }
    } catch(FacebookApiException $e) {
      //取得に失敗したら例外をキャッチしてエラーログに出力
      error_log($e->getType());
      error_log($e->getMessage());
    }
  }
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name=viewport content="width=device-width, initial-scale=1">
<title>popoQ</title>
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="style/css/style.css"　type="text/css">


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63842415-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<!--begin Pageall-->
<div id="pageall">
  <!--begin header-->
  <header>
      <div class="tophead">
        <div class="header_logo f_left"><p>popoQ</p></div>
        <div class="header_login f_left"><p><a href="../login/login.php">log in</a></p></div>
      </div>
  </header>
  <!--end header-->
  <!--start content-->
  <div class="content">
    <div class="top_rec" style="background-image:url(style/img/head.gif)">
      <div class="top_rec_box blur">
        <div class="top_rec_text">
        <div class="text_fix">
          <p class="hello_p">Hello,</p>
          <p>We can answer whatever you imagine</p>
          <p class="jap"><i class="fa fa-tag"></i>みんなでつくる便利でうれしい知恵の共有サービス。</p>
        </div>
        </div>
        <div class="top_join">
          <p><a href="../signup/signup.php">join for free</a></p>
        </div>
      </div>
      <?php
      echo '
      <div class="fb_twt">
        <div class="fb f_left"><a href="' . $loginUrl . '"><i class="fa fa-facebook-official sns_font"></i></a></div>
        <div class="twt f_left"><a href="' . $loginUrl . '"><i class="fa fa-twitter sns_font"></i></a></div>
      </div>
      ';
      ?>
    </div>
    <div class="intro">
      <div class="text_fix">
      <p>
      </p>
      <p class="jap"><i class="fa fa-tag"></i>他人の評価を気にしすぎてしまうあなたへ</p>
      </div>
    </div>
    <div class="top_boxs">
      <div class="top_box">
        <div class="top_img"><img src="style/img/img01.gif"></div>
        <div class="top_item">
          <div class="text_fix">
          <p>Create your own profile and it's all right
        </p>
        <p class="jap"><i class="fa fa-tag"></i>そこには”あなただけの”プロフィールがある</p>
        </div>
        </div>
      </div>
      <div class="top_box">
        <div class="top_img"><img src="style/img/img02.gif"></div>
        <div class="top_item">
        <div class="text_fix">
          <p>Find a frends　and say hello,
        </p>
        <p class="jap"><i class="fa fa-tag"></i>友達をみつける</p>
        </div>
        </div>
      </div>
      <div class="top_box">
        <div class="top_img"><img src="style/img/img03.gif"></div>
        <div class="top_item">
        <div class="text_fix">
          <p>See your friend's page and smile smile smile.......
        </p>
        <p class="jap"><i class="fa fa-tag"></i>友達のページを見てみよう</p>
        </div>
        </div>
      </div>
    </div>
    <div class="outro">
    <div class="text_fix">
      <p>Our concept , Anything is possible if you can imagine it!
      </p>
      <p class="jap"><i class="fa fa-tag"></i>想像から創造は生まれる</p>
    </div>
    </div>
    <div class="last_signup_rec" style="background-image:url(style/img/last.gif)">
    <div class="text_fix">
      <p class="last_signup_rec_p">Create your page</p>
    </div>
      <div class="last_join">
        <p><a href="../confirm/confirm.php">join for free</a></p>
      </div>
      <?php
      echo '
      <div class="fb_twt">
        <div class="fb f_left"><a href="' . $loginUrl . '"><i class="fa fa-facebook-official sns_font"></i></a></div>
        <div class="twt f_left"><a href="' . $loginUrl . '"><i class="fa fa-twitter sns_font"></i></a></div>
      </div>
      ';
      ?>
    </div>
    <div class="clear"><!--Bigin footer-->
      <div id="footer">
        <ul>
          <li><a href="../login/login.php">login</a></li>
          <li><a href="../signup/signup.php">sign up</a></li>
          <li><a href="../rules/rules.html">利用規約</a></li>
          <li><a href="../rules/privacy.html">プライバシーポリシー</a></li>
          <li><a href="../rules/cookie.html">Cookieについて</a></li>
          <li><a href="../rules/help.html">About us</a></li>
          <li><a href="#">Follow us</a></li>
        </ul>
      </div>
      <div class="copy_r">
        <small>©2015/05/16 popoQ. All Rights Reserved.</small>
      </div>
    </div><!--End footer-->
  </div>
  <!--end content-->
</div>
<!--end Pageall-->
</body>
</html>
