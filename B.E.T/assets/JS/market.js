var webroot = $('#webroot').html();
$("#market").on("click", function(event) {
	event.preventDefault();
	var formData = new FormData($('form')[0]);
	formData.set('controller', 'user');
	formData.set('action', 'achat');
	$.ajax({
		url: webroot + 'user/achat',
		method: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		dataType: 'json'
	})
	.done(function(data) {
		$('.success').html('');
		$('.success').append($("<div class='alert alert-success text-center'>"+data.token+"</div>"));
	})
	.fail(function(data){
		data = jQuery.parseJSON(data.responseText);
		$('.error').html('');	
		$('.error').append($("<div class='alert alert-danger text-center'></div>"));
		$.each(data, function (name , value){
			$('.alert').append("<li>"+value+"</li>");
		});
	});
});
