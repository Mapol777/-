<div class="site-section bg-left-half mb-5">
    <div class="container owl-2-style">
      <div>
        <div class="search-content">
          <div class="search-container article-container translation-container">
            <div class="article-text">
              <h1>Поиск</h1>
              <form method="post" action="admin.php?action=search_comm" style="width: 100%;">
                <div class="search-input-container">
                  <div class="search-form">
                    <input class="search-input" name="content" placeholder="" tabindex="1" value="">
                  <!--<div class="search-news-type filters">
                      <input type="checkbox" id="add-filters" name="search-news-type">
                      <div class="search-button">
                        <div class="search-filter-item doreno">
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
                        </div>
                      </div>
                    </div> -->
                    <div class="search-button">
                      <button name="test" class="button" value=""><i class="fa fa-search"></i></button>
                    </div>
                  </div>

                  <div class="search-count"></div>

                  <div class="search-filters-container">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="container owl-2-style">
  <table class="comments-table">
<!--     <tr class="qertw">
      <td>Все комментарии на сайте в порядке временного убывания</td>
    </tr> -->
    <?php foreach($goters as $goter): ?>
      <tr class="comm">
      <td>                
        <div class="DivNews">
          <h2><?=$goter['user_name']?></h2>
          <h3 class="idcustomer">    <a href="admin.php?action=edit&id=<?=$goter['id_new']?>">#ID New: <?=$goter['id_new']?></a></h3>
          <h3 class="idnews"><a href="admin.php?action=user_edit&id=<?=$goter['id_user']?>">#ID User: <?=$goter['id_user']?></a></h3>
          <p><?=$goter['date']?></p>
        </div>
        <p class="text-left p-comment"><?=$goter['text']?></p>
      </td>
      <td>
          <?php if($goter['moder'] == 0): ?>
            <button class="button button-primary podgruzka" value="1"><a href="admin.php?action=comm_moder&id=<?=$goter['id_comment']?>">Модерировать</a></button>
          <?php endif; ?>
      </td>
      <td style="text-align: center;">
          <a href="admin.php?action=comm_gelete&id=<?=$goter['id_comment']?>">Удалить</a>
      </td>
    </tr>
    <?php endforeach ?>
  </table>
</div>