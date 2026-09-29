<?php
if(!isset($_SESSION)) { session_start(); }
require_once("database.php");
require_once("models/articles.php");
    
$link = db_connect();

if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "";

if($action == "search_p"){
    if(!empty($_POST['title'])){
        if(!empty($_POST['date']))
            if(!empty($_POST['teg']))
                $articles = search_n($link, $_POST['title'], $_POST['date'], $_POST['teg']);
            else
                $articles = search_n($link, $_POST['title'], $_POST['date']);
        else if(!empty($_POST['teg']))
            $articles = search_n($link, $_POST['title'], '', $_POST['teg']);
        else
            $articles = search_n($link, $_POST['title']);
    }
    else if(!empty($_POST['date'])){
        if(!empty($_POST['teg']))
            $articles = search_n($link, '', $_POST['date'], $_POST['teg']);
        else
            $articles = search_n($link, '', $_POST['date']);
    }
    else if(!empty($_POST['teg']))
        $articles = search_n($link, '', '', $_POST['teg']);
    else
        $articles = articles_all_p($link);
    $news = articles_all_n($link);
    require ("views/projects.php");
}else if($action == 'search_p_t'){
    if($_GET['teg'])
        $articles = search_p($link, '', '', $_GET['teg']);
    else
        $articles = '';
    $news = articles_all_n($link);
    require ("views/projects.php");  
}
else{
	require ("views/projects.php");       
}
?>