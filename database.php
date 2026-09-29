<?php
define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'p97754yb_login');
define('MYSQL_PASSWORD', 'd1rCyupO');
define('MYSQL_DB', 'p97754yb_login');
function db_connect(){
    $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) 
        or die("Error - mysqli_error 1: ".mysqli_error($link));
    if(!mysqli_set_charset($link, "utf8")){
        printf("Error - mysqli_error 2: ".mysqli_error($link));}
    return $link;
}
?>