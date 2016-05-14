<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>popoQ</title>
<link rel="stylesheet" href="style/style.css">
</head>
<body>
<!--begin Pageall-->
<div id="pageall">
  <!--begin section-->
  <section>
    <!--begin header-->
    <header>
      <img src="../../img/logo.png"><p>お問い合わせ</p>
    </header>
    <!--end header-->

<div id="menu" style="">
  <ul>
    <li><a href="rules.html">利用規約</a></li>
    <li><a href="privacy.html">プライバシー保護方針</a></li>
    <li><a href="cookie.html">クッキー</a></li>
    <li><a href="help.html">help</a></li>
    <li class="selected"><a href="contact.php">contact</a></li>
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
      echo('<p class="message" style="padding:50px 0 0 0;">メッセージを送信しました。<br>ありがとうございます。</p>');
    }
    else
    {
      echo('<p class="message" style="padding:50px 0 0 0;">メッセージを送信できませんでした。<br>申し訳ありません。少し時間をあけて再度送信してください。<p>');
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
<div class="form_content" style=""><h1>Contact</h1>
<p class="message">問題の報告、質問、協力してくれる方<br>メッセージをお待ちしております。</p><hr>
  <form action="contact.php" method="post" class="forms">
      <ul>
        <li>
          <select name="type">
            <option <?php if(isset($_POST['type'])==''){ echo('selected'); } ?> value="">メッセージの種類</option>
            <option <?php if(isset($_POST['type'])=='report'){ echo('selected'); } ?> value="report">問題の報告</option>
            <option <?php if(isset($_POST['type'])=='question'){ echo('selected'); } ?> value="question">質問</option>
            <option <?php if(isset($_POST['type'])=='friend'){ echo('selected'); } ?> value="friend">協力してくれる方</option>
            <option <?php if(isset($_POST['type'])=='other'){ echo('selected'); } ?> value="other">その他</option>
          </select><br>
        </li> 
        <li>
          <input type="text" name="name" placeholder="User Name" value="<?php if(isset($_POST['name'])){ echo($_POST['name']); }?>"><br>
        </li> 
        <li>
          <input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){ echo($_POST['email']); }?>"><br>
        </li>  
        <li>
          <textarea style="" name="message" placeholder="Message"><?php if(isset($_POST['message'])){ echo($_POST['message']); }?></textarea>
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