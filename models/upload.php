<?php
    // проверяем, что есть файл
    if((!empty($_FILES["image"]))) {
      // проверяем, что файл это изображение JPEG и его размер не больше 350кб
      $total = count($_FILES['image']['name']);
      for( $i=0 ; $i < $total ; $i++ ) {
          $filename = str_replace(" ", '', basename($_FILES['image']['name'][$i]));
          $filename = str_replace("(", '9', $filename);
          $filename = str_replace(")", '0', $filename);
          $ext = substr($filename, strrpos($filename, '.') + 1);
          if ((($ext == "jpg") || ($ext == "jpeg") || ($ext == "png")) && (($_FILES["image"]["type"][$i] == "image/jpeg") ||
            ($_FILES["image"]["type"][$i] == "image/png") ||
            ($_FILES["image"]["type"][$i] == "image/jpeg")) && ($_FILES["image"]["size"][$i] <= 350000000)) {
            // путь для сохранения файла
            $newname = dirname(__FILE__).'/upload/'.$filename;
            // echo $newname;
            // проверяем, файл с таким названием уже есть на сервере
            if (!file_exists($newname)) {
              // переместить загруженный файл в новое место
              if ((move_uploaded_file($_FILES['image']['tmp_name'][$i],$newname))) {
                 // echo "Файл был загружен: ".$newname;
              } else {
                 // echo "Произошла ошибка при загрузке файла!";
              }
            } else {
               // echo "Ошибка: файл ".$_FILES["image"]["name"][$i]." уже существует";
            }
        } else {
           // echo "Ошибка при загрузке файла, изображение не .jpg и не .png или больше чем 350кб.";
        }
      }
    } else {
     // echo "Ошибка: файл не загружен!";
    }
?>

