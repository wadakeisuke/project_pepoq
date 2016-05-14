<?php
class FriendCheck
{
  private $w_friend;
  private $my_email;
  private $pr_email;
  private $data;

  public function __construct()
  {
    $this->my_email = $_SESSION['mypage']['email'];
    $this->pr_email = $_SESSION['profile']['email'];
  }
  //setter
  public function setWfriend($w_friend)
  {
    $this->w_friend = $w_friend;
  }
  //mypageから自分のプロフィールへ飛んでいる場合
  public function not_me()
  {
    if($_SESSION['profile']['email'] === $_SESSION['mypage']['email']){
      //mypage->profileにとんだ場合
    }else{
      $this->standby();
    }
  }

  //既に友達の場合
  private function standby()
  {
    $this->setWfriend('all');
    $this->check_fr_type();
    if(!empty($this->data)){
      $this->view('Question','id="go" rel="leanModal" href="#question"');
    }else{
      $this->standby_ed();
    }
  }
  //リクエストを受けている場合
  private function standby_ed()
  {
    $this->setWfriend('accept');
    $this->check_fr_type();
    if(!empty($this->data)){
      $this->view('きてるよー','href="../SB_mypage/mypage.php#lower_content"');
    }else{
      $this->standby_ing();
    }
  }
  //リクエスト中の場合
  private function standby_ing()
  {
    $this->setWfriend('request');
    $this->check_fr_type();
    if(!empty($this->data)){
      $this->view('リクエスト中','href="#"');
    }else{
      $this->other();
    }
  }
  //その他
  private function other()
  {
      $this->view('StandBy');
  }

  //all request accept　を確認する
  private function check_fr_type()
  {
    require('../../php/db_connect.php');
    $sql = $pdo->prepare('SELECT * FROM friends WHERE which_friend=:w_friend AND accepter_email=:pr_email AND sender_email=:my_email');
    $sql->bindValue(':w_friend',$this->w_friend);
    $sql->bindValue(':pr_email',$this->pr_email);
    $sql->bindValue(':my_email',$this->my_email);
    $sql->execute();
    $this->data = $sql->fetch(PDO::FETCH_ASSOC);
  }
  //html 出力
  private function view($value, $link = 'id="go" rel="leanModal" href="#standby"')
  {
    echo '
    <div style="width:150px;margin:0 auto;">
      <a '.$link.'>
        <input id="standby_button" type="submit" value="'.$value.'">
      </a>
    </div>
    ';
  }
}
$fr_check = new FriendCheck();
$fr_check->not_me();
