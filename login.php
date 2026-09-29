<?php
  	require_once("database.php");
  	$link = db_connect();

  	if(!isset($_SESSION)) session_start();

  	if(!empty($_POST['username']) && !empty($_POST['password'])) {
	    $username= htmlspecialchars($_POST['username']);
	    $password= htmlspecialchars($_POST['password']);
	    // $query = mysqli_query($con, "SELECT * FROM admin WHERE name = $username");
	    $query = "SELECT * FROM usertbl WHERE email ='$username'";
	    $result = mysqli_query($link, $query);
	    $numrows= mysqli_num_rows($result);
	    if($numrows!=0 ) {
	        while($row=mysqli_fetch_assoc($result)) {
	          $dbusername=$row['email'];
	          $dbpassword=$row['password'];
	        }
	        if (password_verify($password, $dbpassword)){
			    $password = $dbpassword;
			    if($username == $dbusername) {
			          $_SESSION['session_username']=$username;  
			          header("Location: user.php");
			    }
			} else {header("Location: index.php");} 
		} 
	  	else {
	        $query = "SELECT * FROM admin WHERE name = '$username'";
		    $result = mysqli_query($link, $query);
		    $numrows= mysqli_num_rows($result);
		    if($numrows!=0 ) {
		        while($row=mysqli_fetch_assoc($result)) {
		          $dbusername=$row['name'];
		          $dbpassword=$row['password'];
		        }
		        if (password_verify($password, $dbpassword)){
				    $password = $dbpassword;
				    if($username == $dbusername) {
			          $_SESSION['session_admin']=$username;  
			          header("Location: admin.php");
				    }
				} 
				else {header("Location: index.php");} 
		    } 
		    else {header("Location: index.php");} 
	    }
	} 
	else {header("Location: index.php");}
?>