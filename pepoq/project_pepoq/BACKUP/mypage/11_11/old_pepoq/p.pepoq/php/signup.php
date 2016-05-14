<?
session_start();
header('Expires:-1');
header('Cache-Control:');
header('Pragma:');
class Signup
{
  private $first_name;
  private $last_name;
  private $email;
  private $password;
/*set method*/
  public function setFirstname($first_name)
  {
    $this->first_name=$first_name;
  }
  public function setLastname($last_name)
  {
    $this->last_name=$last_name;
  }
  public function setEmail($email)
  {
    $this->email=$email;
  }
  public function setPassword($password)
  {
    $this->hash($password);
  }
/*get method*/
  public function getFirstname()
  {
    return $this->first_name;
  }
  public function getLastname()
  {
    return $this->last_name;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getPassword()
  {
    return $this->password;
  }
/*hash method passwordをハッシュ*/
  public function hash($password)
  {
    for($num=0;$num<1000;$num++)
      {
        $password=sha1($password);
        $password=md5($password);
      }
      $this->password=$password;
  }
/*signup method データベースに保存*/
  public function signup_sb($name)
  {
    try{
      $pdo = require('../../php/db_connect.php');
      $first_name=$this->getFirstname();
      $last_name=$this->getLastname();
      $email=$this->getEmail();
      $password=$this->getPassword();
      $this->alreadySignup($email,$pdo);
      $created=date('Y-m-d H:i:s');
      $sql=$pdo->prepare('INSERT INTO acount(first_name,last_name,email,password,created) VALUES (?,?,?,?,?)');
      $sql->execute(array("$first_name","$last_name","$email","$password","$created"));

      $sql=$pdo->prepare('INSERT INTO personal_data(email,password,thumbnail,background,name,comment,country,come_from,age,birthday,educational_background,works,lover,singer,writer,movie,twitter,facebook,instagram,google_plus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
      $sql->execute(array("$email","$password",'thumbnail.jpg','background.jpg',"$name",'--','--','--','--','--','--','--','--','--','--','--','https://twitter.com','https://ja-jp.facebook.com','https://instagram.com/','http://www.google.com/intl/ja/+/learnmore/'));

      $sql=$pdo->prepare('INSERT INTO friends(which_friend,accepter_password,accepter_email,sender_password,sender_email,name,thumbnail,meet_trigger,comment) VALUES (?,?,?,?,?,?,?,?,?)');
      $sql->execute(array("all","$password","$email","sbsbsb","sb@sb.com","SB","logo.png","$created","Wellcome to StandBy ! $name さん"));

      $_SESSION['signup'] = 'signup';
      header('Location: ../thanks/thanks.php');
      exit();
    }catch(PDOException $e){
      echo('Error'.$e->getMessage());
      die();
    }
    $pdo=null;
  }
/*alreadySignup method 既にサインアップされていた場合*/
  public function alreadySignup($email,$pdo)
  {
    try{
      $sql=$pdo->prepare('SELECT * FROM acount WHERE email=:email');
      $sql->bindValue(':email',$email);
      $sql->execute();
      if($data=$sql->fetch(PDO::FETCH_ASSOC)){
        header('Location: ../confirm/confirm.php?alert=on');
        exit();
      }
    }catch(PDOException $e){
      echo('Error'.$e->getMessage());
      die();
    }
    $pdo=null;
  }
}
$signup=(isset($_POST['signup']))?'signup':null;
if($signup=='signup'){
  $first_name = isset($_POST['first_name'])?$_POST['first_name']:null;
  $last_name = isset($_POST['last_name'])?$_POST['last_name']:null;
  $first_name=htmlspecialchars($first_name,ENT_QUOTES,'UTF-8');
  $last_name=htmlspecialchars($last_name,ENT_QUOTES,'UTF-8');
  $name=$first_name.' '.$last_name;
  $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
  $password=htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');
  if($first_name&&$last_name&&$email&&$password){
    $signup=new Signup();
    $signup->setFirstname($first_name);
    $signup->setLastname($last_name);
    $signup->setEmail($email);
    $signup->setPassword($password);

    $signup->signup_sb($name);
  }
}