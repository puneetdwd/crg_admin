<?php 

	session_start();
		
	if(!isset($_SESSION['username'])) // If session is not set then redirect to Login Page
       {
		  
                 echo "<script>setTimeout(\"location.href = 'login.php';\",100);</script>";
                 exit();  
                  
       } 
	   else
	   {
		 $login_session=$_SESSION['username'];
		}
	

?>
