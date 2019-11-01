<?php
// require_once("vendor/autoload.php");

// session_start();
// if(isset($_GET['state'])) {
//     $_SESSION['FBRLH_state'] = $_GET['state'];
// }

// /*Step 1: Enter Credentials*/
// $fb = new \Facebook\Facebook([
//     'app_id' => '3079459188747276',
//     'app_secret' => '74ec50347eb89037ca8a697ac5d8e437',
//     'default_graph_version' => 'v5.0',
//     //'default_access_token' => '', // optional
// ]);

// /*Step 2 Create the url*/
// if(empty($access_token)) {
//     echo "<a href='{$fb->getRedirectLoginHelper()->getLoginUrl("http://localhost/MoviePass/fb-Login.php")}'>Login with Facebook </a>";
// }
// /*Step 3 : Get Access Token*/
// $access_token = $fb->getRedirectLoginHelper()->getAccessToken();
// /*Step 4: Get the graph user*/

// try {
//     // Returns a `FacebookFacebookResponse` object
//     $response = $fb->get(
//       '/me',
//       'EAArwwHcLrAwBAFpUHdMZB0VpdDBmexNtjHf3JpY8os1JjqEZCxKLoWn5pb0SryH4Ptvg5f6PQrftT6QFaHscjpsIrquFRkIRFZCcExBjnhKVIgCCf8MgeMh1MnVTOMIoL4yWJsNaZCdPdYUmAG1ejFz6BbAB5mEy64k114wVyyAAZAVEBZA9VjXDcw4ler0BoZD'
//     );
// } catch(FacebookExceptionsFacebookResponseException $e) {
// echo 'Graph returned an error: ' . $e->getMessage();
//     exit;
// } catch(FacebookExceptionsFacebookSDKException $e) {
// echo 'Facebook SDK returned an error: ' . $e->getMessage();
//     exit;
// }
//     $graphNode = $response->getGraphNode();

//     var_dump($graphNode);
//     var_dump($fb);
//     var_dump($access_token);

// if(isset($access_token)) {
//     try {
//     $response = $fb->get('/me',$access_token);
    
//         $fb_user = $response->getGraphUser();

//         echo $fb_user->getName();
//         echo $fb_user->getEmail();
        
//         var_dump($fb_user);
//         var_dump($access_token);
        
//     } catch (\Facebook\Exceptions\FacebookResponseException $e) {
//         echo  'Graph returned an error: ' . $e->getMessage();
//     } catch (\Facebook\Exceptions\FacebookSDKException $e) {
//         // When validation fails or other local issues
//         echo 'Facebook SDK returned an error: ' . $e->getMessage();
//     }
// }

?>

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