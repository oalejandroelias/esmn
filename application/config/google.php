<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
|
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '402569257873-i0ndfm0g7mtght08bvk2d7d2a1iopr8v.apps.googleusercontent.com';
$config['google']['client_secret']    = 'eKa4WuKwLc32Ve8YrUoTiz3r';
$config['google']['redirect_uri']     = base_url('login/oauth2callback');
// $config['google']['redirect_uri']     = 'http://localhost/esmn/inicio/';
$config['google']['application_name'] = 'Cecilia - ESMN';
$config['google']['api_key']          = 'AIzaSyD5K6sFXhqGbhK8gIJxAjtDk7b2i5PBIAI';
$config['google']['scopes']['userinfo.mail'] = 'https://www.googleapis.com/auth/userinfo.email';
