<?php include 'template/header.php';?>

  <article class="main-block">

    <form action="" class="main-form">
      <table>
        <tr>
          <th>
            ID
          </th>
          <th>
            Название папки
          </th>
          <th>
            и файла
          </th>
          <th>
            Логин
          </th>
          <th>
            Пароль
          </th>
          <th>
            Добавленно
          </th>
          <th>
            Проверенно
          </th>
          <th>
            Записать
          </th>
          <th>
            Статус
          </th>
        </tr>

        <?php



        $sql = 'SELECT ID, folder_name, txt_name, login, password, date_add, date_checked, status FROM accounts';
        $result = mysql_query($sql, $link);

        if (!$result) {
          echo "Ошибка DB, запрос не удался\n";
          echo 'MySQL Error: ' . mysql_error();
          exit;
        }

        while ($row = mysql_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['folder_name']; ?></td>
            <td><?php echo $row['txt_name']; ?></td>
            <td><?php echo $row['login']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['date_add']; ?></td>
            <td><?php echo $row['date_checked']; ?></td>
            <td>
              <input type="checkbox">
            </td>
            <td><?php echo $row['status']; ?></td>

          </tr>
        <? } ?>

      </table>
    </form><!-- /.main-form -->
















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
                           <input name="add" type="submit" id="add" value="Add mail">
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


    $sql="INSERT INTO accounts (login, password, date_add) VALUES ('$email', '$email_password', NOW())";

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

<?php include 'template/footer.php';?>
