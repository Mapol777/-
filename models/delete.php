<?php
    define('ROOT', dirname(__FILE__));
    function delete_image($name){
        $name = ROOT . '/upload/' . $name['image'];
        if (file_exists(ROOT . '/upload')){
            foreach (glob(ROOT . '/upload/*') as $file)
            {
                if ($file == $name){
                    unlink($file);}
                
            }
        }
    }

?>
