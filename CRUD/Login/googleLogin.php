<?php  
require("../../Config/googleConfig.php");  
  
$params = [  
    'client_id'     => GOOGLE_CLIENT_ID,  
    'redirect_uri'  => GOOGLE_REDIRECT_URI,  
    'response_type' => 'code',  
    'scope'         => 'email profile',  
    'access_type'   => 'online',  
    'prompt'        => 'select_account'  
];  
  
header('Location: https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params));  
exit();