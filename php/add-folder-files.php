<?php include 'includes/config.php';?>
<?php

  $data = $_POST['data'];

  $data = str_replace('"', '', $data);
  $data = str_replace('[', '', $data);
  $data = str_replace(']', '', $data);

  $foldernames = explode(",", $data);

  // array for object files
  $readyfiles = array();


  foreach($foldernames as $foldername){
    // check is folder name lenght > 0
    if(strlen(trim($foldername)) > 0){

      $path = 'uploads/'.$foldername.'/';

      $files = array();
      $dir = dir($path);

      while (false !== ($entry = $dir->read())) {
        if ($entry != '.' && $entry != '..') {
           if (is_dir($path . '/' .$entry)) {
           } else {
              $files[] = $entry;
           }
        }
      }

      $i = 0;
      $directory_txt = '';
      $directory_pdf = '';
      $directory_pdf2 = '';
      // create object with filenames
      $object = new stdClass();
      $object->foldername = $foldername;
      foreach ($files as $file) {
        // check pdf or txt
        if (strpos($file, 'txt') !== false) {
          $object->txt = $file;
          $directory_txt = $file;
        } else {
          // check one or two pdf files in folder
          if ( $i == 0 ) {
            $object->pdf = $file;
            $directory_pdf = $file;
            $i++;
          } else {
            $object->pdf2 = $file;
            $directory_pdf2 = $file;
          }
        }
      }
      // add object from this folder to global array
      $readyfiles[] = $object;

      $sql = "UPDATE uploads SET directory_txt = '".$directory_txt."', directory_pdf = '".$directory_pdf."', directory_pdf2 = '".$directory_pdf2."' WHERE directory_name = '".$foldername."';";

      $addfolder = mysql_query( $sql, $link );
      if (!$addfolder) {
        echo "Ошибка DB, запрос не удался\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
      }

      // need add check - maybe folder in accounts exist
      $sqltoaccounts = "INSERT INTO accounts (folder_name, txt_name, date_add) VALUES ('".$foldername."', '".$directory_txt."', NOW())";

      $addaccounts = mysql_query( $sqltoaccounts, $link );
      if (!$addaccounts) {
        echo "Ошибка DB, запрос не удался\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
      }
    }
  }

  // send back JSON formated array with objects
  echo json_encode($readyfiles);


?>


