<?php ob_start(); ?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>Validating..</title>
	</head>
	
	<body>
		<?php
		$username = $_POST['username'];
        $password = hash('sha512', $_POST['password']);
        //connect
		require_once('db.php');
		//query
		$sql = "SELECT user_id FROM users WHERE username = :username AND password = :password";
		
		$cmd = $conn->prepare($sql);
		$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
		$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
		$cmd->execute();
		$result = $cmd->fetchAll();
		//count the number of rows returned by our query
		//$count = $result->rowCount();
		//check how many users matched the username hashed password
		if (count($result) >= 1) {
		echo 'Logged in Successfully.';	
		
		//store the user identity before they leave this page
		foreach  ($result as $row) {
			//access the existing session
			session_start();
			
			//store the user_id in the sessin object
			$_SESSION['user_id']=$row['user_id'];
			
			//load the athletes page
			header('location:athletes.php');
			}
		}
		
		else {
		echo 'Invalid Login';
		}
			
		$conn = null;
		?>
	</body>
	
</html>
<?php ob_flush(); ?>