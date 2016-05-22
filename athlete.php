<?php ob_start();
	
	//auth check
	require_once('auth.php');
	
	//set title
	$title='Athelete Details';
	require_once('header.php');
	try{
	
	//check if we have an athlete ID in the querystring
	if(isset($_GET['athlete_id'])){
	
	
	//if we do, store in a variable
	$athlete_id=base64_decode($_GET['athlete_id']);
	
	//connect db
	require_once('db.php');
	
	//select all the data for the selected subscriber
	$sql ="SELECT * FROM athletes WHERE athlete_id=:athlete_id";
	$cmd=$conn->prepare($sql);
	$cmd->bindParam('athlete_id',$athlete_id,PDO::PARAM_INT);
	$cmd->execute();
	$result =$cmd->fetchAll();


	//store each value from the database into a variable
	foreach($result as $row){
	$first_name=$row['first_name'];
	$last_name=$row['last_name'];
	$email=$row['email'];
	$photo=$row['photo'];


	}
	//disconnect
	$conn=null;
		}
		}
		catch (exception $e){
	//email ourselves the error details
	mail("plbrighto@gmail.com","Error!!",$e);
	header('location:error.php');
}

	?>	
	<div class="container">
		<form method="post" action="save-athlete.php" class="form-horizontal" enctype="multipart/form-data">
		<h4>* Required Information</h4>
		<div class="form-group">
		    <label for="first_name" class="col-sm-2">First Name:*</label>
		    <input name="first_name" required value="<?php echo $first_name;?>" />
		</div>
		<div class="form-group">
		    <label for="last_name" class="col-sm-2">Last Name:*</label>
		    <input name="last_name" required value="<?php echo $last_name;?>" />
		</div>
		<div class="form-group">
		    <label for="email" class="col-sm-2">Email:*</label>
		    <input name="email" required type="email" value="<?php echo $email;?>" />
		</div>
		<div class="form-group">
			<label for="photo" class="col-sm-2">Photo:</label>
		    <input name="photo" type="file" />
		</div>
		<?php
		//show photo if one has been saved
		if($photo){
			echo '<div class="col-sm-offset"><img src="images/'.$photo.'" alt="profile" width="150"/></div>';
		}
		?>
		<input type="hidden" name="athlete_id" value="<?php echo $athlete_id;?>" />
		<input type="hidden" name="current_photo" value="<?php echo $photo; ?>" />

		<div class="col-sm-offset-2">
		<input type="submit" value="Save" class="btn btn-primary" />
		</div>
		
		</form>
	</div>
	
	<?php 
	require_once('footer.php');
	ob_flush(); ?>