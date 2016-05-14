<?php
session_start();

$register = h($_POST['register']);
$question_to = h($_POST['question_to']);
$email = $_SESSION['mypage']['email'];
$question = h($_POST['question']);


if($register != ''){
	add_question('register', $question_to, $email, $question);
}else{
	add_question('anonymity', $question_to, $email, $question);
}

header('Location: ../mypage/timeline/index.php');
exit();


/**
 * パラメータをサニタイズ
 * @param int $value
 * @return int
 */
function h($value)
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * 質問を追加
 * @param string $anonymity
 * @param string $question
 * @param string $email
 * @param string $question_to
 * @return 
 */
function add_question($anonymity, $question_to, $email, $question)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare(
		'INSERT INTO question 
		(
			anonymity,
			question_to,
			email,
			question
		)
		VALUES 
		(
			:anonymity,
			:question_to,
			:email,
			:question 
		)
	');
	$sql->bindValue(':anonymity', $anonymity);
	$sql->bindValue(':question_to', $question_to);
	$sql->bindValue(':email', $email);
	$sql->bindValue(':question', $question);
	$sql->execute();
}








