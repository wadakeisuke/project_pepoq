<?php
session_start();

$my_email = $_SESSION['mypage']['email'];
$friend_id = $_POST['friend_id'];
$friend_email = get_friend_email($friend_id);

if($_POST['accept']){
	accept_new_friend($my_email, $friend_email);
}
if($_POST['refuse']){
	refuse_new_friend($friend_email);
}
header('Location: ../mypage/friends.php');
exit;

/**
 * リクエストした人のメールアドレスを取得
 * @param int $friend_id
 */
function get_friend_email($friend_id){
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE id = :friend_id');
	$sql->bindValue(':friend_id',$friend_id);
	$sql->execute();
	$friend_data = $sql->fetch(PDO::FETCH_ASSOC);
	return $friend_data['email'];
}

/**
 * 承認した人とリクエストした人のデータをDB(friend)に追加
 * @param string $my_email
 * @param string $friend_email
 * @return array 
 */
function accept_new_friend($my_email, $friend_email){
	include('../php/db_connect.php');
	//承認した人がmy_email リクエストした人がfr_email
	$sql = $pdo->prepare('INSERT INTO friend(my_email, fr_email) VALUES (:my_email, :fr_email)');
	$sql->bindValue(':my_email', $my_email);
	$sql->bindValue(':fr_email', $friend_email);
	$sql->execute();

	//新しい友達に表示されている友達を削除
	refuse_new_friend($friend_email);

	//承認した人がfr_email リクエストした人がmy_email
	$sql = $pdo->prepare('INSERT INTO friend(my_email, fr_email) VALUES (:my_email, :fr_email)');
	$sql->bindValue(':my_email', $friend_email);
	$sql->bindValue(':fr_email', $my_email);
	$sql->execute();
}

/**
 * リクエストした人のデータをDB(friend)から削除
 * @param string $friend_email
 */
function refuse_new_friend($friend_email){
	include('../php/db_connect.php');
	$sql = $pdo->prepare('DELETE FROM new_friend WHERE request_email = :request_email');
	$sql->bindValue(':request_email', $friend_email);
	$sql->execute();
}
