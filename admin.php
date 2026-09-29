<?php 
require "themes.php";
require_once("database.php");
require_once("models/articles.php");
if(!isset($_SESSION["session_admin"]))
  header("location:index.php");
$link = db_connect();

$goters = comments_all($link);
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tinos:wght@400;700&display=swap" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans|Oswald:300' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/color.css">
  <link rel="stylesheet" type="text/css" href="css/search.css">
  <link rel="stylesheet" type="text/css" href="css/<?= $_SESSION["theme"]; ?>.css" id="theme-link">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>

<body>
  <header class="Header js-header is-visible admin">
      <div class="HeaderBar">
        <div class="HeaderBar-title js-headerBarTitle is-active"> <span><h2>ПАНЕЛЬ АДМИНИСТРАТОРА</h2></span></div>
        <ul class='spisok1'>
           <li class="gorizontal"><a href="admin.php?d=f">Статьи</a></li>
  	       <li class="gorizontal"><a href="admin.php?d=z">Комментарии</a></li>
  	       <li class="gorizontal"><a href="admin.php?d=y">Теги</a></li>
  	       <li class="gorizontal"><a href="admin.php?d=w">Пользователи</a></li>
           <li class="gorizontal"><a href="admin.php?d=t">Благотворители</a></li>
        </ul>
        <button type="button" class="HeaderBar-menuBtn HeaderTemaBtn js-toggleHeaderNav">
          <span class="HeaderTemaBtn-icon">Тема</span>
        </button>
        <button type="button" class="HeaderBar-menuBtn HeaderExitOut" style="padding-left: 10px;">
          <a href="logout.php"><span class="HeaderExitOut-icon">Выход</span></a>
        </button>
        <button type="button" class="HeaderBar-menuBtn HeaderMenuBtn HeaderMenuBtnA js-toggleHeaderNav">
          <span class="HeaderMenuBtn-icon">Меню</span>
        </button>
      </div>
      <nav class="HeaderNav">
        <div class="HeaderNav-container">
          <div class="menu-categories-menu-container">
            <ul id="menu-categories-menu" class="HeaderNav-categoriesList">
           <li class="vertical"><button class="button button_admin" value="1">Новости и Проекты</button></li>
           <li class="vertical"><button class="button button_admin" value="2">Комментарии</button></li>
           <li class="vertical"><button class="button button_admin" value="3">Теги</button></li>
           <li class="vertical"><button class="button button_admin" value="4">Пользователи</button></li>
           <li class="vertical"><button class="button button_admin" value="5">Благотворители</button></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
<div style="display: flex;margin-bottom: 116px;"></div>
<?php 
// require $_SESSION["panel"].".php"; 
// require "redactnesandproj.php";
require "adpanel.php";
?>
    <footer class="flex-rw">
    <section class="footer-social-section flex-rw">
    	<div style="display: flex;margin-bottom: 58px;"></div>
    </section>
  </footer>
  <!-- end content -->
  <script src="js/index.js"></script>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>