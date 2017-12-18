var elem = document.querySelector('input[type="range"]');
var webroot = $('#webroot').html();

var rangeValue = function(){
  var newValue = elem.value;
  var target = document.querySelector('.value');
  target.innerHTML = newValue;
}

elem.addEventListener("input", rangeValue);
var event_id = window.location.href.substr(location.href.lastIndexOf('/') + 1);

$("#betting").on("click", function(event) {
	event.preventDefault();
	var formData = new FormData($('form')[0]);
	formData.set('controller', 'user');
	formData.set('action', 'bet_make');
	$.ajax({
		url: webroot + 'user/bet_make/' + event_id,
		method: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		dataType: 'json'
	})
	.done(function(data) {
		alert("Pari réussi");
		console.log(data);
	})
	.fail(function(data){
		console.log(data.responseText);
	});
});
