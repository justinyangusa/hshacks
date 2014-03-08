<!DOCTYPE html>
<html>
	<head>
		<title>DistComp</title>
	</head>
	<body>
<?php
	$allowedExts = array("zip");
	if ($_FILES["file"]["error"] > 0) {
		echo "Error " . $_FILES["file"]["error"] . "<br />";
	} else {
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if (in_array($extension, $allowedExts)) {
			if (file_exists("projects/" . sha1($_FILES["file"]["name"]) . "/" . $_FILES["file"]["name"])) {
				echo "Error: file already exists";
			} else {
				$fh = @fopen($_FILES["file"]["tmp_name"], "r");
				$blob = fgets($fh, 5);
				if (strpos($blob, 'PK') !== false) {
					$server = "distcomp.db.11560964.hostedresource.com";
					$user = "distcomp";
					$password = "a1#qoiwWQ";
					$database = "distcomp";
					$db = mysql_connect($server, $user, $password) or die('Could not connect to DB ' . mysql_error());
					mysql_select_db($database) or die("Could not select database.");
					mysql_query("INSERT INTO projects VALUES (" . "projects/" . sha1($_FILES["file"]["name"]) . "/" . $_FILES["file"]["name"]	 . ", '" . sha1($_FILES["file"]["name"]) . "', '" . $_FILES["file"]["name"] . "')");
					move_uploaded_file($_FILES["file"]["tmp_name"], "projects/" . sha1($_FILES["file"]["name"]) . "/" . $_FILES["file"]["name"]);
					echo "Project uploaded";
				} else {
					echo "Invalid ZIP file";
				}
			}
		} else {
			echo "Not ZIP file";
		}
	}
?>
	</body>
</html>