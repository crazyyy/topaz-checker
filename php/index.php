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

        <table>
          <tr>
            <th>
              ID
            </th>
            <th>
              login
            </th>
            <th>
              password
            </th>
          </tr>

          <?php while ($row=mysql_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['ID']; ?></td>
              <td><?php echo $row['login']; ?></td>
              <td><?php echo $row['password']; ?></td>
              <td><?php echo $row['ID']; ?></td>
            </tr>
          <? } ?>

        </table>



<hr>
<hr>

     <?php
         if(isset($_POST['add'])) {

            $conn=mysql_connect($db_server, $db_user, $db_pass);

            if (! $conn ) {
               die('Could not connect: ' . mysql_error());
            }

            if (! get_magic_quotes_gpc() ) {
               $login=addslashes ($_POST['login']);
               $password=addslashes ($_POST['password']);
            } else {
               $login=$_POST['login'];
               $password=$_POST['password'];
            }

            $sql="INSERT INTO accounts ". "(login, password, date_add) ". "VALUES('$login', '$password', NOW())";

            mysql_select_db($db_name);
            $retval=mysql_query( $sql, $conn );

            if(! $retval ) {
               die('Could not enter data: ' . mysql_error());
            }

            echo "Entered data successfully\n";

            mysql_close($conn);
         } else {
            ?>

               <form method="post" action="<?php $_PHP_SELF ?>">
                  <table width="400" border="0" cellspacing="1" cellpadding="2">

                     <tr>
                        <td width="100">Email</td>
                        <td><input name="login" type="text" id="login"></td>
                     </tr>

                     <tr>
                        <td width="100">Password</td>
                        <td><input name="password" type="text" id="password"></td>
                     </tr>


                     <tr>
                        <td width="100"> </td>
                        <td>
                           <input name="add" type="submit" id="add" value="Add Employee">
                        </td>
                     </tr>

                  </table>
               </form>

            <?php } ?>







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
