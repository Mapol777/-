<?php 
$query = mysqli_query($link, "SELECT * FROM usertbl WHERE id='".$_GET['id']."'");
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
$goters = comm_user_all($link, $_GET['id']); ?>
<div class="user-conteiner-div container">
    <div class="row-fluid">
      <div class="col-sm-12 col-md-4 col-xl-4 user-div">
        <h2><?= $name;?></h2>
        <table class="info-table user-teble-com">
          <tr class="align-top">
            <td>
              Email
            </td>
            <td><?= $email ?></td>
          </tr>
          <tr class="align-top">
            <td>Регистрация</td>
            <td><?=$date?></td>
          </tr>
        </table>
        <?php if($loked=='1'):?>
          <button class="button button_user"><a href = "admin.php?action=bloking&id=<?=$_GET['id']?>&art=<?= $_GET['action']?>&id_user=<?=$_GET['id']?>">Заблокировать пользователя</a></button>
        <?php else:?>
          <button class="button button_user"><a href = "admin.php?action=rasbloking&id=<?=$_GET['id']?>&art=<?= $_GET['action']?>&id_user=<?=$_GET['id']?>">Разблокировать пользователя</a></button>
        <?php endif;?>
      </div>
      <div class="col-sm-12 col-md-8 col-xl-8 maserty">
        <h2>Все комментарии пользователя <?= count($goters); ?></h2>
        <div class="text-center">
                <table class="comments-table user-teble-com">
                  <tbody>
                  <?php foreach($goters as $goter): 
                    $article = article_get($link, $goter['id_new']);?>
                  <tr class="comment">
                    <td>                
                      <a href="admin.php?action=edit&id=<?=$article['id']?>"><h1><?=$article['title']?></h1></a> <?=$goter['date']?>
                      <p class="p-comment"><?=$goter['text']?></p>
                    </td>
                    <td class="text-right">
                      <?php if($goter['moder'] == 0 && $loked=='1'): ?>
                        <button class="button button-primary podgruzka" value="1"><a href="admin.php?action=comm_moder&id=<?=$goter['id_comment']?>&art=<?= $_GET['action']?>&id_user=<?=$_GET['id']?>">Модерировать</a></button>
                      <?php endif; ?>
                      <a href="admin.php?action=comm_gelete&id=<?=$goter['id_comment']?>&art=<?= $_GET['action']?>&id_user=<?=$_GET['id']?>">Удалить</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
                </table>
              </div>
      </div>