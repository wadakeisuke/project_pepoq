<?php
include('../php/db_connect.php');
$login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8');
$user = htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

if($login != '' && $user != '' && $password != '') {
  include('../../php/db_connect.php');
  $sql = $pdo->prepare('SELECT * FROM pepoq WHERE user = :user AND password = :password');
  $sql->bindValue(':user', $user);
  $sql->bindValue(':password', $password);
  $sql->execute();
  if ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
    header('Location: success.php');
    exit;
  } else {
    header('Location: index.php?error=on');
    exit;
  }
}

?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name=viewport content="width=device-width, initial-scale=1">
<title>pepoQ管理ページ</title>
<style type="text/css">
body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  text-align: center;
}
</style>
<!--start google analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69530483-1', 'auto');
  ga('send', 'pageview');

</script>
<!--end google analytics-->
</head>
<body>
<!--begin Pageall-->
<div id="pageall">
  <!--start content-->
  <div class="content">
    <h1>pepoq管理ページ</h1>
    <?php if($_GET['error'] == 'on') { ?>
    <?php echo'<p style="color:red;">ログインできません</p>'; ?>
    <?php } ?>
    <form method="post" action="index.php">
      <input type="text" name="user" placeholder="user" required><br>
      <input type="text" name="password" placeholder="password" required><br>
      <input type="submit" name="login" value="ログイン">
    </form>
  </div>
  <!--end content-->
</div>
<!--end Pageall-->
</body>
</html>
