<?php include 'includes/config.php';?>
<?php

  $data = $_POST['data'];

  $data = str_replace('"', '', $data);
  $data = str_replace('[', '', $data);
  $data = str_replace(']', '', $data);

  $ids = explode(",", $data);
  foreach ($ids as $id) {

    $sql = "SELECT folder_name, txt_name, status_accept, status_reject FROM accounts WHERE ID = '$id';";
    $result = mysql_query($sql, $link);

    if (!$result) {
      echo "Ошибка DB, запрос не удался\n";
      echo 'MySQL Error: ' . mysql_error();
      $errorlog = 'Ошибка DB, запрос не удался\n MySQL Error: ' . mysql_error();
      exit;
    } else {
      $errorlog = $id.' quered';
    }

    while ($row = mysql_fetch_assoc($result)) {

      $foldername = $row['folder_name'];
      $filenametorename = $row['txt_name'];
      $filename = $row['txt_name'];

      if ( $row['status_accept'] == '1' ) {
        $filename = preg_replace("/(.*).txt/", "$1", $filename);
        $newfilename = $filename.'-Accepted.txt';
      } else if ( $row['status_reject'] == '1' ) {
        $filename = preg_replace("/(.*).txt/", "$1", $filename);
        $newfilename = $filename.'-Rejected.txt';
      } else {
        $newfilename = $filename;
      }

      rename("uploads/".$foldername."/".$filenametorename, "uploads/".$foldername."/".$newfilename);

      $sql = "UPDATE accounts SET txt_name = '.$newfilename.', status = 2 WHERE folder_name = '".$foldername."';";

      $renamed = mysql_query($sql, $link);


    }



  }

    // $updatestatus = mysql_query( $sql, $link );



    echo json_encode($errorlog);


?>


