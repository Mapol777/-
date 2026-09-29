<?php
  require_once("database.php");
  $link = db_connect();

  if(!isset($_SESSION)) 
    session_start();
  if(isset($_GET['id_new']) && isset($_GET['email_user'])){
  	if (!empty($_POST)){
  		$id_new = $_GET['id_new'];
  		$email_user = $_GET['email_user'];
  		$content = trim($_POST['review-text']);
  		$date = date("Y-m-d");
  		$count=$link -> query("SELECT id, full_name FROM usertbl WHERE email='$email_user'");
  		$numrows= mysqli_num_rows($count);
  		if($numrows!=0 ) {
			while($row=mysqli_fetch_assoc($count)) {
				$id_user =$row['id'];
				$name=$row['full_name'];
			}
		}
  		$query = sprintf("INSERT INTO comments (`id_new`, `id_user`, `user_name`, `date`, `text`, `moder`)VALUES ('%d', '%d', '%s', '%s', '%s', '0')", 
  			(int)$id_new, 
  			(int)$id_user, 
  			mysqli_real_escape_string($link, $name),
  			mysqli_real_escape_string($link, $date), 
  			mysqli_real_escape_string($link, $content));
        $result = mysqli_query($link, $query);
        header("Location: newpage.php?id=$id_new");
  	}
  	else 
  		header("Location: news.php");
  }
  else
  	header("Location: news.php");
?>