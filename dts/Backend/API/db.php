<?php

$db_host = 'localhost';
$db_name = 'dts';  //db name
$username = 'root'; //default username
$password = ''; //default password


try {
    //connect to MySQL database club on localhost by default username/password 
	$pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $ex) {
	echo("<p style='text-align:center;color:red'>Failed to connect to the database.</p><br>"); 
	echo($ex->getMessage());
	;
}
?>