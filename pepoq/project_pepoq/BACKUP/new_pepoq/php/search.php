<?php
session_start();

$request_email = $_SESSION['mypage']['email'];

if($_POST['friend_id']){
	$friend_email = get_friend_email($_POST['friend_id']);
	include('../php/db_connect.php');
	$sql = $pdo->prepare('INSERT INTO new_friend(request_email, fr_email)VALUES (:request_email, :fr_email)');
	$sql->bindValue(':request_email', $request_email);
	$sql->bindValue(':fr_email', $friend_email);
	$sql->execute();

	header('Location: ../search/search_friend.php');
	exit;
}

function get_friend_email($friend_id)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE id = :id');
	$sql->bindValue(':id',$friend_id);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	return $data['email'];
}
