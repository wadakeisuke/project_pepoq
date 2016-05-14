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
  padding:0;margin:0;
    -webkit-appearance:none;
}
body{
  background:#ecf0f1;;
}
.c_box{
  min-height:40px;
  padding:0 0 10%;
  width:80%;
  margin:0 10%;
}
/*begin header*/
#header_all{
  position:fixed;
  width:100%;
  z-index: 10000;
}
#upper_header{
  background-color:#CC3333;
  height:30px;
  line-height:30px;
}
#page_back{
  float:left;
  width:10%;
  text-align:center;
}

#page_title{
  color: white;
  text-align:center;
  float:left;
  font-size:16px;
  width:80%;
  padding-right:10%;
}

#header_menu{
  height:30px;
  clear:both;
  background-color:gray;
  width:100%;
  clear:both;
  text-align:center;
}
#menu_search_friend{
  float:left;width:33%;height:20px;padding-top:5px;padding-bottom:5px;background-color:dimgray;
}
#menu_search_group{
  float:left;width:34%;height:20px;padding-top:5px;padding-bottom:5px;background-color:;color:red;
}
#menu_search_question{
  float:left;width:33%;height:20px;padding-top:5px;padding-bottom:5px;background-color:;color:silver;
}
.icon{
  font-size: 20px;
  color: white;
}
.menu_icon{
  font-size: 20px;
  color:silver;
}
#search_form{
  padding:5px 10px 5px 10px;background-color:#585858;
}
#search_form input{
  border:none;padding:5px 3px 5px 3px;color:black;background-color:#BDC3C7;font-size:16px;width:95%;
}
.active{
  color:white;
}
/*end header*/
/*bigin form*/
.content{
  padding-top:30px;
  height:100%;
  width:100%;
}
#form{padding:10px;}
label{
  background:;
  border-radius:3px;
  padding:3px;
  margin:3px;
}
select{
  background:white;
}
input.input_style{width:60%;}
input{
  margin:10px 0 0 0;
  font-size: 18px;
  position:absolute;
  background:white;
    -webkit-appearance:none;
}
input[type=text],input[type=email],input[type=password], select { 
  outline: none;
  width:200px;
  height: 40px;
  padding: 0 3px;
  border:none;
  -webkit-appearance:none;
}
input[type=text],input[type=email],input[type=password]{
  width: 200px;
  height: 40px;
  padding: 0 3px;
  border:none;
  -webkit-appearance:none;
}
input[type=submit]{
  height: 40px;
  padding: 0 3px;
  cursor: pointer;
  color:white;
  border:none;
  -webkit-appearance:none;
  width:180px;
  background:#d61e44;

}
input[type=file]{
  width: 200px;
  height: 40px;
  padding: 0 3px;
  border:none;
  -webkit-appearance:none;

}
input.submit{
  background:#c0392b;
}
.submit2{
  height: 40px;
  padding: 0 3px;
  cursor: pointer;
  color:white;
  border:none;
  -webkit-appearance:none;
  width:180px;
  background:black;
}
.submit_2btn{
  height:40px;
  width:300px;
  color:white;
  border:none;
  -webkit-appearance:none;
  background:red;
  text-align:center;

}
.text-danger{
  font-size: 15px;
  padding:5px;
  position: relative;
  height: 100%;
  color: white;
  background-color: rgba(255,101,12,0.7);
  text-align: center;
  top:10px;
  left:200px;
  border:hidden 1px rgba(255,101,12,0.7);
  border-radius: 5px;        /* CSS3草案 */  
  -webkit-border-radius: 5px;    /* Safari,Google Chrome用 */  
  -moz-border-radius: 5px;   /* Firefox用 */  
}
.text-danger:before {
  content: "";
  position: absolute;
  top: 50%; left: -7px;
  margin-top: -9px;
  display: block;
  border-style: solid;
  border-width: 7px 7px 7px 0;
  border-color: transparent rgba(255,101,12,0.7) transparent transparent;
  z-index: 0;
}
#alert{
  color:red;
  text-align:center;
  font-weight:bold;
}
.select_fl{
  width:80%;
  margin:0 10%;
}
.select_fl select{
  width:15%;
}

/**/
.uploadButton {
    display:inline-block;
    position:relative;
    overflow:hidden;
    border-radius:3px;
    background:#099;
    color:#fff;
    text-align:center;
    padding:10px;
    line-height:30px;
    width:180px;
    cursor:pointer;
}
.uploadButton:hover {
    background:#0aa;
}
.uploadButton input[type=file] {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;    
    cursor:pointer;
    opacity:0;
}
.uploadValue {
    display:none;
    background:rgba(255,255,255,0.2);
    border-radius:3px;
    padding:3px;
    color:#ffffff;
}
/*end form*/
</style>
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
    <form method="post" action="../php/edit.php">

        <div class="c_box fl">  
          <label>名前</label><br>
          <input type="text" maxlength="25" name="name" placeholder="<?php echo($_SESSION['mypage']['name']); ?>"><br>
        </div>
        <div class="c_box fl">  
          <div class="uploadButton">
            ファイルを選択
            <input type="file" onchange="uv.style.display='inline-block'; uv.value = this.value;" />
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
          <label>コメント</label><br>
          <input type="text" name="comment" placeholder="<?php echo($_SESSION['mypage']['comment']); ?>" value=""><br>
        </div>
        <div class="c_box fl">
          <input type="submit" value="編集">
        </div>
    </form>
    </div>
  </div>

</body>
</html>