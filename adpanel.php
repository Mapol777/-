<?php
if(!isset($_SESSION)) { session_start(); }
require_once("database.php");
require_once("models/articles.php");
    
$link = db_connect();

$article['id']='';
$article['title']='';
$article['date']='';
$article['content']='';
$article['type']='';
$article['teg_name'] ='';

if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "";

if (isset($_GET['d'])){
    if ($_GET['d'] == "f"){
        $articles = articles_all($link);
        include("views/articles_admin.php");
    }
    if ($_GET['d'] == "z"){
        include("views/comments.php");
    }
    if ($_GET['d'] == "y"){
        include("views/tegs.php");
    }
    if ($_GET['d'] == "w"){
        include("views/users.php");
    }
    if ($_GET['d'] == "t"){
        include("views/patrons.php");
    }
} 
else if($action == "add"){
    if(!empty($_POST)){
        articles_new($link, $_POST['title'], $_POST['date'], $_POST['content'], $_POST['tegs'], $_POST['toggle']);
        header("Location: admin.php");
    }
    include("views/article_admin.php");
}else if($action == 'edit'){
    if(!isset($_GET['id']))
        header('Location: admin.php');
    $id = (int)$_GET['id'];
    
    if(!empty($_POST) && $id > 0) {
        articles_edit($link, $id, $_POST['title'], $_POST['date'], $_POST['content'], $_POST['tegs'], $_POST['toggle']);
        header("Location: admin.php");
    }
    $article = article_get($link, $id);
    include("views/article_admin.php");  
}elseif($action == 'delete'){
    $id = $_GET['id'];
    $article = articles_delete($link, $id);
    header('Location: admin.php');
}
elseif($action == 'del_teg'){
    $id = $_GET['id'];
    $article = teg_delete($link, $id);
    header('Location: admin.php');
}
elseif($action == 'comm_moder'){
    $id = $_GET['id'];
    $article = comm_moder($link, $id);
    if (!empty($_GET['art']) && !empty($_GET['id_user']))
        header("Location: admin.php?action=$_GET[art]&id=$_GET[id_user]");
    else
        header('Location: admin.php');
}
elseif($action == 'comm_gelete'){
    $id = $_GET['id'];
    $article = comm_gelete($link, $id);
    if (!empty($_GET['art']) && !empty($_GET['id_user']))
        header("Location: admin.php?action=$_GET[art]&id=$_GET[id_user]");
    else header('Location: admin.php');
}
elseif($action == "teg_creare"){
    if(!empty($_POST)){
        teg_creare($link, $_POST['name']);
        header("Location: admin.php");
    }
    include("views/createteg.php");
}
elseif($action == 'teg_edit'){
    if(!isset($_GET['id']))
        header('Location: admin.php');
    $id = (int)$_GET['id'];
    
    if(!empty($_POST)) {
        teg_edit($link, $id, $_POST['name']);
        header("Location: admin.php");
    }
    $article = teg_get($link, $id);
    include("views/createteg.php");  
}
elseif($action == "user_edit"){
    include("views/reduser.php");
}
elseif($action == "bloking"){
    $id = $_GET['id'];
    bloking($link, $id);
    if (!empty($_GET['art']) && !empty($_GET['id_user']))
        header("Location: admin.php?action=$_GET[art]&id=$_GET[id_user]");
    else header('Location: admin.php');
}
elseif($action == "rasbloking"){
    $id = $_GET['id'];
    rasbloking($link, $id);
    if (!empty($_GET['art']) && !empty($_GET['id_user']))
        header("Location: admin.php?action=$_GET[art]&id=$_GET[id_user]");
    else header('Location: admin.php');
}
elseif($action == "search_np"){
    if(!empty($_POST['title'])){
        if(!empty($_POST['date']))
            if(!empty($_POST['teg']))
                $articles = search_np($link, $_POST['title'], $_POST['date'], $_POST['teg']);
            else
                $articles = search_np($link, $_POST['title'], $_POST['date']);
        else if(!empty($_POST['teg']))
            $articles = search_np($link, $_POST['title'], '', $_POST['teg']);
        else
            $articles = search_np($link, $_POST['title']);
    }
    else if(!empty($_POST['date'])){
        if(!empty($_POST['teg']))
            $articles = search_np($link, '', $_POST['date'], $_POST['teg']);
        else
            $articles = search_np($link, '', $_POST['date']);
    }
    else if(!empty($_POST['teg']))
        $articles = search_np($link, '', '', $_POST['teg']);
    else
        $articles = articles_all_n($link);
    include("views/articles_admin.php"); 
}elseif($action == 'search_t'){
    if($_GET['teg'])
        $articles = search_n($link, '', '', $_GET['teg']);
    else
        $articles = '';
    require ("views/admin.php");  
}elseif($action == 'search_comm'){
    if($_POST['content'])
        $goters = search_comm($link, $_POST['content']);
    else
        $goters = '';
    require ("views/comments.php");  
}elseif($action == 'patrons_delete'){
    if($_GET['id'])
        $goters = patrons_delete($link, $_GET['id']);
    else
        $goters = '';
    require ("views/patrons.php");  
}elseif($action == 'patrons_moder'){
    if($_GET['id'])
        $goters = patrons_moder($link, $_GET['id']);
    else
        $goters = '';
    require ("views/patrons.php");  
}
else{
    $articles = articles_all($link);
	include("views/articles_admin.php");
}

// $articles = articles_all($link);
//     if(!isset($_SESSION["panel"])) {
// 	    include("views/articles_admin.php");
// 	}
//     if (isset($_POST['valuepanel'])){
// 		if ($_POST['valuepanel'] == 1){
// 			include("views/articles_admin.php");
// 		}
// 		if ($_POST['valuepanel'] == 2){
// 			include("views/comments.php");
// 		}
// 		if ($_POST['valuepanel'] == 3){
// 			include("views/tegs.php");
// 		}
// 		if ($_POST['valuepanel'] == 4){
// 			include("views/users.php");
// 		}
// 		if ($_POST['valuepanel'] == 5){
// 			include("views/redactnesandproj.php");
// 		}
// 		if ($_POST['valuepanel'] == 6){
// 			include("views/redusers.php");
// 		}
// 	}   

// if (isset($_POST['valuepanel'])) {
// 	if ($_POST['valuepanel'] == 'insert'){
// 		echo('nesandproj');
// 	}
// 	if ($_POST['valuepanel'] == 'select'){
// 		echo('select');
// 	}
//         switch ($_POST['valuepanel']) {
//             case 'insert':
//                 echo "The select function is called.";
//                 break;
//             case 'select':
//                 echo "The insert function is called.";
//                 break;
//         }
//     }
?>