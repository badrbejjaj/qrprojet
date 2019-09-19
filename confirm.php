<?php 

$user_id = $_GET['id'] ;

$user_token = $_GET ['token'];

require 'inc/db.php';

$req = $pdo->prepare("SELECT * FROM users WHERE id =? ");

$req->execute([$user_id]);
$user = $req->fetch();

session_start();

if($user && $user->confirmation_token == $user_token )
{
	$pdo->prepare('UPDATE users SET confirmation_token = NULL , confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
	$_SESSION['auth'] = $user ;
	$_SESSION['flash']['success'] = "Your account was confirmed";
	header('location: account.php');
}
else {

	$_SESSION['flash']['danger'] = "Ce token n'est plus valide";
	header('location: login.php');
}