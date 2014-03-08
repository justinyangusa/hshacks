<!DOCTYPE html>
<html>
	<head>
		<title>DistComp</title>
	</head>
	<body>
<?php
	$server = "distcomp.db.11560964.hostedresource.com";
	$user = "distcomp";
	$password = "a1#qoiwWQ";
	$database = "distcomp";
	$db = mysql_connect($server, $user, $password) or die('Could not connect to DB ' . mysql_error());
	mysql_select_db($database) or die("Could not select database.");
	
	$result = mysql_query("SELECT * FROM projects") or die("Query failed");
	$projects = array();
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		projects[] = $line;
	}
	echo json_encode($projects);
	mysql_free_result($result);
	mysql_close($db);
?>
	</body>
</html>