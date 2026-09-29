<?php require "themes.php";
require "header.php";
require_once("database.php");
require_once("models/articles.php");       
$link = db_connect();
$articles = articles_all_n($link);
$progects = articles_all_p($link);
?>
<?php require "router.php"; ?>

<?php require "footer.php";?>