<?php

            if isset(($_GET['code'])){
                $code = ($_GET['code']);
                $url = 'https://api.instagram.com/oauth/access_token';
                $access_token_settings = array('client_id' => clientID,
                    'client_secret' => clientSecret,
                    'redirect_uri' => redirectURI,
                    'code' => $code);
            }
//        configuration of php server
            set_time_limit(0);
            ini_set('default_socket_timeout', 300);
            session_start();
            
//            making constants using define
            
            define('clientID', 'b5eb5a06065644139b3669194284658e');
            define('client_Secret', 'a10f99b5e29946f7822968b0101d21c0');
            define('redirectURI', 'http://localhost/apiapp/index.php');
            define('ImageDirectory', 'pics/');
            
            
            
            
        ?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        
        <title></title>
        
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
        //<?php
////        configuration of php server
//            set_time_limit(0);
//            ini_set('default_socket_timeout', 300);
//            session_start();
//            
////            making constants using define
//            
//            define('clientID', 'b5eb5a06065644139b3669194284658e');
//            define('client_Secret', 'a10f99b5e29946f7822968b0101d21c0');
//            define('redirectURI', 'http://localhost/apiapp/index.php');
//            define('ImageDirectory', 'pics/');
//            
//        ?>
        <!--creating a login for people to go and give approval for our app to access there instagram 
            after getting approval we are nwo going to have the information so that we can play with it-->
        <a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI ?>&response_type=code">LOGIN</a>
        <script src="js/main.js"></script>
    </body>
</html>
