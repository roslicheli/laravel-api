//
// Global variable
var thisDomain = window.location.hostname;
var thisApi = thisDomain + '/api';
var data_token = '';

$( document ).ready(function() {
  // Handler for .ready() called.
  console.log('ready');
  $('#apiButtonLogin').on('click', function () {
  	console.log(thisApi);
  	var param = {};
  	param.email = $('#email').val();
  	param.password = $('#password').val();

  	var obJSON = JSON.stringify(param);
  	console.log(obJSON);

	  	$.ajax({
	  	   type: 'POST',
	  	   url: '/api/auth/login',
	  	   data: 'email=' + param.email + '&password=' + param.password,
	  	   error: function() {
	  	   		$('#info').html('<p>An error has occurred</p>');
	  	   },
	  	   success: function(data) {
	  	   		console.log(data);
	  	   		var data_status = data.status;
	  	   		if (data_status == 'success') {
	  	   			data_token = data.token;
	  	   		}	  	   		
	  	   		console.log(data_token);
	  	   },
	  	});

  });
});