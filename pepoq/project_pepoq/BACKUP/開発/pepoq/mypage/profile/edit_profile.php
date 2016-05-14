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
<link rel="stylesheet" type="text/css" href="./css/edit_style.css">
<!--loading-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(function() {
  var h = $(window).height();
 
  $('#wrap').css('display','none');
  $('#loader-bg ,#loader').height(h).css('display','block');
});
 
$(window).load(function () { //全ての読み込みが完了したら実行
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
  $('#wrap').css('display', 'block');
});
 
//10秒たったら強制的にロード画面を非表示
$(function(){
  setTimeout('stopload()',10000);
});
 
function stopload(){
  $('#wrap').css('display','block');
  $('#loader-bg').delay(900).fadeOut(800);
  $('#loader').delay(600).fadeOut(300);
}
</script>
<!--loading-->
</head>
<body>
<div id="loader-bg">
  <div id="loader">
    <img src="../../img/img-loading.gif" width="80" height="80" alt="Now Loading..." />
    <p>Now Loading...</p>
  </div>
</div>
<div id="wrap">
<div id="page_all" style="">

  <!-- begin header_all-->
  <div id="header_all">     
    <div id="upper_header">
      <div id="page_back">
        <a onclick="history.back()"><i class="fa fa-angle-left icon"></i></a>
      </div>
      <div id="page_title">編集</div>
    </div>

  </div>
  <!--end header_all-->
    <div class="content">
    <form method="post" action="../../php/edit.php" enctype="multipart/form-data">

        <div class="c_box fl">  
          <label>名前</label><br>
          <input type="text" maxlength="25" name="name" placeholder="<?php echo($_SESSION['mypage']['name']); ?>"><br>
        </div>
        <div class="c_box fl">  
          <div class="uploadButton">
            ファイルを選択
            <input name="file[]" type="file" onchange="uv.style.display='inline-block'; uv.value = this.value;" />
            <input type="text" id="uv" class="uploadValue" disabled />
          </div>
        </div>
        <div class="c_box fl">
        <label>年齢</label><br>
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
        </div>
        <div class="select_fl">
          <label>誕生日</label><br>

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
          </div>
        <div class="c_box fl">
          <label>住んでいるところ</label><br>
          <input type="text" name="from" placeholder="<?php echo($_SESSION['mypage']['come_from']); ?>" value=""><br>
        </div>
        <div class="c_box fl">
          <label>学歴</label><br>
          <input type="text" name="educational_background"  placeholder="<?php echo($_SESSION['mypage']['educational_background']); ?>"value=""><br>
        </div>
        <div class="c_box fl">
          <label>就職先</label><br>
          <input type="text" name="works"  placeholder="<?php echo($_SESSION['mypage']['works']); ?>"value=""><br>
        </div>
        <div class="c_box fl">
          <label>好きな歌手</label><br>
          <input type="text" name="singer"  placeholder="<?php echo($_SESSION['mypage']['singer']); ?>"value=""><br>
        </div>
        <div class="c_box fl">
          <label>好きな小説家</label><br>
          <input type="text" name="writer"  placeholder="<?php echo($_SESSION['mypage']['writer']); ?>"value=""><br>
        </div>
        <div class="c_box fl">
          <label>好きな映画</label><br>
          <input type="text" name="movie"  placeholder="<?php echo($_SESSION['mypage']['movie']); ?>"value=""><br>
        </div>
        <div class="c_box fl">
          <label>好きな人</label><br>
          <input type="text" name="lover"  placeholder="<?php echo($_SESSION['mypage']['lover']); ?>"value=""><br>
        </div>
        <div class="c_box fl">
          <label>コメント</label><br>
          <input type="text" name="comment" placeholder="<?php echo($_SESSION['mypage']['comment']); ?>" value=""><br>
        </div>
        <div class="c_box fl">
          <input type="submit" value="編集">
        </div>
    </form>
    </div>
  </div>
</div>
</body>
</html>