<?php
session_start();


$register = h($_POST['register']); //匿名か実名
$question_to = h($_POST['question_to']); //質問の相手
$email = $_SESSION['mypage']['email']; //質問者のemail
$question = h($_POST['question']); // 質問の内容

$genre = h($_POST['genre']); // 質問のジャンル
$category = h($_POST['category']); // 選択したジャンルのカテゴリ

if ($question == '' || $genre == '' || $category == '') {
	header('Location: ../new_question/new_question/new_question.php?error=on');
	exit;
}



if ($register != '') {
	add_question('register', $question_to, $genre, $category, $email, $question);

} else {
	add_question('anonymity', $question_to, $genre, $category, $email, $question);

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
function add_question($anonymity, $question_to, $genre, $category, $email, $question)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare(
		'INSERT INTO question 
		(
			anonymity,
			question_to,
			genre,
			category,
			email,
			question
		)
		VALUES 
		(
			:anonymity,
			:question_to,
			:genre,
			:category,
			:email,
			:question 
		)
	');
	$sql->bindValue(':anonymity', $anonymity);
	$sql->bindValue(':question_to', $question_to);
	$sql->bindValue(':genre', $genre);
	$sql->bindValue(':category', $category);
	$sql->bindValue(':email', $email);
	$sql->bindValue(':question', $question);
	$sql->execute();
}








