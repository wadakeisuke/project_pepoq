<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <title>ログイン</title>
  <link rel="stylesheet" href="style/css/style.css"　type="text/css">
</head>
<body>
<!--begin Pageall-->
<div id="pageall">
  <!--begin section-->
  <section>
    <!--begin header-->
    <header>
      <img src="../../img/logo.png"><p>log in</p>
    </header>
    <!--end header-->
    <!--begin content-->
    <div id="content">
      <!--begin login_and_signup-->
      <div id="login_and_signup">
        <!--begin login-->
        <div id="login">
          <form action="../php/user_login.php" method="post">
            <input name="email" class="form" type="email" placeholder="Email"><br>
            <input name="password" class="form" type="password" placeholder="Password"><br>
            <input name="login" type="submit" value="Login">
          </form>
        </div>
        <!--end login-->
        <!--begin signup-->
        <div id="signup">
          <p style=""><a href="../confirm/confirm.php">アカウントを作成する</a></p>
        </div>
        <!--end signup-->
      </div>
      <!--end login_and_signup-->
    </div>
    <!--end content-->
  </section>
  <!--end section-->
</div>
<!-- End Pageall-->
</body>