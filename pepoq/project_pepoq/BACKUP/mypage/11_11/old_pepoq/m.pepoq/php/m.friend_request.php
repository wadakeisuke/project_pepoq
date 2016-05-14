<?php
session_start();
require('../../php/db_connect.php');
if($_SESSION['mypage']['email'] == '' OR $_SESSION['mypage']['password'] == ''){
	header('Location: ../mypage/mypage.php');
	exit();
}
function h($str){
	return htmlspecialchars($str,ENT_QUOTES,'utf-8');
}

//ログインしていないとクリックしても意味ない
$which_friend='request'; //which_friend

//profile(StandByされた人)のemail password
$profile_email=$_SESSION['profile']['email']; //accepter_email
$profile_password=$_SESSION['profile']['password']; //accepter_password
$profile_thumbnail=$_SESSION['profile']['thumbnail']; //thumbnail
$profile_name=$_SESSION['profile']['name']; //name

//loginしたひと(StandByした人)のemail password
$mypage_email=$_SESSION['mypage']['email']; //sender_email
$mypage_password=$_SESSION['mypage']['password']; //sender_password
$mypage_name=$_SESSION['mypage']['name']; //name
$mypage_thumbnail=$_SESSION['mypage']['thumbnail']; //thumbnail

$relation=h($_POST['relation']);//relation
$more_relation=h($_POST['more_relation']);//relation

$c_type1=h($_POST['c_type1']);
$comment1=h($_POST['comment1']);

$c_type2=h($_POST['c_type2']);
$comment2=h($_POST['comment2']);

$c_type3=h($_POST['c_type3']);
$comment3=h($_POST['comment3']);

$comment4=h($_POST['comment4']);

$question=h($_POST['question']);

try{
	//既にリクエストしていないかを調べる
	$sql=$pdo->prepare('SELECT * FROM friends WHERE accepter_email=:ac_email AND accepter_password=:ac_pass AND sender_email=:se_email AND sender_password=:se_pass');
	$sql->bindValue(':ac_email',$profile_email);
	$sql->bindValue(':ac_pass',$profile_password);
	$sql->bindValue(':se_email',$mypage_email);
	$sql->bindValue(':se_pass',$mypage_password);
	$sql->execute();
	//既にリクエストしていた場合プロフィールに戻る
	if($requested=$sql->fetch(PDO::FETCH_ASSOC)){
		header('Location: ../mypage/mypage.php');
    	exit();
	}
	//requestした人をデータベースに追加
	$stmt=$pdo->prepare('INSERT INTO friends(which_friend, accepter_email, accepter_password, sender_email, sender_password, name, thumbnail, comment1_type, comment1, comment2_type, comment2, comment3_type, comment3, comment4, relation, more_relation) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->execute(array("$which_friend","$profile_email","$profile_password","$mypage_email","$mypage_password","$mypage_name","$mypage_thumbnail","$c_type1","$comment1","$c_type2","$comment2","$c_type3","$comment3","$comment4","$relation","$more_relation"));

	//acceptする人をデータベースに追加 acceptしたら　acceptをallにかえ、さらにコメント、関係性をかえる。
	$stmt=$pdo->prepare('INSERT INTO friends(which_friend,accepter_email,accepter_password,sender_email,sender_password,name,thumbnail,comment1_type,comment1,comment2_type,comment2,comment3_type,comment3,comment4,relation,more_relation) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->execute(array('accept',"$mypage_email","$mypage_password","$profile_email","$profile_password","$profile_name","$profile_thumbnail","$c_type1","$comment1","$c_type2","$comment2","$c_type3","$comment3","$comment4","$relation","$more_relation"));

    //質問を追加
	$stmt=$pdo->prepare('INSERT INTO question(type,accepter_email,sender_email,name,thumbnail,question) VALUES (?,?,?,?,?,?)');
	$stmt->execute(array('new',"$profile_email","$mypage_email","$mypage_name","$mypage_thumbnail","$question"));
    $pdo = null;

    header('Location: ../mypage/mypage.php');
    exit();
  }catch(PDOException $e){
    echo('Error'.$e->getMessage());
    die();
}