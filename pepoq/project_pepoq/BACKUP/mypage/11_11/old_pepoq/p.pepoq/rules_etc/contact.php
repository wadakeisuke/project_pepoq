<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>pepoQ</title>
  <link rel="stylesheet" type="text/css" href="css/contact.css">
  <link rel="stylesheet" type="text/css" href="css/blue.css">
  <script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
<script src="../../style/js/jquery.hoverintent.r7.js"></script>
<script src="../../style/js/jquery.mnmenu.js"></script>
<script>
$(document).ready(function() {
  $('#idmenu').mnmenu();
})
</script>
<style type="text/css">
a{
  color: white;
  text-decoration: none;
  -webkit-transition: 0.8s;
  -moz-transition: 0.8s;
  -o-transition: 0.8s;
  -ms-transition: 0.8s;
  transition: 0.8s;
}
a:hover{
  color: steelblue;
}
/*begin header*/
header{
  position: relative;
  width: 100%;
  height: 40px;
  margin: 0 auto;
  padding-top:10px;
  padding-bottom:10px;
  padding-left: 10px;
  background: rgba(38, 38, 38, 0.9);
  -webkit-box-shadow: 0 1px 0 rgba(0,0,0,0.55), inset 0 -1px 0 rgba(255,255,255,0.09);
  -moz-box-shadow: 0 1px 0 rgba(0,0,0,0.55), inset 0 -1px 0 rgba(255,255,255,0.09);
  box-shadow: 0 1px 0 rgba(0,0,0,0.55), inset 0 -1px 0 rgba(255,255,255,0.09);
  z-index: 101;
}
header h1{
  margin: 0;
  color: white;
}
header img{
  margin-right:10px;
}
/*end header*/
p.message{
  font-family:'メイリオ';
}
p.alert{
  color:red;
}
li{
  margin:10px 0 0 20px;
}
</style>
</head>
<body>
<div id="pageall">
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

<div class="sidemenu" style="float:left;background-color:;padding-top:80px;margin-left:50px;">
  <ul>
    <li><a href="rules.html">利用規約</a></li>
    <li><a href="privacy.html">個人情報保護方針</a></li>
    <li><a href="cookie.html">クッキー</a></li>
    <li><a href="help.html">ヘルプ</a></li>
    <li><a href="contact.php">コンタクト</a></li>
  </ul>
</div>

<?php
//メールを送信
if(isset($_POST['submit']))
{
  if($_POST['type']!=''&&$_POST['name']!=''&&$_POST['email']!=''&&$_POST['message'])
  {
    mb_language("japanese");
    mb_internal_encoding("utf-8");
    $type=htmlspecialchars($_POST['type'],ENT_QUOTES,'UTF-8');
    if($type=='report')
    {
      $type='問題の報告';
    }
    if($type=='question')
    {
      $type='質問';
    }
    if($type=='friend')
    {
      $type='協力者';
    }
    if($type=='other')
    {
      $type='その他';
    }
    $name=htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
    $ms=htmlspecialchars($_POST['message'],ENT_QUOTES,'UTF-8');
    $he=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');

    $to = "yk0818kkk@yahoo.co.jp";
    $subject = $type."-".$name."さん";
    $message = $ms;
    $header = "From:".$he;
    if(mb_send_mail($to, $subject, $message, $header))
    {
      $submit='on';
      echo('<p class="message" style="float:left;padding:50px 0 0 0;">メッセージを送信しました。<br>ありがとうございます。</p>');
    }
    else
    {
      echo('<p class="message" style="float:left;padding:50px 0 0 0;">メッセージを送信できませんでした。<br>申し訳ありません。少し時間をあけて再度送信してください。<p>');
    }
  }
  else
  {
    if($_POST['type']=='')
    {
      echo('
        <p class="message alert">※メッセージの種類を選択してください。</p> 
        ');
    }
    if($_POST['name']=='')
    {
      echo('
        <p class="message alert">※User Name　が未入力です。</p> 
        ');
    }
    if($_POST['email']=='')
    {
      echo('
        <p class="message alert">※Email　が未入力です。</p> 
        ');
    }
    if($_POST['message']=='')
    {
      echo('
        <p class="message alert">※Message　が未入力です。</p> 
        ');
    }
  }
}
?>
  <?php
  if(isset($submit)=='on')
  {

  }
  else
  {
    ?>
<div class="form_content" style="background-color:;float:left;padding-top:100px;"><h1>Contact</h1>
<p class="message">問題の報告、質問、協力してくれる方<br>メッセージをお待ちしております。</p><hr>
  <form action="contact.php" method="post" class="forms">
      <ul style="padding-bottom:100px;">
        <li>
          <label>Type:</label><br>
          <select name="type">
            <option <?php if(isset($_POST['type'])==''){ echo('selected'); } ?> value="">メッセージの種類</option>
            <option <?php if(isset($_POST['type'])=='report'){ echo('selected'); } ?> value="report">問題の報告</option>
            <option <?php if(isset($_POST['type'])=='question'){ echo('selected'); } ?> value="question">質問</option>
            <option <?php if(isset($_POST['type'])=='friend'){ echo('selected'); } ?> value="friend">協力してくれる方</option>
            <option <?php if(isset($_POST['type'])=='other'){ echo('selected'); } ?> value="other">その他</option>
          </select><br>
        </li> 
        <li>
          <label>User Name :</label>
          <input type="text" name="name" placeholder="User Name" value="<?php if(isset($_POST['name'])){ echo($_POST['name']); }?>"><br>
        </li> 
        <li>
          <label>Email :</label><input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){ echo($_POST['email']); }?>"><br>
        </li>  
        <li>
          <label>Message :</label>
          <textarea style="max-width:600px;max-height:300px;" name="message" placeholder="Message"><?php if(isset($_POST['message'])){ echo($_POST['message']); }?></textarea>
        </li> 
        <li class="button-row">
          <input type="submit" value="送信" name="submit"/><br>
        </li>
      </ul>
  </form>
  <?php
  }
  ?>
</div>

</div>
</section>
</div>
</body>
</html>