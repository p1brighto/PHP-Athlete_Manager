<? ob_start();?>
<!DOCTYPE >
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Saving Athlete Details...</title>
</head>

<body>
<?php
//store into input variables
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$athlete_id=$_POST['athlete_id'];
$ok=true;
//photo check
$photo=$_FILES['photo']['name'];
if($photo)
{
	//check type
	$type=$_FILES['photo']['type'];
	if($type=="image/jpeg" || $type=="image/png"){
		
		//give the file a unique name
		session_start();
		$photo=session_id().'-'.$photo;
		
		//save the file
		$tmp_name=$_FILES['photo']['tmp_name'];
		move_uploaded_file($tmp_name,"images/$photo");
	}
	else{
		echo 'Invalid file type';
		$ok=false;
	}
}
else
{
	$photo=$_POST['current_photo'];
}
if($ok){
try{
//connect to db using our credentials
require_once('db.php');
//set up and execute an SQL INSERT command
//set up the sql 
if(!empty($athlete_id)){
$sql="UPDATE athletes SET first_name=:first_name,last_name=:last_name,email=:email,photo=:photo WHERE athlete_id=:athlete_id";
}
else{
$sql="INSERT INTO athletes(first_name,last_name,email,photo) VALUES(:first_name,:last_name,:email,:photo) ";
}
//create a command object to fill the parameter vaues
$cmd = $conn->prepare($sql);
$cmd->bindParam(':first_name',$first_name,PDO::PARAM_STR,50);
$cmd->bindParam(':last_name',$last_name,PDO::PARAM_STR,50);
$cmd->bindParam(':email',$email,PDO::PARAM_STR,50);
$cmd->bindParam(':photo',$photo,PDO::PARAM_STR,100);

//add athlete_id parameter if we are updating
if(!empty($athlete_id)){
$cmd->bindParam(':athlete_id',$athlete_id,PDO::PARAM_INT);
}
$cmd->execute();
//disconnect
$conn=null;
//redirect to updated athletes page
header('location:athletes.php');
}
catch (exception $e){
	//email ourselves the error details
	mail("plbrighto@gmail.com","Save_Error!!",$e);
	header('location:error.php');
}
}
?>

</body>

</html>
<?php ob_flush();?>