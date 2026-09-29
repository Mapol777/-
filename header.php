<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  
  <meta name='viewport' content='width=device-width,initial-scale=1'/>
  <meta content='true' name='HandheldFriendly'/>
  <meta content='width' name='MobileOptimized'/>
  <meta content='yes' name='apple-mobile-web-app-capable'/>


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
  <link rel="stylesheet" type="text/css" href="css/carusel.css">
</head>

<body>
  <!-- <div class="loader-wrapper1">
  </div>
  <div class="loader"></div>
  <div class="loader-wrapper2">
  </div> -->
  <header class="Header js-header is-visible">
      <div class="HeaderBar">
        <div class="HeaderBar-title js-headerBarTitle is-active"> <span><a href="/">Фонд М. Петипа</a></span></div>
        <ul class='spisok'>
          <li class="gorizontal"><a href="./index.php">Главная</a></li>
          <li class="gorizontal"><a href="./news.php">Новости</a></li>
          <li class="gorizontal"><a href="./project.php">Проекты</a></li>
          <li class="gorizontal"><a href="./contacts.php">Контакты</a></li>
        </ul>
        <?php if(isset($_SESSION["session_admin"])): ?>
          <a href="admin.php" style="height: 60px;">
            <button type="button" class="HeaderBar-menuBtn HeaderLoginBtn" id="js-toggleLogin">
              <span class="HeaderLoginBtn-icon">Вход</span>
              <span class="HeaderLoginBtn-initials"></span>
            </button>
           </a>
        <?php elseif(isset($_SESSION["session_username"])): ?>
          <a href="user.php" style="height: 60px;">
            <button type="button" class="HeaderBar-menuBtn HeaderLoginBtn" id="js-toggleLogin">
              <span class="HeaderLoginBtn-icon">Вход</span>
              <span class="HeaderLoginBtn-initials"></span>
            </button>
           </a>
        <?php else: ?>
          <button type="button" class="HeaderBar-menuBtn HeaderLoginBtn" id="js-toggleLogin">
              <span class="HeaderLoginBtn-icon">Вход</span>
              <span class="HeaderLoginBtn-initials"></span>
            </button>
        <?php endif;?>
        <button type="button" class="HeaderBar-menuBtn HeaderTemaBtn js-toggleHeaderNav">
          <span class="HeaderTemaBtn-icon">Тема</span>
        </button>
        <button type="button" class="HeaderBar-menuBtn HeaderMenuBtn js-toggleHeaderNav">
          <span class="HeaderMenuBtn-icon">Меню</span>
        </button>
      </div>
      <nav class="HeaderNav">
        <div class="HeaderNav-container">
          <div class="menu-categories-menu-container">
            <ul id="menu-categories-menu" class="HeaderNav-categoriesList">
              <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4001 HeaderNav-categoriesListItem"><a href="./index.php" class="HeaderNav-categoriesListLink js-headerCategoryLink" data-alias="Главная">Главная</a></li>
              <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4001 HeaderNav-categoriesListItem"><a href="./news.php" class="HeaderNav-categoriesListLink js-headerCategoryLink" data-alias="Новости">Новости</a></li>
              <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4002 HeaderNav-categoriesListItem"><a href="./project.php" class="HeaderNav-categoriesListLink js-headerCategoryLink" data-alias="Проекты">Проекты</a></li>
              <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4003 HeaderNav-categoriesListItem"><a href="./contacts.php" class="HeaderNav-categoriesListLink js-headerCategoryLink" data-alias="Контакты">Контакты</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <?php if(!isset($_SESSION["session_admin"])): ?>
      <div class="LoginWindow" id="js-LoginWindow">
        <div class="LoginWindow__login-form" id="js-LoginWindow__login-form">
          <div class="UserPanelLogin__title">Вход</div>
          <div class="UserPanelLogin__input-group input-group-social">
            <!-- <div class="input-group__title">Через соцсети</div>
            <div class="nextend_social_login">
              <div class="nsl-container nsl-container-block" data-align="left">
                <div class="nsl-container-buttons">
                  <a href="https://moskvichmag.ru/wp-login.php?loginSocial=facebook&amp;redirect=https%3A%2F%2Fmoskvichmag.ru%2F" rel="nofollow" aria-label="Continue with <b>Facebook</b>" data-plugin="nsl" data-action="connect" data-provider="facebook" data-popupwidth="475" data-popupheight="175">
                    <div class="nsl-button nsl-button-default nsl-button-facebook" data-skin="dark" style="background-color:#1877F2;">
                      <div class="nsl-button-svg-container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1365.3 1365.3" height="1365.3" width="1365.3">
                          <path d="M1365.3 682.7A682.7 682.7 0 10576 1357V880H402.7V682.7H576V532.3c0-171.1 102-265.6 257.9-265.6 74.6 0 152.8 13.3 152.8 13.3v168h-86.1c-84.8 0-111.3 52.6-111.3 106.6v128h189.4L948.4 880h-159v477a682.8 682.8 0 00576-674.3" fill="#fff"></path>
                        </svg>
                      </div>
                      <div class="nsl-button-label-container">Войти через <b>Facebook</b></div>
                    </div>
                  </a>
                </div>
              </div>
            </div> -->
            <div class="input-group__title">С помощью Email</div>
            <form name="loginform" id="loginform" action="login.php" method="post">
              <p class="login-username">
                <label for="user_login"></label>
                <input type="text" name="username" id="user_login" class="input" value="" size="20" placeholder="Email">
                <?php if (!empty($messog2)) echo "$messog2" ?>
              </p>
              <p class="login-password">
                <label for="user_pass"></label>
                <input type="password" name="password" id="user_pass" class="input" value="" size="20" placeholder="Пароль">
                <?php if (!empty($messog1)) echo "$messog1" ?>
              </p>
              <p class="login-submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Войти">
              </p>
              <p class="regtex registration_link">Еще не зарегистрированы?<br><a href= "register.php">Регистрация!</a></p>
            </form>
          </div>
          <input type="hidden" id="js-UserPanelLogin__security" name="js-UserPanelLogin__security" value="1d526f5980">
          <input type="hidden" name="_wp_http_referer" value="/">
        </div>
        <div class="LoginWindow__register-form" id="js-LoginWindow__register-form"></div>
        <div class="LoginWindow__recovery-form" id="js-LoginWindow__recovery-form"></div>
      </div>
      <?php endif;?>
    </header>