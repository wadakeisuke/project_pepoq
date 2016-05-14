<?php
session_start();
$question=new Question_edit();
if(@$_POST['question_id']){
	$question->which_friend='all';
	$question->question_id=$_POST['question_id'];
	$question->answer=htmlspecialchars($_POST['answer'],ENT_QUOTES,'utf-8');//question
	$question->toAll();
}
if(@$_POST['delete_id']){
	$question->question_id=$_POST['delete_id'];
	$question->toDelete();
}

class Question_edit
{
	public $question_id;
	public $which_friend;
	public $answer;

	function toAll()
	{	
		try{
			$pdo=require('../../php/db_connect.php');
			//newからall
	    	$sql=$pdo->prepare('UPDATE question SET type=?,answer=? WHERE id=?');
	    	$sql->execute(array($this->which_friend,$this->answer,$this->question_id));
	    	$pdo = null;
	    	header('Location: ../mypage/mypage.php');
    		exit();
		}catch(PDOException $e){
	    	echo('Error'.$e->getMessage());
	    	die();
		}
	}
	function toDelete()
	{	
		try{
			$pdo=require('../../php/db_connect.php');
			//delete
			$sql=$pdo->prepare('DELETE FROM question WHERE id=:delete_id');
	    	$sql->execute(array(':delete_id'=>$this->question_id));
	    	$pdo = null;
	    	header('Location: ../mypage/mypage.php');
    		exit();
		}catch(PDOException $e){
	    	echo('Error'.$e->getMessage());
	    	die();
		}
	}
}