<div class="site-section bg-left-half mb-5 forzirofor">
    <div class="container owl-2-style">
        <form method="post" action="admin.php?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>" enctype="multipart/form-data">
          <div class="search-content">
            <div class="search-container article-container translation-container">
              <div class="article-text">
                <div class="search-input-container">
                  <div class="search-form terno">
                    <input class="search-input" placeholder="" tabindex="1" name="name" value="<?=$article['teg_name']?>" style='    margin-bottom: 10px;'>
                    <div class="search-button teg-search-button" style="display: contents;">
                      <input type="submit" value="Сохранить" class="btn">
                      <i class="fa fa-plus-square-o" aria-hidden="true" style="margin: auto;"></i>
                    </div>
                  </div>
                  <div class="search-count"></div>
                  <div class="search-filters-container"></div>
                </div>
              </div>
            </div>
          </div>
        </form>
    </div>
</div>