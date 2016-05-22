<?php ob_start();
	
	//auth check
	require_once('auth.php');
	
	//set page title
	$title='Athelete';
	require_once('header.php');
try{	
	//connect to db
	require_once('db.php');
	
	//setup an SQL query
	$sql ="SELECT * FROM athletes";
	
	//column sorting
	$sort=$_GET['sort'];
	$dir=$_GET['dir'];
	
	//set default 
	if(empty($sort)){
		$sort="first_name";
		$dir="ASC";
	}
	
	$sql=$sql." ORDER BY $sort $dir";
	
	//execute the query and store the results
	$cmd=$conn->prepare($sql);
	$cmd->execute();
	$result =$cmd->fetchAll();
	
	//toogle the direction variable **BEFORE** creating the header links
	if($dir=="ASC"){
		$next_dir="DESC";
	}
	else{
		$next_dir="ASC";
	}
	
	function set_arrow($column,$sort_column,$sort_direction)
	{
		//emppty class name by default
		$class='';
		
		//is the current column the same as the sort column?
		if($column==$sort_column){
			//show the up or down arrow accordingly
			if($sort_direction=="ASC"){
				$class="fa fa-sort-asc";
			}
			else{
				$class="fa fa-sort-desc";
			}
		return $class;
		}
	}

	//start table and add the headings BEFORE our loop
	echo '<table class="table table-striped"><thead>
	<th><a href="athletes.php?sort=first_name&dir='.$next_dir.'">First name</a><i class="'.set_arrow('first_name',$sort,$dir).'"></i></th>&nbsp;
	<th><a href="athletes.php?sort=last_name&dir='.$next_dir.'">Last name</a><i class="'.set_arrow('last_name',$sort,$dir).'"></i></th>&nbsp;
	<th><a href="athletes.php?sort=email&dir='.$next_dir.'">Email</a><i class="'.set_arrow('email',$sort,$dir).'"></i></th>&nbsp;
	<th>Edit</th>&nbsp;<th>Delete</th></thead><tbody>';
	
	//loop through the query result where $result
	foreach($result as $row){
	//display
	echo '<tr><td>'.$row['first_name'] .'</td>
		<td> '. $row['last_name'] .'</td>
		<td> '. $row['email'] .'</td>
		<td><a href="athlete.php?athlete_id='.base64_encode($row['athlete_id']).'">Edit</a></td>
		<td><a href="delete-athelete.php?athlete_id='.base64_encode($row['athlete_id']).'"onclick="return confirm(\'Are you sure you want to delete?\');">Delete</a></td></tr>';
	}
	echo '</tbody></table>';
	
	//disconnect
	$conn=null;
	}
	catch (exception $e){
	//email ourselves the error details
	mail("plbrighto@gmail.com","Error!!",$e);
	header('location:error.php');

	}
	require_once('footer.php');

	ob_flush(); 
	?>	
