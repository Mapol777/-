<?php require "themes.php"; 
require "header.php";
require_once("database.php");
require_once("models/articles.php");
    
$link = db_connect();
$article = article_get($link, $_GET['id']);
$comms = comm_get($link, $_GET['id']);
?>
<div style="display: flex;margin-bottom: 100px;"></div>
<div class="site-section bg-left-half mb-5">
    <div class="container owl-2-style osnov-div-new">
    	<div class="DivNews">
	        <p class="palochka"></p>
	        <p>
	        </p>
	        <p class="tegs"><?php $tegs = tegs_new($link, $article['id']); foreach($tegs as $teg): ?> <?=$teg['teg_name']?> <?php endforeach ?></p>
	        <p><?=$article['date']?></p>
      	</div>
      	<h1><?=$article['title']?></h1>
      	<div class="gallery">
      		<?php 
      		$images = images($link,$article['id']); 
            foreach($images as $image):?>
		  	<img src="models/upload/<?=$image['image'];?>" />
		  <?php endforeach;?>
		</div>
		<div class="new-div-p col-sm-12 col-md-10 col-xl-9" style="padding: 0;">
			<p>
				<?=str_replace("\n", "<br/>", $article['content'])?>
			</p>
			<h1>Комментарии <?= count($comms)?></h1>
			<?php if(isset($_SESSION["session_username"])): 
				$query = mysqli_query($link, "SELECT * FROM usertbl WHERE email='".$_SESSION['session_username']."'");
				$numrows= mysqli_num_rows($query);
				  if($numrows!=0 ) {
				    while($row=mysqli_fetch_assoc($query)) {
				      $loked=$row['loked'];
				    }
				  }
				  if($loked=='1'):?>
				<form class="new-comment" action="commentid.php?id_new=<?=$_GET['id']?>&email_user=<?=$_SESSION['session_username']?>" method="POST">
					<textarea name="review-text" rows="7" id="review-text" placeholder="Краткое описание"></textarea>
		        	<div class="counter rotew">Доступно для ввода еще <span id="counter"></span> символов из 500</div>
					<div class="soglasie-div">
						<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary podgruzka" value="Выложить">
					</div>
				</form>
				<?php elseif($loked=='0'):?>
			      <div class="col-sm-12 col-md-12 col-xl-12 bloking">
			        <h2>ВЫ БЫЛИ ЗАБЛОКИРОВАНЫ, ДО ДАЛЬНЕЙШИХ ИЗМЕНЕНИЙ ВЫ НЕ МОЖЕТЕ ОСТАВЛЯТЬ НОВЫЕ КОММЕНТАРИИ, ПО ВОПРОСАМ РАЗБЛОКИРОВКИ СВЯЗЫВАЙТЕСЬ С АДМИНИСТРАТОРОМ САЙТА</h2>
			      </div>
			    <?php endif;?>
			<?php else: ?>
				<form class="new-comment">
					<textarea name="review-text" rows="7" id="review-text" placeholder="Краткое описание"></textarea>
		        	<div class="counter rotew">Доступно для ввода еще <span id="counter"></span> символов из 500</div>
					<div class="soglasie-div">
						<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary podgruzka" value="Выложить" disabled><p style="    margin: auto; padding: 0;">Чтобы участвовать в дискуссиях, <button style="margin-right: 53px;" type="button" class="HeaderBar-menuBtn HeaderLoginBtn" id="js-toggleLogin">Войдите</button> или <a href="register.php">Зарегистрируйтесь</a></p>
					</div>
				</form>
			<?php endif; ?>
			<table class="comments-table">
                  <tbody>
                    <?php foreach($comms as $comm): ?>
                      <tr class="comment">
                        <td>                
                          <div class="DivNews">
                            <h2><?=$comm['user_name']?></h2>
                            <p><?=$comm['date']?></p>
                          </div>
                          <p class="text-left p-comment"><?=$comm['text']?></p>
                        </td>
                      </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
		</div>
    </div>
</div>

<?php require "footer.php";?>