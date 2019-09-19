<?php
require 'inc/header.php';

if(isset($_POST["email-verification"]) ){
	require_once 'inc/db.php';
	require_once 'inc/functions.php';

	$email = $_POST['email'];
	$req = $pdo->prepare('SELECT * FROM users WHERE  email= ?');
	$req->execute([$email]);
	$user = $req->fetch();

	if(!$user)
	{
		$_SESSION['flash']['danger'] = "Email does Not Exist";
	}
	else {

	$req = $pdo->prepare("UPDATE users SET confirmation_token= ? ");
	$token = str_random(60);
	$req->execute([$token]);

	$subject = 'Request password';
	$message = 'Afin de valider votre compte merci de cliquer sur ce lien'."\n\n".'http://localhost/qrproject/forgot.php?&token=' . $token;
	$headers = 'From: webmaster@example.com' . "\r\n" .
	    'Reply-To: webmaster@example.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
	mail($email,$subject,$message,$headers);
	$_SESSION['flash']['success'] = "An email was sent to confirm your account";
	}
}


?>



<?php  if(isset($_GET['token'])): ?>
	<?php 
		$token = $_GET['token'];

		require_once 'inc/db.php';

		$req = $pdo->prepare("SELECT * FROM users WHERE confirmation_token = ? ") ;
		$req->execute([$token]);

		$user = $req->fetch();

		if(!$user){
				$_SESSION['flash']['danger'] = "Ce token n'est plus valide";
				header('location: forgot.php');

		}else {
			
			if(isset($_POST['reset-pass']))

  if ( $_POST['password'] != $_POST['confirm-password'])
  {
      $_SESSION['flash']['danger'] = "Erreur";
  }
  else
  {
    $pass = $_POST['password'];
    $conf_pass = $_POST['confirm-password'];
    $user_id = $user->id ;
    $password = password_hash($pass, PASSWORD_BCRYPT);
    $req = $pdo->prepare('UPDATE users SET password = ? , confirmation_token = NULL WHERE id = ?  ');
    $req->execute([$password,$user_id]);
    $_SESSION['flash']['success'] = "Your password was Changed";
    header('location: login.php');

  }
		}




	?>
<div class="container" style="padding : 60px 0;">
	
	<div class="row">
		                <div class="col-md-12">
		                    <form method="POST" >
                              <div class="form-group row">
                                <label for="password" class="col-4 col-form-label">New password</label> 
                                <div class="col-8">
                                  <input id="password" name="password" placeholder="New password" class="form-control here" required="required" type="password" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">Confirme New password</label> 
                                <div class="col-8">
                                  <input id="confirm-password" name="confirm-password" placeholder="confirm-password" class="form-control here" type="password" required>
                                </div>
                              </div>                              
                              <div class="form-group row">
                                <div class="offset-4 col-8">
                                  <button name="reset-pass" type="submit" class="btn btn-primary">Reset Password</button>
                                </div>
                              </div>
                            </form>
		                </div>
		            </div>
		        </div>

<?php else: ?>
<main id="main">

	<section id="about" >
			
	<div class="container">
		<div class="row ">
		
			<form action="" method="POST">
				<?php if(isset($_SESSION["flash"])): ?>
		<?php foreach ($_SESSION["flash"] as $type => $message): ?>
		<div class="alert alert-<?= $type ?>">
			<?= $message ?>
		</div>
		<?php endforeach ?>
		<?php unset($_SESSION["flash"]); ?>
		<?php endif ?>
				<div class="form-group">
					<label for="">Inser your E-mail</label>
					<input type="email" class="form-control" name="email"  required>
				</div>
				<div class="text-center"><button class="btn btn-primary" name="email-verification">Request password</button></div>

			</form>
        
    	</div>
	</div>

	</section>

</main> 


<?php endif; ?>





<?php require 'inc/footer.php'; ?>