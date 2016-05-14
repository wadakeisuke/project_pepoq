<?php
if($_GET['search_word'] && $_GET['search_word'] !== ''){
	$search_word = h($_GET['search_word']);
	$result_friend = search_friend($search_word);
}else{
	$result_friend = get_all_friend();
}

/**
 * パラメータをサニタイズ
 * @param string $value
 * @return string $sanitize_result;
 */
function h($value)
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * 友達を検索
 * @param array $search_word
 * @return 
 */
function search_friend($search_word)
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data WHERE name LIKE :name');
	$sql->bindValue(':name', $search_word);
	$sql->execute();
	$result_friend = [];
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		array_push($result_friend, $data);
	}
	return $result_friend;
}

/**
 * 全てのユーザーを表示
 *
 */
function get_all_friend()
{
	include('../php/db_connect.php');
	$sql = $pdo->prepare('SELECT * FROM personal_data ORDER BY id DESC');
	$sql->execute();
	$result_friend = [];
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		array_push($result_friend, $data);
	}
	return $result_friend;
}
