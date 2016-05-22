<?php

//connect to db
require_once("db.php");
/*
if(isset($_GET['athlete_id'])){
	
	$athlete_id=$_GET['athlete_id'];

	//write and execute the query to fetch the data
	$sql="SELECT * FROM athletes WHERE athlete_id=:athlete_id";
		
	$cmd=$conn->prepare($sql);
	$cmd->bindParam('athlete_id',$athlete_id,PDO::PARAM_INT);
	$cmd->execute();
	$result=$cmd->fetchAll();
	echo json_encode($result);
}
else{
}
*/
	//write and execute the query to fetch the data
	$sql="SELECT * FROM athletes";
	
	if(isset($_GET['athlete_id'])){
	
	$athlete_id=$_GET['athlete_id'];
	$sql.="WHERE athlete_id=:athlete_id";
	}
	
	$cmd=$conn->prepare($sql);
	
	if(isset($_GET['athlete_id'])){
	
	$cmd->bindParam('athlete_id',$athlete_id,PDO::PARAM_INT);
	}
	$cmd->execute();
	$result=$cmd->fetchAll();	
	echo json_encode($result);
	

	//diconnect db
	$conn=null;
	
/*
//initialise an empty json arraay to hold the results
$json_obj=array();

//loop through the results
foreach($result as $row){
	//add each record to a json array
	$json_obj[]=$row;
}

//print the entire json array
echo json_encode($json_obj);
*/


?>