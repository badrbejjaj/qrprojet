<?php 

require_once 'inc/functions.php';
unlogged_only();

if(!empty($_POST)) {

	require_once 'inc/db.php' ;

	$errors = array();
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$uname = $_POST['username'];
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$gender = $_POST['gender'];
	$tel = $_POST['tel'];
	$birth = $_POST['birth'];
	$pass_conf = $_POST['password_confirm'];

	if( empty($uname) || !preg_match('/^[a-zA-z0-9_]+$/', $uname) ){

		$errors["username"] = "Votre pseudo n'est pas valide (alphanumérique)";

	} else  {
		$req = $pdo->prepare("SELECT id FROM users WHERE username= ? ");
		$req->execute([$uname]);

		$user = $req->fetch();

		if ($user) {

			$errors['username'] = "Username existe deja";
		}
	}
	if(empty($tel)){
		$errors['tel'] = "Numero telephone n'est pas valide";
	}
	if(empty($gender)){
		$errors['gender'] = "gender telephone n'est pas valide";
	}
	if ( empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL ))
	{
		$errors["email"] = "Votre Email n'est pas valide ";
	} else  {
		$req = $pdo->prepare("SELECT id FROM users WHERE email= ? ");
		$req->execute([$email]);

		$mail = $req->fetch();

		if ($mail) {

			$errors['email'] = "email existe deja";
		}
	}

	if( empty($pass) || $pass != $pass_conf ){

		$errors["password"] = "Your password is not valide ";
	}

	if ( empty($errors) )
	{
	
	$req = $pdo->prepare("INSERT INTO users SET firstname = ? , lastname = ?, username = ? , password= ? , email = ?, phone= ? , gender= ?, birth_date=? , confirmation_token= ? ");

	$password = password_hash($pass, PASSWORD_BCRYPT);
	$token = str_random(60);
	$req->execute([ $firstname, $lastname, $uname , $password , $email , $tel ,$gender,$birth , $token]);
	$user_id = $pdo->LastInsertId();


	$to      =  $email ;
	$subject = 'confirmation de votre compte';
	$message = 'Afin de valider votre compte merci de cliquer sur ce lien'."\n\n".'http://localhost/qrprojet/confirm.php?id='. $user_id .'&token=' . $token;
	$headers = 'From: webmaster@example.com' . "\r\n" .
	    'Reply-To: webmaster@example.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);

	$_SESSION['flash']['success'] = "Regiter Complited an email was sent to confirm your account";
	header('Location: Login.php');

	exit();



	}


}

?>


<?php require 'inc/header.php';  ?>


<section id="about" class="clearfix">
    <div class="container">
    	<div class="row justify-content-center">
    		<div class="col-md-7">
    			<!-- Default form register -->
    			<?php if (!empty($errors)): ?>	
						<div class="alert alert-danger" rol="alert">
							<h4 class="alert-heading">Vous n'avez pas rempli le formulaire correctement</h4>
							<ul>
							<?php foreach ($errors as $error): ?>
								<li> <?= $error ?></li>
							<?php endforeach ?>
							</ul>
						</div>
    			<?php endif; ?>
				<form class="text-center border border-light p-5" method="POST" action="">
					
				    <p class="h4 mb-4">Sign up</p>
						<?php if(isset($_SESSION["flash"])): ?>
							<?php foreach ($_SESSION["flash"] as $type => $message): ?>
								<div class="alert alert-<?= $type ?>">
									<?= $message ?>
								</div>
							<?php endforeach ?>
							<?php unset($_SESSION["flash"]); ?>
						<?php endif ?>

				    <div class="form-row mb-4">	
				        <div class="col">
				            <!-- First name -->
				            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First name" value="<?php if(isset($_POST['register'])){ echo $_POST['firstname']; } ?>">
				        </div>
				        <div class="col">
				            <!-- Last name -->
				            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last name" value="<?php if(isset($_POST['register'])){ echo $_POST['lastname']; } ?>">
				        </div>
				    </div>

					<!-- Usename -->
				    <input type="text" id="username" name="username" class="form-control mb-4" placeholder="Username" value="<?php if(isset($_POST['register'])){ echo $_POST['username']; } ?>">

				    <!-- E-mail -->
				    <input type="email" id="email" class="form-control mb-4" name="email" placeholder="E-mail"
				    value="<?php if(isset($_POST['register'])){ echo $_POST['email']; } ?>">
					
					<!-- Gender -->
					<div class="form-row mb-4">

					<!-- Option 1 - Female -->
					<div class="custom-control custom-radio custom-control-inline justify-content-left">
					  <input type="radio" class="custom-control-input" id="female" value="f" name="gender" <?php if(isset($_POST['register']) && $_POST['gender'] == "f" ) { echo 'checked'; } ?>>
					  <label class="custom-control-label" for="female" >Female</label>
					</div>
					
					<!-- Option 1 - Male -->
					<div class="custom-control custom-radio custom-control-inline">
					  <input type="radio" class="custom-control-input" id="male" value="m" name="gender" <?php if(isset($_POST['register']) && $_POST['gender'] == "m" ) { echo 'checked'; } ?>>
					  <label class="custom-control-label" for="male" >Male</label>
					</div>

					</div>

					<!-- Phone number -->
					<input type="text" id="defaultRegisterPhonePassword" name="tel" class="form-control mb-4" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock" pattern="[0-9]{10}" value="<?php if(isset($_POST['register'])){ echo $_POST['tel']; } ?>">

					<!-- Birth date -->
				    <input type="text" id="user1" placeholder="yyyy-mm-dd" name="birth" class="form-control datepicker mb-4" value="<?php if(isset($_POST['register'])){ echo $_POST['birth']; } ?>">

					<!-- Password -->
				    <input type="password" name="password" id="password" class="form-control mb-3" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
				    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirmation Password" >
				    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
				        At least 8 characters and 1 digit
				    </small>
				    <!-- Sign up button -->
				    <button class="btn btn-info my-4 btn-block" name="register" type="submit">Sign in</button>


				    <hr>

				    <!-- Terms of service -->
				    <p>By clicking
				        <em>Sign up</em> you agree to our
				        <a href="" target="_blank">terms of service</a>

				</form>
				<!-- Default form register -->
    		</div>
    	</div>
	</div>	

	

  </section>




<?php require 'inc/footer.php' ?>