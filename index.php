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
		header("Refresh:0.01; url=index.php");
	}
	
	if(isset($_GET['error'])){
		if($_GET['error']==1){
			echo '<script type="text/javascript">'; 
			echo 'alert("Please Login before finding your match!!")'; 
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
			header("Refresh:0.01; url=index.php#contact");  
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
	
    <!--icon-->
    <link rel="icon" href="img/logo.jpg">
    
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">
    <link href="css/move_form.css" rel="stylesheet">
    
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
    
    <script>
		function startTour() {
			var tour = introJs()
			tour.setOption('tooltipPosition', 'auto');
			tour.setOption('positionPrecedence', ['left', 'right', 'bottom', 'top'])
			tour.start()
		}
	
	</script>
    
    <style>
		.hide_user{
			display:none;
		}
		.show_user{
			display:block;
		}
	</style>
    
</head>

<body id="page-top" class="index">

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
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <p><a class="navbar-brand page-scroll" href="#page-top">MSinCS@US</a></p>
            </div>
			
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float:left;">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden"><a href="#page-top"></a></li>
                    <li><a class="page-scroll" href="#services">Services</a></li>
                    <li><a class="page-scroll" href="#portfolio">Universities</a></li>
                    <li><a class="page-scroll" href="#about">Info</a></li>
                    <li><a class="page-scroll" href="#team">Your Match</a></li>
                    <li><a class="page-scroll" href="#contact">Sign Up</a></li>
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
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	
    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="back_img">
                    <p class="lead"><b>"Why do you go away? So that you can come back. So that you can see the place you came from with new eyes and extra colors. And the people there see you differently, too. Coming back to where you started is not the same as never leaving."
    ― Terry Pratchett</p>
                    <a href="javascript:void(0);" onclick="javascript:startTour();" class="page-scroll btn btn-xl">Get a Tour</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <a  href="#portfolio" class="page-scroll">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                            <i class="fa fa-university fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h4 class="service-heading">View Universities</h4>
                    <p class="text-muted">See what we have to offer on various universities.</p>
                </div>
                <div class="col-md-4">
                    <a href="#team" class="page-scroll">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-home fa-stack-2x text-primary"></i>
                            <i class="fa fa-graduation-cap fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h4 class="service-heading">What matches you best?</h4>
                    <p class="text-muted">Find the  matching universities and profiles according to your profile.</p>
                </div>
                <div class="col-md-4">
                    <a href="#about" class="page-scroll">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                            <i class="fa fa-line-chart fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h4 class="service-heading">Widden our database</h4>
                    <p class="text-muted">Enter your profile and choice of universities. Help us to widden our database so that we can help others.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="bg-light-gray" style="position:relative; top:100px;">
       		<!--<div style="position:fixed; top: 50px; left:1260px; background-color:#000; border-radius: 5px; width: 90px;" align="center">
				<a href="index.html"><i class="fa fa-times fa-5x"></i></a>
                <p style="color:rgba(254,209,54,.9); font-size:16px;"><b>CLOSE</b></p>
        	</div>-->
            <div class="span6" data-step="2" data-intro="See University Details with everything you need to know to apply to a university!!" data-position="right">	<!-- this div is for introduction --> 
                <div class="container">
    
    
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">Universities</h2>
                            <h3 class="section-subheading text-muted"></h3>
                        </div>
                    </div>
			</div>		<!-- end the div of tour dialogue box -->

				<!-- show 6 universities-->
                <!--<div class="row">-->
                    <?php
						
						$number = 6;
						
						echo '<div class="row">';
						for($i=1; $i<=3 ; $i++)
						{
							$result = mysqli_query($conn,"SELECT * FROM univ_show WHERE UID = '".$i."'");
							$row = mysqli_fetch_assoc($result);
							echo '<div class="col-md-4 col-sm-12 portfolio-item">';
							echo '<a href="javascript:void(0);" class="portfolio-link" onclick = UniversityDetails("'.$row['UID'].'") >';
							echo '<div class="portfolio-hover">';
							echo '<div class="portfolio-hover-content">';
							echo '<h3 style="padding-bottom:10px;">'.$row['University'].'</h3>';
							echo '<button class="btn-md btn-info">DETAILS</button>';
							//echo '<i class="fa fa-plus fa-3x"></i>';
							echo '</div>';
							echo '</div>';
							echo '<img src="'.$row["Image"].'" class="img-responsive" alt="">';
							echo '</a>';
							echo '<div class="portfolio-caption">';
							echo '<h4>'.$row["University"].'</h4>';
							echo '<p class="text-muted"></p>';
							echo '</div>';
							echo '</div>';
							echo '';	
						}
						echo '</div>';
						
						echo '<div class="row">';
						for($i=4; $i<=6 ; $i++)
						{
							$result = mysqli_query($conn,"SELECT * FROM univ_show WHERE UID = '".$i."'");
							$row = mysqli_fetch_assoc($result);
							echo '<div class="col-md-4 col-sm-12 portfolio-item">';
							echo '<a href="javascript:void(0);" class="portfolio-link" onclick = UniversityDetails("'.$row['UID'].'") >';
							echo '<div class="portfolio-hover">';
							echo '<div class="portfolio-hover-content">';
							echo '<h3 style="padding-bottom:10px;">'.$row['University'].'</h3>';
							echo '<button class="btn-md btn-info">DETAILS</button>';
							//echo '<i class="fa fa-plus fa-3x"></i>';
							echo '</div>';
							echo '</div>';
							echo '<img src="'.$row["Image"].'" class="img-responsive" alt="">';
							echo '</a>';
							echo '<div class="portfolio-caption">';
							echo '<h4>'.$row["University"].'</h4>';
							echo '<p class="text-muted"></p>';
							echo '</div>';
							echo '</div>';
							echo '';	
						}
						echo '</div>';
						
					?>
                    <div align="center">
                		<a href="auto_univ.php" class="btn btn-xl">More Universities</a>
                	</div>
                <!--</div>-->
            </div>
           
    </section>
    
                    
                    
                    <script>
                    	function UniversityDetails(id)
						{
							document.location.href = "new_auto_modal.php?id="+id;
						}
                    </script>

    <!-- About Section -->
    
   <section id="about" style="min-height:800px; overflow:hidden;">
   		<div class="span6" data-step="3" data-intro="Fill this form to help us widden our database and make us dynamic!!">
    	<div class="container">
            <div class="row col-lg-12" align="center">
            	<h2 class="section-heading">SHARE YOUR DETAILS</h2><br>
                <p class="text-muted">Help us to grow.</p>
			</div>
            <div class="move" style="width:5000px; overflow:hidden;">
            	<form id="info" action="submit_info.php" method="post" role="form">
                <div class="div1 row jumbotron col-md-10 col-sm-10 show_div" style="position: absolute; left:6%; width:90%; padding-right:10px; padding-top: 39px; padding-bottom: 73px; background-image: url(img/image3.jpg); background-attachment:fixed; background-size:cover; border-radius: 10px;">
                	<!--<form role="form">-->
                    <p style="color:#FFF; font-size:13px"><b>All fields are REQUIRED</b></p>
                	<div class="row">
                        <div class="form-group col-md-5">
                            <label for="name" class="sr-only">NAME:</label>
                            <input type="text" class="form-control" name="name" required= "required" placeholder="Enter your name">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="form-group col-md-5">
                            <label for="institute" class="sr-only">UG Institute</label>
                            <input type="text" class="form-control" name="institute" required placeholder="Name of your Undergraduate Institute">
                        </div>
                    </div>
                <!--</form>-->
                <!--<form role="form">-->
                	<div class="row">
                        <div class="form-group col-md-5">
                            <label for="gpa" class="sr-only">GPA:</label>
                            <input type="text" class="form-control" name="gpa" required placeholder="GPA/Percentage (Do not Convert to US Scale)">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="form-group col-md-5">
                            <label for="email" class="sr-only">Email ID:</label>
                            <input type="email" class="form-control" name="email" required placeholder="Your Email ID">
                        </div>
                    </div>
                <!--</form>-->
                <!--<form role="form">-->
                	<!--<div class="row">
                        <div class="form-group col-md-5">
                            <label for="gre" class="sr-only">GRE:</label>
                            <input type="number" min="270" max="340" class="form-control" name="gre" required placeholder="GRE Score" style="border: 2px solid #F5121B;">
                        </div>    
                    </div>-->
                    <div class="row">
                        <div class="form-inline col-md-5">
                          <label for="gre" style="color:white;padding-right: 26px;">GRE:</label>
                          <select class="form-control" id="gre" name="gre" required style="width: 84%; padding-left: 20px;" >
                            <option>295-300</option>
                            <option>301-305</option>
                            <option>306-310</option>
                            <option>311-315</option>
                            <option>316-320</option>
                            <option>321-325</option>
                            <option>326-330</option>
                            <option>331-335</option>
                            <option>336-340</option>
                          </select>
                        </div>
                    </div>
                    
                    <!--
                    <div class="form-group col-md-3">
                    	<label for="gre_v" class="sr-only">GRE Verbal:</label>
                        <input type="number" class="form-control" name="gre_v" placeholder="GRE Verbal Score">
                    </div>
                    <div class="form-group col-md-3">
                    	<label for="gre_q" class="sr-only">GRE Quantitative:</label>
                        <input type="number" class="form-control" name="gre_q" placeholder="GRE Quantitative Score">
                    </div>
                    <div class="form-group col-md-3">
                    	<label for="gre_a" class="sr-only">Analytical Writing:</label>
                        <input type="number" class="form-control" name="gre_a" placeholder="GRE Analytical Writing">
                    </div>
                    -->
                <!--</form>-->
                <!--<form role="form">-->
                	<div class="row">
                        <ul class="pager" style="padding-right: 20px;">
                            <!--<li class="previous p_one"><a href="#">Previous</a></li>-->
                            <li class="next n_one"><a href="#section" style="color:#900;">Next</a></li>
                        </ul>
                    </div>
                    <div class="row" style="height:49px;">
                        <div class="form-inline col-md-5">
                          <label for="toefl" style="color:white; padding-right: 26px;">TOEFL iBT:</label>
                          <select class="form-control" id="toefl" name="toefl" required style="width: 73%;">
                            <option>90-95</option>
                            <option>96-100</option>
                            <option>101-105</option>
                            <option>106-110</option>
                            <option>111-115</option>
                            <option>116-120</option>
                          </select>
                        </div>
                    </div>
                    <!--
                    <div class="form-group col-md-2">
                    	<label for="toefl_r" class="sr-only">TOEFL Reading:</label>
                        <input type="number" class="form-control" name="toefl_r" placeholder="Reading">
                    </div>
                    <div class="form-group col-md-2">
                    	<label for="toefl_l" class="sr-only">TOEFL Listening:</label>
                        <input type="number" class="form-control" name="toefl_l" placeholder="Listening">
                    </div>
                    <div class="form-group col-md-2">
                    	<label for="toefl_s" class="sr-only">TOEFL Speaking:</label>
                        <input type="number" class="form-control" name="toefl_s" placeholder="Speaking">
                    </div>
                    <div class="form-group col-md-2">
                    	<label for="toefl_w" class="sr-only">TOEFL Writing:</label>
                        <input type="number" class="form-control" name="toefl_w" placeholder="Writing">
                    </div>
                    -->
                <!--</form>-->
                <!--<form role="form">-->
                	<div class="row">
                        <div class="form-group col-md-3">
                            <label for="experience" class="sr-only">Experience:</label>
                            <input type="number" class="form-control" name="experience" required placeholder="Years of Experience">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="company" class="sr-only">Company</label>
                            <input type="text" class="form-control" name="company" placeholder="Company Name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="term" class="sr-only">Term</label>
                            <input type="text" class="form-control" name="term" placeholder="Term of Admission. ex: Fall 2015">
                        </div>
                    </div>
                <!--</form>-->
                <!--<form role="form">-->
                <!--</form>-->
                </div>
                
                
                <div class="div2 row jumbotron col-md-10 col-sm-10 hide" style="position: absolute; left:6%;  width:90%; padding-right:10px; padding-left:10px; padding-top: 74px;padding-bottom: 50px; background-image: url(img/form/form1.jpg); background-attachment: fixed; background-position: top; background-size:cover; border-radius: 10px;">
                	<!--<form role="form">-->
                	<div class="form-group col-md-12">
                    	<label for="intern_a" class="sr-only">Academic Internships:</label>
                        <textarea rows="2" class="form-control" name="internship" required  placeholder="Mention all Academic Internships here. One in each line."></textarea>
                    </div>
                    <div class="form-group col-md-12">
                    	<label for="project" class="sr-only">Projects:</label>
                        <textarea rows="2" class="form-control" name="project" required  placeholder="Mention the Project Name and Company/University under whom the project was done. One in each line."></textarea>
                    </div>
                <!--</form>-->
                <!--<form role="form">-->
                    <ul class="pager">
                    	<li class="previous p_two"><a href="#section"  style="color:#900;">Previous</a></li>
                    	<li class="next n_two"><a href="#section"  style="color:#900;">Next</a></li>
                	</ul>
                	<div class="form-group col-md-12">
                    	<label for="pub" class="sr-only">Publications:</label>
                        <textarea rows="5" class="form-control" name="publication"  required placeholder="Submitted or Accepted Publications:
Journal:
-- Journal Name/ Paper topic/ Impact factor
Conference:
-- Conference Name/ Place"></textarea>
                    </div>
                </div>
                
                <div class="div3 row jumbotron col-md-10 col-sm-10 hide" style="position: absolute; left:6%;  width:90%; padding-right:10px; padding-left:10px; background-image: url(img/form/form2.jpg); background-attachment: fixed; background-position:center; background-size:cover; border-radius: 10px;">
                	<!--<form role="form">-->
                    <div class="form-group col-md-12">
                    	<label for="lor" class="sr-only">Recommendations:</label>
                        <textarea rows="2" class="form-control" name="lor" required  placeholder="Recommendations: (one in each line)
-- Designation/ University/ Moderate or Strong"></textarea>
                    </div>
                	<div class="form-group col-md-12">
                    	<label for="univ_fill" class="sr-only">Universities Filled:</label>
                        <textarea rows="3" class="form-control" name="univ_fill" required placeholder="Universities Filled: (one in each line)
-- University Name/ Campus Location/ Degree applied"></textarea>
                    </div>
                <!--</form>-->
                <!--<form role="form">-->
                	<ul class="pager">
                        <li class="previous p_three"><a href="#section"  style="color:#900;">Previous</a></li>
                        <!--<li class="next n_three"><a href="#"  style="color:#900;">Next</a></li>-->
               	 	</ul>
                	<div class="form-group col-md-12">
                    	<label for="univ_admit" class="sr-only">Universities Admit:</label>
                        <textarea rows="3" class="form-control" name="univ_admit" required  placeholder="Mention Universities from which you got an admit: (one in each line)
-- University Name/ Campus Location/ Degree applied
NOTE: If no university then write NONE"></textarea>
                    </div>
                <!--</form>-->
                <!--<form role="form">-->
                <!--</form>-->
                <div align="center">
                	<input type="submit" class="btn btn-lg btn-success"></input>
                </div>
                </div>
            	</form>
            </div>
        </div>
        </div>
	</section>

    <!-- Team Section -->
        <section id="team"  class="bg-light-gray" style="position: relative;top: 50px;">
        	<div class="span6" data-step="4" data-intro="Fill this form to see the matching universities and profile of other students matching your profile!!">
    		<div class="container">
                <div class="row col-lg-12" align="center">
                    <h2 class="section-heading">FIND YOUR MATCH</h2><br>
                </div>
            <!--<div class="row">-->
            	<div class="jumbotron col-lg-12 col-md-12" style="padding-left:100px; height: 535px; background-image: url(img/match.jpg); background-attachment:fixed; background-repeat: round;">
                        
                        
                        	<form id="match" action="univ_match.php" method="post">
                            	<div class="row" align="center"  style="padding-top:20px;">
                                    <div class="col-md-12">
                                      <label for="gre" style="font-size:26px;"><b>GRE:</label>
                                      <select class="form-control" id="gre" name="gre" required style="width: 50%" >
                                        <option>295-300</option>
                                        <option>301-305</option>
                                        <option>306-310</option>
                                        <option>311-315</option>
                                        <option>316-320</option>
                                        <option>321-325</option>
                                        <option>326-330</option>
                                        <option>331-335</option>
                                        <option>336-340</option>
                                      </select>
                                    </div>
                    			</div>
                                
                                <div class="row"  align="center"  style="padding-top:20px;">
                                    <div class="col-md-12">
                                      <label for="toefl" style="font-size:26px;"><b>TOEFL iBT:</label>
                                      <select class="form-control" id="toefl" name="toefl" required style="width: 50%;">
                                        <option>90-95</option>
                                        <option>96-100</option>
                                        <option>101-105</option>
                                        <option>106-110</option>
                                        <option>111-115</option>
                                        <option>116-120</option>
                                      </select>
                                    </div>
                    			</div>
                                
                                <div class="row" align="center" style="padding-top:20px;">
                                	<div class="col-md-12">
                                    	<label for="journal" style="font-size:26px;"><b>PAPER PUBLICATION:</label>
                                        <select class="form-control" id="journal" name="journal" required style="width: 50%;">
                                            <option value="true">YES</option>
                                            <option value="false">NO</option>
                                      	</select>
                                    </div> 
                                </div>
                                
                                <div class="row" align="center" style="padding-top:20px;">
                                	<div class="col-md-12">
                                    	<label for="job" style="font-size:26px;"><b>JOB EXPERIENCE:</label>
                                        <select class="form-control" id="job" name="job" required style="width: 50%;">
                                            <option value="true">YES</option>
                                            <option value="false">NO</option>
                                      	</select>
                                    </div> 
                                </div>
                                
                                
                                <div class="col-lg-12" align="center" style="padding-top:30px;">
                                    <button type="submit" class="btn btn-xl">Find Match</button>
                           		</div>

                        </form>
		         </div>  
            </div>
            </div>
	</section>

    <!-- Clients Aside -->
   <!-- <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/envato.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/designmodo.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/themeforest.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/creative-market.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside> -->

    <section id="contact">
    	<?php
        if (!empty($error_msg)) {
			echo $error_msg;
        }
        ?>
        <div class="span6" data-step="5" data-intro="Register with us to avail all our services." data-position="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Sign Up</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form  name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Choose an Username" id="username" name="username" required data-validation-required-message="Please enter a username">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Email" id="email" name="email" required data-validation-required-message="Please enter your email.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Choose a password" id="password" name="password" required data-validation-required-message="Please choose a password.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm your password" id="confirmpwd" name="confirmpwd" required data-validation-required-message="The the same password as above.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <!--<div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>-->
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <input type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email,this.form.password,this.form.confirmpwd);"  class="btn btn-xl">
                            </div>
                        </div>
                    </form>
                    <!--<h4 style="color:#fff;">Existing User? Click <button id="login_button" class="btn-sm btn-success" onClick=show_login()><b>Login</b></button> to login.</h4>-->
                </div>
            </div>
        </div>
        </div>
    </section>

    <footer>
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
    
    <script type="text/javascript" src="js/intro.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var $_Tawk_API={},$_Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/552fda1dfd29683e1f7290d4/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>



</html>