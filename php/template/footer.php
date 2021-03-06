    </div><!-- /.inner -->
  </section><!-- /section -->
</div><!-- /wrapper -->

<footer role="contentinfo">
  <div class="inner">
  </div><!-- /.inner -->
</footer><!-- /footer -->

    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

<script>

$(document).ready(function() {
  // process the form
  $('.refresh-new-folder').submit(function(event) {

    // get the form data
    var newFolderNames = [];
    $('.refresh-new-folder input:checked').each(function(index, el) {
      $(this).closest('tr').addClass('temp-class');
      var folderName = $('.temp-class input[name="foldername"]').val();
      newFolderNames.push(folderName);
      $('.temp-class').removeClass('temp-class');
    });

    console.log(newFolderNames);

    var jsonString = JSON.stringify(newFolderNames)
    var SenderNewFolderNames = {};
    SenderNewFolderNames.data = jsonString;

    // process the form
    $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : 'add-check-folder.php', // the url where we want to POST
      data: SenderNewFolderNames,
      cache: false,
      success: function(data){
        console.log('ajax ok');
      },
      error: function (error) {
        console.log('ajax false: ' + error);
      }
    })

    .done(function( data ) {
      console.log(data);
      $('.refresh-old-folders table').append('<tr><td>1</td><td>2</td>3<td></td><td></td><td></td><td></td><td></td></tr>');
      $('.refresh-old-folders').append('<h1 class="title title-red">Господин, для продолжения обновите эту страничку <i class="fa fa-refresh"></i></h1>');
      location.reload();
    });
    // stop the form from submitting the normal way and refreshing the page
    event.preventDefault();
  });

  // process the form
  $('.refresh-old-folders').submit(function(event) {

    // get the form data
    var oldFolderNames = [];
    $('.refresh-old-folders input:checked').each(function(index, el) {
      var folderName = $(this).val();
      console.log(folderName);
      oldFolderNames.push(folderName);
    });

    console.log(oldFolderNames);

    var jsonString = JSON.stringify(oldFolderNames)
    var SenderOldFolderNames = {};
    SenderOldFolderNames.data = jsonString;

    // process the form
    $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : 'add-folder-files.php', // the url where we want to POST
      data: SenderOldFolderNames,
      cache: false,
      success: function(data){
        console.log('ajax ok');
      },
      error: function (error) {
        console.log('ajax false: ' + error);
      }
    })

    .done(function( data ) {
      console.log(data);
      // alert('Братишка, обнови страничку!');
      location.reload();
    });
    // stop the form from submitting the normal way and refreshing the page
    event.preventDefault();
  });

  $('.fill-the-form').on('click', function(event){
    event.preventDefault();

    // get the form data
    var needCheckFiles = [];
    $('.main-form input[name="fiilformed"]:checked').each(function(index, el) {
      var fileLocations = $(this).val();
      console.log(fileLocations);
      needCheckFiles.push(fileLocations);
    });

    console.log(needCheckFiles);

    var jsonString = JSON.stringify(needCheckFiles)
    var SenderNeedCheckFiles = {};
    SenderNeedCheckFiles.data = jsonString;

    // process the form
    $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : 'add-content-from-file.php', // the url where we want to POST
      data: SenderNeedCheckFiles,
      cache: false,
      success: function(data){
        console.log('ajax ok');
      },
      error: function (error) {
        console.log('ajax false: ' + error);
      }
    })

    .done(function( data ) {
      console.log(data);
      // alert('Братишка, обнови страничку!');
      location.reload();
    });
  })


  $('.main-form .remove-row').on('click', function(event){
    event.preventDefault();

    // get the form data
    var needRemoveFiles = [];
    $('.main-form input[name="remove-this"]:checked').each(function(index, el) {
      var thisID = $(this).val();
      console.log(thisID);
      needRemoveFiles.push(thisID);
    });

    console.log(needRemoveFiles);

    var jsonString = JSON.stringify(needRemoveFiles)
    var SenderNeedRemoveString = {};
    SenderNeedRemoveString.data = jsonString;

    // process the form
    $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : 'remove.php', // the url where we want to POST
      data: SenderNeedRemoveString,
      cache: false,
      success: function(data){
        console.log('ajax ok');
      },
      error: function (error) {
        console.log('ajax false: ' + error);
      }
    })

    .done(function( data ) {
      console.log(data);
      location.reload();
    });
  })

  $('.rename-row').on('click', function(event){
    event.preventDefault();

    // get the form data
    var needRenameFiles = [];
    $('.main-form input[name="rename-this"]:checked').each(function(index, el) {
      var thisID = $(this).val();
      console.log(thisID);
      needRenameFiles.push(thisID);
    });

    console.log(needRenameFiles);

    var jsonString = JSON.stringify(needRenameFiles)
    var SenderNeedRenameString = {};
    SenderNeedRenameString.data = jsonString;

    // process the form
    $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : 'rename.php', // the url where we want to POST
      data: SenderNeedRenameString,
      cache: false,
      success: function(data){
        console.log('ajax ok');
      },
      error: function (error) {
        console.log('ajax false: ' + error);
      }
    })

    .done(function( data ) {
      console.log(data);
      location.reload();
    });
  })

  $('.refresh-old-folders .remove-row').on('click', function(event){
    event.preventDefault();

    // get the form data
    var needRemoveFiles = [];
    $(this).parent('table').addClass('this-form-clean');
    $('.refresh-old-folders input[name="remove-this"]:checked').each(function(index, el) {
      var thisID = $(this).val();
      console.log(thisID);
      needRemoveFiles.push(thisID);
    });

    console.log(needRemoveFiles);

    var jsonString = JSON.stringify(needRemoveFiles)
    var SenderNeedRemoveString = {};
    SenderNeedRemoveString.data = jsonString;

    // process the form
    $.ajax({
      type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
      url         : 'remove-uploads.php', // the url where we want to POST
      data: SenderNeedRemoveString,
      cache: false,
      success: function(data){
        console.log('ajax ok');
      },
      error: function (error) {
        console.log('ajax false: ' + error);
      }
    })

    .done(function( data ) {
      console.log(data);
      location.reload();
    });
  })

  $('.checkbox-toggler-1').click(function(event) {
    event.preventDefault();
    $('.main-form td:nth-child(1), .refresh-old-folders td:nth-child(1)').each(function(index, el) {
      var $elem = $(this).find('input');
      $elem.click();
    })
  });

  $('.checkbox-toggler-8').click(function(event) {
    event.preventDefault();
    $('.main-form td:nth-child(8)').each(function(index, el) {
      var $elem = $(this).find('input');
      $elem.click();
    })
  });

  $('.checkbox-toggler-9').click(function(event) {
    event.preventDefault();
    $('.main-form td:nth-child(9)').each(function(index, el) {
      var $elem = $(this).find('input');
      $elem.click();
    })
  });


  $('.check-the-from').on('click', function(event){
    event.preventDefault();

    $('.main-form input[name="check-this"]:checked').each(function(index, el) {

      console.log('index ' + index);
      console.log('el ' + el);

      // get the form data
      var needCheckMails = {foldername : '', login : '', password : ''};

      $(this).closest('tr').addClass('checking-this-mail');

      needCheckMails.foldername = $('.checking-this-mail input[name="foldername"]').val();
      needCheckMails.login = $('.checking-this-mail input[name="login"]').val();
      needCheckMails.password = $('.checking-this-mail input[name="password"]').val();

      console.log(needCheckMails);

      var jsonString = JSON.stringify(needCheckMails)
      var SenderNeedCheckEmails = {};
      SenderNeedCheckEmails.data = jsonString;

      // process the form
      $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : 'check-mail.php', // the url where we want to POST
        data: SenderNeedCheckEmails,
        cache: false,
        success: function(data){
          console.log('ajax ok');
        },
        error: function (error) {
          console.error('Ошибка, смотри логи')
          console.log('ajax false: ' + error);
        }
      })

      .done(function( data ) {
        console.log(data);

        // alert('Братишка, обнови страничку!');
        location.reload();
      });

      $(this).closest('tr').removeClass('checking-this-mail');

    })


  });

});

</script>


</body>
</html>
