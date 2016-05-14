<?php
class Question
{
	/**
	 * みんなに向けた質問を取得する
	 */
	function get_question_to_all()
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM question 
			WHERE 
			question_to = :question_to
		ORDER BY id DESC
		');
		$sql->bindValue(':question_to', 'all');
		$sql->execute();
		while($data = $sql->fetch(PDO::FETCH_ASSOC)){
			$result[] = $data; 
		}
		return $result;
	}

	/**
	 * 私への質問を取得
	 */
	function get_question_to_me()
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM question WHERE question_to = :question_to ORDER BY id DESC');
		$sql->bindValue(':question_to', $_SESSION['mypage']['email']);
		$sql->execute();
		while($data = $sql->fetch(PDO::FETCH_ASSOC)){
			$question_to_me[] = $data;
		}
		return $question_to_me;
	}	

	/**
	 * question_idから質問を取得
	 * @param int $question_id
	 * @return array $question 
	 */
	function get_question_data($question_id)
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM question WHERE id = :id');
		$sql->bindValue(':id', $question_id);
		$sql->execute();
		$question_data = $sql->fetch(PDO::FETCH_ASSOC);
		return $question_data;	
	}

	/**
	 * 投稿した質問を取得
	 */
	function get_my_post_question()
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM question WHERE email = :email ORDER BY id DESC');
		$sql->bindValue(':email', $_SESSION['mypage']['email']);
		$sql->execute();
		while($data = $sql->fetch(PDO::FETCH_ASSOC)){
			$my_post_question[] = $data;
		}
		return $my_post_question;
	}
}

