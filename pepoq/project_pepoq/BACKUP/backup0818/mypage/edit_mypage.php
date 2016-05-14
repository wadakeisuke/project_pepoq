<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>コメント</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
*{
	font-family : YuGothic, '游ゴシック', sans-serif;
}
body{
	margin: 0;
	padding: 0;
	background-color:#FFFFE0;
}
textarea{
	width: 90%;
	height: 150px;
    font-size:14px;
    font-family: 'ヒラギノ角ゴ Pro W3', 'Hiragino Kaku Gothic Pro', 'Hiragino Kaku Gothic ProN', 'メイリオ', Meiryo;
    border: 1px solid #B9C9CE;
    border-radius:5px;
    padding: 12px 0.8em;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.2);
}
</style>
</head>
<body>
<div id="page_all" style="">
	<div style="width:100%;background-color:#F5F5F5;height:100%;position:relative;padding-bottom:5%;">
		<div style="position:absolute;top:3%;left:5%;">
			<input type="button" value="キャンセル" onclick="history.back()">
		</div>
		<div style="text-align:center;padding-top:10px;">
			<b>編集してみる</b>
		</div>
		<form method="post" action="../php/edit.php">
		<div style="position:absolute;top:3%;right:5%;">
			<input type="submit" value="編集">
		</div>
		<div style="text-align:center; padding-top:10px;">
	        
				名前<br><input type="text" maxlength="25" name="name" placeholder="<?php echo($_SESSION['mypage']['name']); ?>"><br>
				Twitter<br><input type="text" name="twitter" placeholder="<?php echo($_SESSION['mypage']['twitter']); ?>" value=""><br>
				Facebook<br><input type="text" name="facebook" placeholder="<?php echo($_SESSION['mypage']['facebook']); ?>" value=""><br>      
				Instagram<br><input type="text" name="instagram" placeholder="<?php echo($_SESSION['mypage']['instagram']); ?>" value=""><br>
				Google+<br><input type="text" name="google_plus" placeholder="<?php echo($_SESSION['mypage']['google_plus']); ?>" value=""><br>
				コメント<br><input type="text" name="comment" placeholder="<?php echo($_SESSION['mypage']['comment']); ?>" value=""><br>
				年齢<br>
				<select name="age">
                <option value="" selected>--</option>
                <?php
                  for($id=1;$id<=120;$id++){
                    if($id==$_SESSION['mypage']['age']){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'歳</option>');
                    }
                    echo('<option name="age" value="'.$id.'">'.$id.'歳</option>');
                  }
                ?>
              	</select>
				<br>
				誕生日<br>
              <select name="year">
              <option value="">--</option>
                <?php
                $age=$_SESSION['mypage']['birthday'];
                $birthday=explode('/',$age);
                $year=$birthday[0];
                $month=$birthday[1];
                $day=$birthday[2];

                  for($id=1900;$id<=2020;$id++){
                    if($id==$year){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }
                    echo('<option name="year" value="'.$id.'">'.$id.'</option>');
                  }
                ?>
              </select>年
              <select name="month">
                <option value="">--</option>
                <?php
                  for($id=1;$id<=12;$id++){
                    if($id==$month){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }
                    echo('<option name="month" value="'.$id.'">'.$id.'</option>');
                  }
                ?>
              </select>月
              <select name="day">
                <option value="">--</option>
                <?php
                  for($id=1;$id<=31;$id++){
                    if($id==$day){
                      echo('<option name="year" value="'.$id.'" selected>'.$id.'</option>');
                    }
                    echo('<option name="day" value="'.$id.'">'.$id.'</option>');
                  }
                ?>
              </select>日
				<br>
				住んでいるところ<br><input type="text" name="from" placeholder="<?php echo($_SESSION['mypage']['come_from']); ?>" value=""><br>
				学歴<br><input type="text" name="educational_background"  placeholder="<?php echo($_SESSION['mypage']['educational_background']); ?>"value=""><br>
				就職先<br><input type="text" name="works"  placeholder="<?php echo($_SESSION['mypage']['works']); ?>"value=""><br>
			
		</div>
		</form>
	</div>
</div>
</body>
</html>