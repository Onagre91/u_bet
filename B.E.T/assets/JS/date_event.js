var id_event = $('#id_event').html();
$(window).bind("load", function(event) {
	event.preventDefault();
	$.ajax({
		url: 'date_check/admin',
		dataType: 'json'
	})
	.done(function(data) {
		$('.success').html('');	
		$('.success').append($("<div class='alert alert-success text-center'>"+data+"</div>"));
	})
	.fail(function(data){
		console.log(data.responseText);
	})
});

$("#delete").on("click", function(event) {
	event.preventDefault();
	console.log("detecte");
	$.ajax({
		url: 'delete_event/admin',
		data : {
			"id" : id_event ,
		} 
	})
	.done(function(data){
		alert("L'événement a bien été supprimé !");
	})
	.fail(function(data){
		console.log(data);
	})
});