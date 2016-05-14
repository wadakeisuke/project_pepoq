<?php
//全ての友達を取得
$allf_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_password=:ac_password AND accepter_email=:ac_email');
$allf_data->bindValue(':w_friend','all');
$allf_data->bindValue(':ac_password',$_SESSION['mypage']['password']);
$allf_data->bindValue(':ac_email',$_SESSION['mypage']['email']);
$allf_data->execute();
$allf_profile_data_all=array();
$allf_data_all=array();
$i=0;
while($friends = $allf_data->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
  //プロフィールに飛ぶための情報
  $f_profile=$pdo->prepare('SELECT * FROM personal_data WHERE email=:email');
  $f_profile->bindValue(':email',$friends['sender_email']);
  $f_profile->execute();
  $f_profile_data=$f_profile->fetch(PDO::FETCH_ASSOC);
  $allf_profile_data_all[$i]=array_merge($allf_profile_data_all,$f_profile_data);
  $allf_data_all[$i]=array_merge($allf_data_all,$friends);
  //プロフィールに飛ぶための情報
  $i++;
}

//全ての友達に対する自分のコメント等を取得
$allm_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND sender_password=:sender_password AND sender_email=:sender_email');
$allm_data->bindValue(':w_friend','all');
$allm_data->bindValue(':sender_password',$_SESSION['mypage']['password']);
$allm_data->bindValue(':sender_email',$_SESSION['mypage']['email']);
$allm_data->execute();
$allf_my_data_all=array();
$i=0;
while($friends = $allm_data->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
  $allf_my_data_all[$i]=array_merge($allf_my_data_all,$friends);
  $i++;
}
$i=0;

//friends_type毎に対する自分のコメント等を取得
$friends_type=array('family'=>'家族','lover'=>'恋人','school'=>'小・中学校','high_school'=>'高校','college'=>'大学・専門','works'=>'勤務先','other'=>'その他',);
$db_friends_my_data_all=array();
foreach($friends_type as $name => $value){
  $db_friends_my_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND sender_password=:ac_password AND sender_email=:ac_email AND relation=:relation');
  $db_friends_my_data->bindValue(':w_friend','all');//そのまま
  $db_friends_my_data->bindValue(':ac_password',$_SESSION['mypage']['password']);//そのまま
  $db_friends_my_data->bindValue(':ac_email',$_SESSION['mypage']['email']);//そのまま
  $db_friends_my_data->bindValue(':relation',$value);//変える
  $db_friends_my_data->execute();//そのまま
  $i=0;
  while($friends = $db_friends_my_data->fetch(PDO::FETCH_ASSOC)){ //$friendsにfriendsのDB情報を代入
    foreach($friends as $fr_data_name => $fr_data_value){
      $fr_ar[$name][$i][$fr_data_name]=$fr_data_value;
    }    
    array_push($db_friends_my_data_all,$friends);//$db_friends_data_allにDB friendsのデータを代入
    //プロフィールに飛ぶための情報
    $f_personal_data=$pdo->prepare('SELECT * FROM personal_data WHERE email=:email');
    $f_personal_data->bindValue(':email',$friends['sender_email']);
    $f_personal_data->execute();
    $f_personal_data=$f_personal_data->fetch(PDO::FETCH_ASSOC);

    foreach($f_personal_data as $data_name => $data_value){
      $ar[$name][$i][$data_name]=$data_value;
    }
    $i++;
  }
}


//友達リクエストを取得
$newf_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_password=:ac_password AND accepter_email=:ac_email');
$newf_data->bindValue(':w_friend','request');
$newf_data->bindValue(':ac_password',$_SESSION['mypage']['password']);
$newf_data->bindValue(':ac_email',$_SESSION['mypage']['email']);
$newf_data->execute();
$newf_profile_data_all=array();
$newf_data_all=array();
$i=0;
while($friends = $newf_data->fetch(PDO::FETCH_ASSOC)){ //$friendsに友達の情報を代入
  //プロフィールに飛ぶための情報
  $f_profile=$pdo->prepare('SELECT * FROM personal_data WHERE email=:email');
  $f_profile->bindValue(':email',$friends['sender_email']);
  $f_profile->execute();
  $f_profile_data=$f_profile->fetch(PDO::FETCH_ASSOC);
  $newf_profile_data_all[$i]=array_merge($newf_profile_data_all,$f_profile_data);
  $newf_data_all[$i]=array_merge($newf_data_all,$friends);
  //プロフィールに飛ぶための情報
  $i++;
}


//friends_typeに連想配列で友達の種類を代入
$friends_type=array('family'=>'家族','lover'=>'恋人','school'=>'小・中学校','high_school'=>'高校','college'=>'大学・専門','works'=>'勤務先','other'=>'その他',);
/*
$ar_data=array('id'=>'0','name'=>'kuma','email'=>'kuma@kuma.com','password'=>'kumakuma',);

for($i=0;$i<10;$i++){
  foreach($ar_data as $name => $value){
    $ar['family'][$i][$name]=$value;
  }
}
foreach($ar_data as $name => $value){
  $ar['lover'][2][$name]=$value;
}
foreach($ar_data as $name => $value){
  $ar['school'][3][$name]=$value;
}
*/
$db_friends_data_all=array();
foreach($friends_type as $name => $value){
  $db_friends_data=$pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_password=:ac_password AND accepter_email=:ac_email AND relation=:relation');
  $db_friends_data->bindValue(':w_friend','all');//そのまま
  $db_friends_data->bindValue(':ac_password',$_SESSION['mypage']['password']);//そのまま
  $db_friends_data->bindValue(':ac_email',$_SESSION['mypage']['email']);//そのまま
  $db_friends_data->bindValue(':relation',$value);//変える
  $db_friends_data->execute();//そのまま
  $i=0;
  while($friends = $db_friends_data->fetch(PDO::FETCH_ASSOC)){ //$friendsにfriendsのDB情報を代入
    foreach($friends as $fr_data_name => $fr_data_value){
      $fr_ar[$name][$i][$fr_data_name]=$fr_data_value;
    }    
    array_push($db_friends_data_all,$friends);//$db_friends_data_allにDB friendsのデータを代入
    //プロフィールに飛ぶための情報
    $f_personal_data=$pdo->prepare('SELECT * FROM personal_data WHERE email=:email');
    $f_personal_data->bindValue(':email',$friends['sender_email']);
    $f_personal_data->execute();
    $f_personal_data=$f_personal_data->fetch(PDO::FETCH_ASSOC);

    foreach($f_personal_data as $data_name => $data_value){
      $ar[$name][$i][$data_name]=$data_value;
    }
    $i++;
  }
}

