<?php
session_start();
class Friend_edit
{
	//id
	private $friend_id;

	//友達のタイプ all request accept
	private $which_friend;

	//関係
	private $relation;
	private $more_relation;

	//comment 
	private $comment1_type;
	private $comment1;
	private $comment2_type;
	private $comment2;
	private $comment3_type;
	private $comment3;
	private $comment4;

	//question
	private $question;

	//コンストラクタ
	/*
	* DBの友達のIDを代入
	* which_friendを代入 all request accept
	*/
	public function __construct($w_friend='all')
	{
		$this->friend_id = $this->h($_POST['friend_id']);
		$this->which_friend = $w_friend;
	}
	//setter
	/*
	* 
	*/
	public function set_question($question)
	{
		$this->question = $this->h($question);
		$this->request_question($this->question);
	}
	//質問を追加する
	private function request_question($question)
	{
		$my_email = $_SESSION['mypage']['email'];
		$my_name = $_SESSION['mypage']['name'];
		$my_thumbnail = $_SESSION['mypage']['thumbnail'];
		try{
			$pdo = require('../../php/db_connect.php');
			$sql = $pdo->prepare('SELECT * FROM friends WHERE id=:id');
	    	$sql->bindValue(':id',$this->friend_id);
	    	$sql->execute();
	    	$data = $sql->fetch(PDO::FETCH_ASSOC);
	    	$fr_email = $data['sender_email'];

			$sql = $pdo->prepare('INSERT INTO question(type,accepter_email,sender_email,name,thumbnail,question) VALUES (?,?,?,?,?,?)');
			$sql->execute(array("new","$fr_email","$my_email","$my_name","$my_thumbnail","$this->question"));
		}catch(PDOException $e){
	    	echo('Error'.$e->getMessage());
	    	die();
		}		
	}	
	//エスケープ処理
	private function h($str){
		return htmlspecialchars($str,ENT_QUOTES,'utf-8');
	}

	//データをチェック、空だった場合元のデータを変数に入れる
	public function check_data()
	{
		$pdo = require('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM friends WHERE id=:id');
    	$sql->bindValue(':id',$this->friend_id);
    	$sql->execute();
    	$data = $sql->fetch(PDO::FETCH_ASSOC);

		$relation = $this->h($_POST['relation']);
		$more_relation = $this->h($_POST['more_relation']);
		//$more_relation = $this->h($_POST['more_relation']);
		$comment1_type = $this->h($_POST['comment1_type']);
		$comment1 = $this->h($_POST['comment1']);
		$comment2_type = $this->h($_POST['comment2_type']);
		$comment2 = $this->h($_POST['comment2']);
		$comment3_type = $this->h($_POST['comment3_type']);
		$comment3 = $this->h($_POST['comment3']);
		$comment4 = $this->h($_POST['comment4']);

		if($relation == '' OR $relation == $data['relation']){
			$this->relation = $data['relation'];
		}else{
			$this->relation = $relation;
		}
		if($more_relation == '' OR $more_relation == $data['more_relation']){
			$this->more_relation = $data['more_relation'];
		}else{
			$this->more_relation = $more_relation;
		}
		if($comment1_type == '' OR $comment1_type == $data['comment1_type']){
			$this->comment1_type = $data['comment1_type'];
		}else{
			$this->comment1_type = $comment1_type;
		}
		if($comment1 == '' OR $comment1 == $data['comment1']){
			$this->comment1 = $data['comment1'];
		}else{
			$this->comment1 = $comment1;
		}
		if($comment2_type == '' OR $comment2_type == $data['comment2_type']){
			$this->comment2_type = $data['comment2_type'];
		}else{
			$this->comment2_type = $comment2_type;
		}
		if($comment2 == '' OR $comment2 == $data['comment2']){
			$this->comment2 = $data['comment2'];
		}else{
			$this->comment2 = $comment2;
		}
		if($comment3_type == '' OR $comment3_type == $data['comment3_type']){
			$this->comment3_type = $data['comment3_type'];
		}else{
			$this->comment3_type = $comment3_type;
		}
		if($comment3 == '' OR $comment3 == $data['comment3']){
			$this->comment3 = $data['comment3'];
		}else{
			$this->comment3 = $comment3;
		}		
		if($comment4 == '' OR $comment4 == $data['comment4']){
			$this->comment4 = $data['comment4'];
		}else{
			$this->comment4 = $comment4;
		}


	}

	//元の友達のDBの情報
	private function friend_db()
	{
		$pdo = require('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM friends WHERE id=:id');
    	$sql->bindValue(':id',$this->friend_id);
    	$sql->execute();
    	$data = $sql->fetch(PDO::FETCH_ASSOC);
	}

	//新しい友達を許可する
	public function toAll()
	{	
		try{
			$pdo = require('../../php/db_connect.php');
			//requestからall
			$sql = $pdo->prepare('UPDATE friends SET which_friend=? WHERE id=?');
	    	$sql->execute(array($this->which_friend,$this->friend_id));
	    	//acceptからall
	    	$sql = $pdo->prepare('SELECT * FROM friends WHERE id=:id');
	    	$sql->bindValue(':id',$this->friend_id);
	    	$sql->execute();
	    	$data = $sql->fetch(PDO::FETCH_ASSOC);

	    	$which_friend = 'accept';
	    	$my_email = $_SESSION['mypage']['email'];
	    	$fr_email = $data['sender_email'];
	    	$sql = $pdo->prepare('UPDATE friends SET which_friend=?,comment1_type=?,comment1=?,comment2_type=?,comment2=?,comment3_type=?,comment3=?,comment4=? WHERE which_friend=? AND sender_email=? AND accepter_email=?');
	    	$sql->execute(array($this->which_friend,$this->comment1_type,$this->comment1,$this->comment2_type,$this->comment2,$this->comment3_type,$this->comment3,$this->comment4,$which_friend,$my_email,$fr_email));
	    	$pdo = null;
	    	$this->header();
		}catch(PDOException $e){
	    	echo('Error'.$e->getMessage());
	    	die();
		}
	}

	//自分のコメント等を変更
	public function toEdit()
	{	
		try{
			$pdo = require('../../php/db_connect.php');

	    	$sql = $pdo->prepare('SELECT * FROM friends WHERE id=:id');
	    	$sql->bindValue(':id',$this->friend_id);
	    	$sql->execute();
	    	$data = $sql->fetch(PDO::FETCH_ASSOC);

	    	$my_email = $_SESSION['mypage']['email']; //自分のemail
	    	$fr_email = $data['accepter_email']; //友達のemail
	    	$sql = $pdo->prepare('UPDATE friends SET comment1_type=?, comment1=?, comment2_type=?, comment2=?, comment3_type=?, comment3=?, comment4=?, relation=?, more_relation=? WHERE sender_email=? AND accepter_email=?');
	    	$sql->execute(array($this->comment1_type, $this->comment1, $this->comment2_type, $this->comment2, $this->comment3_type, $this->comment3, $this->comment4, $this->relation, $this->more_relation, $my_email, $fr_email));
	    	$pdo = null;
	    	$this->header();
		}catch(PDOException $e){
	    	echo('Error'.$e->getMessage());
	    	die();
		}
	}
	//友達を削除する
	/*
	* 
	*/
	public function toDelete()
	{	
		try{
			$pdo=require('../../php/db_connect.php');
			$email=$pdo->prepare('SELECT * FROM friends WHERE id=:delete_id');
			$email->bindValue(':delete_id',$this->friend_id);
			$email->execute();
			$data=$email->fetch(PDO::FETCH_ASSOC);

			$sql=$pdo->prepare('DELETE FROM friends WHERE accepter_email=:ac_email AND sender_email=:se_email');
	    	$sql->execute(array(':ac_email'=>$data['sender_email'],':se_email'=>$_SESSION['mypage']['email']));

			$sql=$pdo->prepare('DELETE FROM friends WHERE id=:delete_id');
	    	$sql->execute(array(':delete_id'=>$this->friend_id));
	    	$pdo = null;
	    	$this->header();
		}catch(PDOException $e){
	    	echo('Error'.$e->getMessage());
	    	die();
		}
	}
	//header
	/*
	* mypageにとばす
	*/
	private function header()
	{
		header('Location: ../mypage/mypage.php');
    	exit();
	}
}
//新しい友達を承認
if(@$_POST['accept_friend']){
	$friend=new Friend_edit();
	$friend->set_question($_POST['question']); //question
	$friend->check_data();
	$friend->toAll();
}
//自分のコメント等を変更
if(@$_POST['comment_edit']){
	$friend = new Friend_edit();
	$friend->check_data();
	$friend->toEdit();
}
if(@$_POST['delete']){
	$friend = new Friend_edit();
	$friend->toDelete();
}





