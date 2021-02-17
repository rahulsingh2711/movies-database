<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
  $name = mysqli_real_escape_string($mysqli, $_POST['name']);
  $username = mysqli_real_escape_string($mysqli, $_POST['username']);
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  $psw = mysqli_real_escape_string($mysqli, $_POST['psw']);
  $pswrepeat = mysqli_real_escape_string($mysqli, $_POST['psw-repeat']);
  $rs=mysqli_query($mysqli,"SELECT * from users WHERE username ='$username'");	
	// checking empty fields
	if(empty($name) || empty($username) || empty($email) || empty($psw) || empty($pswrepeat)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($username)) {
			echo "<font color='red'>Username field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
    }
    
    if(empty($psw) || empty($pswrepeat)) {
			echo "<font color='red'>Password cannot be empty</font><br/>";
		}
    
    
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	}
	
	elseif (mysqli_num_rows($rs)>0)
	{
		echo "<br><br><br><div class=head1>Login Id Already Exists</div>";
		
	}
	
	
	else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO users(name,username,email,pass) VALUES('$name','$username','$email','$psw')");
		
		//display success message
		setcookie("sess_user",$username,time()+60*60*24);
		header("Location: indexlo.php"); 
	}
}
?>