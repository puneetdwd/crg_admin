<?php 
error_reporting(0);
include "check_session.php"; ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/map.css" rel="stylesheet">
  </head>

  <body class="nav-md">

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title">
                <img class="img-responsive img-thumbnail" src="images/Crg-logo2.0.png" style="width:90%"></a>
               <!--<img class="img-responsive  img-thumbnail" src="" style="width:70%"/> -->
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/image.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Himanshu</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />


         <?php include "sidebar.php"; ?>
		 
		 <?php include"topnav.php"; ?>
		 
		 <?php include"content.php"; ?>
		  
		 <?php include "footer.php"; ?>
            <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

     
			<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
           <script type="text/javascript">
            $(function () {
                $('.timePicker').datetimepicker( { format: 'YYYY-MM-DD hh:mm'});
            }); 
			
			 $(function () {
                $('.DatePicker').datetimepicker( { format: 'YYYY-MM-DD'});
            });
                 $(document).ready(function() {
$('#ActionRemove').hide();
} );</script>
          