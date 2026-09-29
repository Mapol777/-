<?php 
require_once("database.php");
$con = db_connect();
if(isset($_POST["login"])){
	require("index.php");
}
?>

<?php
if(isset($_GET['hash']) && !empty($_GET['hash'])){
	$hash = $_GET['hash'];
}else{
	exit("<p><strong>Ошибка!</strong> Отсутствует проверочный код.</p>");
}
//Проверяем, если существует переменная email в глобальном массиве GET
if(isset($_GET['email']) && !empty($_GET['email'])){
	$email = $_GET['email'];
}else{
	exit("<p><strong>Ошибка!</strong> Отсутствует адрес электронной почты.</p>");
}
$query = mysqli_query($con, "SELECT * FROM usertbl WHERE email='".$email."' AND hash = '".$hash."' ");
$numrows= mysqli_num_rows($query);
if($numrows!=0 ) {
	while($row=mysqli_fetch_assoc($query)) {
		$id=$row['id'];
	}
}
$query = mysqli_query($con, "UPDATE `usertbl` SET `email_chek` = '1' WHERE `usertbl`.`id` = $id ");
$query = mysqli_query($con, "SELECT * FROM usertbl WHERE email='".$email."' AND hash = '".$hash."' ");
$numrows= mysqli_num_rows($query);
if($numrows!=0 ) {
	while($row=mysqli_fetch_assoc($query)) {
		$chek=$row['email_chek'];
	}
}
if ($chek == 1) {
	?>
	<?php require "themes.php";?>
<?php require "header.php";?>
	<div class="container mlogin forzirofor">
		<div id="login">
			<h1>Поздравляем! Ваш email был успешно подтвержден!</h1>
			<a href=intropage.php>Перейти на сайт</a>
		</div>
	</div>
<?php require "footer.php";?>
<?php } else { ?>
	<?php require "themes.php";?>
  <?php require "header.php";?>
	<div class="container mlogin">
		<div id="login">
			<h1>К сожалению что-то пошло не так.</h1>
		</div>
	</div>
  <?php require "footer.php";?>
<?php } ?>
