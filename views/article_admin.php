<?php 
$comms = comm_get_all($link, $_GET['id']);
?>
<div class="site-section bg-left-half mb-5">
    <div class="container owl-2-style">
        <div>
        <div class="search-content">
          <div class="search-container article-container translation-container">
            <?php if($article['title'] == ""):?>
            <h1>Создание</h1>
            <?php else: ?>
            <div class="diargod"><h1 style="padding-left: 40px;">Редактирование</h1><span class="redact-icon" style="float: left;"></span></div>
            <div class="not-activ canypukillme"><h1 class=" lefth1 comment-icon">Комментарии <?= count($comms); ?></h1><span class="comment-icon" style="float: right;"></span></div>
            <?php endif; ?>
                <form class="news-project-creat form1 redact" method="post" action="admin.php?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Название" value='<?=$article['title']?>'class="input-admin" autofocus required>
                    <label>
                        <div class="mne_ucwvo">
                            <span>Дата</span>
                            <input type="date" name="date" value="<?=$article['date']?>" class="form-item" required>
                        </div>
                    </label>
                    <div class="search-filter-item">
                      <div class="selectize-control single">
                        <div class="selectize-input items not-full has-options">
                          <select id="filter-theme" tabindex="-1" class="selectized selectpicker" name="tegs[]" multiple data-live-search="true">
                            <option disabled selected="selected"value="">Теги</option>
                             <?php 
                             $tegs = tegs_all($link); 
                             $tegs_new = tegs_new($link, $article['id']); 
                             foreach($tegs as $teg): ?>
                                    <option 
                                    <?php foreach($tegs_new as $teg_new): ?>
                                        <?php if($teg['teg_name'] == $teg_new['teg_name']):?>
                                        selected="selected" 
                                    <?php endif;?> 
                                    <?php endforeach; ?>
                                    value="<?=$teg['id_teg']?>"><?=$teg['teg_name']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="torgetmenatreggerit">
                        <?php if($article['type']=='new'):?> 
                            <input id="toggle-on" class="toggle toggle-left" name="toggle" value="new" type="radio" checked>
                            <label for="toggle-on" class="geryyu">Новость</label>
                            <input id="toggle-off" class="toggle toggle-right" name="toggle" value="project" type="radio">
                            <label for="toggle-off" class="geryyu">Проект</label>
                        <?php else:?>
                            <input id="toggle-off" class="toggle toggle-left" name="toggle" value="new" type="radio">
                            <label for="toggle-off" class="geryyu">Новость</label>
                            <input id="toggle-on" class="toggle toggle-right" name="toggle" value="project" type="radio" checked>
                            <label for="toggle-on" class="geryyu">Проект</label>
                        <?php endif;?>
                    </div>
                    <div>
                    <?php $images = images($link,$article['id']); 
                    foreach($images as $image):
                        if($action == 'edit' && ($image['image'] != '')){?>
                            <label class="ret_st">
                                Изображение:
                                <table>
                                    <tr>
                                        <td style="padding-right: 5px;"><img class="img-rounded pull-left" src="models/upload/<?=$image['image'];?>" width="80" height="80" alt="Картинка"></td>
                                    </tr>
                                    <tr>
                                        <td><?=$image['image'];?></td>
                                    </tr>
                                </table>
                            </label>
                        <?php }
                    endforeach;?>
                    </div>
                        <label>
                            <?php if($action == 'add'){?>Добавить изображение:<?php }?>
                            <?php if(($action == 'edit') && ($article['image'] != '')){?>Изменить или удалить изображение:<?php }?>
                            <?php if(($action == 'edit') && ($article['image'] == '')){?>Добавить изображение:<?php }?>
                            <input type="hidden" name="MAX_FILE_SIZE" value="350000000" />
                            <input name="image[]" type="file" multiple="multiple" class="btn"/>
                        </label>
                    <!-- <textarea name="review-text" rows="7" id="review-text" placeholder="Краткое описание"></textarea>
                    <div class="counter rotew">Доступно для ввода еще <span id="counter"></span> символов из 200</div> -->
                    <textarea name="content" rows="15" id="osnov-text" placeholder="Основной текст" required><?=$article['content']?></textarea>
                    <button class="btn button button-primary podgruzka" type="submit">Сохранить</button>
                </form>
                <form class="news-project-creat form2 redact hidden" style="display: inherit;">
              <div class="text-center">
                <table class="comments-table">
                   <?php if($article['title'] != ""):
                       foreach($comms as $comm): ?>
                      <tr class="comment">
                        <td>                
                          <div class="DivNews">
                            <h2><a href="admin.php?action=user_edit&id=<?=$comm['id_user']?>"><?=$comm['user_name']?></a></h2>
                            <p><?=$comm['date']?></p>
                          </div>
                          <p class="text-left p-comment"><?=$comm['text']?></p>
                        </td>
                        <td>
                            <?php if($comm['moder'] == 0): ?>
                            <button class="button button_admin button-primary podgruzka" value="1"><a href="admin.php?action=comm_moder&id=<?=$comm['id_comment']?>>&art=<?= $_GET['action']?>&id_user=<?=$_GET['id']?>">Модерировать</a></button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="admin.php?action=comm_gelete&id=<?=$comm['id_comment']?>>&art=<?= $_GET['action']?>&id_user=<?=$_GET['id']?>">Удалить</a>
                        </td>
                      </tr>
                    <?php endforeach; endif; ?>
                </table>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
