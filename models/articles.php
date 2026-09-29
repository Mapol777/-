<?php
    function articles_all($link){
    // Формируем запрос
        $query = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new GROUP BY articles.id ORDER BY articles.id DESC";
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function articles_all_n($link){
    // Формируем запрос
        $query = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE type = 'new' GROUP BY articles.id ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function articles_all_p($link){
    // Формируем запрос
        $query = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE type = 'project' GROUP BY articles.id ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function article_get($link, $id_article){
        $query = sprintf("SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE articles.id=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        
        if (!$result)
            die(mysqli_error($link));
        
        $article = mysqli_fetch_assoc($result);
        
        return $article;
    }

    function articles_new($link, $title, $date, $content,$tegs, $type, $image = ''){
        //--------------------------------------
        include("upload.php");//Загрузка самого файла
        //--------------------------------------
        // Подготовка
        $title = trim($title);
        $content = trim($content);
        $type = trim($type);
        $image = trim($image);
        // Проверка
        if ($title == '')
            return false;
        
        // Запрос
        $template_add = "INSERT INTO articles (title, date, content, type) "
                . "VALUES ('%s', '%s', '%s', '%s')";

        //mysqli_real_escape_string экранирует строку запроса для защиты от SQL инекций
        $query1 = sprintf($template_add, 
                         mysqli_real_escape_string($link, $title),
                         mysqli_real_escape_string($link, $date),
                         mysqli_real_escape_string($link, $content),
                         mysqli_real_escape_string($link, $type),);
        $result = mysqli_query($link, $query1);

        $id = mysqli_insert_id($link);
        $id = (int)$id;

        $total = count($_FILES['image']['name']);
        for( $i=0 ; $i < $total ; $i++ ) {
            $image = $_FILES['image']['name'][$i];
            $template_add = "INSERT INTO file (id_new, name) " . "VALUES ('%d', '%s')";
            $query1 = sprintf($template_add, $id, mysqli_real_escape_string($link, $image));
            $result = mysqli_query($link, $query1);
        }

        foreach ($tegs as $teg){
            $teg = trim($teg);
            $gert = "INSERT INTO ntegs (id_new, id_teg) " . "VALUES ('%d', '%s')";
            $query2 = sprintf($gert, $id, mysqli_real_escape_string($link, $teg));
            $result2 = mysqli_query($link, $query2);
        }
        return true;
    }

    function articles_edit($link, $id, $title, $date, $content, $tegs, $type, $image = ''){
        // Проверка
        if ($title == '')
            return false;
        // Подготовка
        $title = trim($title);
        $content = trim($content);
        $date = trim($date);
        $type = trim($type);
        $id = (int)$id;
        // $imagebd = $_FILES['image']['name'];
        // $imagebd = trim($imagebd);

        // удаление файла картинки
        //-------------------------
        if (!empty($_FILES['image']['name'][0])){
            include("delete.php");
            $query_dell = sprintf("SELECT name as image FROM file WHERE id_new=%d", $id);
            $result = mysqli_query($link, $query_dell);
            $n = mysqli_num_rows($result);
            $articles = array();

            for ($i = 0; $i < $n; $i++)
            {
                $row = mysqli_fetch_assoc($result);
                $articles[] = $row;
            }

            $total = count($articles);
            foreach ($articles as $article) {
                delete_image($article);
            }
            $template_dell = "DELETE FROM `file` WHERE `id_new`='%d'";
            $query_dell = sprintf($template_dell, $id);
            $result = mysqli_query($link, $query_dell);

            $total = count($_FILES['image']['name']);
            for( $i=0 ; $i < $total ; $i++ ) {
                $image = str_replace(" ", '', $_FILES['image']['name'][$i]);
                $image = str_replace("(", '9', $image);
                $image = str_replace(")", '0', $image);
                $template_add = "INSERT INTO file (id_new, name) " . "VALUES ('%d', '%s')";
                $query1 = sprintf($template_add, $id, mysqli_real_escape_string($link, $image));
                $result = mysqli_query($link, $query1);
            }
        }
        //-----------------------
        
        
        // Запрос 
        $gert = "DELETE FROM `ntegs` WHERE `id_new`='%d'";
        $query2 = sprintf($gert, $id);
        $result = mysqli_query($link, $query2);

        if(!empty($tegs)) {
            foreach ($tegs as $teg){
                $teg = trim($teg);
                $gert = "INSERT INTO ntegs (id_new, id_teg) " . "VALUES ('%d', '%s')";
                $query2 = sprintf($gert, $id, mysqli_real_escape_string($link, $teg));
                $result2 = mysqli_query($link, $query2);
            }
        } 
        $template_update = "UPDATE articles SET title='%s', content='%s', "
                . "date='%s', type='%s' WHERE id='%d'";
        $query = sprintf($template_update, 
                         mysqli_real_escape_string($link, $title),
                         mysqli_real_escape_string($link, $content),
                         mysqli_real_escape_string($link, $date),
                         mysqli_real_escape_string($link, $type),
                         $id);
        
        $result = mysqli_query($link, $query);
        
        //--------------------------------------
        include("upload.php");//Загрузка самого файла
        //--------------------------------------
        
        // if (!result)
        //     die(mysqli_error($link));
        
        return mysqli_affected_rows($link);
    }

    function articles_delete($link, $id){
        $id = (int)$id;
        // Проверка
        if ($id == 0)
            return false;
        // удаление файла картинки
        //-------------------------
        include("delete.php");
        $query_dell = sprintf("SELECT name as image FROM file WHERE id_new=%d", $id);
        $result = mysqli_query($link, $query_dell);
        $n = mysqli_num_rows($result);
        $articles = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }

        $total = count($articles);
        foreach ($articles as $article) {
            delete_image($article);
        }
        //-----------------------
        // Запрос
        $query = sprintf("DELETE FROM articles WHERE id='%d'", $id);
        $query2 = sprintf("DELETE FROM ntegs WHERE id_new='%d'", $id);
        $query_dell = sprintf("DELETE FROM `file` WHERE `id_new`='%d'",$id);
        $result = mysqli_query($link, $query_dell);
        $result = mysqli_query($link, $query);
        $result = mysqli_query($link, $query2);
        
        // if (!result)
        //     die(mysqli_error($link));
        
        return mysqli_affected_rows($link);
    }

    function articles_intro($text, $len = 500)
    {
        return mb_substr($text, 0, $len);        
    }
    function images($link, $id_article){
        $id = (int)$id_article;
        $query = sprintf("SELECT name as image FROM file WHERE id_new=%d", $id);
        $result = mysqli_query($link, $query);
        $n = mysqli_num_rows($result);
        $articles = array();

        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        return $articles;
    }
    function comments_all($link){
        $query = sprintf("SELECT * FROM comments");
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function comm_get($link, $id_article){
        $query = sprintf("SELECT * FROM comments WHERE moder = 1 AND id_new=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function comm_get_all($link, $id_article){
        $query = sprintf("SELECT * FROM comments WHERE id_new=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function comm_user_all($link, $id_article){
        $query = sprintf("SELECT * FROM comments WHERE id_user=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function comm_moder($link, $id_article){
        $query = sprintf("UPDATE comments SET moder=1 WHERE id_comment=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
    // Извлекаем данные
        return $articles;
    }
    function comm_gelete($link, $id_article){
        $id = (int)$id_article;
        // Проверка
        if ($id == 0)
            return false;
        // Запрос
        $query = sprintf("DELETE FROM comments WHERE id_comment='%d'", $id);

        $result = mysqli_query($link, $query);
        
        // if (!result)
        //     die(mysqli_error($link));
        
        return mysqli_affected_rows($link);
    }
    function comm_moder_s($link, $id_article){
        $query = sprintf("UPDATE comments SET moder=1 WHERE id_comment=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
    // Извлекаем данные
        return $articles;
    }
    function comm_gelete_s($link, $id_article){
        $id = (int)$id_article;
        // Проверка
        if ($id == 0)
            return false;
        // Запрос
        $query = sprintf("DELETE FROM comments WHERE id_comment='%d'", $id);

        $result = mysqli_query($link, $query);
        
        // if (!result)
        //     die(mysqli_error($link));
        
        return mysqli_affected_rows($link);
    }
    function teg_get($link, $id_article){
        $query = sprintf("SELECT * FROM tegs WHERE id_teg=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        
        if (!$result)
            die(mysqli_error($link));
        
        $article = mysqli_fetch_assoc($result);
        
        return $article;
    }
    function tegs_all($link){
        $query = sprintf("SELECT * FROM tegs");
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function tegs_new($link, $id_article){
        $query = sprintf("SELECT teg_name FROM ntegs INNER JOIN tegs ON ntegs.id_teg = tegs.id_teg WHERE id_new=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function tegs_new_s($link, $id_article){
        $query = sprintf("SELECT * FROM ntegs INNER JOIN tegs ON ntegs.id_teg = tegs.id_teg WHERE id_new=%d", (int)$id_article);
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $articles = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        
        return $articles;
    }
    function teg_creare($link, $name){
        $name = trim($name);

        // Проверка
        if ($name == '')
            return false;
        
        // Запрос
        $template_add = "INSERT INTO tegs (id_teg, teg_name) " . "VALUES (NULL, '%s')";
        //mysqli_real_escape_string экранирует строку запроса для защиты от SQL инекций
        $query = sprintf($template_add, 
                         mysqli_real_escape_string($link, $name));
        // echo $query;
        $result = mysqli_query($link, $query);
        // if (!$result)
        //     die(mysqli_error($link));
        return true;
    }
    function teg_delete($link, $id_article){
        $id = (int)$id_article;
        // Проверка
        if ($id == 0)
            return false;
        // Запрос
        $query1 = sprintf("DELETE FROM tegs WHERE id_teg='%d'", $id);
        $query2 = sprintf("DELETE FROM ntegs WHERE id_teg='%d'", $id);
        
        $result = mysqli_query($link, $query1);
        $result = mysqli_query($link, $query2);
        
        // if (!result)
        //     die(mysqli_error($link));
        
        return mysqli_affected_rows($link);
    }
    function teg_edit($link, $id_article, $name){
        $name = trim($name);
        $id = (int)$id_article;

        $template_update = "UPDATE tegs SET teg_name='%s' WHERE id_teg='%d'";
            
        $query = sprintf($template_update, mysqli_real_escape_string($link, $name), $id);
        
        $result = mysqli_query($link, $query);

        return true;
    }
    function users_all($link){
        $query = sprintf("SELECT * FROM usertbl");
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        $n = mysqli_num_rows($result);
        $articles = array();
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        return $articles;
    }
    function bloking($link, $id_article){
        $id = (int)$id_article;
        $template_update = "UPDATE usertbl SET loked=0 WHERE id='%d'";
        $query = sprintf($template_update, $id);
        $result = mysqli_query($link, $query);
        $template_update = "UPDATE comments SET moder=0 WHERE id_user='%d'";
        $query = sprintf($template_update, $id);
        $result = mysqli_query($link, $query);
    }
    function rasbloking($link, $id_article){
        $id = (int)$id_article;
        $template_update = "UPDATE usertbl SET loked=1 WHERE id='%d'";
        $query = sprintf($template_update, $id);
        $result = mysqli_query($link, $query);
        return true;
    }
    function search_n($link, $t, $date='', $teg=''){
        $date = trim($date);
        $teg = trim($teg);
        $t = '%'.trim($t).'%';
        if ($teg!=''){
            $template_update = "SELECT id_new FROM ntegs WHERE id_teg = '%s'";
            $query = sprintf($template_update, mysqli_real_escape_string($link, $teg));
            $news = mysqli_query($link, $query);
            $n = mysqli_num_rows($news);
            $terlop = array();
        
            for ($i = 0; $i < $n; $i++)
            {
                $row = mysqli_fetch_assoc($news);
                $terlop[] = $row;
            }
        }
        
        if ($t!=''){
            if ($date!=''){
                $template_update = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE type = 'new' AND `title` LIKE '%s' AND `date` = '%s' GROUP BY articles.id ORDER BY id DESC";
                $query = sprintf($template_update, mysqli_real_escape_string($link, $t), mysqli_real_escape_string($link, $date));
            }
            else {
                $template_update = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE type = 'new' AND `title` LIKE '%s' GROUP BY articles.id ORDER BY id DESC";
                $query = sprintf($template_update, mysqli_real_escape_string($link, $t));
            }
            $result = mysqli_query($link, $query);
            $n = mysqli_num_rows($result);
            $articles = array();
            for ($i = 0; $i < $n; $i++)
            {
                $row = mysqli_fetch_assoc($result);
                if($teg!=''){
                    $g = count($terlop);
                    for ($j = 0; $j < $g; $j++){
                        if($row['id']==$terlop[$j]['id_new'])
                            $articles[] = $row;
                    }
                }
                else
                    $articles[] = $row;
            }
        }
        
        return $articles;
            
    }
    function search_p($link, $t, $date='', $teg=''){
        $date = trim($date);
        $teg = trim($teg);
        $t = '%'.trim($t).'%';
        if ($teg!=''){
            $template_update = "SELECT id_new FROM ntegs WHERE id_teg = '%s'";
            $query = sprintf($template_update, mysqli_real_escape_string($link, $teg));
            $news = mysqli_query($link, $query);
            $n = mysqli_num_rows($news);
            $terlop = array();
        
            for ($i = 0; $i < $n; $i++)
            {
                $row = mysqli_fetch_assoc($news);
                $terlop[] = $row;
            }
        }
        
        if ($t!=''){
            if ($date!=''){
                $template_update = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE type = 'project' AND `title` LIKE '%s' AND `date` = '%s' GROUP BY articles.id ORDER BY id DESC";
                $query = sprintf($template_update, mysqli_real_escape_string($link, $t), mysqli_real_escape_string($link, $date));
            }
            else {
                $template_update = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE type = 'project' AND `title` LIKE '%s' GROUP BY articles.id ORDER BY id DESC";
                $query = sprintf($template_update, mysqli_real_escape_string($link, $t));
            }
            $result = mysqli_query($link, $query);
            $n = mysqli_num_rows($result);
            $articles = array();
            for ($i = 0; $i < $n; $i++)
            {
                $row = mysqli_fetch_assoc($result);
                if($teg!=''){
                    $g = count($terlop);
                    for ($j = 0; $j < $g; $j++){
                        if($row['id']==$terlop[$j]['id_new'])
                            $articles[] = $row;
                    }
                }
                else
                    $articles[] = $row;
            }
        }
        return $articles;    
    }
    function search_np($link, $t, $date='', $teg=''){
        $date = trim($date);
        $teg = trim($teg);
        $t = '%'.trim($t).'%';
        if ($teg!=''){
            $template_update = "SELECT id_new FROM ntegs WHERE id_teg = '%s'";
            $query = sprintf($template_update, mysqli_real_escape_string($link, $teg));
            $news = mysqli_query($link, $query);
            $n = mysqli_num_rows($news);
            $terlop = array();
        
            for ($i = 0; $i < $n; $i++)
            {
                $row = mysqli_fetch_assoc($news);
                $terlop[] = $row;
            }
        }
        
        if ($t!=''){
            if ($date!=''){
                $template_update = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE `title` LIKE '%s' AND `date` = '%s' GROUP BY articles.id ORDER BY id DESC";
                $query = sprintf($template_update, mysqli_real_escape_string($link, $t), mysqli_real_escape_string($link, $date));
            }
            else {
                $template_update = "SELECT articles.*, name as image FROM articles left JOIN file ON articles.id = file.id_new WHERE `title` LIKE '%s' GROUP BY articles.id ORDER BY id DESC";
                $query = sprintf($template_update, mysqli_real_escape_string($link, $t));
            }
            $result = mysqli_query($link, $query);
            $n = mysqli_num_rows($result);
            $articles = array();
            for ($i = 0; $i < $n; $i++)
            {
                $row = mysqli_fetch_assoc($result);
                if($teg!=''){
                    $g = count($terlop);
                    for ($j = 0; $j < $g; $j++){
                        if($row['id']==$terlop[$j]['id_new'])
                            $articles[] = $row;
                    }
                }
                else
                    $articles[] = $row;
            }
        }
        return $articles;    
    }
    function search_comm($link, $t){
        $t = '%'.trim($t).'%';
        $template_update = "SELECT * FROM comments WHERE `text` LIKE '%s'";
        $query = sprintf($template_update, mysqli_real_escape_string($link, $t));
        $result = mysqli_query($link, $query);
        $n = mysqli_num_rows($result);
        $articles = array();
        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            $articles[] = $row;
        }
        return $articles;    
    }
    function patron_creare($link, $name, $contact){
        $name = trim($name);
        $contact = trim($contact);

        // Проверка
        if ($name == '')
            return false;
        $query = "SELECT * FROM patrons WHERE cont_patron ='$contact'";
        $result = mysqli_query($link, $query);
        $numrows= mysqli_num_rows($result);
        if($numrows!=0 ) {
            $template_upp = "UPDATE patrons SET name_patron='%s' WHERE cont_patron='%s'";
            //mysqli_real_escape_string экранирует строку запроса для защиты от SQL инекций
            $query = sprintf($template_upp, 
                             mysqli_real_escape_string($link, $name),
                             mysqli_real_escape_string($link, $contact));
            // echo $query;
            $result = mysqli_query($link, $query);
        }
        else{
            // Запрос
            $template_add = "INSERT INTO patrons (name_patron, cont_patron) " . "VALUES ('%s', '%s')";
            //mysqli_real_escape_string экранирует строку запроса для защиты от SQL инекций
            $query = sprintf($template_add, 
                             mysqli_real_escape_string($link, $name),
                             mysqli_real_escape_string($link, $contact));
            // echo $query;
            $result = mysqli_query($link, $query);
            // if (!$result)
            //     die(mysqli_error($link));
        }
    }
    function patrons_all($link){
        $query = sprintf("SELECT * FROM patrons");
        $result = mysqli_query($link, $query);
        if(!$result)
            die(mysqli_error($link));
        
    // Извлекаем данные
        $n = mysqli_num_rows($result);
        $patrons = array();
        
        for ($i = 0; $i < $n; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $patrons[] = $row;
        }
        
        return $patrons;
    }
    function patrons_moder($link, $id_article){
        $id = (int)$id_article;
        $template_update = "UPDATE patrons SET tr=1 WHERE id='%d'";
        $query = sprintf($template_update, $id);
        $result = mysqli_query($link, $query);
        return true;
    }
    function patrons_delete($link, $id_article){
        $id = (int)$id_article;
        // Проверка
        if ($id == 0)
            return false;
        // Запрос
        $query1 = sprintf("DELETE FROM patrons WHERE id='%d'", $id);

        $result = mysqli_query($link, $query1);
        
        // if (!result)
        //     die(mysqli_error($link));
        
        return mysqli_affected_rows($link);
    }
?>