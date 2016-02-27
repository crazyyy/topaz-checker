

    </div><!-- /.inner -->
  </section><!-- /section -->
</div><!-- /wrapper -->

<footer role="contentinfo">
  <div class="inner">

    <p class="copyright">

    </p><!-- /copyright -->

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
      $('.refresh-old-folders table').append('<tr><td>1</td><td>2</td>3<td></td><td></td><td></td><td></td><td></td></tr>')
      $('.refresh-old-folders').append('<h1 class="title title-red">Господин, для продолжения обновите эту страничку <i class="fa fa-refresh"></i></h1>')
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
      alert('Братишка, обнови страничку!');
      location.reload();
    });
    // stop the form from submitting the normal way and refreshing the page
    event.preventDefault();
  });

});

</script>


</body>
</html>
