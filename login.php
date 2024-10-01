<?php
session_start();
include('sys/connect.php'); 
function clean_input($string)
{
	 $patterns[0] = "/'/";
	 $patterns[1] = "/\"/";
	// $patterns[2] = "/:/";
	 $string = preg_replace($patterns,'',$string);
     //$string = ereg_replace("[^A-Za-z0-9]", "", $string);  
	 $string = trim($string);
	 if(get_magic_quotes_gpc()) $string = stripslashes($string);
	 return preg_replace("/[<>]/", '_', $string);
}
require("include/class.FormValidation.php");



if(isset($_POST['login']) && $_POST['login'] == 'login')
{
	$error_found = FALSE;  
           //validator		
			$Form->ValidField($username,'empty',"*  Please supply your Username");	
			$Form->ValidField($password,'empty',"*  Please supply your Password");
			if (!$Form->retval) {
				$error_found = TRUE;
				$message = $Form->ErrorString;
			}
			  
			  
			  if (!$error_found) 
			    {  
				
				  $username = clean_input(trim($username));
				  $password = clean_input(trim($password));
				  $password = sha1($username.$password.$username);
				  $en_password = sha1($password.$username);
				  	if(!$error_found)
							{
								$sql = mysqli_query( $connection, "
								SELECT *
								FROM user 
								WHERE username = \"".$username."\" AND
								password = \"".$password."\"
								");
							}
							
							if(!$error_found)
							{
							if(mysqli_num_rows($sql) < 1)
								{//if username exists
								  $error_found = true;
		 						 $message = "<span style=' color: red;'>Invalid <strong>Username</strong> or <strong>Password</strong>!</span>"; 	
								}
							}
							
							
							if(!$error_found && mysqli_num_rows($sql)> 0)
							{
								$row = mysqli_fetch_assoc($sql);
								$username = $row['username'];
								if($row['active'] == 0)
									{//account is inactive
		 							 $error_found = true;
		 							 $message = "<span style=' color: red;'>Your account has been <strong>DEACTIVATED</strong> or <strong>INACTIVE</strong> at the moment!</span>"; 	
									}
									
									else
									{ 
									    $_SESSION['username'] = $username;
										$username = $_SESSION['username'];
										header ("Location: dashboard.php");
									}
							}
							
						
			
				}
				  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Article Manager</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="img/logo8.png" width="100%" height="100%"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                   </div>
                   <?php if(!empty($message)) echo $message; ?>
                  <form class="user" action="" method="post">
                    <div class="form-group">
                      <input  type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username..." name="username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                     <input type="submit" name="login" placeholder="Login" class="btn btn-primary btn-user btn-block" value="login"/>
                    </form>
                   <div class="text-center">
                    <a class="small" href="#">Forgot Password?</a> <br/><br/>
                    <a class="small" href="signup.php">Don't have accoun? Sign Up Here</a>
                    
                  </div>
                 </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
