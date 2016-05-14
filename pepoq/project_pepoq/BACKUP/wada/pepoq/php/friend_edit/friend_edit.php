<?php
session_start();

require('../user_data/personalData.php');
require('../sanitize/sanitize.php');
$personal_data = new personalData();
$friend_id = h($_POST['friend_id']);
$friend_data = $personal_data->get_personal_data_from_id($friend_id);
$friend_email = $friend_data['email'];



$friend_edit = new FriendEdit();

if ($_POST['edit_type'] == 'accept') {
	$friend_edit->accept_new_friend($friend_email);
	header('Location: ../../mypage/friedns/friends.php');
	exit;
} 

if ($_POST['edit_type'] == 'refuse') {
	$friend_edit->refuse_new_friend($friend_email);
	header('Location: ../../mypage/friends/friends.php');
	exit;
}

if ($_POST['edit_type'] == 'cancel') {
	$friend_edit->cancel_request_friend($friend_email);
	header('Location: ../../mypage/friends/friends.php');
	exit;
}

if ($_POST['request_friend'] != '') {
	$friend_type = $friend_edit->check_friend_type($friend_email);
	if ($friend_type === 0) {
		$friend_edit->request_friend($friend_email);	
	}	
}

header('Location: ../../friend_page/profile/profile.php?friend_id=' . $friend_id);
exit;

class FriendEdit
{
	/**
	 * 友達かチェック
	 * @param string $friend_email
	 */
	function check_friend_type($friend_email)
	{
		include('../db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM new_friend WHERE my_email = :my_email AND fr_email = :fr_email');
		$sql->bindValue(':my_email', $_SESSION['mypage']['email']);
		$sql->bindValue(':fr_email', $friend_email);
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_ASSOC);
		if ($result == '') {
			return 0;
		} else {
			return 1;
		}
	}

	/**
	 * 友達申請
	 * @param string $friend_email
	 */
	function request_friend($friend_email)
	{
		include('../db_connect.php');
		$sql = $pdo->prepare('INSERT INTO friend(my_email, fr_email) VALUES (:my_email, :fr_email)');
		$sql->bindValue(':my_email', $_SESSION['mypage']['email']);
		$sql->bindValue(':fr_email', $friend_email);
		$sql->execute();
	}

	/**
	 * 友達申請のキャンセル
	 * @param string $friend_email
	 */
	function cancel_request_friend($friend_email)
	{
		include('../db_connect.php');
		$sql = $pdo->prepare('DELETE FROM friend WHERE my_email = :my_email AND fr_email = :fr_email');
		$sql->bindValue(':my_email', $_SESSION['mypage']['email']);
		$sql->bindValue(':fr_email', $friend_email);
		$sql->execute();
	}

	/**
	 * 新しい友達の承認
	 */
	function accept_new_friend($friend_email)
	{
		include('../db_connect.php');
		$sql = $pdo->prepare('INSERT INTO friend(my_email, fr_email) VALUES (:my_email, :fr_email)');
		$sql->bindValue(':my_email', $_SESSION['mypage']['email']);
		$sql->bindValue(':fr_email', $friend_email);
		$sql->execute();
		$sql = $pdo->prepare('INSERT INTO friend(my_email, fr_email) VALUES (:my_email, :fr_email)');
		$sql->bindValue(':my_email', $friend_email);
		$sql->bindValue(':fr_email', $_SESSION['mypage']['email']);
		$sql->execute();
	}

	/**
	 * 新しい友達の拒否
	 */
	function refuse_new_friend($friend_email)
	{
		include('../db_connect.php');
		$sql = $pdo->prepare('DELETE FROM friend WHERE my_email = :my_email AND fr_email = :fr_email');
		$sql->bindValue(':my_email', $friend_email);
		$sql->bindValue(':fr_email', $_SESSION['mypage']['email']);
		$sql->execute();
	}


}



















