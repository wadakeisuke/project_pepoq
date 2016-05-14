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
          <label>ニックネーム</label><br>
          <input type="text" maxlength="25" name="name" placeholder="<?php echo($_SESSION['mypage']['name']); ?>"><br>
        </div>

        <div class="c_box fl">
          <label>ひとこと</label><br>
          <input type="text" name="comment" style="" placeholder="<?php echo($_SESSION['mypage']['comment']); ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>サムネイル</label><br>
          <div class="uploadButton">
            ファイルを選択
            <input name="file[]" type="file" onchange="uv.style.display='inline-block'; uv.value = this.value;" />
            <input type="text" id="uv" class="uploadValue" disabled />
          </div>
        </div>




        <!--
        sex 性別
        age 年代
        blood_type 血液型
        -->
        <div class="c_box fl">
          <?php
          $sex_list = [
            '男性',
            '女性',
            'どちらでもない',
          ];
          ?>
          <label>性別</label><br>
          <select name="sex">
            <option value="">--</option>
            <?php foreach ($sex_list as $key => $value) { ?>
              <?php if ($value == $_SESSION['mypage']['sex']) { ?>
                <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
              <?php } else { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
        </div>

        <div class="c_box fl">
          <?php
          $age_list = [
            '10代',
            '20代',
            '30代',
            '40代',
            '50代',
            '60代',
            '70代',
            '80代',
          ];
          ?>
          <label>年代</label><br>
          <select name="age">
            <option value="" selected>--</option>
            <?php foreach ($age_list as $key => $value) { ?>
              <?php if ($value == $_SESSION['mypage']['age']) { ?>
                <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
              <?php } else { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
        </div>

        <div class="c_box fl">
          <?php
          $blood_type_list = [
            'A型',
            'B型',
            'O型',
            'AB型',
            'わからない',
          ];
          ?>
          <label>血液型</label><br>
          <select name="blood_type">
            <option value="">--</option>
            <?php foreach ($blood_type_list as $key => $value) { ?>
              <?php if ($value == $_SESSION['mypage']['blood_type']) { ?>
                <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
              <?php } else { ?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
        </div>

        
        <!--
        settlement 住んでいるところ
        alma_mater 学校
        job 仕事
        place_of_work 働いているところ
        -->
        <div class="c_box fl">
          <label>住んでいるところ</label><br>
          <input type="text" name="settlement" placeholder="<?php echo $_SESSION['mypage']['settlement']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>学校</label><br>
          <input type="text" name="school" placeholder="<?php echo $_SESSION['mypage']['school']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>仕事</label><br>
          <input type="text" name="job" placeholder="<?php echo $_SESSION['mypage']['job']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>働いているところ</label><br>
          <input type="text" name="place_of_work" placeholder="<?php echo $_SESSION['mypage']['place_of_work']; ?>" value=""><br>
        </div>


        <!--
        hobby 趣味
        special_skill 特技
        my_boom マイブーム
        dream 夢
        -->
        <div class="c_box fl">
          <label>趣味</label><br>
          <input type="text" name="hobby" placeholder="<?php echo $_SESSION['mypage']['hobby']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>特技</label><br>
          <input type="text" name="special_skill" placeholder="<?php echo $_SESSION['mypage']['special_skill']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>マイブーム</label><br>
          <input type="text" name="my_boom" placeholder="<?php echo $_SESSION['mypage']['my_boom']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>夢</label><br>
          <input type="text" name="dream" placeholder="<?php echo $_SESSION['mypage']['dream']; ?>" value=""><br>
        </div>


        <!--
        favorite_movie 好きなスポーツ
        favorite_singer 好きな歌手
        favorite_book 好きな本
        favorite_animation 好きな映画
        favorite_sports 好きなアニメ 
        -->
        <div class="c_box fl">
          <label>好きなスポーツ</label><br>
          <input type="text" name="favorite_sports" placeholder="<?php echo $_SESSION['mypage']['favorite_sports']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>好きな歌手</label><br>
          <input type="text" name="favorite_singer" placeholder="<?php echo $_SESSION['mypage']['favorite_singer']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>好きな本</label><br>
          <input type="text" name="favorite_book" placeholder="<?php echo $_SESSION['mypage']['favorite_book']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>好きな映画</label><br>
          <input type="text" name="favorite_movie" placeholder="<?php echo $_SESSION['mypage']['favorite_movie']; ?>" value=""><br>
        </div>

        <div class="c_box fl">
          <label>好きなアニメ</label><br>
          <input type="text" name="favorite_animation" placeholder="<?php echo $_SESSION['mypage']['favorite_animation']; ?>" value=""><br>
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