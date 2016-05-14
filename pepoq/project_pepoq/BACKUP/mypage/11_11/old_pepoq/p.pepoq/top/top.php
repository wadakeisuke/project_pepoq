<?php
require('../php/login.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>pepoQ</title>
	<meta name="description" content="プロフィールサイト、pepoQ。pepoQは人間関係をデザインし、より鮮明にする新しい形のプロフィールサイト「pepoQ」。基本的なプロフィール、SNSへのリンクそしてあなたの友達がプロフィールの一部となり、そしてあなた自身も友人たちのプロフィールの一部となります。">
	<meta name="keywords" content="プロフィール,プロフィールサイト,プロフ,pepoQ,pepoQ">
	<meta name="robots" content="ALL">
	<link rel="stylesheet" type="text/css" href="style/css/top.css">
	<link rel="stylesheet" type="text/css" href="style/css/blue.css">
	<script type="text/javascript" src="../../style/js/jquery-1.7.2.min.js"></script>
	<script src="../../style/js/jquery.hoverintent.r7.js"></script>
	<script src="../../style/js/jquery.mnmenu.js"></script>
	<script>
	$(document).ready(function() {
	  $('#idmenu').mnmenu();
	})
	</script>

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
<!--begin section-->
<section>
  <!--begin header_all-->
  <div id="header_all">
    <div id="header">
      <div id="logo">
        <a href="../php/logout.php"><img src="../../img/logo.png"></a>
      </div>
      <div id="sb_info">
	  	<h1>友達から紹介文を書いてもらおう</h1>
	    <p id="description">
			pepoQは人間関係をデザインし、より鮮明にする新しい形のプロフィールサイトです<br>
			あなたの親密な人たちがプロフィールの一部となり、そしてあなた自身も友人たちのプロフィールの
	    </p>
	  </div>
    </div>
  </div>
  <!--end header_all-->
	<!--begin content-->
	<div id="content">
		<!--begin sb_info-->
		<!--end sb_info-->
		<!--begin login_and_signup-->
		<div id="login_and_signup">
			<!--begin login-->
			<div class="f_float">
			<div id="login">
			<p>Login</p><hr>
				<form action="top.php" method="post">
					<input name="email" class="form" type="email" placeholder="Email" value="<?php echo $my_email; ?>"><br>
					<input name="password" class="form" type="password" placeholder="Password"><br>
					<input name="login" type="submit" value="Login">
					<input type="checkbox" name="save" value="on">保存する<br>
					<p class="alert">パスワードを忘れた場合は<a href="#">こちら</a></p>
				</form>
			</div>
			</div>
			<!--end login-->
			<!--begin signup-->
			<div class="f_float">
			<div id="signup">
        		<p>pepoQ始めませんか？</p><hr>
				<form action="../confirm/confirm.php" method="post">
					<input name="first_name" class="form" type="text" placeholder="Firstname"><br>
        			<input name="last_name" class="form" type="text" placeholder="Lastname"><br>
					<input name="email" class="form" type="email" placeholder="Email"><br>
					<input name="password" class="form" type="password" placeholder="Password"><br>
       		 		<p class="alert">SBに登録するをクリックすることで、当サイトの<a href="../rules_etc/rules.html">利用規約</a>及び<a href="../rules_etc/cookie.html">Cookieの使用</a>を含む<a href="../rules_etc/privacy.html">データの使用</a>に関するポリシーに同意するものとします。</p>
					<input type="submit" value="SBに登録する"><br>
				</form>
			</div>
			</div>
			<!--end signup-->
		</div>
		<!--end login_and_signup-->
	</div>
	<!--end content-->
	<!--begin footer-->
	<div id="footer">
		<!--begin footer_content-->
		<div id="footer_content">
			<div id="footer_about">
		        <ul>
		        　<li><a href="../about/about.html">pepoQについて</a></li>     
		          <li><a href="../rules_etc/rules.html">利用規約</a></li>
		          <li><a href="../rules_etc/privacy.html">個人情報保護方針</a></li>
		          <li><a href="../rules_etc/cookie.html">クッキー</a></li>
		          <li><a href="../rules_etc/help.html">ヘルプ</a></li>
		          <li><a href="../rules_etc/contact.php">コンタクト</a></li>
		          <li><a href="../rules_etc/contact.php">問題の報告</a></li>
		          <li><a href="../rules_etc/contact.php">協力者募集</a></li>
		        </ul>
			</div>
		</div>
		<!--end footer_content-->
		<!--begin copyright-->
		<div id="copyright">
			<p>Copyright(c)　pepoQ all rights reserved. 2014 </p>
		</div>
		<!--end copyright-->
	</div>
	<!--end footer-->
</section>
<!--end section-->
</div>
<!-- End Pageall-->
</body>
</html>