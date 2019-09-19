<?php require 'inc/header.php' ?>
<?php require 'inc/functions.php' ?>

<?php 
 
 if(!empty($_POST) && !empty($_POST["username"]) && !empty($_POST["password"]) ){
 	require_once 'inc/db.php';
 	require_once 'inc/functions.php'; 	

 	$username = $_POST["username"];
 	$password = $_POST["password"];

 	$req = $pdo->prepare("SELECT * FROM users WHERE ( username= :username OR email= :username ) AND confirmed_at IS NOT NULL ");
 	$req->execute(['username' => $username ]);
 	$user = $req->fetch();

if($user)

 	{
 		if( password_verify($password , $user->password )){
 	
 	 		$_SESSION['auth'] = $user;
 	 		$_SESSION['flash']['success'] = "Login success";
 	 		header('location: account.php') ;
 	 	}
 	 	else{
 	
 	 		$_SESSION['flash']['danger'] = "Username ou Mot de passe Incorrecte ";
 	 	}
 	}
 	else
 		{$_SESSION['flash']['danger'] = "User does not exist";}
 	

 }


?>

 <main id="main">

	<section id="about" >
			
	<div class="container">
		<div class="row justify-content-center">
        <div class="col-md-6">
        	<!-- Default form login -->
<form class="text-center border border-light p-5" action="" method="POST">

    <p class="h4 mb-4">Login</p>
		<?php if(isset($_SESSION["flash"])): ?>
		<?php foreach ($_SESSION["flash"] as $type => $message): ?>
		<div class="alert alert-<?= $type ?>" rol="alert">
			<?= $message ?>
		</div>
		<?php endforeach ?>
		<?php unset($_SESSION["flash"]); ?>
		<?php endif ?>
    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" name="username" placeholder="Username ou E-mail">

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" name="password" placeholder="Password">

    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
            </div>
        </div>
        <div>
            <!-- Forgot password -->
            <a href="forgot.php">Forgot password?</a>
        </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>

    <!-- Register -->
    <p>Not a member?
        <a href="register.php">Register</a>
    </p>

    

</form>
<!-- Default form login -->
        </div>
            	</div>
	</div>

	</section>

</main>

<?php require 'inc/footer.php' ?>