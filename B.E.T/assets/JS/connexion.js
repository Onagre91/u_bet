var webroot = $('#webroot').html();
$("#connexion").on("click", function(event) {
	event.preventDefault();
	var formData = new FormData($('form')[1]);
	formData.set('controller', 'user');
	formData.set('action', 'connexion');
	$.ajax({
		url: 'user/connexion',
		method: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		dataType: 'json'
	})
	.done(function(data) {
		alert("Vous êtes connecté !");
		setTimeout(function(){
			document.location = webroot + data + "/_home";
		}, 200)
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
