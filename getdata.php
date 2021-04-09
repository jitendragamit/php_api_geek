<?php
/*
Author : Jitendra Gamit
date : 6thApl, 2021
Purpose : Add game score 
**/

include_once("database.php");

 $sql = "SELECT u.Id, nickname, username, user_type, score, timediff(end_time, start_time) as time_taken
        FROM users u 
		LEFT JOIN gamedetails g ON u.Id = g.user_id 
		WHERE user_type = 'learner' and score is not null";
   
 //$sql = "SELECT Id, nickname, username, user_type FROM users WHERE user_type = 'learner'";
 
    if($result = mysqli_query($mysqli,$sql))
	{
	 $rows = array();
	  while($row = mysqli_fetch_assoc($result))
	  {
		$rows[] = $row;
	  }
	  echo json_encode($rows);
	}
	else
	{
	  http_response_code(404);
	}
	
?>