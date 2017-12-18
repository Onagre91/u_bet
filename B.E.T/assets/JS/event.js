var webroot = $('#webroot').html();
$("#event").on("click", function(event) {
	event.preventDefault();
	var formData = new FormData($('form')[0]);
	formData.set('controller', 'admin');
	formData.set('action', 'create_event');
	$.ajax({
		url: 'create_event/admin',
		method: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		dataType: 'json'
	})
	.done(function(data) {
		alert("Event crée avec Succès !");
		console.log(data);
	})
	.fail(function(data){
		console.log(data);
		data = jQuery.parseJSON(data.responseText);
		$('.error').html('');	
		$('.error').append($("<div class='alert alert-danger text-center'></div>"));
		$.each(data, function (name , value){
			$('.alert').append("<li>"+value+"</li>");
		});
	});
});