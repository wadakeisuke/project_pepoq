<?php
//header("Content-type: text/html; charset=utf-8");
/*
$dsn = 'mysql:dbname=sbm;host=localhost';
$user = 'root';
//$pass = 'kumakawa'; //xampp
$pass = 'root'; //mac
$pdo=new PDO($dsn,$user,$pass);
$pdo->query('SET NAMES utf-8');
return $pdo;
*/
//以下 さくらサーバの場合
$dsn = "mysql:dbname=standby_pepoq;host=mysql505.db.sakura.ne.jp;charset=utf8;";
$user = 'standby';
//$pass = 'kumakawa'; //xampp
$pass = 'standby_db_connect'; //mac
$pdo=new PDO($dsn,$user,$pass);
//$pdo->query('SET NAMES utf-8');
return $pdo;