<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> </title>

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
    <script type="text/javascript" src="///cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>
<body>
<!-- wrapper -->
<div class="wrapper">
  <header role="banner">
    <div class="inner">

      <div class="logo">
        <img src="img/logo.png" alt="" title="">
      </div><!-- /logo -->

      <nav class="nav" role="navigation">
        <ul class="headnav">
          <li>menu</li>
          <li>menu</li>
        </ul>
      </nav><!-- /nav -->

    </div><!-- /.inner -->
  </header><!-- /header -->

  <section role="main">
    <div class="inner">

      <article>

<?php

if (!$link = mysql_connect("localhost","topaz_user","topaz_pass")) {
  echo 'Не удалось подключиться к mysql';
  exit;
}

if (!mysql_select_db('topaz_db', $link)) {
    echo 'Не удалось выбрать базу данных';
    exit;
}

$sql    = 'SELECT ID, login, password FROM accounts ';
$result = mysql_query($sql, $link);

if (!$result) {
  echo "Ошибка DB, запрос не удался\n";
  echo 'MySQL Error: ' . mysql_error();
  exit;
}

while ($row = mysql_fetch_assoc($result)) {
  echo $row['ID'];
  echo $row['login'];
  echo $row['password'];
}

mysql_free_result($result);

?>


      </article>

      <aside class="sidebar" role="complementary">


      </aside><!-- /sidebar -->

    </div><!-- /.inner -->
  </section><!-- /section -->
</div><!-- /wrapper -->

<footer role="contentinfo">
  <div class="inner">

    <p class="copyright">
      © 2015 Собственность. Работает на html2wp easy.
    </p><!-- /copyright -->

  </div><!-- /.inner -->
</footer><!-- /footer -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
    <script type="text/javascript" src="js/scripts.js"></script>

</body>
</html>
