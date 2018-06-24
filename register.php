<?php 
$con = mysqli_connect("localhost:1443","root","","social");

if(mysqli_connect_errno()){
    echo "Not Connected:".mysqli_connect_errno();
}
//Declaring variables to prevent errors
$fname=""; //First Name
$lname=""; //Last Name
$em=""; //Email
$em2=""; //Re-enter Email
$password=""; //Password
$password2=""; //Re-enter Password
$date=""; //Date of the Registration
$fname=""; //Holds the error messages

if (isset($_POST['register_button'])){
   
//First Name   
    $fname = strip_tags($_POST["reg_fname"]); //Removes the HTML Tags
    $fname = str_replace(' ','', $fname); //Removes Spaces
    $fname = ucfirst(strtolower($fname)); // Uppercases the First Letter

//Second Name   
$lname = strip_tags($_POST["reg_lname"]);
$lname = str_replace(' ','', $lname);
$lname = ucfirst(strtolower($lname));

//Email   
$em = strip_tags($_POST["reg_email"]);
$em = str_replace(' ','', $em);
$em = ucfirst(strtolower($em));

//Email2   
$em2 = strip_tags($_POST["reg_email2"]);
$em2 = str_replace(' ','', $em2);
$em2 = ucfirst(strtolower($em2));

//Passwords
$password = strip_tags($_POST("reg_password"));
$password2 = strip_tags($_POST("reg_password2"));

if($em==$em2){

}else{
    echo "The Emails Don't Match";
}


//Date of the Registration
$date=("Y-m-d"); //Shows the current date

}


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>


<form>

<input type="text" name="reg_fname" placeholder="First Name" required>
<br><input type="text" name="reg_lname" placeholder="Last Name" required>
<br><input type="email" name="reg_email" placeholder="Your Email" required>
<br><input type="email" name="reg_email2" placeholder="Confirm Email" required>
<br><input type="password" name="reg_password" placeholder="Enter Password" required>
<br><input type="password" name="reg_password2" placeholder="Confirm Password" required>
<br><input type="submit" name="register_button" value="Register">

</form>

     
</body>
</html>