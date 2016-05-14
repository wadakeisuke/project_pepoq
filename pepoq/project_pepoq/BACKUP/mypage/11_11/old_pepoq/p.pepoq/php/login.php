<?php
session_start();
//cookie設定
//emailをクッキー設定
if(isset($_COOKIE['my_email'])){
	$my_email=$_COOKIE['my_email'];
}else{
	$my_email='';
}
//begin class Login
class Login
{
	private $email;
	private $password;

	public function setEmail($email)
	{
		$this->email=$email;
	}
	public function setPassword($password)
	{
		$this->hash($password);
	}
	//ログインするパスワードをハッシュ化
	public function hash($password)
	{
		for($num=0;$num<1000;$num++){
	      $password=sha1($password);
	      $password=md5($password);
	    }
	    $this->password=$password;
	}
	public function login_sb()
	{
		try{
			$pdo=require('../../php/db_connect.php');
			$email=$this->email;
			$password=$this->password;
			//DBからemail passwordが同じ情報を取得	
			$sql=$pdo->prepare('SELECT * FROM acount WHERE email=:email AND password=:password');
			$sql->bindValue(':email',$email);
			$sql->bindValue(':password',$password);
			$sql->execute();
			if($data=$sql->fetch(PDO::FETCH_ASSOC)){
				$_SESSION['login']['email']=$email;
				$_SESSION['login']['password']=$password;
				header('Location: ../mypage/mypage.php');
				exit();
			}else{
				header('Location: ../confirm/login_error.php');
				exit();
			}
		}catch(PDOException $e){
			echo('Error'.$e->getMessage());
			die();
		}
		$pdo=null;
	}
}
//end class login
//loginがクリックされた場合
$login=(isset($_POST['login']))?$_POST['login']:null;
if($login==='Login'){
	$email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
	$password=htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');
	if($email&&$password){
		$login=new Login();
		$login->setEmail($email);
		$login->setPassword($password);
		
		$my_email=$email;
		$save=(isset($_POST['save']))?$_POST['save']:null;
		//保存するにチェックがあった場合
		if($save=='on'){
			//1週間クッキーを保存
			setcookie('my_email',$my_email,time()+60*60*24*7);
		}else{
			setcookie('my_email','');
		}

		$login->login_sb();
	}else{
		header('Location: ../confirm/login_error.php');
		exit();
	}
	
}