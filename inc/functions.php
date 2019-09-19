<?php 

function debug($var) {

	echo "<pre>" . print_r($var, true ) . "</pre>" ;

} 

function str_random($length){

	$alpha ="0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

	return substr(str_shuffle(str_repeat($alpha, $length)),0,$length);
}

function logged_only() {
	if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
	if(!isset($_SESSION['auth'])){
		
		$_SESSION['flash']['danger'] = "You must have an account if you already have one please login";
		header('location: login.php');
		exit();

	}
}
function unlogged_only() {
	if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
	if(isset($_SESSION['auth'])){
		
		$_SESSION['flash']['success'] = "you already logged";
		header('location: account.php');
		exit();

	}
}