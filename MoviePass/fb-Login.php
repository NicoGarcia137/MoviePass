<?php 

require_once __DIR__ . '/vendor/autoload.php';

// session_start();

// Creacion de la app
$fb = new Facebook\Facebook([
      'app_id' => '3079459188747276',
      'app_secret' => '74ec50347eb89037ca8a697ac5d8e437',
      'default_graph_version' => 'v5.0',
      //'default_access_token' => '', // optional
]);

$helper = $fb->getRedirectLoginHelper();

// URL de redireccion al login de fb
//$loginUrl = $helper->getLoginUrl("http://localhost/MoviePass/fb-Login.php");
$loginUrl = $helper->getLoginUrl("http://localhost/MoviePass/Login/FacebookLogin");

// La URL generada tiene un parametro 'state' que lo guarda getRedirectLoginHelper() en la session
if(isset($_GET["state"])){
    
    $_SESSION['FBRLH_state'] = $_GET['state'];
}

// URL a la que el usuario accede para loguear desde facebook
echo '<a href="' . $loginUrl . '"> Log in with Facebook ! </a>';


// Traigo el token del helper
$accessToken = $helper->getAccessToken();

$user = null;
//Si tengo el token, accedo al usuario y ejecuto lo que quiera
if($accessToken != null){
    try{
        $response = $fb->get('/me?fields=id,email,first_name,last_name', $accessToken);
        $user = $response->getGraphUser();
        
        // $_SESSION['user-facebook'] = $user;


    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e){
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}



?>