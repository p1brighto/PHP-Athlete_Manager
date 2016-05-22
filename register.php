<?php ob_start();

$title='Register';
require_once('header.php');
?>
<div class="container">
<h1>User Registeration</h1>
<form method="post" action="save-registration.php" class="form-horizontal">
<div class="form-group">
    <label for="username" class="col-sm-2">Username: </label>
    <input name="username" /> <br>
</div>
<div class="form-group">
    <label for="password" class="col-sm-2">Password:</label>
    <input type="password" name="password" /> <br>
</div>
<div class="form-group">
    <label for="confirm" class="col-sm-2">Confirm Password:</label>
    <input type="password" name="confirm" /> <br>
</div>
<div class="form-group">
    <div class="g-recaptcha" data-sitekey="6LcpfgoTAAAAAFJbUVwwZpCVkPbcQdEHBUzngV_N"></div>
</div>
<input type="submit" value="Register" class="btn btn-primary"/>
</form>
</div></br>
<?php 
require_once('footer.php');
ob_flush(); ?>	
