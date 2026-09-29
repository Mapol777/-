<?php require_once("database.php");
$con = db_connect();
$msg ="";
if(isset($_POST["register"])){
	if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['password2']) && !empty($_POST['password'])) {
		$full_name= htmlspecialchars($_POST['full_name']);
		$email=htmlspecialchars($_POST['email']);
		$date = date("Y-m-d");
		$doll=htmlspecialchars($_POST['password']);
		$doll2=htmlspecialchars($_POST['password2']);
		$password = password_hash("$doll", PASSWORD_BCRYPT);
		$regex = '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/';
		if ($doll == $doll2) {
			if(preg_match($regex, $email)) {
				$count=$con -> query("SELECT * FROM usertbl WHERE email='".$email."'");
				if(mysqli_num_rows($count) < 1) {
					$query= $con -> query("SELECT * FROM usertbl WHERE full_name='".$full_name."'");
					$numrows=mysqli_num_rows($query);
					if($numrows==0) {
						$hash = md5($full_name . time());
						$sql="INSERT INTO usertbl (`full_name`, `email`, `loked`, `password`, `hash`, `date`) VALUES('$full_name','$email', 1, '$password', '$hash', '$date')";
						$result=$con -> query($sql);
						if($result){
							include 'mail.php';
							Send_Mail($full_name, $email, $hash);
							session_start();
							$_SESSION['session_username'] = $email;	 
							header("Location:user.php");
						} else {
							$message3 = "Failed to insert data information!";
						}
					} else {
						$message3 = "Это имя пользователя уже существует! Пожалуйста, используйте другое!";
					}
				} else {
					$msg= 'Данный адрес электронный почты уже занят, пожалуйста, введите другой. Забыли пароль? <a href=vosstanovlenie.php>Восстановить</a> '; 
				} 
			} else {
				$msg = 'Адрес, введенный вами, неверен. Пожалуйста, попробуйте еще раз.'; 
			}
		}
		else{
			$error = 'Пароли не совпадают';
		}
	}
}
?>
<?php require "themes.php";?>
<?php include("header.php"); ?>
<div class="container mregister forzirofor">
	<div id="login">
		<div style="display: flex;margin-bottom: 50px;"></div>
		<h1 class="polz">Регистрация</h1>
		<form action="register.php" id="loginform" method="post"name="registerform"style=" text-align: center;">

			<input class="input" id="full_name" name="full_name"size="32"  type="text" value="" placeholder = 'Полное имя' required><p class="lop"><?php if (!empty($message3)) echo "$message3" ?></p></p>

			<input class="input" id="email" name="email" size="32"type="email" value="" placeholder = 'E-mail' required><p class="lop">
				<?php if (!empty($message2)) echo "$message2" ?></p><?php if ($msg !== NULL) echo $msg;?> </p>

			<input class="input" id="password" name="password"size="32"   type="password" value="" placeholder = 'Пароль' required><p class="lop"><?php if (!empty($message4)) echo "$message4" ?></p></p>
			<input class="input" id="password" name="password2"size="32"
					type="password" value="" placeholder = 'Повторите пароль' required> <p class="lop">
			<?php if (!empty($error)) echo "$error" ?></p></p>
			<p class="submit"><input class="button regist" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
			<p class="regtext">Уже зарегистрированы? <a href= "index.php">Введите имя пользователя!</a></p>
		</form>
	</div>
</div>
  <?php require "footer.php";?>