<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(!isset($_SESSION["theme"]))
{
    $_SESSION["theme"] = "light";
}

if(isset($_GET["theme"]))
{
    $theme = $_GET["theme"];

    if($theme == "light" || $theme == "dark")
    {
   	 $_SESSION["theme"] = $theme;
    }
}

?>
