<?php
$users = users_all($link);
?>
<!-- <div class="site-section bg-left-half mb-5">
    <div class="container owl-2-style">
      <div>
        <div class="search-content">
          <div class="search-container article-container translation-container">
            <div class="article-text">
              <h1>Поиск</h1>
              <div class="search-input-container">
                <div class="search-form">
                  <input class="search-input" placeholder="" tabindex="1" value="">
                  <div class="search-news-type filters">
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
                  </div>
                  <div class="search-button">
                    <button name="test" class="button" value="6"><i class="fa fa-search"></i></button>
                  </div>
                </div>

                <div class="search-count"></div>

                <div class="search-filters-container">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

<div class="text-center" style="height: 100vh;">
  <table class="tegs-table">
    <!-- <tr class="comment qertw">
      <td>Все пользователи сайта</td>
      <td></td>
    </tr> -->
    <?php foreach($users as $user): ?>
    <tr class="teg" style="display: flex;justify-content: space-between;">
      <td>                
        <div class="DivTeg">
          <h2><?=$user['full_name']?></h2>
          <!-- <h3 class="iduser"><a href="admin.php?action=user_edit&id=<?=$user['id']?>">#ID: <?=$user['id']?></a></h3> -->
          <!-- <p>Дата регистрации <?=$user['date']?></p> -->
        </div>
      </td>
      <td class="text-right"><button class="button button-primary podgruzka" value="1"><a href="admin.php?action=user_edit&id=<?=$user['id']?>">Модерировать</a></button></td>
    </tr>
    <?php endforeach ?>
  </table>
</div>