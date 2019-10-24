<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>

<?php
require_once("vendor/autoload.php");

session_start();
if(isset($_GET['state'])) {
    $_SESSION['FBRLH_state'] = $_GET['state'];
}
/*Step 1: Enter Credentials*/
$fb = new \Facebook\Facebook([
    'app_id' => '3079459188747276',
    'app_secret' => '74ec50347eb89037ca8a697ac5d8e437',
    'default_graph_version' => 'v4.0',
    //'default_access_token' => '{access-token}', // optional
]);
/*Step 2 Create the url*/
if(empty($access_token)) {
    echo "<a href='{$fb->getRedirectLoginHelper()->getLoginUrl("http://localhost/MoviePass/fb-Login.php")}'>Login with Facebook </a>";
}
/*Step 3 : Get Access Token*/
$access_token = $fb->getRedirectLoginHelper()->getAccessToken();
/*Step 4: Get the graph user*/
if(isset($access_token)) {
    try {
        $response = $fb->get('/me',$access_token);
        $fb_user = $response->getGraphUser();


        echo  $fb_user->getName();
          var_dump($fb_user);
        
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        echo  'Graph returned an error: ' . $e->getMessage();
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
    }
}
?>