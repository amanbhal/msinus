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
                    <li><a class="page-scroll" href="index.php#services">Services</a></li>
                    <li><a class="page-scroll" href="index.php#portfolio">Universities</a></li>
                    <li><a class="page-scroll" href="index.php#about">Info</a></li>
                    <li><a class="page-scroll" href="index.php#team">Your Match</a></li>
                    <li><a class="page-scroll" href="index.php#contact">Sign Up</a></li>
                    <li class="span6" data-step="1" data-intro="Visit our FORUM page to discuss with other students and experts." data-position="left"><?php if(login_check($mysqli)==true) echo '<a class="page-scroll" href="profile.php">Forum</a>'; else echo'<a href="javascript:void(0);" onclick="javascript:login_first();">Forum</a>'; ?></li>
                    <li class="span6" data-step="6" data-intro="Compare universities." data-position="left"><?php if(login_check($mysqli)==true) echo '<a class="page-scroll" href="compare.php">Compare</a>'; else echo'<a href="javascript:void(0);" onclick="javascript:login_first();">Compare</a>'; ?></li>
 
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
            
        <!-- /.container-fluid -->
    </nav>
	
    <div>
    			<?php
						$id = $_GET['id']; //get UID from previous page.
						
						$info_result = mysqli_query($conn,"SELECT * FROM univ_info WHERE UID = $id");
						$info_row = mysqli_fetch_assoc($info_result);
						$fee_result = mysqli_query($conn,"SELECT * FROM univ_fee WHERE UID = $id");
						$fee_row = mysqli_fetch_assoc($fee_result);
						$dates_result = mysqli_query($conn,"SELECT * FROM univ_dates WHERE UID = $id");
						$dates_row = mysqli_fetch_assoc($dates_result);
						$gre_result = mysqli_query($conn,"SELECT * FROM univ_gre_toefl WHERE UID = $id");
						$gre_row = mysqli_fetch_assoc($gre_result);
						$docs_result = mysqli_query($conn,"SELECT * FROM univ_docs WHERE UID = $id");
						$docs_row = mysqli_fetch_assoc($docs_result);
						$links_result = mysqli_query($conn,"SELECT * FROM univ_links WHERE UID = $id");
						$links_row = mysqli_fetch_assoc($links_result);
				?>		
						
        <div class="modal-content">
            <div class="container-fluid">
                <div class="row" style="background-image: url(img/info.jpg); background-repeat:no-repeat; background-attachment:fixed; background-size:cover;">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body" style="padding-top:20%; padding-bottom: 10%;">
                            <!--<div style="position:relative; left:1000px; top:-40px; width:60px;">
                            	<a href="index.html"><i class="fa fa-times fa-5x"></i></a>
                            </div>-->
                            <p style="font-size:50px; color: #39C;" align="center"><b><?php echo $info_row["University"] ?></b></h2>
                            <h4 class="text-intro text-muted" style="color: #39C;" align="center"><b><?php echo $info_row["Rank"] ?></b></h4><br>
                            <?php echo '<img class="img-responsive center-block" src="'.$info_row["Image"].'" alt=""><br>' ?>
                            <div class="jumbotron" align="center">
	                            <p class="text-danger"><b><?php echo $info_row["Accept_rate"] ?></b></p>
                            </div>
                            <div class="jumbotron" align="center">
                                <p style="font-size:36px;"><b>FEE</b></p>
                                <p class="text-warning"><b><?php echo $fee_row["Annual"] ?> INR (ANNUAL)</b></p>
                                    <p class="text-success"><b>COST BREAKDOWN<br>
                                    <?php echo $fee_row["Tuition"] ?> INR	-- Tuition<br>
                                    <?php echo $fee_row["Apartment_food"] ?> INR -- Apartment & Food<br>
                                    <?php echo $fee_row["Books"] ?> INR -- Books</b></p><br>
                                <p class="text-info"><b>Our review: <?php echo $fee_row["Review"] ?></b></p>
                            </div>
                            <p>
                            
                            <div class="jumbotron" align="center">
                            	<p style="font-size:36px;"><b>DEADLINES</b></p>
                                <p class="text-warning"><b>REGULAR APPLICATION DEADLINE -- <?php echo $dates_row["Regular"] ?><br>
                                						   FALL APPLICATION DEADLINE -- <?php echo $dates_row["Fall"] ?><br>
                                                           <?php if($dates_row["Test_scores"] != NULL) echo 'TEST SCORES DUE -- '.$dates_row["Test_scores"].'<br>' ?>
                                                           COLLEGE WILL NOTIFY STUDENT FOR REGULAR ADMISSION -- <?php echo $dates_row["Notify"] ?><br>
														   STUDENT MUST REPLY TO ACCEPTANCE -- <?php echo $dates_row["Reply"] ?></b></p>
								<?php if($dates_row["Early"] != NULL) echo '<p class="text-danger"><b>EARLY DECISION DEADLINE -- '.$dates_row["Early"].'<br>
														  COLLEGE WILL NOTIFY STUDENT OF EARLY DECISION -- '.$dates_row["Notify_early"].'</b></p>' ?>
                            </div>
                            
                            <div class="jumbotron" align="center">
                            	<p style="font-size:36px;"><b>GRE and TOEFL</b></p>
                                <p class="text-warning"><b><?php echo $gre_row["Gre_detail"] ?><br><br>
                                <?php if($gre_row["Verbal"] != NULL) echo 'The average GRE score range for CS is:<br>
                                Verbal Reasoning -- '.$gre_row["Verbal"].'<br>
                                Quantitative Reasoning -- '.$gre_row["Quant"].'<br>
                                Analytical Writing -- '.$gre_row["Analytical"].'</b></p>' ?>
                                <p class="text-danger"><b><?php echo $gre_row["Toefl_detail"] ?></b></p>
                                <p class="text-success"><b>GRE: Institution code, <?php echo $gre_row["Gre_inst_code"]; if($gre_row["Gre_dept_code"] != NULL) echo '; Department code, '.$gre_row["Gre_dept_code"].'<br>' ?>
                                						TOEFL: Institution code, <?php echo $gre_row["Toefl_inst_code"]; if($gre_row["Toefl_dept_code"] != NULL) echo '; Department code, '.$gre_row["Toefl_dept_code"].'<br>' ?>
                            </div>
                            
                            <div class="jumbotron text-justify" align="center">
                            	<p style="font-size:36px;"><b>DOCUMENTS</b></p>
                                <p class="text-warning"><b>TRANSCRIPTS: <?php echo $docs_row["Transcript_detail"] ?><br>
                                                    <?php if($docs_row["Address_line1"] != NULL) echo '<br> Mailing Address: '.$docs_row["Address_line1"].'<br>' ?>
                                                    <?php if($docs_row["Address_line2"] != NULL) echo $docs_row["Address_line2"].'<br>' ?>
                                                    <?php if($docs_row["Address_line3"] != NULL) echo $docs_row["Address_line3"].'<br>' ?>
                                                    <?php if($docs_row["Address_line4"] != NULL) echo $docs_row["Address_line4"].'<br>' ?>
                                                    <?php if($docs_row["Address_line5"] != NULL) echo $docs_row["Address_line5"] ?></b></p><br>
                                <p class="text-danger"><b>RESUME: <?php echo $docs_row["Resume"] ?></b></p><br>
                                <p class="text-success"><b>STATEMENT: <?php echo $docs_row["SOP"] ?></b></p><br>
                                <p class="text-info"><b>LETTERS OF RECOMMENDATION: <?php echo $docs_row["LOR"] ?></b></p>
                            </div>
                            
                            <div class="jumbotron" align="center">
                            	<p style="font-size:36px;"><b>USEFUL LINKS</b></p>
                                <p style="font-size:21px;">
									<?php if($links_row["Link1"] != NULL) echo '<a href="'.$links_row["Link1"].'"><b>'.$links_row["Link1_description"].'</b></a><br>' ?>
                                    <?php if($links_row["Link2"] != NULL) echo '<a href="'.$links_row["Link2"].'"><b>'.$links_row["Link2_description"].'</b></a><br>' ?>
                                    <?php if($links_row["Link3"] != NULL) echo '<a href="'.$links_row["Link3"].'"><b>'.$links_row["Link3_description"].'</b></a><br>' ?>
                                    <?php if($links_row["Link4"] != NULL) echo '<a href="'.$links_row["Link4"].'"><b>'.$links_row["Link4_description"].'</b></a><br>' ?>
                                    <?php if($links_row["Link5"] != NULL) echo '<a href="'.$links_row["Link5"].'"><b>'.$links_row["Link5_description"].'</b></a><br>' ?>
                            	</p>
                            </div>
                          <!--<div align="center">
                            <a href="index.html #portfolio"><button type="button" class="btn btn-lg btn-success"><i class="fa fa-times"></i> Close Window</button></a>
                          </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
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

</body>

</html>