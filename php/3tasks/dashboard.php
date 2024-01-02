<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("CET");
// header("Cache-Control: no-cache, must-revalidate");
ini_set('session.gc_maxlifetime', 20);
// $timeout = 30;
// session_set_cookie_params(time() + $timeout);
session_start();

// if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
//     header('WWW-Authenticate: Basic realm="Restricted Area"');
// 	header('HTTP/1.0 401 Unauthorized');
// 	echo 'Authentication required';
// 	exit;
// }

// $user = 'test1';
// $pass = 'test1';
// if (($_SERVER['PHP_AUTH_USER'] == $user) && ($_SERVER['PHP_AUTH_PW'] == $pass)) {    
// 	require_once('chart.php');      
// } else {
//     header("WWW-Authenticate: Basic realm=\"Private Area\"");
//     header("HTTP/1.0 401 Unauthorized");
//     print "Credentials is not valid!\n";
//     exit;
// }




$authorized = false;

# checkup login and password
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
    $user = 'test';
    $pass = 'test';
    if (($user == $_SERVER['PHP_AUTH_USER']) && ($pass == ($_SERVER['PHP_AUTH_PW'])) && isset($_SESSION['auth']))
    {
    	$authorized = true;
    	require_once('chart.php');
    }
}

# login
if (isset($_GET["login"]) && !$authorized ||
# relogin
    isset($_GET["login"]) && isset($_GET["logout"]) && !isset($_SESSION['reauth']))
{
    header('WWW-Authenticate: Basic Realm="Login please"');
    header('HTTP/1.0 401 Unauthorized');
    $_SESSION['auth'] = true;
    $_SESSION['reauth'] = true;
    echo "Login now or forever hold your clicks...";
    exit;
}
$_SESSION['reauth'] = null;



// $now = time();
// if (isset($_SESSION['first_time']) && $now > $_SESSION['first_time']) {
//     session_unset();
//     session_destroy();
//     setcookie(session_name(), '', -1, '/');
//     unset($_SERVER['PHP_AUTH_USER']);
// 	unset($_SERVER['PHP_AUTH_PW']);
// 	if ( $realm == '' ) $realm = mt_rand( 1, 1000000000 );
// 	header( 'WWW-Authenticate: Basic realm='.$realm );
// 	header("Location: /");
// }
// $_SESSION['first_time'] = $now + 30;


if(isset($_POST['logout']) && $_POST['logout'] == "true" && isset($_SESSION['auth'])) {
	// $_SESSION = array();
    // unset($_COOKIE[session_name()]);
    // session_start();
    // session_destroy();
    // setcookie(session_name(), false, -1,'/');
    // unset($_SERVER['PHP_AUTH_USER']);
    // if ( $realm == '' ) $realm = mt_rand( 1, 1000000000 );
	// header('WWW-Authenticate: Basic realm='.$realm);
	// session_destroy();
  	// session_unset($_SESSION[session_id()]);
  	// session_unset($_SESSION['logged']);

  	// header("Location: /", TRUE, 301); 
  	// header('HTTP/1.1 401 Unauthorized');
  	$_SESSION = array();
    unset($_COOKIE[session_name()]);
    session_destroy();
    echo "logging out...";
    header("Location: /", TRUE, 301);
 	
}

 // $cookieParams = session_get_cookie_params();
 // $lifetime = $cookieParams['lifetime'];
 
 // if ($lifetime > 0) {

 // 	if (isset($_SESSION['last_activity'])) { 
 	   	
 // 	   	$last_activity = $_SESSION['last_activity'];
 // 	   	if($current_time > $last_activity) {
 // 	   		echo "//////////////////";
 // 	   		$_SESSION['last_activity'] = null;
 // 	   	}

 // 	   	if (($current_time - $last_activity) > $last_activity+60) {
 // 	   		echo "***************";
 // 	   		session_unset();
 // 	       	session_destroy();
 // 	       	setcookie(session_name(), "", time() - 60);
 // 	       	$_SESSION['last_activity'] = null;
 // 			$_SERVER['PHP_AUTH_PW'] = null;
 // 	       	$_SERVER['PHP_AUTH_USER'] = null;
 // 	      	header("Location: ". $_SERVER['HTTP_REFERER']);
 // 	   	}
 // 	} else {
 // 		$_SESSION['last_activity'] = time()+10;
 // 	}
 	
 // } else {
 // 	$_SERVER['PHP_AUTH_PW'] = null;
 // 	$_SERVER['PHP_AUTH_USER'] = null;
 // 	echo "asdsd";
// 	// $timeout = 60; 
// 	// setcookie('AuthCookie', session_id(), time() + $timeout);
 // 	// $timeout = 60;
// 	// session_set_cookie_params($timeout);
 // }
