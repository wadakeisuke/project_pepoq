<?php
session_start();
ini_set('display_errors', 1);
/**
 * サインアップ時にグループに参加する
 */

//グループのデータリスト
$group_data_list = [
  'diary',
  'tv_game',
  'entertainment',
  'child_care',
  'stock',
  'computer',
  'sports',
  'medicine',
  'current_news',
  'political_economy',
  'anime',
  'car',
  'work',
  'pet',
  'travel',
  'finance',
  'study',
  'online_game',
  'fashion',
  'affiliate',
  'school',
  'gambling',
];

if(isset($_POST)){
  $join_group_list = array();
  foreach ($group_data_list as $key => $value) {
    if($_POST[$value]){
      $data = $_POST[$value];
      $data = h($data);
      array_push($join_group_list, $data);
    }
  }
  //first_join_group($join_group_list);
  join_group($join_group_list);
  header('Location: ../signup/thanks/thanks_you.php');
  exit;
}

/**
 * ユーザーの初期グループを追加
 * @param array $data
 * @return 
 */
function join_group($join_group_list)
{
  include('db_connect.php');
  foreach ($join_group_list as $group_name) {
    $sql = $pdo -> prepare(
      "INSERT INTO participating_group(
        user_email, 
        group_name, 
        permission
        ) 
       VALUES (
        :user_email, 
        :group_name, 
        :permission
        )"
    );
    $sql->bindValue(':user_email', $_SESSION['mypage']['email']);
    $sql->bindValue(':group_name', $group_name);
    $sql->bindValue(':permission', 'other');
    $sql->execute();
  }
}

/**
 * postメソッドのデータをサニタイジングする
 * @param string $data
 * @return string 
 */
function h($data)
{
  return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
