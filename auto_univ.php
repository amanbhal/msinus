<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/register.inc.php';
	include_once 'includes/functions.php';
	include_once 'includes/config.php';
							 
	sec_session_start();
	
	if(isset($_GET['submit'])){
		echo '<script type="text/javascript">'; 
		echo 'alert("Thank You!!")'; 
		echo '</script>';  
		header("Refresh:1; url=index.php");
	}
	
	if(isset($_GET['error'])){
		if($_GET['error']==1){
			echo '<script type="text/javascript">'; 
			echo 'alert("Please Login before finding the match!")'; 
			echo '</script>';
			header("Refresh:0.01; url=index.php");  
		}
		if($_GET['error']==2){
			echo '<script type="text/javascript">'; 
			echo 'alert("Your account locked due to too many unsuccessful attempts.")'; 
			echo '</script>';
			header("Refresh:0.01; url=index.php");  
		}
		if($_GET['error']==3){
			echo '<script type="text/javascript">'; 
			echo 'alert("Incorrect Password! Please try again.")'; 
			echo '</script>';
			header("Refresh:0.01; url=index.php");  
		}
		if($_GET['error']==4){
			echo '<script type="text/javascript">'; 
			echo 'alert("Not Registered! Please register yourself before logging in.")'; 
			echo '</script>';
			header("Refresh:0.01; url=index.php");  
		}
	}
	if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	 <!-- jQuery -->
    <script src="js/jquery.js"></script>

    
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    
   

    
     
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MSinCS@US</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">
    
     <!-- Add IntroJs styles -->
    <link href="css/introjs.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
		
		tr {
			height:40px;
		
		}
		
		td, th {
   	 	border: 1px solid black;
		}
		
		.image {
			border: none;
		}
		
		td, th {
			text-align:center;
		}
</style>

<style>
		.hide_user{
			display:none;
		}
		.show_user{
			display:block;
		}
	</style>
</head>

<body>

<div class="container jumbotron show" align="center" style="position: fixed; top: -200%; left: 10%; z-index: 10; box-shadow: 19px 14px 24px 2px rgba(0,0,0,0.75); border-radius: 20px; padding-top:40px; background-color:rgba(0,0,0,0.95); width:85%;">
					<?php
						if (isset($_GET['error'])) {
							echo '<p class="error">Error Logging In!</p>';
						}
                    ?>
                    
                    <i id="close_login" class="fa fa-times fa-4x" style="position:relative; left: 45%; color:white;"></i>
                    
                    <fieldset style="padding-bottom:30px; position: relative; top: -20px;">
                        <legend align="center"><b style="color:white;">LOGIN</b></legend>
                        <form action="includes/process_login.php" method="post" name="login_form">                      
                            <div class="row">
                                <div class="col-md-4">
                                    <b  style="color:white;">Email: &nbsp;&nbsp;&nbsp;</b><input type="text" name="email" placeholder="Email:" />
                                </div>
                                <div class="col-md-4">
                                    <b  style="color:white;">Password: &nbsp;&nbsp;&nbsp;</b><input type="password" name="password" id="password" placeholder="Password:"/>
                                </div>
                                <div class="col-md-4">
                                    <input type="button" class="btn-lg btn-success" value="Login" onclick="formhash(this.form, this.form.password);" />
                                </div>
                            </div> 
                        </form>
                    </fieldset>  
                </div>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color:#000;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <p><a class="navbar-brand page-scroll" href="index.php">MSinCS@US</a></p>
            </div>
			
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float:left;">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden"><a href="#page-top"></a></li>
                    <li><a class="page-scroll" href="#index.phpservices">Services</a></li>
                    <li><a class="page-scroll" href="index.php#portfolio">Universities</a></li>
                    <li><a class="page-scroll" href="index.php#about">Info</a></li>
                    <li><a class="page-scroll" href="#index.phpteam">Your Match</a></li>
                    <li><a class="page-scroll" href="#index.phpcontact">Sign Up</a></li>
                    <li><?php if(login_check($mysqli)==true) echo '<a class="page-scroll" href="profile.php">Forum</a>'; else echo'<a href="javascript:void(0);" onclick="javascript:login_first();">Forum</a>'; ?></li>
                    <li><?php if(login_check($mysqli)==true) echo '<a class="page-scroll" href="compare.php">Compare</a>'; else echo'<a href="javascript:void(0);" onclick="javascript:login_first();">Compare</a>'; ?></li>
 
 				<script>
					function login_first(){
						alert("Login first!!");
						window.location.assign(window.location.href);	
					}
				</script>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <p style="padding-left:40px; float:left"><span style="color:white; font-size:12px; "><?php if (login_check($mysqli) == true) echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img onMouseOver="show_user()" onMouseOut="hide_user()" src="img/user2.png" style="width:40px; height=40px;"> &nbsp;&nbsp;&nbsp;&nbsp;<a href="includes/logout.php"><button class="btn btn-lg btn-danger"><b>Logout</b></button></a>'; else {echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="login_button" class="btn-lg btn-success" onClick=show_login()><b>Login</b></button>';} ?></span></p>
            
            <div id="user" class="hide_user" style="min-width: 200px; min-height:50px; position:fixed; left:78%; top: 13%; background-color:#000; border-radius:5px; padding-left:10px; padding-right:10px; padding-top:10px; text-align:center;">
            	<p style="color:white;"><b><?php echo 'Hi '.$_SESSION['username'].'!'; ?></b></p>
            </div>
            
            <script>
				function show_user(){
					$('#user').removeClass('hide_user');
					$('#user').addClass('show_user');
				}
				function hide_user(){
					$('#user').removeClass('show_user');
					$('#user').addClass('hide_user');
				}
			</script>
            
            
        </div>
        <!-- /.container-fluid -->
    </nav>
	
    <section id="portfolio" class="bg-light-gray" style="position:relative; top:100px;">
       		<!--<div style="position:fixed; top: 50px; left:1260px; background-color:#000; border-radius: 5px; width: 90px;" align="center">
				<a href="index.html"><i class="fa fa-times fa-5x"></i></a>
                <p style="color:rgba(254,209,54,.9); font-size:16px;"><b>CLOSE</b></p>
        	</div>-->
            <div class="container">

                <!--<div class="row">-->
                    <?php
						$result = mysqli_query($conn,"SELECT * FROM univ_info");
						$row = mysqli_fetch_assoc($result);
						echo '<p class="span6" data-step="1" data-intro="Explore the whole range of Universities." data-position="left" align="center" style="font-size:36px;">UNIVERSITIES</p>';
						echo '<div class="container jumboton" style="padding-top:30px;">';
						while($row)
						{
							echo ' <table class="table"  width="85%">
										<tr>
											<table class="table">
												<tr>
													<td class="span6 image" data-step="2" data-intro="Click on images to see the full University Details." data-position="left" rowspan="3" style="text-align: -webkit-left;"><a href="#" onclick = UniversityDetails("'.$row['UID'].'") ><img width="144px" height="100px" src="'.$row['Image_small'].'"></img></a>
													<th class="success" colspan="2">'.$row['University'].'
												</tr>
												<tr>
													<td>'.$row['Rank'].'
													<td>'.$row['Accept_rate'].'
												</tr>
												<tr>
													<td>'.$row['Gre'].'
													<td>'.$row['Toefl'].'
												</tr>	
											</table>
										</tr>	
									</table>
							';
							$row = mysqli_fetch_assoc($result);						
						}
						echo '</div>';
					?>
                    <script>
                    	function UniversityDetails(id)
						{
							document.location.href = "new_auto_modal.php?id="+id;
						}
                    </script>
                <!--</div>-->
            </div>
    </section>
    <footer style="position:relative; top:100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <span class="copyright">Copyright &copy; MSinCS@US 2015</span>
                </div>
                <div class="col-md-2">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


	 <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/cbpAnimatedHeader.js"></script>
   
<!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_us.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>
    <script src="js/form_move.js"></script>
    <script src="js/login_script.js"></script>
    
    <!-- Login form javascript -->
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 
    
     <script type="text/javascript" src="js/intro.js"></script>
     
<script src="js/classie.js"></script>
    

</body>

<script>		
$(document).ready(function(){
		function startTour() {
			console.log("inside function");
			var tour = introJs()
			tour.setOption('tooltipPosition', 'auto');
			tour.setOption('positionPrecedence', ['left', 'right', 'bottom', 'top'])
			tour.start()
			
		}
		setTimeout(startTour, 1000)
	}); 
	
	</script>

</html>