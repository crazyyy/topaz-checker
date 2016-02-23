<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

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



        fclose($file);

    } else {

        if(isset($_FILES) && $_FILES['file']['type'] == '')
            echo "<span>Please Choose a file by click on 'Browse' or 'Choose File' button.</span>";
        }
    }
?>


</body>
</html>
