<?php 
require "themes.php";
require "header.php";
require_once("database.php");
require_once("models/articles.php");
$con = db_connect();

if(!isset($_SESSION["session_username"])):
  header("location:index.php");
else:

  $query = mysqli_query($con, "SELECT * FROM usertbl WHERE email='".$_SESSION["session_username"]."'");
    // $query = $con -> query("SELECT * FROM usertbl WHERE username='"$_SESSION["session_username"]"'");
  $numrows= mysqli_num_rows($query);
  if($numrows!=0 ) {
    while($row=mysqli_fetch_assoc($query)) {
      $id=$row['id'];
      $hash=$row['hash'];
      $email=$row['email'];
      $chek=$row['email_chek'];
      $name=$row['full_name'];
      $date=$row['date'];
      $loked=$row['loked'];
    }
  }
  if(isset($_POST["login"])){
    include 'mail.php';
    Send_Mail($name, $email, $hash);
  }
  $goters = comm_user_all($con, $id);
  ?>
<div style="display: flex;margin-bottom: 57px;"></div>
<div class="user-conteiner-div container forzirofor">
    <div class="row-fluid">
      <?php if($loked=='0'):?>
      <div class="col-sm-12 col-md-12 col-xl-12 bloking">
        <h2>ВЫ БЫЛИ ЗАБЛОКИРОВАНЫ, ВАШИ СТАРЫЕ КОММЕНТАРИИ БУДУТ СКРЫТЫ, ДО ДАЛЬНЕЙШИХ ИЗМЕНЕНИЙ ВЫ НЕ МОЖЕТЕ ОСТАВЛЯТЬ НОВЫЕ, ПО ВСЕМ ВОПРОСАМ СВЯЗЫВАЙТЕСЬ С АДМИНИСТРАТОРОМ САЙТА</h2>
      </div>
    <?php endif;?>
      <div class="col-sm-12 col-md-4 col-xl-4 user-div">
        <h2><?= $name;?></h2>
        <table class="info-table text-center user-teble-com">
          <tr class="align-top">
            <td>
              Email
            </td>
            <td><?= $email ?></td>
          </tr>
          <?php if($chek == NULL) { ?>
          <tr class="align-top">
            <td colspan="2">Ваш Email не подтведтвержден, на вашу почту отправлено письмо
            </td>
          </tr>
          <tr>
          <td colspan="2">
              <form action="" id="loginform" method="post"name="loginform">
                <p style="text-align: center;"><input class="button repeat_email" value="Отправить письмо повторно" type="submit" name="login"></p>
              </form> 
            </td>
          </tr>
          <?php } ?>
          <tr class="align-top">
            <td>Регистрация</td>
            <td><?=$date?></td>
          </tr>
        </table>
        <button class="button button_user"><a href = 'newpass.php'>Сменить пароль</a></button>
        <button class="button button_user"><a href="logout.php">Выйти</a></button>
      </div>
      <div class="col-sm-12 col-md-8 col-xl-8 maserty">
        <h2>Все Ваши комментарии <?= count($goters); ?></h2>
        <div class="text-left">
                <table class="comments-table user-teble-com">
                  <?php 
                  foreach($goters as $goter): 
                    $article = article_get($con, $goter['id_new']);?>
                  <tr class="comment">
                    <td style="width: 100%;" 
                    <?php if($goter['moder']=='0'):?>
                      class="not_loked"
                      <?php endif;?> >               
                      <div class="DivNews">
                      	<h3 style="width: 80%;"><a href="newpage.php?id=<?=$goter['id_new']?>"><?=$article['title']?></a></h3>
                        <p><?=$goter['date']?></p>
                      </div>
                      <p class="text-left p-comment"><?=$goter['text']?></p>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </table>
              </div>
          </div>
      </div>
  </div>

  <!-- FOOTER -->
<?php require "footer.php";?>
<?php endif; ?>