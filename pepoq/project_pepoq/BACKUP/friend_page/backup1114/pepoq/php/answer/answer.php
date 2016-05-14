<?php
class Answer
{
	/**
	 * 質問に対する回答の数を取得 
	 * @param int $question_id
	 * @return int
	 */
	function get_num_for_answer($question_id)
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM answer WHERE question_id = :question_id');
		$sql->bindValue(':question_id', $question_id);
		$sql->execute();
		while($data = $sql->fetch(PDO::FETCH_ASSOC)){
			$answer_data[] = $data;
		}
		return count($answer_data);
	}

	/**
	 * question_idから回答を取得 新しい順番で
	 * @param int $question_id
	 * @return array $answer_data_list
	 */
	function get_answer_data($question_id)
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM answer WHERE question_id = :question_id ORDER BY created DESC');
		$sql->bindValue(':question_id', $question_id);
		$sql->execute();
		while($data = $sql->fetch(PDO::FETCH_ASSOC)){
			$answer_data_list[] = $data;
		}
		return $answer_data_list;
	}	
}