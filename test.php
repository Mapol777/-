<?php
echo 'INSERT INTO `admin`(`name`, `password`) VALUES ("admin", "' . password_hash('Pa$$w0rd',PASSWORD_DEFAULT) . '")';
?>
