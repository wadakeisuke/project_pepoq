<?php header('Content-Type: text/css; charaset=utf-8'); ?>
@charset "UTF-8";
<?php
//全て　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_all'.$num.'{
width:800px;height:400px;padding:0px 20px 20px 20px;
display:none;
background: #FFF;
border-radius: 5px;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;

}
#edit_all'.$num.'{
  color:black;
  width:770px;height:440px;padding:15px;
  display:none;
  background-color:rgba(255,255,255,0.8);
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
  -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
  -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);    
}
#goodby_all'.$num.'{
  width: 600px;
  padding: 30px;
  display:none;
  background: #FFF;
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
  -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
  -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);
}
');
}
?>
<?php
//友達リクエスト ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment'.$num.'{
width:800px;height:400px;padding:0px 20px 20px 20px;
display:none;
background: #FFF;
border-radius: 5px;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;

}
#edit'.$num.'{
  color:black;
  width:770px;height:440px;padding:15px;
  display:none;
  background-color:rgba(255,255,255,0.8);
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
  -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
  -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);    
}
#goodby'.$num.'{
  width: 600px;
  padding: 30px;
  display:none;
  background: #FFF;
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
  -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
  -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);
}
');
}
?>
<?php
//友達毎の ポップアップウィンドウ
//friends_typeに連想配列で友達の種類を代入
$friends_type=array('family'=>'家族','lover'=>'恋人','school'=>'小・中学校','high_school'=>'高校','college'=>'大学・専門','works'=>'勤務先','other'=>'その他',);
foreach($friends_type as $name => $value){
  for($num=0;$num<100;$num++){
  echo('
  #comment_'.$name.'_'.$num.'{
  width:800px;height:400px;padding:0px 20px 20px 20px;
  display:none;
  background: #FFF;
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;

  }
  #edit_'.$name.'_'.$num.'{
    color:black;
    width:770px;height:440px;padding:15px;
    display:none;
    background-color:rgba(255,255,255,0.8);
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
    -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
    -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);    
  }
  #goodby_'.$name.'_'.$num.'{
    width: 600px;
    padding: 30px;
    display:none;
    background: #FFF;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
    -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
    -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);
  }
  ');
  }
}
?>
/*---------------------------------------
  BEGIN UPPER CONTENT POPUP WINDOW
-----------------------------------------*/
#lean_overlay {
    position: fixed;
    z-index: 10000;
    top: 0px;
    left: 0px;
    height:100%;
    width:100%;
    background: steelblue;
    display: none;
}
.popup_window{
padding:10px 30px 20px;
display:none;
background-color: rgba(255, 255, 255, 0.9);
border-radius: 5px;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
}
#delete_acount{
width: 520px;
}
#delete_acount h1{
font-family: “ヒラギノ角ゴ Pro W3″,”Hiragino Kaku Gothic Pro”;
}
#delete_acount p{
font-size:15px;
font-family: “ヒラギノ角ゴ Pro W3″,”Hiragino Kaku Gothic Pro”;
}
#delete_acount input{
cursor:pointer;
width:80px;
text-align:center;
  -moz-transition: .5s;
  -webkit-transition: .5s;
  -o-transition: .5s;
  -ms-transition: .5s;
  transition: .5s;
}
#delete_acount input:hover{
background-color:red;
}
#delete_acount small{
  color:black;
}
#edit_img{
color:gray;
width: 400px;
}
#edit_name{
width: 220px;
}
#edit_comment{
width: 500px;
}
#edit_comment textarea{
  font-size:18px;
  padding:5px;
}
#edit_basicdata{
width: 380px;
}
#edit_love_and_likes{
width: 220px;
}
/*---------------------------------------
  END UPPER CONTENT POPUP WINDOW
-----------------------------------------*/


/*---------------------------------------
  LEAN MODAL　style
-----------------------------------------*/
/*======================================共通スタイル================================================*/
.c_e_g p{
  color:black;font-size:14px;
  font-family:‘Sacramento’, cursive,"Times New Roman", "游明朝", YuMincho, "Hiragino Mincho ProN", Meiryo, serif;
}
.c_e_g h2{color: #444;font-size:20px; font-family:‘Sacramento’, cursive,"Times New Roman", "游明朝", YuMincho, "Hiragino Mincho ProN", Meiryo, serif;}
.c_e_g .txt-fld textarea{width:660px;padding:5px;}
.c_e_g .txt-fld input {
  width: 600px; 
  padding: 0px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px; 
  font-size: 1.2em;
  color: #222;
  background: #F7F7F7;
  font-family: "Helvetica Neue";
  outline: none;
  border-top: 1px solid #CCC; 
  border-left: 1px solid #CCC;
  border-right: 1px solid #E7E6E6;
  border-bottom: 1px solid #E7E6E6;
  }
.c_e_g .btn-fld{float:left;clear:both;}










/*======================================comment_edit================================================*/