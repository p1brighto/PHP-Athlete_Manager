<?php ob_start();
//auth check
require_once('auth.php');
		//check the url for an id value and store in a variable
		$athlete_id=base64_decode($_GET['athlete_id']);
		try{
		//connect
		require_once('db.php');

		//setup the SQL DELETE command
			$sql="DELETE FROM athletes WHERE athlete_id= :athlete_id";
		//execute the deletion
		$cmd=$conn->prepare($sql);
		$cmd->bindParam(':athlete_id',$athlete_id,PDO::PARAM_INT);
		$cmd->execute();
		//disconnect
		$conn=null;
		//redirect to updated atheletes
		header('location:athletes.php');
		}
		catch (exception $e){
	//email ourselves the error details
	mail("plbrighto@gmail.com","Delete_Error!!",$e);
	header('location:error.php');
	}
ob_flush();
?>