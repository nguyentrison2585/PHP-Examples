$(document).ready(function() {
  $('input[name="password"], input[name="password_confirm"]').on('keyup', function () {
    if ($('input[name="password"]').val() == $('input[name="password_confirm"]').val()) {
      $('#password-confirm-message').html('Matching').css('color', '#63c76a');
    }
    else {
      $('#password-confirm-message').html('Not Matching').css('color', '#dc3545');
    }
  });

  //Check a valid email
  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }

  $('input[name="password"]').keyup(function () {
    var password_strength = checkStrength($('input[name="password"]').val());
    $('#strengthMessage').html(password_strength);
  })

  //Check length of the password
  function checkStrength(password) {
    var strength = 0
    if (password.length < 6) {
      $('#strengthMessage').removeClass()
      $('#strengthMessage').addClass('Short')
      return 'Too short'
    }
    if (password.length >= 6) strength += 1
        // If password contains both lower and uppercase characters, increase strength value.
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
      // If it has numbers and characters, increase strength value.
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
      // If it has one special character, increase strength value.
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
      // If it has two special characters, increase strength value.
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
      // Calculated strength value, we can return messages
      // If value is less than 2
    if (strength < 2) {
      $('#strengthMessage').removeClass()
      $('#strengthMessage').addClass('weak')
      return 'Weak'
    } else if (strength == 2) {
      $('#strengthMessage').removeClass()
      $('#strengthMessage').addClass('good')
      return 'Good'
    } else {
      $('#strengthMessage').removeClass()
      $('#strengthMessage').addClass('strong')
      return 'Strong'
    }
  }
})
