<?php

            if (isset($_GET['code'])){
                $code = ($_GET['code']);
                $url = 'https://api.instagram.com/oauth/access_token';
                $access_token_settings = array('client_id' => clientID,
                    'client_secret' => clientSecret,
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => redirectURI,
                    'code' => $code);
//                cURL is what we use in php, its a library calls to other apis
                $curl = curl_init($url); //setting a cURL session and we put in $url because thats where we are getting the data from
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings); //setting the POSTFIELDS to the array setup that we created
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //setting it eaul to 1 because we are getting strings back
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //but in live work-production we want to set this to true
                
            }
            
            $result = curl_exec($curl);
            curl_close();
            
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
<!--        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale-1">-->
        
        <title></title>
        
<!--        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">-->
    </head>
    <body>
        <?php
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
<!--        <script src="js/main.js"></script>-->
    </body>
</html>
