<?php
    include('lib/password.php');
	session_start(); 
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRG Login</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
  
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="" method="POST">
              <img class="img-responsive" src="images/Crg-logo2.0.png"/><br/><br/>
              <div>
                <input type="text" class="form-control" placeholder="Official Email Address" required="" name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div class="pull-right">
             
				<input type="submit" name="login" value="submit" class="btn btn-default btn-lg submit"/>
               <!-- <a class="reset_pass" href="#">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>
<!--
              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

               
                <br />

               
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                
              </div>
            </form>
            -->
          </section>
        </div>
      </div>
    </div>
  </body>
</html>



<?php

	include "db/config.php"; 
	// for user login	
	if (isset($_POST['login'])) { 
		
		$username = $_POST['username'];
		$_SESSION['username']=$username; // create session 
		
		$password = $_POST['password'];
		
	
		//$query = "select * from cr_login where username='$username' AND password='$password'"; 
                $query = "select password from users where username='$username' and type='admin' "; 
                
                
	 
		$result = mysqli_query($connection, $query);
 
        if (mysqli_num_rows($result) != 1){
            // invalid login information
         
			 echo "<div id=\"errormsg\"> Wrong Email Id or Password! </div>";
			   echo "<script>setTimeout(\"location.href = 'login.php';\",2400);</script>";
            //show the loginform again.           
        } else {         
            $hash_cost = 10;
            
            $user = mysqli_fetch_row($result);
            
            if(password_verify('c8d4e8763d'.$password, $user[0])){
                echo "<div id=\"successmsg\"> Login Success </div>";
                echo "<script>setTimeout(\"location.href = 'index.php';\",1400);</script>";
            }else{
                echo "<div id=\"errormsg\"> Invalid Password </div>";
                echo "<script>setTimeout(\"location.href = 'login.php';\",1400);</script>";
            }
        }
	}
	
?>	