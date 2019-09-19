<?php 
require 'inc/functions.php'; 
logged_only();
require 'inc/header.php' ;




if(isset($_POST['reset-pass']))
{
  if ( $_POST['password'] != $_POST['confirm-password'])
  {
      $_SESSION['flash']['danger'] = "Erreur";
  }
  else
  {
    $pass = $_POST['password'];
    $conf_pass = $_POST['confirm-password'];
    require_once 'inc/db.php';
    $user_id = $_SESSION['auth']->id ;
    $password = password_hash($pass, PASSWORD_BCRYPT);
    $req = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?  ');
    $req->execute([$password,$user_id]);
    $_SESSION['flash']['success'] = "Password Reseted";
    header('location: logout.php');

  }
}

if (isset($_POST['update-profil']))

{
  
  require_once 'inc/db.php';
  $user_id = $_SESSION['auth']->id ;
  $firstname  = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $birth = $_POST['birth'];

  $req = $pdo->prepare('UPDATE users SET firstname= ?, lastname= ?, username= ? , email= ?,gender= ?,phone= ?, birth_date= ? WHERE id= ?  ');
  $req->execute([$firstname,$lastname,$username,$email,$gender,$phone,$birth,$user_id]);

  $_SESSION['flash']['success'] = "Informations updated";
  header('location: logout.php');

  
}

debug($_SESSION['auth']);

?>
<section id="intro" class="pt-100 pb-100">
	<div class="container">
		<div class="intro-info">
        <h2>Hello <?= $_SESSION['auth']->username ?></h2>
    </div>
	</div>


</section>
<div class="container" style="padding: 60px 0;">
  <?php if(isset($_SESSION["flash"])): ?>
    <?php foreach ($_SESSION["flash"] as $type => $message): ?>
    <div class="alert alert-<?= $type ?>">
      <?= $message ?>
    </div>
    <?php endforeach ?>
    <?php unset($_SESSION["flash"]); ?>
    <?php endif ?>
	<div class="row">
		<div class="col-md-3 ">
		     <div class="list-group nav nav-tabs">
              <a href="#profile" data-toggle="tab" class="list-group-item list-group-item-action active show">Profile</a>
              <a href="#edit" data-toggle="tab" class="list-group-item list-group-item-action">Edit</a>
              <a href="#reset" data-toggle="tab" class="list-group-item list-group-item-action">Reset Password</a>
              
             </div> 
		</div>
		 <div class="tab-content" >
		 	<div class="tab-pane" id="reset">
		<div class="col-md-12">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Reset Passsword</h4>
		                    <hr>
		                </div>
		            </div>
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
		    </div>
		</div>
	</div>
         
  <div class="tab-pane  active show" id="profile">
		<div class="col-md-12">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Infos</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <form>
                              <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">Your ID</label> 
                                <div class="col-8">
                                  <input placeholder="<?= $_SESSION['auth']->id ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">First Name</label> 
                                <div class="col-8">
                                  <input placeholder="<?= $_SESSION['auth']->firstname ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">Last Name</label> 
                                <div class="col-8">
                                  <input placeholder="<?= $_SESSION['auth']->lastname ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">User Name</label> 
                                <div class="col-8">
                                  <input placeholder="<?= $_SESSION['auth']->username ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">E-mail</label> 
                                <div class="col-8">
                                  <input placeholder="<?= $_SESSION['auth']->email ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">Phone</label> 
                                <div class="col-8">
                                  <input placeholder="<?= $_SESSION['auth']->phone ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">Gender</label> 
                                <div class="col-8">
                                  <input placeholder="<?php 
                                  if($_SESSION['auth']->gender == "m") { echo "Men";} else { echo "Women";}
                                  ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">Date of birth</label> 
                                <div class="col-8">
                                  <input placeholder="<?= $_SESSION['auth']->birth_date ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>
                              
                             <!--  <div class="form-group row">
                                <label for="select" class="col-4 col-form-label">Display Name public as</label> 
                                <div class="col-8">
                                  <select id="select" name="select" class="custom-select">
                                    <option value="admin">Admin</option>
                                  </select>
                                </div>
                              </div> -->
                                                          </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
	</div>
	<div class="tab-pane" id="edit">	
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Edit Info</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="POST" >
                              <div class="form-group row">
                                <label for="" class="col-4 col-form-label">Your ID</label> 
                                <div class="col-8">
                                  <input placeholder="<?= $_SESSION['auth']->id ?>" class="form-control here" type="text" disabled>
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="lastname" class="col-4 col-form-label">First Name</label> 
                                <div class="col-8">
                                  <input value="<?= $_SESSION['auth']->firstname ?>" name="firstname" class="form-control here" type="text" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="lastname" class="col-4 col-form-label">Last Name</label> 
                                <div class="col-8">
                                  <input value="<?= $_SESSION['auth']->lastname ?>" name="lastname" class="form-control here" type="text" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">User Name</label> 
                                <div class="col-8">
                                  <input value="<?= $_SESSION['auth']->username ?>" name="username" class="form-control here" type="text" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">E-mail</label> 
                                <div class="col-8">
                                  <input value="<?= $_SESSION['auth']->email ?>" name="email"  class="form-control here" type="text" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="phone" class="col-4 col-form-label">Phone</label> 
                                <div class="col-8">
                                  <input value="<?= $_SESSION['auth']->phone ?>" name="phone" class="form-control here" type="text" >
                                </div>
                              </div>
                              <!-- Gender -->
                              <div class="form-row mb-4">
                                <label for="gender" class="col-4 col-form-label">Gender</label>             
                              <!-- Option 1 - Female -->
                              <div class="custom-control custom-radio custom-control-inline justify-content-left">
                                <input type="radio" class="custom-control-input" id="female" value="f" name="gender" <?php if( $_SESSION['auth']->gender == "f" ) { echo 'checked'; } ?>>
                                <label class="custom-control-label" for="female" >Female</label>
                              </div>
                              
                              <!-- Option 1 - Male -->
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="male" value="m" name="gender" <?php if( $_SESSION['auth']->gender == "m" ) { echo 'checked'; } ?>>
                                <label class="custom-control-label" for="male" >Male</label>
                              </div>

                              </div>

                              <div class="form-group row">
                                <label for="birth" class="col-4 col-form-label">Date of birth</label> 
                                <div class="col-8">
                                  <input value="<?= $_SESSION['auth']->birth_date ?>" name="birth" class="form-control here datepicker" type="text" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="offset-4 col-8">
                                  <button name="update-profil" type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </div>

                            </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		
	</div>








</div>
	</div>
</div>

<?php require 'inc/footer.php' ?>