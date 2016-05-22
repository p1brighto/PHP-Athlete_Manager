<?php ob_start();
$tittle=Gallery;
require_once('header.php');
?>
<div class="container">
	 <style>
	 	 .gallery-list li {list-style: none; list-style-type: none; text-align: center;}
		 .gallery-list li:nth-child(5) {clear:both;}
		 .gallery-list li img {margin: 15px auto; display: block;}	
  	 </style>
	
	<?php
	//connect
	require_once('db.php');
	//get images
	$sql="SELECT first_name,last_name,photo FROM athletes ORDER BY last_name";
	
	//execute query
	$cmd = $conn->prepare($sql);
	$cmd->execute();
	$result=$cmd->fetchAll();
	
	echo '<ul class="gallery-list">';
	//loop through the results and show each photo
	foreach ($result as $row){		
		 echo'<li class="col-md-3">
		 <a class="thumbnail" href="images/'.$row['photo'].'" alt="Enlarge" >
		 <img src="images/'.$row['photo'].'" alt="profile" class="img-thumbnail" width="150" height="100"/>
		 <h5>'.$row['first_name'].' '.$row['last_name'].'</h5></a></li>';
	}
	echo '</ul>';

	?>
</div>
<?php
require_once('footer.php');
ob_flush();
?>