<?php
session_start();
include('../php/user_data.php');

//いいね機能
$user_id = $_SESSION['mypage']['id'];
$question_id = $_GET['question_id'];

$data_exists = exists_user_id_for_question_good_point($user_id);
if($data_exists){
	add_good_point($question_id);
}
header('Location: ../mypage/index.php');
exit;

/**
 * いいねを追加
 * @param int $question_id
 * @return 
 */
function add_good_point($question_id)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('INSERT INTO question_good_point (question_id, user_id) VALUES (:question_id, :user_id)')
	$sql->bindValue(':question_id', $question_id);
	$sql->execute();
}

/**
 * 指定のuser_idが存在するかチェック 存在:true 存在しない:false
 * @param int $user_id
 * @return boolean 
 */
function exists_user_id_for_question_good_point($user_id)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM question_good_point WHERE user_id = :user_id');
	$sql->bindValue(':user_id', $user_id);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	if(0 < count($data)){
		return true;
	}
	return false;
}
