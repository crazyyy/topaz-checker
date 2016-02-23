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

          <?php while ($row = mysql_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['ID']; ?></td>
              <td><?php echo $row['login']; ?></td>
              <td><?php echo $row['password']; ?></td>
              <td>
                <button class="checkmail" data-id="<?php echo $row['ID']; ?>">check</button>

              </td>
            </tr>
          <? } ?>

        </table>


<div class="result-checker">

</div><!-- /.result-checker -->


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



<hr>



<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="file" size="60" />
    <input type="submit" value="Read Contents" />
</form>


<?php

    if($_FILES){

    //Checking if file is selected or not
    if($_FILES['file']['name'] != "") {

        //Checking if the file is plain text or not
        if(isset($_FILES) && $_FILES['file']['type'] != 'text/plain') {
            echo "<span>File could not be accepted ! Please upload any '*.txt' file.</span>";
            exit();
        }

        echo "<center><span id='Content'>Contents of ".$_FILES['file']['name']." File</span></center>";

        //Getting and storing the temporary file name of the uploaded file
        $fileName = $_FILES['file']['tmp_name'];

        //Throw an error message if the file could not be open
        $file = fopen($fileName,"r") or exit("Unable to open file!");

        // Reading a .txt file line by line
        echo 'line by line : <br>';
        $i = 0;
        $userline = "";
        while (!feof($file)) {
            $line = fgets($file);
            echo $i . ": " . $line . "";
            if ($i==1) {
                $userline = $line;
            }
            echo '<br>';
            $i++;
        }

        echo '<hr>';
        echo $userline;
        echo '<hr>';

        preg_match_all("/(.*) \/ (.*)/", $userline, $output_array);

        foreach($output_array[1] as $findfirst){
            $email = $findfirst;
        }

        foreach($output_array[2] as $findsecond){
            $email_password = $findsecond;
        }

        echo "email: ".$email."<br>";
        echo "password: ".$email_password;



    $conn=mysql_connect($db_server, $db_user, $db_pass);

    if (! $conn ) {
       die('Could not connect: ' . mysql_error());
    }


    $sql="INSERT INTO accounts ". "(login, password, date_add) ". "VALUES('$email', '$email_password', NOW())";

    mysql_select_db($db_name);
    $retval=mysql_query( $sql, $conn );

    if(! $retval ) {
       die('Could not enter data: ' . mysql_error());
    }

    echo "Entered data successfully\n";

    mysql_close($conn);





        fclose($file);

    } else {

        if(isset($_FILES) && $_FILES['file']['type'] == '')
            echo "<span>Please Choose a file by click on 'Browse' or 'Choose File' button.</span>";
        }
    }
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

    </p><!-- /copyright -->

  </div><!-- /.inner -->
</footer><!-- /footer -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
    <script type="text/javascript" src="js/scripts.js"></script>

<script>



function checkMail(ID) {
  var dataSend = {checkmailid: ID};
  $.ajax({
    type: "GET",
    url: 'mail-check.php',
    data: dataSend,
    success: function(data){
      $('.result-checker').fadeIn('fast');
      $('.result-checker').html(data);
    }
  });
}


$(document).ready(function($) {
  $('.checkmail').on('click', function(){
    var thisID = $(this).attr('data-id');
    checkMail(thisID);
  })

});


</script>



</body>
</html>
