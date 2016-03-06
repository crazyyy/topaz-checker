<?php include 'includes/config.php';?>
<?php

  $data = json_decode($_POST['data']);

  $foldername = $data->foldername;
  $username = $data->login;
  $password = $data->password;


  /* connect to yandex */
  $hostname = '{imap.yandex.ru:993/imap/ssl}INBOX';
  /* try to connect */
  $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Yandex: ' . imap_last_error());

  /* grab emails */
  $emails = imap_search($inbox,'ALL');

  /* if emails are returned, cycle through each... */
  if($emails) {

    /* begin output var */
    $output = '';

    /* put the newest emails on top */
    rsort($emails);

    $searchstringaccept = 'Your Federal Return Was Accepted';
    $searchstringreject = 'Federal Return Rejected - Action Needed';

    $allmails = [];

    /* for every email... */
    foreach($emails as $email_number) {
      $emailobject = new stdClass();

      /* get information specific to this email */
      $overview = imap_fetch_overview($inbox,$email_number,0);
      $message = imap_fetchbody($inbox,$email_number,2);

      /* output the email header information */
      $output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
      $output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
      $output.= '<span class="from">'.$overview[0]->from.'</span>';
      $output.= '<span class="date">on '.$overview[0]->date.'</span>';
      $output.= '</div>';
      /* output the email body */
      $output.= '<div class="body">'.$message.'</div>';

      $subjectstring = $overview[0]->subject;



      $emailobject->readstatus = ($overview[0]->seen ? 'read' : 'unread');
      $emailobject->subject = $overview[0]->subject;

      // search string in subject
      if ( strpos($subjectstring, $searchstringaccept) !== false ) {
        $emailobject->found = true;
        $emailobject->accepted = true;
        $sql = "UPDATE accounts SET date_checked = NOW(), status_accept = 1 WHERE folder_name = '".$foldername."';";
      } else if ( strpos($subjectstring, $searchstringreject) !== false ) {
        $emailobject->found = true;
        $emailobject->accepted = false;
        $sql = "UPDATE accounts SET date_checked = NOW(), status_reject = 1 WHERE folder_name = '".$foldername."';";
      } else {
        $emailobject->found = false;
        $emailobject->accepted = false;
        $sql = "UPDATE accounts SET date_checked = NOW(), status = 1 WHERE folder_name = '".$foldername."';";
      }
      $updatestatus = mysql_query( $sql, $link );

      $emailobject->from = $overview[0]->from;
      $emailobject->date = $overview[0]->date;
      // $emailobject->message = $message;

      $emailobject->foldername = $foldername;
      $emailobject->login = $username;

     /* update check status date */


      if (!$updatestatus) {
        echo "Ошибка DB, запрос не удался\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
      }


      $allmails[] = $emailobject;

    }


  }

  /* close the connection */
  imap_close($inbox);

  echo json_encode($allmails);

  // echo json_encode($data);

?>


