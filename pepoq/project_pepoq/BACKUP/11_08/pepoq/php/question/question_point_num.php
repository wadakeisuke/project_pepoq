<?php
class QuestionPointNum
{
	public function get_good_point_num($question_id)
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * 
			FROM 
				question_point
			WHERE
				question_id = :question_id AND
				point_type = :point_type
		');
		$sql->bindValue(':question_id', $question_id);
		$sql->bindValue(':point_type', 'good');
		$sql->execute();
		while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
			$data_list[] = $data;
		}
		return count($data_list);
	}

	public function get_bad_point_num($question_id)
	{
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * 
			FROM 
				question_point
			WHERE
				question_id = :question_id AND
				point_type = :point_type
		');
		$sql->bindValue(':question_id', $question_id);
		$sql->bindValue(':point_type', 'bad');
		$sql->execute();
		while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
			$data_list[] = $data;
		}
		return count($data_list);
	}

}