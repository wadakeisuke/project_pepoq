<?php
$dsn = "mysql:dbname=standby_x_mtm;host=mysql505.db.sakura.ne.jp;charset=utf8;";
$user = 'standby';
$pass = 'standby_db_connect';
$pdo = new PDO($dsn,$user,$pass);
$ok = 'o k ';$ng='NG';
$sql = $pdo->prepare('SELECT * FROM data');
$sql->execute();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
	//名前が正しく入力されているかのチェック
	$name = null;
	if(!isset($_POST['name']) || !strlen($_POST['name'])){
		$errors['name'] = '名前を正しく入力してください';
	}else if(strlen($_POST['name']) > 40){
		$errors['name'] = '40文字以内で入力してください';	
	}else{
		$name = $_POST['name'];
	}

	//ひとことが正しく入力されているかチェック
	$comment = null;
	if(!isset($_POST['comment']) || !strlen($_POST['comment'])){
		$errors['comment'] = '一言を入力してください';
	}else if(strlen($_POST['comment']) > 200){
		$errors['comment'] = '200文字以内で入力してください';	
	}else{
		$comment = $_POST['comment'];
	}

	if(count($errors) === 0){
	//保存するためのsql文作成

	/*VALUES('". $name ."',
		'". $comment ."',
		'". date('Y-m-d H:i:s') ."'
		)";*/
		//保存する
		//mysql_query($sql,$dbh);//これ
		//mysql_close($dbh);
	}
}
/*
while($data=$sql->fetch(PDO::FETCH_ASSOC)){
	echo($data['id']);echo('<br>');
	echo($data['date']);echo('<br>');
	echo($data['unique_id']);echo('<br>');
	echo($data['name']);echo('<br>');
	echo($data['comment']);echo('<br>');
	echo($data['created']);echo('<br>');
}*/

	$sql = $pdo->prepare("insert into data (date,name,comment) values(?,?,?)");
	$sql -> execute(array("","wada","keisuke"));
?>

<!doctype html>
<html>
<head>
<title>掲示板</title>
<meta charset="utf-8">
</head>
<body>
<h1>掲示板</h1>

<form action="kuma.php" method="post">
	<?php if(count($errors) > 0): ?>
	<ul class="error_list">
	<?php foreach($errors as $error): ?>
		<li>
			<?php echo htmlspecialchars($error,ENT_QUOTES,'utf-8') ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	名前：<input type="text" name="name">
	ひとこと：<input type="text" name="comment">
	<input type="submit"  name="submit" value="投稿">
</form>

</body>
</html>

