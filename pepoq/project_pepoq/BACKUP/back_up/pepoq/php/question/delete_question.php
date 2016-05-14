<?php
session_start();
require('../sanitize/sanitize.php');

$question_type = h($_GET['question_type']);
$question_id = h($_GET['question_id']);
$email = $_SESSION['mypage']['email'];

if($question_type==='to_other' OR $question_type==='to_me' && $question_id && $email) {
	$delete_question = new DeleteQuestion();
	if($question_type == 'to_other'){
		//自分の質問
		$delete_question->delete_my_question($question_id, $email);
		header('Location: ../../mypage/questions/my_questions.php');
		exit;
	}else if($question_type == 'to_me'){
		//あなたへの質問
		$delete_question->delete_question_to_me($question_id, $email);
		header('Location: ../../mypage/questions/my_answers.php');
		exit;
	}	
}

header('Location: ../../mypage/questions/my_questions.php');
exit;

class DeleteQuestion
{
	public function delete_my_question($question_id, $email)
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('DELETE FROM question WHERE id = :question_id AND email = :email');
		$sql->bindValue(':question_id', $question_id);
		$sql->bindValue(':email', $email);
		$sql->execute();

	}
	public function delete_question_to_me($question_id, $email)
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('DELETE FROM question WHERE id = :question_id AND question_to = :email');
		$sql->bindValue(':question_id', $question_id);
		$sql->bindValue(':email', $email);
		$sql->execute();

	}
}