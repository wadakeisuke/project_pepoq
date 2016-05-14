<?php
session_start();
if(!isset($_SESSION['signup'])=='signup'){
  header('../top/top.php');
  exit();
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>StandBy</title>
    <link rel="stylesheet" href="style/css/thanks.css">
    <link rel="stylesheet" type="text/css" href="style/css/blue.css">
<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<script src="../../style/js/jquery.hoverintent.r7.js"></script>
<script src="../../style/js/jquery.mnmenu.js"></script>
<script>
$(document).ready(function() {
  $('#idmenu').mnmenu();
})
</script>
  </head>
<body>
<!--begin Pageall-->
<div id="pageall">
  <!--begin section-->
  <section>
  <!--begin header_all-->
  <div id="header_all">
    <div id="header">
      <div id="logo">
        <a href="../php/logout.php"><img src="../../img/logo.png"><img src="../../img/standby_letter.png" style="width:150px;"></a>
      </div>
    </div>
  </div>
  <!--end header_all-->
      <div id="content" style="padding-top:200px;">
        <h1>Wellcome to Stand By </h1>
        <p>ログインして、あなただけのプロフィールを作りましょう</p><br><br>
        <p id="login"><a href="../top/top.php">Login</a></p>
      </div>
      <div id="footer">
         <p>Copyright © pepoQ All Rights Reserved. 2014</p>
      </div>
  </section>
  <!--end section-->
</div>
<!--end pageall-->
</body>
</html>