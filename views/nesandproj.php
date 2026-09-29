<div class="site-section bg-left-half mb-5">
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
                      <i class="fa fa-sliders"></i>
                    </div>
                  </div>
                  <div class="search-button">
                      <button name="test" class="button" value="5"><i class="fa fa-search"></i></button>
                    </form>
                    
                    <i class="fa fa-search"></i>
                  </div>
                </div>

                <div class="search-count"></div>

                <div class="search-filters-container">

                  <!-- <div class="search-filters hidden"> -->
                  <div class="search-filters hidden">
                    <div class="search-filter-item date-picker">
                      <input class="date-input flatpickr-input" type="date" placeholder="Дата" max="<?=date('Y-m-d');  ?>">
                    </div>
                    <div class="search-filter-item">
                      <div class="selectize-control single">
                        <div class="selectize-input items not-full has-options">
                          <select id="filter-theme" tabindex="-1" class="selectized selectpicker" data-live-search="true">
                            <option disabled selected="selected">Теги</option>
                            <option>PHP</option>
                            <option>CSS</option>
                            <option>HTML</option>
                            <option>CSS 3</option>
                            <option>Bootstrap</option>
                            <option>JavaScript</option>
                            <!-- <option value="" selected="selected"></option> -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="search-filter-item doreno">
                      <div class="selectize-control single">
                        <div class="selectize-input items not-full has-options">
                          <select id="filter-theme" tabindex="-1" class="selectized selectpicker" data-live-search="true">
                            <option disabled selected="selected">Сортировка</option>
                            <option>По алфавиту Возрастание</option>
                            <option>ПО алфавиту Убывание</option>
                            <option>По дате Возростание</option>
                            <option>По дате Убывание</option>
                            <!-- <option value="" selected="selected"></option> -->
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
<!--               <div class="search-category-container search-authors">
              </div>
              <div class="search-category-container search-regions">
              </div>
              <div class="placeholder-loading-wrapper hidden">
                <div class="placeholder-loading">
                  <div class="placeholder-message-time-container">
                    <div class="placeholder-message-time">
                      <div class="value"></div>
                      <div class="line"></div>
                    </div>
                  </div>
                  <div class="placeholder-message">
                    <div class="placeholder-line-message">
                      <div class="placeholder-line-message-head"></div>
                    </div>
                    <div class="placeholder-picture"></div>
                    <div class="placeholder-subheader">
                      <div class="placeholder-subheader-line"></div>
                      <div class="placeholder-subheader-line"></div>
                      <div class="placeholder-subheader-line"></div>
                      <div class="placeholder-subheader-line"></div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <h1>Создание</h1>
            <form class="news-project-creat">
            	<input type="text" name="" placeholder="Название" class="input-admin">
            	<div class="search-filter-item">
                      <div class="selectize-control single">
                        <div class="selectize-input items not-full has-options">
                          <select id="filter-theme" tabindex="-1" class="selectized selectpicker" multiple data-live-search="true">
                            <option disabled selected="selected"value="">Теги</option>
                            <option>PHP</option>
                            <option>CSS</option>
                            <option>HTML</option>
                            <option>CSS 3</option>
                            <option>Bootstrap</option>
                            <option>JavaScript</option>
                            <!-- <option value="" selected="selected"></option> -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="torgetmenatreggerit">
                    	<input id="toggle-on" class="toggle toggle-left" name="toggle" value="false" type="radio" checked>
						<label for="toggle-on" class="geryyu">Новость</label>
						<input id="toggle-off" class="toggle toggle-right" name="toggle" value="true" type="radio">
						<label for="toggle-off" class="geryyu">Проект</label>
                    </div>
            	<input type="file" name="photo" multiple class="input-admin">
		        <textarea name="review-text" rows="7" id="review-text" placeholder="Краткое описание"></textarea>
		        <div class="counter rotew">Доступно для ввода еще <span id="counter"></span> символов из 200</div>
		        <textarea name="osnov-text" rows="15" id="osnov-text" placeholder="Основной текст"></textarea>
		        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary podgruzka" value="Выложить">
            </form>
          </div>
        </div>
      </div>
    </div>
</div>