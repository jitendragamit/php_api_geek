<?php
/*
Author : Jitendra Gamit
date : 6thApl, 2021
Purpose : Add game score 
**/

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once("database.php");

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
	
	$time_taken = '';
	$score = '';
	
	$request = json_decode($postdata);
	$user_id = mysqli_real_escape_string($mysqli, trim($request->user_id));
	
	$total = count_score($user_id, $mysqli);
	
	$score = $total + 1;
	
	if ($score == 1) {
		$start_time = date('H:i:s');
		$sql = "INSERT INTO gamedetails(user_id, score, start_time) VALUES ('$user_id', '$score', '$start_time')";
	} else {
		$end_time = date('H:i:s');
		$sql = "UPDATE gamedetails SET score = $score, end_time = '$end_time' WHERE user_id = $user_id";
	}
	
	if ($mysqli->query($sql) === TRUE) {
		$authdata = [
		'user_id' => $user_id,
		'score' => $score,
		'time_taken' => $time_taken,
		'Id' => mysqli_insert_id($mysqli)
		];
	    // echo json_encode($authdata);
	}
	
	//
	$sql = "SELECT Id, user_id, score FROM gamedetails where user_id = $user_id";
	
	if($result = mysqli_query($mysqli,$sql))
	{
		  $rows = array();
		  while($row = mysqli_fetch_assoc($result))
		  {
			$rows[] = $row;
		  }
	  echo json_encode($rows);
	}
	
}


/*
Author : Jitendra Gamit
date : 6thApl, 2021
Purpose : to get score 
**/
function count_score($user_id, $mysqli) {
   
    $sql = "SELECT score FROM gamedetails where user_id = $user_id";
	
    $result = mysqli_query($mysqli, $sql);
	$row = mysqli_fetch_array($result);
	return $row['score'];
	
} // EO count_score()


?>