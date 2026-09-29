<?php require_once("database.php");
$con = db_connect();
session_start();

if(!isset($_SESSION["session_username"])):
	header("location:index.php");
else:

	$query = mysqli_query($con, "SELECT * FROM usertbl WHERE email='".$_SESSION["session_username"]."'");
		// $query = $con -> query("SELECT * FROM usertbl WHERE username='"$_SESSION["session_username"]"'");
	$numrows= mysqli_num_rows($query);
	if($numrows!=0 ) {
		while($row=mysqli_fetch_assoc($query)) {
			$hash=$row['hash'];
			$email=$row['email'];
			$chek=$row['email_chek'];
			$name=$row['full_name'];
		}
	}
	if(isset($_POST["login"])){
		include 'mail.php';
		Send_Mail($name, $email, $hash);
	}
	?>
	
	<?php include("header.php"); ?>
	<div id="welcome">
		<h2>Добро пожаловать, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
		<p><a href="logout.php">Выйти</a> из системы</p>
		<?php if($chek == NULL) { ?>
			<p>Ваш Email не подтведтвержден, на вашу почту отправлено письмо с сыдкой для подтверждения, перейдите по ней пожалуйста</p>
			<form action="" id="loginform" method="post"name="loginform">
				<p><input value="Отправить письмо повторно" type="submit" name="login"></p>
			</form> 
		<?php } ?>
		<p class="submit"><a href = newpass.php>Смена пароля</a></p>
	</div>
</body>
</html>


<?php endif; ?>