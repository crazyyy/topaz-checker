<?php
  $db_server = "localhost";
  $db_user = "topaz_user";
  $db_pass = "topaz_pass";
  $db_name = "topaz_db";


  if (!$link = mysql_connect($db_server,$db_user,$db_pass)) {
    echo 'Не удалось подключиться к mysql';
    exit;
  }

  if (!mysql_select_db($db_name, $link)) {
    echo 'Не удалось выбрать базу данных';
    exit;
  }

?>
