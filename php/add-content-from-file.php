<?php include 'includes/config.php';?>
<?php


  $data = $_POST['data'];

  $data = str_replace('"', '', $data);
  $data = str_replace('[', '', $data);
  $data = str_replace(']', '', $data);
  $data = str_replace('@', '/', $data);

  $filepaths = explode(",", $data);
  $searchloginsresult = [];

  foreach ($filepaths as $filepath) {


    //Getting and storing the temporary file name of the uploaded file
    $fileName = "uploads/".$filepath;
    $foldername = preg_replace("/(.*)\/(.*)/", "$1", $filepath);

    //Throw an error message if the file could not be open
    $file = fopen($fileName,"r") or exit("Unable to open file!");

    // Reading a .txt file line by line
    $i = 0;
    $fullfilecontents = file_get_contents($fileName,true);

    preg_match_all("/(.*)@(.*) \/ (.*)/", $fullfilecontents, $output_array);

    foreach($output_array[1] as $findfirst){
      $email1 = $findfirst;
    }
    foreach($output_array[2] as $findfirst){
      $email2 = $findfirst;
    }
    foreach($output_array[3] as $findsecond){
      $email_password = $findsecond;
    }

    $email = $email1.'@'.$email2;
    $email = trim($email);

    $email_password = trim($email_password);

    $sql = "UPDATE accounts SET login = '".$email."', password = '".$email_password."', txt_content = '".$fullfilecontents."' WHERE folder_name = '".$foldername."';";

    $fillpasswords = mysql_query( $sql, $link );
        if (!$fillpasswords) {
            echo "Ошибка DB, запрос не удался\n";
            echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $searchlogin = (object) [
        'foldername' => $foldername,
        'login' => $email,
        'password' => $email_password
    ];

    $searchloginsresult[] = $searchlogin;
  }

  echo json_encode($searchloginsresult);
?>
