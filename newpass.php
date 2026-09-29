<?php require_once("database.php");
$con = db_connect();
session_start();
$email = $_SESSION["session_username"];
$query = mysqli_query($con, "SELECT * FROM usertbl WHERE email='".$email."'");
// $query = $con -> query("SELECT * FROM usertbl WHERE email='".$email."'");
$numrows= mysqli_num_rows($query);
if($numrows!=0 ) {
	while($row=mysqli_fetch_assoc($query)) {
		$dbpassword=$row['password'];
	}
}
if (isset($_POST['login'])) {
	$password= htmlspecialchars($_POST['password']);
	$newpass1 = htmlspecialchars($_POST['newpass1']);
	$newpass2 = htmlspecialchars($_POST['newpass2']);

	if (password_verify($password, $dbpassword)){
		if ($newpass1 == $newpass2) {
			$password = htmlspecialchars($_POST['newpass1']);		
			$password = password_hash("$password", PASSWORD_BCRYPT);
			$query = mysqli_query($con, "UPDATE `usertbl` SET `password` = '".$password."' WHERE email='".$email."'");
			$LOP = 'Пароль успешно изменен! <a href=user.php>Перейти в личный кабинет</a>';
		}
		else{
			$error = 'Пароли не совпадают';
		}
	}
	else {
		$messog1 = 'Неверный пароль';
	}
}
?>
<?php include("header.php"); ?>	
<div class="forzirofor">
    <div style="display: flex;margin-bottom: 100px;"></div> 
	<div class="container mlogin">
		<div id="login">
			<h1 class="polz">Изменение пароля</h1>
			<?php if (!isset($LOP)) { ?>
				<form action="" id="loginform" method="post"name="loginform">
					<input class="input newpass" id="password" name="password"size="20"
					type="password" value="" placeholder = 'Старый пароль' required> <p class="lop"><?php if (!empty($messog1)) echo "$messog1" ?></p></p>

					<input class="input newpass" id="password" name="newpass1"size="20"
					type="password" value="" placeholder = 'Новый пароль' required> <p class="lop"><?php if (!empty($messog)) echo "$messog" ?></p></p>

					<input class="input newpass" id="password" name="newpass2"size="20"
					type="password" value="" placeholder = 'Повторите новый пароль' required> <p class="lop"><?php if (!empty($error)) echo "$error" ?></p></p>
					<p class="submit"><input class="button repeat_email" name="login" type= "submit" value="Изменить пароль" id="btn"></p>
					<p class="submit"><a href="user.php">Отмена</a></p>
				</form>
			<?php } else echo $LOP; ?>
		</div>
	</div>
</div>
  <?php require "footer.php";?>
