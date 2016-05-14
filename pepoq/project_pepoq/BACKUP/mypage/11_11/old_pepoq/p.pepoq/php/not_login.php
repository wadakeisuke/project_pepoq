<?php
class NotLogin
{
	private $email;
	private $password;

	//コンストラクタ		
	public function __construct()
	{
		if(isset($_SESSION['login']['email'])){
			$this->email = $_SESSION['login']['email'];
		}else{
			$this->email = null;
		}

		if(isset($_SESSION['login']['password'])){
			$this->password = $_SESSION['login']['password'];
		}else{
			$this->password = null;
		}
	}

	//ログインされているかチェック
	public function check()
	{
		if(!isset($this->email) || !isset($this->password)){
			$this->header();
		}
	}

	//トップページにとばす
	private function header()
	{
		header('Location: ../top/top.php');
		exit();
	}

}

$n_login = new NotLogin();
$n_login->check();
