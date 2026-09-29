  <div style="display: flex;margin-bottom: 58px;"></div>
  <div class="site-section bg-left-half mb-5">
    <div class="container owl-2-style">
      <!-- CARUSEL -->
      <div class="carusel">
        <h2>Недавние новости</h2>
        <div class="owl-carousel owl-2">
          <?php for ($i = 0; $i < 4; $i++){?>
          <div class="media-29101">
            <a href="#"><img src="models/upload/<?=$news[$i]['image'];?>" alt="Image" class="img-fluid"></a>
            <div class="hero-slides-content">
              <div class="DivNews">
                <p class="palochka"></p>
                <p>
                </p>
                <p class="tegs"><?php $tegs = tegs_new($link, $news[$i]['id']); foreach($tegs as $teg): ?> <?=$teg['teg_name']?> <?php endforeach ?></p>
                <p><?= $news[$i]['date'] ?></p>
              </div>
              <h3><a href="#"><?=$news[$i]['title']?></a></h3>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div style="display: flex;margin-bottom: 58px;"></div>
      <!-- SEARCH -->
      <div>
        <div class="search-content">
          <div class="search-container article-container translation-container">
            <div class="article-text">
              <h1 style="padding: 0;">Проекты</h1>
              <form method="post" action="project.php?action=search_p" style="width: 100%;">
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
                      <div class="search-filter-footer">
                        <div class="search-filter-clear-btn">Очистить</div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- NEWS -->
      <div>
        <?php 
        if($articles): 
         foreach($articles as $article): ?>
        <div class="blog-card">
          <div class="meta">
            <div class="photo" style="background-image: url('models/upload/<?=$article['image'];?>')"></div>
          </div>
          <div class="description">
            <div class="DivNews">
              <p class="palochka">
                <p>
                  <p class='tegs'><?php $tegs = tegs_new_s($link, $article['id']); foreach($tegs as $teg): ?>
                      <a href="project.php?action=search_p_t&teg=<?=$teg['id_teg']?>"><?=$teg['teg_name']?></a>
                    <?php endforeach ?></p></p>
                  <p><?=$article['date']?></p>
            </div>
            <h3><a href="newpage.php?id=<?=$article['id']?>"><?=$article['title']?></a></h3>
            <p> <?=articles_intro($article['content'])?></p>
            <p class="read-more">
              <a href="newpage.php?id=<?=$article['id']?>">Read More</a>
            </p>
          </div>
        </div>
            <hr>
            <?php endforeach;
            else:?>
          <div class="col-sm-12 col-md-12 col-xl-12">
              <h2>К сожалению по вашему поиску не удалось найти статей, попробуйте другой поисковый запрос</h2>
          </div>
        <?php endif;?>
        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary podgruzka" value="Загрузить еще 10 новостей">
      </div>
    </div>
  </div>