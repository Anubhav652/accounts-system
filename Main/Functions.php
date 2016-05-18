<?php
	include( 'Connections.php' ); // Include the connections file so we can access the connection things!

	function checkAccountExist( $username ) // A function which checks if the account exists or not
	{
		global $conn; // Declare this so we can use $conn here.

		if ($conn) // Again to check if connection was successfull so we proceed
		{
			$q = $conn->query( "SELECT username FROM accountsSystem WHERE username='".$username."'" ); // If it was then check if the account exists by using a query
			if ($q->num_rows == 0) // Now we check if the query returned how many rows
			{
				return "False"; // If it returned 0 rows, it means there was no account with that username, so we return a string value "False" to tell that no such account exist.
			}
			else // If the query returned more than that then..
			{
				return "True"; // It will return "True" as there was a account found with that name
			}
		}
		//
		else // If there was no connection
		{
			return "Error: The resource was not able to connect to the MySQL database."; // Return that there a error in MySQL database
		}
	}
	//
	function deleteUser( $username ) // You can delete a user using these functions
	{
		if (checkAccountExist( $username ) === "True") // Check if the account exist and then go. This can return the normal error.
		{
			$conn->query( "DELETE FROM accountsSystem WHERE username='".$username."'"); // Delete the user.
			return "That account with the username ".$username." was deleted!"; // Return that the account was deleted without any problems
		}
		else // If it did not 
		{
			return "There is no account with that username"; // Return that there was no account with that username so it becomes clear, it doesn't exist! :#
		}
	}
	//
	function createUser( $username, $password ) { // Function made for creating a user/account..
		//
		global $conn; // Declare this so we can use $conn here.

		if ($conn) // Again to check if connection was successfull so we proceed
		{
			if (checkAccountExist( $username ) !== "True") // If connection was successfull then check if the account exist, if it doesn't go ahead.
			{
				$conn->query( "INSERT INTO accountsSystem(username, hpassword) VALUES('".$username."','".md5($password)."')" ); // If does not exist then add the username to the table
				
				return "Your account has been created with the username of: ".$username; // Return the message that the query was successfull
			}
			else // If it was already taken
			{
				return "A account with the same name already exists!"; // Return that the account already exists message
			}
		}
		//
		else // If there was no connection
		{
			return "Error: The resource was not able to connect to the MySQL database."; // Return that there a error in MySQL database
		}
	}
?>
