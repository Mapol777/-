<?php 
require "themes.php";
require "header.php";
require_once("database.php");
require_once("models/articles.php");
$con = db_connect();
$progects = articles_all($con);
$msg ="";
if(isset($_POST["register"])){
  if(!empty($_POST['contact'])){
    $contact=htmlspecialchars($_POST['contact']);
    $regex = '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/';

    if(preg_match($regex, $contact)) {
      $msg = '<div class="verno">Данные отправлены</div>';
      patron_creare($con, $_POST['name'], $_POST['contact']);
    }

    else{
      $msg = '<div class="oshe">Адрес, введенный вами, неверен. Пожалуйста, попробуйте еще раз.</div>';
      $contact = str_replace(" ", '', $contact);
      $contact = str_replace("(", '', $contact);
      $contact = str_replace(")", '', $contact); 
      $contact = str_replace("-", '', $contact); 
      if (preg_match('/^(8|\+7|7){0,1}[0-9]{10}$/', $contact)){$msg = '<div class="verno">Данные отправлены</div>';patron_creare($con, $_POST['name'], $_POST['contact']);}
      else $msg = '<div class="oshe">Контакт для связи, введенный вами, неверен. Пожалуйста, попробуйте еще раз.</div>'; 
    }
  }
}
if(!isset($_SESSION["session_username"])){
  $email="";
  $name="";
}
else{
  $query = mysqli_query($con, "SELECT * FROM usertbl WHERE email='".$_SESSION["session_username"]."'");
  $numrows= mysqli_num_rows($query);
  if($numrows!=0 ) {
    while($row=mysqli_fetch_assoc($query)) {
      $email=$row['email'];
      $name=$row['full_name'];
    }
  }
}
?>
  <div class="vouler">
      <div style="display: flex;margin-bottom: 58px;"></div>
        <div class="row ballerin">
          <div class="col-xs-12 col-sm-8 col-md-5 pt-100 wow laAKOY">
            <div class="slide--headline">
              <h1>Сбор средств</h1>
            </div>
            <div class="slide--bio">Это следует использовать, чтобы рассказать историю и позволить вашим пользователям узнать немного больше о вашем цели и его использовании. Почему им стоит сделать пожертвование?<br>Если Вы хотите сделать пожертвование можете самостоятельно отправить его, воспользовавшись <a href="./contacts.php" class="recvis">реквизитами фонда</a> .<p style="margin-top: 1rem;">Или оставьте Ваши контакты, наш менеджер свяжется с Вами:</p>
              <?php if ($msg !== NULL) echo $msg;?>
            </div>
              <form action="index.php" class="mb-0 form-action" method="post">
                 <div class="input-group custom-search">
                   <input type="text" class="form-control" name="name" placeholder="Имя и Фамилия" value="<?= $name ?>">
                   <input type="text" class="form-control" name="contact" placeholder="Введите почту или номер телефона" value="<?= $email ?>">
                   <input class="btn btn-primary custom-search-botton" id="register" name= "register" type="submit" value="Отправить" style="margin-left: 0;">
                   <!-- <button class="button btn btn-primary custom-search-botton" id="register" type="submit">Отправить</button>  --> 
                 </div>
              </form>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-2 wow"></div>
          </div>
      </div>
      <div class="row ob-osnovatele">
        <div class="col-xs-12 col-sm-12 col-md-12 osnovatele">
              <div class="DivNews"><p class="palochka first-pal"></p></div>
                    <h1 style="    display: contents;">Пара слов об основателе фонда</h1>
                    <p>Это следует использовать, чтобы рассказать историю и позволить вашим пользователям узнать немного больше о вашем цели и его использовании. Почему им стоит сделать пожертвование?</p>
              <div class="DivNews"><p class="palochka"></p></div>
            </div>
          </div>
  <div class="site-section bg-left-half mb-5 style-carusel">
    <div class="container owl-2-style">

      <!-- CARUSEL -->
      <div class="carusel">
        <h2>Недавние проекты</h2>
        <div class="owl-carousel owl-2">
         <?php for ($i = 0; $i < 4; $i++){?>
          <div class="media-29101">
            <a href="#"><img src="models/upload/<?=$progects[$i]['image'];?>" alt="Image" class="img-fluid"></a>
            <div class="hero-slides-content">
              <div class="DivNews">
                <p class="palochka"></p>
                <p>
                </p>
                <p class="tegs"><?php $tegs = tegs_new($con, $progects[$i]['id']); foreach($tegs as $teg): ?> <?=$teg['teg_name']?> <?php endforeach ?></p>
                <p><?= $progects[$i]['date'] ?></p>
              </div>
              <h3><a href="newpage.php?id=<?=$progects[$i]['id']?>"><?=$progects[$i]['title']?></a></h3>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
      
  <!-- FOOTER -->
  <?php require "footer.php";?>