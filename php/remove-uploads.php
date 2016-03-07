<?php include 'includes/config.php';?>
<?php

  $data = $_POST['data'];

  $data = str_replace('"', '', $data);
  $data = str_replace('[', '', $data);
  $data = str_replace(']', '', $data);

  $ids = explode(",", $data);
  foreach ($ids as $id) {

    $sql = "DELETE FROM uploads WHERE ID = '$id';";

    $updatestatus = mysql_query( $sql, $link );
    if (!$updatestatus) {
      echo "Ошибка DB, запрос не удался\n";
      echo 'MySQL Error: ' . mysql_error();
      $errorlog = 'Ошибка DB, запрос не удался\n MySQL Error: ' . mysql_error();
      exit;
    } else {
      $errorlog = $id.' deleted';
    }

    echo json_encode($sql);
    echo json_encode($errorlog);

  }

?>


