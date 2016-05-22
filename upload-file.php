<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>Upload any File</title>
	</head>
	
	<body>
			<form method="post" action="save-upload.php" enctype="multipart/form-data">
				<div>
					<label for="upload">Upload any file</label>
					<input type="file" name="upload"/>
				</div>
				<input type="submit" value="Upload"/>
			</form>
	</body>

</html>
