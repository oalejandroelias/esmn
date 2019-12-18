var socket = io.connect( 'https://192.168.0.114:8080', {secure: true} );

$( "#messageForm" ).submit( function() {
	var nameVal = $( "#nameInput" ).val();
	var msg = $( "#messageInput" ).val();

	socket.emit( 'message', { name: nameVal, message: msg } );

	// Ajax call for saving datas
	$.ajax({
		url: ruta+"Test/send_message",
		type: "POST",
		data: { name: nameVal, message: msg },
		success: function(data) {
			console.log(data);
		}
	});

	return false;
});

socket.on( 'message', function( data ) {
	var actualContent = $( "#messages" ).html();
	var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
	var content = newMsgContent + actualContent;

	$( "#messages" ).html( content );
});
