<?php 
	session_start(); // starting the session, necessary for using session variables

	// declaring and hoisting the variables
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// DBMS connection code -> hostname, username, password, database name
	$db = mysqli_connect('localhost', 'root', '', 'registration');

	// registration code
	if (isset($_POST['reg_user'])) {

		// receiving the values entered and storing in the variables
		//data sanitization is done to prevent SQL injections
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// ensuring that the user has not left any input field blank
		// error messages will be displayed for every blank input
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
			//checking if the passwords match
		}

		// if the form is error free, then register the user
		if (count($errors) == 0) {
			$password = md5($password_1);//password encryption to increase data security
			$query = "INSERT INTO users (username, email, password) 
					  VALUES('$username', '$email', '$password')"; //inserting data into table
			mysqli_query($db, $query);

			//storing username of the logged in user, in the session variable
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You have logged in"; //welcome message
			header('location: index.php'); 
			//page on which the user will be redirected after logging in
		}

	}

	// user login
	if (isset($_POST['login_user'])) {
		//data sanitization to prevent SQL injection
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		//error message if the input field is left blank
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		//checking for the errors
		if (count($errors) == 0) {
			$password = md5($password); //password matching
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			// $results = 1 means that one user with the entered username exists
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username; //storing username in session variable
				$_SESSION['success'] = "You have logged in!"; //welcome message
				header('location: index.php'); //page on which the user is sent to after logging in
			}else {
				array_push($errors, "Username or password incorrect"); 
				//if the username and password doesn't match
			}
		}
	}

?>