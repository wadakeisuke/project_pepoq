<?php
header('Content-type: text/html; charset=UTF-8');

class Check
{
	/**
	 * 匿名かチェックして適切な名前を返す
	 * @param string $anonimity 匿名:anonymity 記名:register
	 * @return string $name
	 */
	public function check_anonimity_for_name($anonymity, $register_name)
	{
		if ($anonymity == 'anonymity') {
			$name = '匿名さん';
		} else if($anonymity == 'register') {
			$name = $register_name;
		}
		return $name;
	}

	/**
	 * 匿名かチェックして適切なサムネイルを返す
	 * @param string $anonimity 匿名:anonymity 記名:register
	 * @return string $name
	 */
	public function check_anonimity_for_thumbnail($anonymity, $register_thumbnail)
	{
		if ($anonymity == 'anonymity') {
			$thumbnail = 'thumbnail.jpg';
		} else if($anonymity == 'register') {
			$thumbnail = $register_thumbnail;
		}
		return $thumbnail;
	}

	/**
	 * 友達のタイプをチェックしてタイプを返す
	 * @param string $email ログイン中のユーザのemail
	 * @param string $friend_email
	 * @return string $friend_type
	 * not_follow フォローしていない
	 * following フォロー中
	 * be_followed フォローされている　
	 */
	public function check_friend_type($my_email, $friend_email)
	{
		include('../../php/db_connect.php');

		$sql = $pdo->prepare('SELECT * FROM friend WHERE my_email = :my_email AND fr_email = :fr_email');
		$sql->bindValue(':my_email', $my_email);
		$sql->bindValue(':fr_email', $friend_email);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if ($data != '') {
			$friend_type = 'フォロー中';
			return $friend_type;	
		}

		$sql = $pdo->prepare('SELECT * FROM friend WHERE my_email = :fr_email AND fr_email = :my_email');
		$sql->bindValue(':my_email', $my_email);
		$sql->bindValue(':fr_email', $friend_email);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if ($data != '') {
			$friend_type = 'フォローされています';
			return $friend_type;
		}

		$friend_type = 'フォロー';
		return $friend_type;

	}
}





