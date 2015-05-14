<?php
            //        configuration of php server
            set_time_limit(0);
            ini_set('default_socket_timeout', 300);
            session_start();
            
//            making constants using define
            
            define('clientID', 'b5eb5a06065644139b3669194284658e');
            define('clientSecret', 'a10f99b5e29946f7822968b0101d21c0');
            define('redirectURI', 'http://localhost/apiapp/index.php');
            define('ImageDirectory', 'pics/');
            
            //Function that is going to connect to instagram
            function connectToInstagram($url){
                $ch = curl_init();
                
                curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false, 
                CURLOPT_SSL_VERIFYHOST => 2,
                ));
                $result = curl_exec($ch);
                curl_close($ch);
                return $result;
                        
            }
            
            //Function to get userID cause userName doesnt allow us to get pictures
            function getUserID($userName){
                $url = 'http://api.instagram.com/v1/users/search?q=' . $userName . '&client_id='. clientID;
                $instagramInfo = connectToInstagram($url);
                $results = json_decode($instagramInfo, true);
                
                return $results['data']['0']['id'];
            }
           
            //Function to print images onto screen
            function printImages($userID){
	$url = 'http://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id='.clientID.'&count=5';
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);
	//Parse through the information one by one
	foreach ($results['data'] as $items) {
		$image_url = $items['images']['low_resolution']['url'];//going to go through all of my results and give myself back the URL of those pictures 
		//because we want to have it in the PHP Server.
		echo '<img src=" '.$image_url.'"/>br/>';
	}
}
            
            
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
                
            
            
            $result = curl_exec($curl);
            curl_close($curl);
            $results = json_decode($result, true);
            
            $userName = $results['user']['username'];
            
            $userID = getUserID($userName);
            
            printImages($userID);
            }
            else{
            
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
    
        <!--creating a login for people to go and give approval for our app to access there instagram 
            after getting approval we are nwo going to have the information so that we can play with it-->
        <a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI ?>&response_type=code">LOGIN</a>
<!--        <script src="js/main.js"></script>-->
    </body>
</html>
<?php
            }
            ?>
