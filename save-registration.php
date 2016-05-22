<!DOCTYPE>
<html>

	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>Save Registration</title>
	</head>
	
	<body>
		<?php
		//store the form input in variables
		$username=$_POST['username'];
		$password=$_POST['password'];
		$confirm=$_POST['confirm'];
		
		$ok=true;
		
		//recaptcha  check
		$secret="6LcpfgoTAAAAAHow4A_2RHG7I5PG1QAP87gMzFkB";
		$response=$_POST['g-recaptcha-response'];
		
		//call the recaptcha api
		$url="https://www.google.com/recaptcha/api/siteverify";
		
		$post_data=array();
		$post_data['secret']=$secret;
		$post_data['response']=$response;
		
		//initialise the result to the remote url
		$ch=curl_init();
		
		//add the option to url request
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
		
		//execute the post request and get a result back from google
		$result=curl_exec($ch);
		curl_close($ch);
		
		//evaluate result
		//echo $result;
		
		//decode the result thats in JSON format
		$obj=json_decode($result,true);
		
		//checks the recaptcha
		if($obj['success']==false){
			$ok=false;
			echo 'Please confirm you are a human!</br>';
		}
		
		//input validation
		if(empty($username)){
			echo 'Username is required<br/>';
			$ok=false;
		}
		if(empty($password)){
			echo 'Password is required<br/>';
			$ok=false;
		}
		if($confirm != $password){
			echo 'Password must match<br/>';
			$ok=false;
		}
		if($ok)
		{
			//hash the passwarod
			$password=hash('sha512',$password);
			try{
			//connect to db using our credentials
			require_once('db.php');
	
			//insert
			$sql="INSERT INTO users(username,password) VALUES(:username,:password) ";
			$cmd=$conn->prepare($sql);
			$cmd->bindParam(':username',$username,PDO::PARAM_STR,50);
			$cmd->bindParam(':password',$password,PDO::PARAM_STR,128);
			$cmd->execute();
	
	
			//disconnect
			$conn=null;
			//show a message or give login link
			echo 'Your Registration was saved.Click <a href="index.php">here</a> to log in.';
			}
			catch (exception $e){
				//email ourselves the error details
				mail("plbrighto@gmail.com","Error!!",$e);
				header('location:error.php');
			}

		}
		?>
	</body>

</html>
