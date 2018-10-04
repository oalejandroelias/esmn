<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="google-signin-client_id" content="402569257873-i0ndfm0g7mtght08bvk2d7d2a1iopr8v.apps.googleusercontent.com">
	<title>Welcome to CodeIgniter</title>

</head>
<body>
		<div class="g-signin2" data-onsuccess="onSignIn" data-width="257" data-height="45" data-longtitle="true" data-theme="dark"></div>


	<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript">
function onSignIn(googleUser) {
var profile = googleUser.getBasicProfile();
console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
console.log('Name: ' + profile.getName());
console.log('Image URL: ' + profile.getImageUrl());
console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}

</script>
</body>
</html>
