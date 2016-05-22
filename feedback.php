<?php ob_start();

$title='Feedback';
require_once('header.php');
?>
<div class="container">
	<div class="fb-comments" data-href="http://gc200303805.computerstudi.es/Web/Week11/feedback.php" data-numposts="5"></div>
</div>
<?php 
require_once('footer.php');
ob_flush(); ?>	
