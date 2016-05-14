<?php
session_start();
include('./db_connect.php');

//session(login)した人のemail password
$email = $_SESSION['mypage']['email'];
$password = $_SESSION['mypage']['password'];
//postをサニタイジング
function h($value)
{
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}


/*
name ニックネーム
thumbnail サムネイル
comment ひとこと
*/
$name = h($_POST['name']);
$thumbnail = h($_POST['thumbnail']);
$comment = h($_POST['comment']);


/*
sex 性別
age 年代
blood_type 血液型
*/
$sex = h($_POST['sex']);
$age = h($_POST['age']);
$blood_type = h($_POST['blood_type']);


/*
settlement 住んでいるところ
alma_mater 学校
job 仕事
place_of_work 働いているところ
*/
$settlement = h($_POST['settlement']);
$school = h($_POST['school']);
$job = h($_POST['job']);
$place_of_work = h($_POST['place_of_work']);


/*
hobby 趣味
special_skill 特技
my_boom マイブーム
dream 夢
*/
$hobby = h($_POST['hobby']);
$special_skill = h($_POST['special_skill']);
$my_boom = h($_POST['my_boom']);
$dream = h($_POST['dream']);


/*
favorite_sports 好きなスポーツ
favorite_singer 好きな歌手
favorite_book 好きな本
favorite_movie 好きな映画
favorite_animation 好きなアニメ
*/
$favorite_sports = h($_POST['favorite_sports']);
$favorite_singer = h($_POST['favorite_singer']);
$favorite_book = h($_POST['favorite_book']);
$favorite_movie = h($_POST['favorite_movie']);
$favorite_animation = h($_POST['favorite_animation']);


// ニックネーム変更
if (!empty($name)) {
  $sql = $pdo->prepare('UPDATE personal_data SET name = :name WHERE email = :email AND password = :password');
  $sql->bindValue(':name', $name);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// ひとこと変更
if (!empty($comment)) {
  $sql = $pdo->prepare('UPDATE personal_data SET comment = :comment WHERE email = :email AND password = :password');
  $sql->bindValue(':comment', $comment);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 性別変更
if (!empty($sex)) {
  $sql = $pdo->prepare('UPDATE personal_data SET sex = :sex WHERE email = :email AND password = :password');
  $sql->bindValue(':sex', $sex);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 年代変更
if (!empty($age)) {
  $sql = $pdo->prepare('UPDATE personal_data SET age = :age WHERE email = :email AND password = :password');
  $sql->bindValue(':age', $age);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 血液型変更
if (!empty($blood_type)) {
  $sql = $pdo->prepare('UPDATE personal_data SET blood_type = :blood_type WHERE email = :email AND password = :password');
  $sql->bindValue(':blood_type', $blood_type);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 住んでいるところ変更
if (!empty($settlement)) {
  $sql = $pdo->prepare('UPDATE personal_data SET settlement = :settlement WHERE email = :email AND password = :password');
  $sql->bindValue(':settlement', $settlement);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 学校変更
if (!empty($school)) {
  $sql = $pdo->prepare('UPDATE personal_data SET school = :school WHERE email = :email AND password = :password');
  $sql->bindValue(':school', $school);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 仕事変更
if (!empty($job)) {
  $sql = $pdo->prepare('UPDATE personal_data SET job = :job WHERE email = :email AND password = :password');
  $sql->bindValue(':job', $job);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 働いているところ変更
if (!empty($place_of_work)) {
  $sql = $pdo->prepare('UPDATE personal_data SET place_of_work = :place_of_work WHERE email = :email AND password = :password');
  $sql->bindValue(':place_of_work', $place_of_work);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 趣味変更
if (!empty($hobby)) {
  $sql = $pdo->prepare('UPDATE personal_data SET hobby = :hobby WHERE email = :email AND password = :password');
  $sql->bindValue(':hobby', $hobby);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 特技変更
if (!empty($special_skill)) {
  $sql = $pdo->prepare('UPDATE personal_data SET special_skill = :special_skill WHERE email = :email AND password = :password');
  $sql->bindValue(':special_skill', $special_skill);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// マイブーム変更
if (!empty($my_boom)) {
  $sql = $pdo->prepare('UPDATE personal_data SET my_boom = :my_boom WHERE email = :email AND password = :password');
  $sql->bindValue(':my_boom', $my_boom);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 夢変更
if (!empty($dream)) {
  $sql = $pdo->prepare('UPDATE personal_data SET dream = :dream WHERE email = :email AND password = :password');
  $sql->bindValue(':dream', $dream);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 好きなスポーツ変更
if (!empty($favorite_sports)) {
  $sql = $pdo->prepare('UPDATE personal_data SET favorite_sports = :favorite_sports WHERE email = :email AND password = :password');
  $sql->bindValue(':favorite_sports', $favorite_sports);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 好きな歌手変更
if (!empty($favorite_singer)) {
  $sql = $pdo->prepare('UPDATE personal_data SET favorite_singer = :favorite_singer WHERE email = :email AND password = :password');
  $sql->bindValue(':favorite_singer', $favorite_singer);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 好きな本変更
if (!empty($favorite_movie)) {
  $sql = $pdo->prepare('UPDATE personal_data SET favorite_book = :favorite_book WHERE email = :email AND password = :password');
  $sql->bindValue(':favorite_book', $favorite_book);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 好きな映画変更
if (!empty($favorite_movie)) {
  $sql = $pdo->prepare('UPDATE personal_data SET favorite_movie = :favorite_movie WHERE email = :email AND password = :password');
  $sql->bindValue(':favorite_movie', $favorite_movie);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

// 好きなアニメ変更
if (!empty($favorite_animation)) {
  $sql = $pdo->prepare('UPDATE personal_data SET favorite_animation = :favorite_animation WHERE email = :email AND password = :password');
  $sql->bindValue(':favorite_animation', $favorite_animation);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':password', $password);
  $sql->execute();
}

//edit thumbnail and background
if(isset($_FILES['file'])){
  $file=$_FILES['file'];
  //edit thumbnail
  if(!empty($file['name'][0])){
    $path_parts=pathinfo($file['name'][0]);
    $filename=$path_parts['filename'];
    $extension=$path_parts['extension'];
    if($extension == 'jpg' or $extension == 'jpeg' or $extension=='png' or $extension=='gif'){
      if($_SESSION['mypage']['thumbnail'] != 'thumbnail.jpg'){
        unlink('../mypage/profile/img/thumbnail/'.$_SESSION['mypage']['thumbnail']);
      }
      $thumbnailname=$filename.rand().'.'.$extension;
      if(is_uploaded_file($file['tmp_name'][0])){
        if(move_uploaded_file($file['tmp_name'][0], '../mypage/profile/img/thumbnail/'.$thumbnailname)){
          $personal_sql=$pdo->prepare('UPDATE personal_data SET thumbnail=? WHERE email=? AND password=?');
          $personal_sql->execute(array($thumbnailname,$email,$password));
          $friend_sql=$pdo->prepare('UPDATE friends SET thumbnail=? WHERE sender_email=?');
          $friend_sql->execute(array($thumbnailname,$email));
        }
      }
    }        
  }
  //edit background
  if(!empty($file['name'][1])){
    $path_parts=pathinfo($file['name'][1]);
    $filename=$path_parts['filename'];
    $extension=$path_parts['extension'];
    if($extension == 'jpg' or $extension == 'jpeg' or $extension=='png' or $extension=='gif'){
      if($_SESSION['mypage']['background'] != 'background.jpg'){
        unlink('../../img/background/'.$_SESSION['mypage']['background']);
      }
      $backgroundname=$filename.rand().'.'.$extension;
      if(is_uploaded_file($file['tmp_name'][1])){
        if(move_uploaded_file($file['tmp_name'][1], '../../img/background/'.$backgroundname)){
          $personal_sql=$pdo->prepare('UPDATE personal_data SET background=? WHERE email=? AND password=?');
          $personal_sql->execute(array($backgroundname,$email,$password));
        }
      }
    }        
  }
}

header('Location: ../mypage/profile/profile.php');
exit;
