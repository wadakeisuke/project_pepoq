<?php
session_start();
include('../php/db_connect.php');
//session(login)した人のemail password
$email=$_SESSION['mypage']['email'];
$password=$_SESSION['mypage']['password'];
//postをサニタイジング
function h($value)
{
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
//img
$thumbnail = h($_POST['thumbnail']);
$background = h($_POST['background']);

$name = h($_POST['name']);
$comment = h($_POST['comment']);

$country = h($_POST['country']);
$from = h($_POST['from']);

$age = h($_POST['age']);
$year = h($_POST['year']);
$month = h($_POST['month']);
$day = h($_POST['day']);

$educational_background = h($_POST['educational_background']);
$works = h($_POST['works']);
$lover = h($_POST['lover']);
$singer = h($_POST['singer']);
$writer =h($_POST['writer']);
$movie = h($_POST['movie']);
//sns links
$twitter = h($_POST['twitter']);
$facebook = h($_POST['facebook']);
$instagram = h($_POST['instagram']);
$google_plus = h($_POST['google_plus']);

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

    //edit more_relation
    if(!empty($more_relation)){
      if(get_magic_quotes_gpc()){
        $more_relation=stripslashes($more_relation);
      }
      $stmt3 = $pdo->prepare('UPDATE friends SET more_relation=? WHERE id=?');
      $stmt3->execute(array($more_relation,$id));
    }
    //edit meet_trigger
    if(!empty($meet_trigger)){
      if(get_magic_quotes_gpc()){
        $meet_trigger=stripslashes($meet_trigger);
      }
      $stmt3 = $pdo->prepare('UPDATE friends SET meet_trigger=? WHERE id=?');
      $stmt3->execute(array($meet_trigger,$id));
    }
    //edit good
    if(!empty($good)){
      if(get_magic_quotes_gpc()){
        $good=stripslashes($good);
      }
      $stmt3 = $pdo->prepare('UPDATE friends SET good=? WHERE id=?');
      $stmt3->execute(array($good,$id));
    }
    //edit respect
    if(!empty($respect)){
      if(get_magic_quotes_gpc()){
        $respect=stripslashes($respect);
      }
      $stmt3 = $pdo->prepare('UPDATE friends SET respect=? WHERE id=?');
      $stmt3->execute(array($respect,$id));
    }
    //edit enjoy
    if(!empty($enjoy)){
      if(get_magic_quotes_gpc()){
        $enjoy=stripslashes($enjoy);
      }
      $stmt3 = $pdo->prepare('UPDATE friends SET enjoy=? WHERE id=?');
      $stmt3->execute(array($enjoy,$id));
    }
    //edit bad
    if(!empty($bad)){
      if(get_magic_quotes_gpc()){
        $bad=stripslashes($bad);
      }
      $stmt3 = $pdo->prepare('UPDATE friends SET bad=? WHERE id=?');
      $stmt3->execute(array($bad,$id));
    }
    //edit my_comment
    if(!empty($my_comment)){
      if(get_magic_quotes_gpc()){
        $my_comment=stripslashes($my_comment);
      }
      $stmt3 = $pdo->prepare('UPDATE friends SET comment=? WHERE id=?');
      $stmt3->execute(array($my_comment,$id));
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