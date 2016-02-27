<?php include 'includes/config.php';?>
<?php

  $data = $_POST['data'];

  $data = str_replace('"', '', $data);
  $data = str_replace('[', '', $data);
  $data = str_replace(']', '', $data);

  $foldernames = explode(",", $data);

  foreach($foldernames as $foldername){

    // check is folder name lenght > 0
    if(strlen(trim($foldername)) > 0){
      $sql = "INSERT INTO uploads (directory_name, date_add) VALUES('$foldername', NOW())";
      $addfolder = mysql_query( $sql, $link );
    }

  }

?>


