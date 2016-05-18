<?php
	// Include the settings file so we can load the variables needed to connect.
	include '../Settings.php';

	// Form a connection to the MySQL server.
	$conn = new mysqli($servername, $username, $password, $database);
	//
	if ($conn) // Check if the connection was successfull
	{
		$conn->query("CREATE TABLE IF NOT EXISTS accountsSystem( username TEXT, hpassword TEXT )"); // If it was then, we will create the table if it doesn't exist.
	}
	//
?>
