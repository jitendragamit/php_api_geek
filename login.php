<?php
include_once("database.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if(isset($postdata) && !empty($postdata))
{
	$pwd = mysqli_real_escape_string($mysqli, trim($request->password));
	$username = mysqli_real_escape_string($mysqli, trim($request->username));
	$nickname = mysqli_real_escape_string($mysqli, trim($request->nickname));

    $pwd = md5($pwd);

	$sql = "SELECT * FROM users where username='$username' and password='$pwd'";
	
	$result = mysqli_query($mysqli,$sql);
	
	$rowcount=mysqli_num_rows($result);
	
	if ($rowcount <= 0) {
			$request = json_decode($postdata);
			$sql = "INSERT INTO users(username, password, nickname) VALUES ('$username','$pwd','$nickname')";
		    $ret = $mysqli->query($sql);
			
			$chk = checkRecord ($mysqli,  $username, $pwd);
			echo $chk;
				
	} else {
		$rows = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$rows[] = $row;
		}
		echo json_encode($rows);
	}
}

/*
Author : jiten
**/
function checkRecord ( $mysqli,  $username, $pwd ) {
	
	$sql = "SELECT * FROM users where username='$username' and password='$pwd'";
	$result = mysqli_query($mysqli,$sql);
	
	$rows = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$rows[] = $row;
	}
	return json_encode($rows);
}

?>