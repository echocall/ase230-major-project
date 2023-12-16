<?php
// DB

//Configure credentials
$host='localhost';
$db='squadup';
$user='root';
$pass='';
$charset='utf8';

$dsn="mysql:host=$host;dbname=$db;charset=$charset";

//Specify options
$opt = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false
];

$pdo=new PDO($dsn,$user,$pass,$opt);

function select($pdo,$query){
	$result=$pdo->query($query);
	$row=$result->fetchAll();
	// returns as array
	return $row;
}

function query($pdo,$query,$data){
	$query=$pdo->prepare($query);
	print_r("what went wrong===========");
	print_r($data);
	return $query->execute($data);
}