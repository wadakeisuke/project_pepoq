<?php header('Content-Type: text/css; charaset=utf-8');?>
<?php
//全て　ポップアップウィンドウ
for($num=0;$num<10;$num++)
{
echo('
#comment_all'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_all'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#goodby_all'.$num.'{margin-top:50px;margin:0;padding:0;width:100%;height:100%;display:none;background: #FFF;}
#edit_question'.$num.'{width: 100%;height:100%;text-align: center;padding:50px 0 20px 0;display:none;background-color: rgba(255, 255, 255, 0.9);}
');
}
?>
<?php
//友達リクエスト　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_new'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_new'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;  }
#goodby_new'.$num.'{width: 100%;height:100%;padding: 30px;display:none;background: #FFF;}
');
}
?>
<?php
//家族　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_family'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_family'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;  }
#goodby_family'.$num.'{width: 100%;height:100%;padding: 30px;display:none;background: #FFF;}
');
}
?>
<?php
//恋人　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_lover'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_lover'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;  }
#goodby_lover'.$num.'{width: 100%;height:100%;padding: 30px;display:none;background: #FFF;}
');
}
?>
<?php
//小・中学校　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_school'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_school'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;  }
#goodby_school'.$num.'{width: 100%;height:100%;padding: 30px;display:none;background: #FFF;}
');
}
?>
<?php
//高校　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_high_school'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_high_school'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;  }
#goodby_high_school'.$num.'{width: 100%;height:100%;padding: 30px;display:none;background: #FFF;}
');
}
?>
<?php
//大学・専門　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_college'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_collge'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;  }
#goodby_collge'.$num.'{width: 100%;height:100%;padding: 30px;display:none;background: #FFF;}
');
}
?>
<?php
//勤務先　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_works'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_works'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;  }
#goodby_works'.$num.'{width: 100%;height:100%;padding: 30px;display:none;background: #FFF;}
');
}
?>
<?php
//その他　ポップアップウィンドウ
for($num=0;$num<100;$num++)
{
echo('
#comment_other'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;}
#edit_other'.$num.'{margin:0;padding:0;width:100%;height:100%;display:none;  }
#goodby_other'.$num.'{width: 100%;height:100%;padding: 30px;display:none;background: #FFF;}
');
}
?>




