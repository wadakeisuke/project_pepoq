<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.css" />
  <link rel="stylesheet" href="style/css/style.css"　type="text/css">
  <script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>  
  <title>ログイン</title>
</head>
<body>
<!--begin Pageall-->
<div id="pageall">
  <!--begin header-->
  <header>
    <img src="../img/logo.png"><p>ログイン</p>
  </header>
  <!--end header-->
  <!--begin content-->
  <div id="content">
    <div id="login"> 
      <div id="form_content" data-role="content">
        <form action="../php/user_login.php" method="post" data-ajax="false">               
          <input name="email" type="text" placeholder="メールアドレス"><br>
          <input name="password" type="password" placeholder="パスワード"><br>
          <input name="login" type="submit" value="ログイン"><br>
          <a href="../signup/signup/signup.php" data-ajax="false">
            <input type="button" value="アカウントを作成">
          </a>
        </form>
      </div>
    </div>
    <!--end login-->
  </div>
  <!--end content-->
</div>
<!-- End Pageall-->
</body>
