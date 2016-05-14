<?php
$dsn = 'mysql:dbname=sbm;host=localhost';
$user = 'root';
//$pass = 'kumakawa'; //xampp
$pass = 'root'; //mac
$pdo=new PDO($dsn,$user,$pass);
$pdo->query('SET NAMES utf-8');
return $pdo;