<div class="site-section bg-left-half mb-5">
    <div class="container owl-2-style">
        <div>
        <div class="search-content">
          <div class="search-container article-container translation-container">
            <table id="admin_table" class="admin_table" style="width: 100%;">
                <tr>
                    <th>Имя</th>
                    <th>Контакт для связи</th>
                </tr>
                <?php $patrons = patrons_all($link); foreach($patrons as $patron): ?>
                    <tr 
                    <?php if ($patron['tr']==0): ?>
                        class="notmodeer"
                    <?php else: ?>
                        class="modering"
                    <?php endif;?> >
                        <td class="date_news"><?=$patron['name_patron']?></td>
                        <td><?=$patron['cont_patron']?></td>
                        <td>
                            <a href="admin.php?action=patrons_moder&id=<?=$patron['id']?>">Обработать</a>
                            <a href="admin.php?action=patrons_delete&id=<?=$patron['id']?>">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>