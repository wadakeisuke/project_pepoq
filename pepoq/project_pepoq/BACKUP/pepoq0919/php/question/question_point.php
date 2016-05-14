<?php
session_start();
require('../sanitize/sanitize.php');

$question_point = new QuestionPoint();

$point_type = h($_GET['point_type']);
$question_id = h($_GET['question_id']);
$email = $_SESSION['mypage']['email'];

if($point_type == 'good' OR $point_type == 'bad') {
	$check_question_point = $question_point->check_question_point($question_id, $email);
	if($check_question_point === 0) {
		$question_point->add_question_point($point_type, $question_id, $email);
	}
}

header('Location: ../../mypage/timeline/index.php');
exit;

class QuestionPoint
{
	public function add_question_point($point_type, $question_id, $email)
	{
		include('../db_connect.php');
		$sql = $pdo->prepare(
			'INSERT INTO question_point
			(
				question_id,
				point_type,
				email
			)
			VALUES 
			(
				:question_id,
				:point_type,
				:email
			)
		');
		$sql->bindValue(':question_id', $question_id);
		$sql->bindValue(':point_type', $point_type);
		$sql->bindValue(':email', $email);
		$sql->execute();
	}


	public function check_question_point($question_id, $email)
	{
		include('../db_connect.php');
		$sql = $pdo->prepare('SELECT * 
			FROM 
				question_point
			WHERE
				question_id = :question_id AND
				email = :email
		');
		$sql->bindValue(':question_id', $question_id);
		$sql->bindValue(':email', $email);
		$sql->execute();
		if($data = $sql->fetch(PDO::FETCH_ASSOC)) {
			return 1;
		}
		return 0;
	}
}

