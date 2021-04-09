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
			
			$authdata = [
				'username' => $username,
				'pwd' => $pwd,
				'nickname' => $nickname,
				'user_type' => 'learner',
				'Id' => mysqli_insert_id($mysqli)
				];
				echo json_encode($authdata);
				
	} else {
		$rows = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$rows[] = $row;
		}
		echo json_encode($rows);
	}
}
?>