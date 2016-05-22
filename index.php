<?php ob_start();

session_start();

if($_SESSION['user_id']){
	//redirect to athlete page
	header('location:athletes.php');

}
$title='Log In';
require_once('header.php');
?>
<div class="container">
<h1>Log in</h1>
<form method="post" action="validate.php" class="form-horizontal">
<div class="form-group">
    <label for="username" class="col-sm-2">Username:</label>
    <input name="username" />
</div>
<div class="form-group">
    <label for="password" class="col-sm-2">Password:</label>
    <input type="password" name="password" />
</div>
<div>
    <input type="submit" value="Login" class="btn btn-primary" />
</div>
</form>
</div></br>
<?php 
require_once('footer.php');
ob_flush(); ?>	
