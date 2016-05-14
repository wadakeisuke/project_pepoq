<?php
class GenreAndCategory
{
	/**
	 * ジャンルを取得
	 */
	function get_genre($id) {
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT DISTINCT category_name FROM category_and_genre');
		$sql->execute();

		while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
			$genre_list[] = $data['category_name'];
		}
		return $genre_list[$id];
	}

	/**
	 * カテゴリを取得
	 */
	function get_category($genre, $id) {
		include('../../php/db_connect.php');
		$sql = $pdo->prepare('SELECT * FROM category_and_genre WHERE category_name = :category_name');
		$sql->bindValue(':category_name', $genre);
		$sql->execute();

		while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
			$category_list[] = $data;
		}
		return $category_list[$id]['genre_name'];
	}
}

