<?php require_once("database.php");
$con = db_connect();
if (isset($_POST["login2"])) {
	header("Location:index.php");
}
if (isset($_POST["login"])) {
	$email= htmlspecialchars($_POST['email']);
	$query = mysqli_query($con, "SELECT * FROM usertbl WHERE email = '".$email."'");
	$numrows= mysqli_num_rows($query);
	if($numrows!=0 ) {
		$simv = array ("92", "83", "7", "66", "45", "4", "36", "22", "1", "0", 
			"k", "l", "m", "n", "o", "p", "q", "1r", "3s", "a", "b", "c", "d", "5e", "f", "g", "h", "i", "j6", "t", "u", "v9", "w", "x5", "6y", "z5");
		for ($k = 0; $k < 8; $k++)
		{
			shuffle ($simv);
			$string = $string.$simv[1];
		}
		$password = password_hash("$string", PASSWORD_BCRYPT);
		$query = mysqli_query($con, "UPDATE `usertbl` SET `password` = '".$password."' WHERE `usertbl`.`email` = '".$email."'");
		include 'mail.php';
		Send_Mail2($email, $string);
		$mess = "На ваш Email был выслан новый пароль для входа на сайт.";
	} else {
		$messog2 = "Данный Email не зарегестрирован";
	}
}
?>


<?php include("header.php"); ?>
<div class="container mlogin">
	<div id="login">
		<h1>Восстановление пароля</h1>    
		<?php if (!isset($mess)) { ?>
			<form action="" id="loginform" method="post"name="loginform">
				<input class="input" id="username" name="email"size="20" type="email" value="" placeholder = 'Укажите Email' required><p class="lop"><?php if (!empty($messog2)) echo "$messog2" ?></p>
				<p class="submit"><input class="button" name="login" type= "submit" value="Отправить" id="btn"></p> </form>
				<p class="submit"><a href = login.php>Вернуться на страницу входа</a></p>
			<?php } else echo $mess; ?>
		</body>
		</html>