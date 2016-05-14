<?php
session_start();
class QuestionRequest
{
	private $type;
	private $my_email;
	private $pr_email;
	private $question;
	private $name;
	private $thumbnail;

	public function __construct()
	{
		$this->type = 'new';
		$this->my_email = $_SESSION['mypage']['email'];
		$this->pr_email = $_SESSION['profile']['email'];
		$this->name = $_SESSION['mypage']['name'];
		$this->thumbnail = $_SESSION['mypage']['thumbnail'];
	}
	public function setQuestion()
	{
		$question = htmlspecialchars($_POST['question'],ENT_QUOTES,'UTF-8');
		if(!empty($question)){
			$this->question = $question;
		}else{
			header('Location: ./m.profile/profile.php');
			exit();
		}
	}
	public function add()
	{	
		try{
			$pdo=require('../../php/db_connect.php');
			$sql=$pdo->prepare('INSERT INTO question(type,accepter_email,sender_email,name,thumbnail,question) VALUES (?,?,?,?,?,?)');
			$sql->execute(array("$this->type","$this->pr_email","$this->my_email","$this->name","$this->thumbnail","$this->question"));
	    	header('Location: ../mypage/mypage.php');
    		exit();
		}catch(PDOException $e){
	    	echo('Error'.$e->getMessage());
	    	die();
		}
	}
}
$question = new QuestionRequest();
$question->setQuestion();
$question->add();
