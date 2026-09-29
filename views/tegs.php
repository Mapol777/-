<div class="site-section bg-left-half mb-5">
    <div class="container owl-2-style">
      <div>
        <div class="search-content">
          <div class="search-container article-container translation-container">
            <div class="article-text">
              <!-- <h1>Поиск</h1>
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
                    <button name="test" class="button" value=""><i class="fa fa-search"></i></button>
                  </div>
                </div> -->

                <div class="search-count"></div>

                <div class="search-filters-container">
                </div>
              </div>
            </div>
          </div>
        </div>
        <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="admin.php?action=teg_creare&id=''">Создать тег</a></li>
                    </ul>
                </div>
            </nav> 
      </div>
    </div>
  </div>

<div class="text-center">
  <table class="tegs-table">
    <?php $tegs = tegs_all($link); foreach($tegs as $teg): ?>
    <tr class="teg">
      <td>                
        <div class="DivTeg">
          <h2><?=$teg['teg_name']?></h2>
          <!-- <h3 class="idteg"><a href="/user.php?id=66666666">#IDтега: <?=$teg['id_teg']?></a></h3> -->
        </div>
      </td>
      <td><a href="admin.php?action=teg_edit&id=<?=$teg['id_teg']?>">Редактировать</a>
      <a href="admin.php?action=del_teg&id=<?=$teg['id_teg']?>">Удалить</a></td>
    </tr>
    <?php endforeach ?>
  </table>
</div>