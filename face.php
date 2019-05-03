<?php
session_start();
//unset($_SESSION['face_access_token']);
require_once 'lib/Facebook/autoload.php';
//include_once 'conexao.php';
$fb = new \Facebook\Facebook([
    'app_id' => '2253437764742464',
    'app_secret' => '48867e26bbefad152bead84cf3b184fc',
    'default_graph_version' => 'v2.9',
    //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();
//var_dump($helper);
$permissions = ['email']; // Optional permissions

try {
    if (isset($_SESSION['face_access_token'])) {
        $accessToken = $_SESSION['face_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    $url_login = 'http://localhost/Voyage/face.php';
    $loginUrl = $helper->getLoginUrl($url_login, $permissions);
} else {
    $url_login = 'http://localhost/Voyage/face.php';
    $loginUrl = $helper->getLoginUrl($url_login, $permissions);
    //Usuário ja autenticado
    if (isset($_SESSION['face_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['face_access_token']);
    } //Usuário não está autenticado
    else {
        $_SESSION['face_access_token'] = (string)$accessToken;
        $oAuth2Client = $fb->getOAuth2Client();
        $_SESSION['face_access_token'] = (string)$oAuth2Client->getLongLivedAccessToken($_SESSION['face_access_token']);
        $fb->setDefaultAccessToken($_SESSION['face_access_token']);
    }

    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/me?fields=name, email');
        $user = $response->getGraphUser();
        $_SESSION['nomMembre'] = $user['name'];
        /*echo '<pre>';
        var_dump($user);
        echo '</pre>';*/
        /*$result_usuario = "SELECT id, nome, email FROM usuarios WHERE email='".$user['email']."' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if($resultado_usuario){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			$_SESSION['id'] = $row_usuario['id'];
			$_SESSION['nomMembre'] = $row_usuario['nome'];
			$_SESSION['email'] = $row_usuario['email'];
			header("Location: index.php");			
		} else {
            // inserer le nom et le courriel dans la base de données
        }*/
        header("Location: index.php");
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}
