<?php include 'includes/config.php';?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TopaZ checke mail</title>

    <link href="http://www.google-analytics.com/" rel="dns-prefetch"><!-- dns prefetch -->
    <!-- meta -->

    <!-- icons -->
    <link href="favicon.ico" rel="shortcut icon">

    <!-- css + javascript -->
    <link rel="stylesheet" href="style.css" media="all">

    <!--[if lt IE 9]>
      <script type="text/javascript" src="js/html5shiv.js"></script>
      <script type="text/javascript" src="js/selectivizr.js"></script>
      <script type="text/javascript" src="js/respond.js"></script>
    <![endif]-->
</head>
<body>
<!-- wrapper -->
<div class="wrapper">
  <header role="banner">
    <div class="inner">
    </div><!-- /.inner -->
  </header><!-- /header -->

  <section role="main">
    <div class="inner">

      <article class="main-block">





<?php
  $path = 'uploads';

  $dirs = array();
  $files = array();

  // directory handle
  $dir = dir($path);

  while (false !== ($entry = $dir->read())) {
    if ($entry != '.' && $entry != '..') {
       if (is_dir($path . '/' .$entry)) {
          $dirs[] = $entry;
       } else {
          $files[] = $entry;
       }
    }
  }

  foreach ($dirs as $directory) {


    // echo $directory . '<br>';

    $sql = 'SELECT ID FROM uploads WHERE directory_name = "'.$directory.'"';

    // check MySQL query
    echo $sql;

    $result = mysql_query($sql, $link);

    if ( $result == true ) {
      // mysql connect ok
      // echo '<br>T R U E <br>';
    } else {
      echo '<br>MySQL connections problem<br>';
    }


    $num_rows = mysql_num_rows($result);

    // check if folder in uploads dir added to DB or not
    if ($num_rows > 0) {
      echo '<br>'.$directory.' is on DB';
    } else {

      echo '<br>'.$directory.' is new folder <br>';
      $query = "INSERT INTO uploads (directory_name, directory_status, date_add) VALUES ('$directory', '0', NOW())";
      echo '<br>query to add this folder to DB '.$query.'<br>';
      $add_folder_name = mysql_query($query, $link);
      echo '<br>folder '.$directory.' added to DB';



    }

  }





  foreach ($files as $file) {
    echo $file . '<br>';
  }


  // echo "<pre>"; print_r($dirs); exit;

?>


      <table>
        <tr>
          <th>
            <i class="fa fa-chevron-right"></i> ID</i>
          </th>
          <th>
            <i class="fa fa-calendar"></i> DATE</i>
          </th>
          <th>
            <i class="fa fa-folder-open-o"> NAME</i>
          </th>
          <th>
            <i class="fa fa-file-text-o"></i> TXT</i>
          </th>
          <th>
            <i class="fa fa-file-pdf-o"></i> PDF</i>
          </th>
          <th>
            <i class="fa fa-file-pdf-o"></i> PDF 2</i>
          </th>
          <th>
            <i class="fa fa-plus-circle"></i> ADD</i>
          </th>
        </tr>


<?php
  $path = 'uploads';

  $dirs = array();
  $files = array();

  // directory handle
  $dir = dir($path);

  while (false !== ($entry = $dir->read())) {
    if ($entry != '.' && $entry != '..') {
       if (is_dir($path . '/' .$entry)) {
          $dirs[] = $entry;
       } else {
          $files[] = $entry;
       }
    }
  }

  foreach ($dirs as $directory) {


    // echo $directory . '<br>';

    $sql = 'SELECT ID FROM uploads WHERE directory_name = "'.$directory.'"';

    // check MySQL query
    echo $sql;

    $result = mysql_query($sql, $link);

    if ( $result == true ) {
      // mysql connect ok
      // echo '<br>T R U E <br>';
    } else {
      echo '<br>MySQL connections problem<br>';
    }


    $num_rows = mysql_num_rows($result);

    // check if folder in uploads dir added to DB or not
    if ($num_rows > 0) {

      echo '<br>'.$directory.' is on DB';


      echo "<tr>";

      echo "<td></td>";
      echo "<td></td>";
      echo "<td>' .$directory. '</td>";
      echo "<td></td>";
      echo "<td> check  </td>";

      echo "</tr>";



    } else {


      echo "<tr>";

      echo "<td></td>";
      echo "<td></td>";
      echo "<td>' .$directory. '</td>";
      echo "<td></td>";
      echo "<td> new dir +  </td>";

      echo "</tr>";




      echo '<br>'.$directory.' is new folder <br>';
      $query = "INSERT INTO uploads (directory_name, directory_status, date_add) VALUES ('$directory', '0', NOW())";
      echo '<br>query to add this folder to DB '.$query.'<br>';
      $add_folder_name = mysql_query($query, $link);
      echo '<br>folder '.$directory.' added to DB';



    }

  }





  foreach ($files as $file) {
    echo $file . '<br>';
  }


  echo "<pre>"; print_r($dirs); exit;

?>



















      </table>



      </article>

      <aside class="sidebar" role="complementary">


      </aside><!-- /sidebar -->

    </div><!-- /.inner -->
  </section><!-- /section -->
</div><!-- /wrapper -->

<footer role="contentinfo">
  <div class="inner">

    <p class="copyright">

    </p><!-- /copyright -->

  </div><!-- /.inner -->
</footer><!-- /footer -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
    <script type="text/javascript" src="js/scripts.js"></script>


</body>
</html>
