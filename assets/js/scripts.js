// Avoid `console` errors in browsers that lack a console.
(function () {
  var method;
  var noop = function () {};
  var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd', 'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'];
  var length = methods.length;
  var console = (window.console = window.console || {});

  while (length--) {
    method = methods[length];

    // Only stub undefined methods.
    if (!console[method]) {
        console[method] = noop;
    }
}
}());

// Place any jQuery/helper plugins in here.

// AJAX query to check mail
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
