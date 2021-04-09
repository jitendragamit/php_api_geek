<?php
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Origin: http://192.168.230.135:4200");

header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

/*
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'db_test_geek';
**/

/*
$db_host = 'localhost';
$db_username = 'jitendra_jitendb';
$db_password = '~Gamit123';
$db_name = 'jitendra_gamit';
***/

$db_host = '103.50.163.144';
$db_username = 'root';
$db_password = 'Cg04#OoI8H7O@X';
$db_name = 'db_creditor_portal_test';

/*
public $host = 'localhost';
	public $user = 'jitendra_jitendb';
	public $password = '~Gamit123';
	public $db = 'jitendra_gamit';
***/



$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);

if ($mysqli->connect_error) {
	die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>