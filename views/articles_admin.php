<div class="site-section bg-left-half mb-5">
    <div class="container owl-2-style">
        <div>
        <div class="search-content">
          <div class="search-container article-container translation-container">
            <div class="article-text">
              <h1 style="padding: 0;">Поиск</h1>
              <form method="post" action="admin.php?action=search_np" style="width: 100%;">
                <div class="search-input-container">
                  <div class="search-form">
                    <input class="search-input" placeholder="" tabindex="1" value="" name="title">
                    <div class="search-news-type filters">
                      <input type="checkbox" id="add-filters" name="search-news-type">
                      <div class="search-button">
                        <i class="fa fa-sliders"></i>
                      </div>
                    </div>
                    <div class="search-button">
                      <button type="submit" class="licantrop"><i class="fa fa-search"></i></button>
                    </div>
                  </div>

                  <div class="search-count"></div>

                  <div class="search-filters-container">

                    <!-- <div class="search-filters hidden"> -->
                    <div class="search-filters hidden">
                      <div class="search-filter-item date-picker">
                        <input class="date-input flatpickr-input" type="date" name ='date'placeholder="Дата" max="<?=date('Y-m-d');  ?>">
                      </div>
                      <div class="search-filter-item">
                        <div class="selectize-control single">
                          <div class="selectize-input items not-full has-options">
                            <select id="filter-theme" tabindex="-1" class="selectized selectpicker" name="teg" data-live-search="true">
                              <option disabled selected="selected"value="">Теги</option>
                               <?php $tegs = tegs_all($link); 
                               foreach($tegs as $teg): ?>
                                  <option value="<?=$teg['id_teg']?>"><?=$teg['teg_name']?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    <!-- <div class="search-filter-item doreno">
                      <div class="selectize-control single">
                        <div class="selectize-input items not-full has-options">
                          <select id="filter-theme" tabindex="-1" class="selectized selectpicker" data-live-search="true">
                            <option disabled selected="selected">Сортировка</option>
                            <option>По алфавиту Возрастание</option>
                            <option>ПО алфавиту Убывание</option>
                            <option>По дате Возростание</option>
                            <option>По дате Убывание</option>
                          </select>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="search-filter-footer">
                      <div class="search-filter-clear-btn">Очистить</div>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="admin.php?action=add&id=''">Создать статью</a></li>
                    </ul>
                </div>
            </nav> 
            <table id="admin_table" class="admin_table" style="width: 100%;">
                <tr>
                    <th>Картинка</th>
                    <th class="date_news">Дата</th>
                    <th>Заголовок</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td>
                            <?php if ($article['image'] != ''){?>
                            <img class="img-rounded pull-left" src="models/upload/<?=$article['image'];?>" width="40" height="40" alt="Картинка">
                            <?php }?>
                          </td>
                        <td class="date_news"><?=$article['date']?></td>
                        <td><?=articles_intro($article['title'], 80)?></td>
                        <td>
                            <a href="admin.php?action=edit&id=<?=$article['id']?>">Редактировать</a>
                            <a href="admin.php?action=delete&id=<?=$article['id']?>">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
