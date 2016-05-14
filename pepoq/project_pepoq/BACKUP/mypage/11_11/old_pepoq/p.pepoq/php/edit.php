<?php
session_start();
require('../../php/sanitizing.php');
$pdo=include('../../php/db_connect.php');

//session(login)した人のemail password
$email=$_SESSION['mypage']['email'];
$password=$_SESSION['mypage']['password'];

//postしたデータ
$thumbnail = h(isset($_POST['thumbnail'])?$_POST['thumbnail']:null);
$background = h(isset($_POST['background'])?$_POST['background']:null);
$name = h(isset($_POST['name'])?$_POST['name']:null);
$comment = h(isset($_POST['comment'])?$_POST['comment']:null);
$country = h(isset($_POST['thumbnail'])?$_POST['thumbnail']:null);
$from = h(isset($_POST['from'])?$_POST['from']:null);
$age = h(isset($_POST['age'])?$_POST['age']:null);
$year = h(isset($_POST['year'])?$_POST['year']:null);
$month = h(isset($_POST['month'])?$_POST['month']:null);
$day = h(isset($_POST['day'])?$_POST['day']:null);
$educational_background = h(isset($_POST['educational_background'])?$_POST['educational_background']:null);
$works = h(isset($_POST['works'])?$_POST['works']:null);
$lover = h(isset($_POST['lover'])?$_POST['lover']:null);
$singer = h(isset($_POST['singer'])?$_POST['singer']:null);
$writer = h(isset($_POST['writer'])?$_POST['writer']:null);
$movie = h(isset($_POST['movie'])?$_POST['movie']:null);
$twitter = h(isset($_POST['twitter'])?$_POST['twitter']:null);
$facebook = h(isset($_POST['facebook'])?$_POST['facebook']:null);
$skype = h(isset($_POST['skype'])?$_POST['skype']:null);
$instagram = h(isset($_POST['instagram'])?$_POST['instagram']:null);
$google_plus = h(isset($_POST['google_plus'])?$_POST['google_plus']:null);
try{
  //DB personal_data のレコードを取得
  $sql = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email AND password = :password');
  $sql->bindValue(':email',$email);
  $sql->bindValue(':password',$password);
  $sql->execute();
  //mypage_datanに連想配列で代入
  $mypage_data = $sql->fetch(PDO::FETCH_ASSOC);

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
          unlink('../../img/thumbnail/'.$_SESSION['mypage']['thumbnail']);
        }
        $thumbnailname=$filename.rand().'.'.$extension;
        if(is_uploaded_file($file['tmp_name'][0])){
          if(move_uploaded_file($file['tmp_name'][0], '../../img/thumbnail/'.$thumbnailname)){
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

  //edit name
  if(!empty($name)){
    $personal_sql = $pdo->prepare('UPDATE personal_data SET name=? WHERE email=? AND password=?');
    $personal_sql->execute(array($name,$email,$password));
    $friends_sql = $pdo->prepare('UPDATE friends SET name=? WHERE sender_email=?');
    $friends_sql->execute(array($name,$email));
  }
  //edit comment
  if(!empty($comment)){
    if(get_magic_quotes_gpc()){
      $comment=stripslashes($comment);
    }
    $comment=nl2br($comment);
    $stmt3 = $pdo->prepare('UPDATE personal_data SET comment=? WHERE email=? AND password=?');
    $stmt3->execute(array($comment,$email,$password));
  }
  //edit country
  if(!empty($country)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET country=? WHERE email=? AND password=?');
    $stmt3->execute(array($country,$email,$password));
  }
  //edit from
  if(!empty($from)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET come_from=? WHERE email=? AND password=?');
    $stmt3->execute(array($from,$email,$password));
  }
  //edit age
  if(!empty($age)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET age=? WHERE email=? AND password=?');
    $stmt3->execute(array($age,$email,$password));
  }
  //edit birthday
  if(!empty($year)){
    $birthday = $year.'/00/00';
    if(!empty($month)){
      if($month<10){
        $month = '0'.$month;
      }
      $birthday = $year.'/'.$month;
      if(!empty($day)){
        if($day<10){
          $day = '0'.$day;
        }
        $birthday = $year.'/'.$month.'/'.$day;
      }
    }      
    $stmt3 = $pdo->prepare('UPDATE personal_data SET birthday=? WHERE email=? AND password=?');
    $stmt3->execute(array($birthday,$email,$password));
  }
  //edit educational_background
  if(!empty($educational_background)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET educational_background=? WHERE email=? AND password=?');
    $stmt3->execute(array($educational_background,$email,$password));
  }
  //edit works
  if(!empty($works)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET works=? WHERE email=? AND password=?');
    $stmt3->execute(array($works,$email,$password));
  }
  //edit lover
  if(!empty($lover)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET lover=? WHERE email=? AND password=?');
    $stmt3->execute(array($lover,$email,$password));
  }
  //edit singer
  if(!empty($singer)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET singer=? WHERE email=? AND password=?');
    $stmt3->execute(array($singer,$email,$password));
  }
  //edit writer
  if(!empty($writer)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET writer=? WHERE email=? AND password=?');
    $stmt3->execute(array($writer,$email,$password));
  }
  //edit movie
  if(!empty($movie)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET movie=? WHERE email=? AND password=?');
    $stmt3->execute(array($movie,$email,$password));
  }    
  //edit twitter
  if(!empty($twitter)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET twitter=? WHERE email=? AND password=?');
    $stmt3->execute(array($twitter,$email,$password));
  }
  //edit facebook
  if(!empty($facebook)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET facebook=? WHERE email=? AND password=?');
    $stmt3->execute(array($facebook,$email,$password));
  }
  //edit skype
  if(!empty($skype)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET skype=? WHERE email=? AND password=?');
    $stmt3->execute(array($skype,$email,$password));
  } 
  //edit instagram
  if(!empty($instagram)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET instagram=? WHERE email=? AND password=?');
    $stmt3->execute(array($instagram,$email,$password));
  } 
  //edit google_plus
  if(!empty($google_plus)){
    $stmt3 = $pdo->prepare('UPDATE personal_data SET google_plus=? WHERE email=? AND password=?');
    $stmt3->execute(array($google_plus,$email,$password));
  }
  $pdo = null;
  header('Location: ../mypage/mypage.php');
  exit();
}catch(PDOException $e){
  echo('Error'.$e->getMessage());
  die();
}
