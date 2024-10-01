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



if(isset($_POST['signup']) && $_POST['signup'] == 'Register Account')
{   

echo $_POST['first_name'];
	$error_found = FALSE;  
           //validator		
			$Form->ValidField($username,'empty',"<span style='color:#E31215'>*  Please supply your Username</span>");	
			$Form->ValidField($password1,'empty',"<span style='color:#E31215'>*  Please supply your Password</span>");
			$Form->ValidField($password2,'empty',"<span style='color:#E31215'>*  Please repeat your Password</span>");
			$Form->ValidField($name,'empty',"<span style='color:#E31215'>*  Please supply your First name</span>");	
			//$Form->ValidField($last_name,'empty',"<span style='color:#E31215'>*  Please supply your Last name</span>");
			$Form->ValidField($phone_number,'empty',"<span style='color:#E31215'>*  Please supply your Phone Number</span>");
		 $Form->ValidField($email_address,'empty',"<span style='color:#E31215'>*  Please supply your Email Address</span>");
		 
		
		 			
			if (!$Form->retval) {
				$error_found = TRUE;
				$message = $Form->ErrorString;
			}
			  
	  
			  if (!$error_found) 
			    {  
				  if ($password1 == $password2)
				  {
					  $message = "The password match";
					  
					  $name = clean_input(trim(strtoupper($name)));
					  $password1 = clean_input(trim($password1));
					  //echo $name.$password1.$email_address;
				  $password = sha1 ($username.$password1.$username);
				  //echo $password;
				  
				 $now = date("Y-m-d h:i:sa");
				// $now = "ok";
				 $query = "INSERT INTO user (username, password, user_type, name, email, phone, active) 
				 VALUES (\"".$username."\", \"".$password."\", 'author', \"".$name."\", \"".$email_address."\", \"".$phone_number."\", '1')";
				  //
				   //VALUES ('1', '2', '2', '2','2')
				  $result = mysqli_query($connection, $query);
				  if ($result)
				     {
												 $message = "<span style=' color: green;'>Account created successfully</span>"; 
					 }
					 else {
						     $message = "<span style=' color: red;'>Account creation Failed!</span>"; 
   							// $message = "Error: " . $sql . "<br>" . mysqli_error($connection);
									}
				  }
				  else
				  {
					$message = "The password you entre doest not match";  
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

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image">
          <img src="img/logo8.png" width="100%">
</div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                <p> <span style="color:#E31215">To create an account you should have a valid email address and do the following.</span></br><b/>

Fill out a simple form with your personal information;<br/>
follow the link we send to your email address to complete the account creation.</p>
              </div>
              <?php if(!empty($message)) echo $message; ?>
              <form class="user" action="" method="post">
              <div class="form-group">
                  <span style="color:#E31215">*</span><input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="First Name, Middle Name, Last Name" name="name">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <span style="color:#E31215">*</span><input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Username" name="username">
                  </div>
                  <div class="col-sm-6">
                    <span style="color:#E31215">*</span><input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Phone Number" name="phone_number">
                  </div>
                </div>
                <div class="form-group">
                  <span style="color:#E31215">*</span><input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email_address">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <span style="color:#E31215">*</span><input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password1">
                  </div>
                  <div class="col-sm-6">
                    <span style="color:#E31215">*</span><input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="password2">
                  </div>
                </div>
                 <input type="submit" name="signup" placeholder="signup" class="btn btn-primary btn-user btn-block" value="Register Account"/>
                <hr>
               </form>
              <hr>
              <div class="text-center">
                <a class="small" href="#">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
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
