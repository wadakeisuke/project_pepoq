<?php
class PersonalData
{
	/**
	 * emailからプロフィールデータを取得
	 * @param string $email
	 * @return array $personal_data
	 */
	function get_personal_data($email)
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM personal_data WHERE email = :email');
		$sql->bindValue(':email', $email);
		$sql->execute();
		while($personal_data = $sql->fetch(PDO::FETCH_ASSOC)){
			$result[] = $personal_data;
		}
		return $result;
	}
}