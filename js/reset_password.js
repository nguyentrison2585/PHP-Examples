$(document).ready(function() {
  $('input[name="password"], input[name="password_confirm"]').on('keyup', function () {
    if ($('input[name="password"]').val() == $('input[name="password_confirm"]').val()) {
      $('#password-confirm-message').html('Matching').css('color', '#63c76a');
    }
    else {
      $('#password-confirm-message').html('Not Matching').css('color', '#dc3545');
    }
  });
})
