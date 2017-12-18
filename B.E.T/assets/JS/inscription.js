var webroot = $('#webroot').html();
$("#inscription").on("click", function(event) {
	event.preventDefault();
	var formData = new FormData($('form')[0]);
	formData.set('controller', 'user');
	formData.set('action', 'inscription');
	$.ajax({
		url: 'user/inscription',
		method: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		dataType: 'json'
	})
	.done(function(data) {
		alert("Felicitations, vous êtes inscrit !");
	})
	.fail(function(data) {
		data = jQuery.parseJSON(data.responseText);
		$('.error').html('');	
		$('.error').append($("<div class='alert alert-danger text-center'></div>"));
		$.each(data, function (name , value){
			$('.alert').append("<li>"+value+"</li>");
		});
	});
});
