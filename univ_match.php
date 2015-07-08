<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/register.inc.php';
	include_once 'includes/functions.php';
	include_once 'includes/config.php';
							 
	sec_session_start();
	
	if (login_check($mysqli) != true) 
	header('Location: index.php?error=1');
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
		
		tr {
			height:40px;
		
		}
		
		td, th {
   	 	border: 1px solid black;
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
                <p><a class="navbar-brand page-scroll" href="index.php#page-top">MSinCS@US</a></p>
            </div>
			
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float:left;">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden"><a href="#page-top"></a></li>
                    <li><a class="page-scroll" href="#services">Matching Universities</a></li>
                    <li><a class="page-scroll" href="#portfolio">Matching Profiles</a></li>
                    <!--<li><a class="page-scroll" href="index.php#about">Info</a></li>
                    <li><a class="page-scroll" href="index.php#team">Your Match</a></li>
                    <li><a class="page-scroll" href="index.php#contact">Sign Up</a></li>-->
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
	
    <!-- show matching universities-->
    <section id="services">
    <?php if (login_check($mysqli) == true):
	{
            $range = array('295-300','301-305','306-310','311-315','316-320','321-325','326-330','331-335','336-340');
            
            for($i=0; $i<9; $i++)
            {
                if($_POST['gre']==$range[$i])
                    $range_index = $i;	
            }
            
            echo "<div class='jumbotron'><br><br><br><p class='text-danger text-center' style='font-size:45px;'><b>SAFE UNIVERSITIES</b></p><br>";
            
            if($range_index == 8)
                $numbers = range(1,8);
            else
                $numbers = range(1, 11);
            shuffle($numbers);
            $index = array_slice($numbers, 0, 3);
            sort($index);
        
            $safe_count = 0;	
            for($i =0;$i<3;$i++)
            {
                $result = mysqli_query($conn,"SELECT * FROM univ_score WHERE UID = '".$index[$i]."'");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);	
                    if($_POST['journal']=="false" OR $_POST['job']=="false")
                        echo "<p class='text-success text-center' style='font-size:32px;'><b>".$row[$range[$range_index-1]]."</b><p><br>";
                    else
                        echo "<p class='text-success text-center' style='font-size:32px;'><b>".$row[$range[$range_index]]."</b></p><br>";
                }
                else
                    die(mysqli_error());	
            }
            echo "<br><br><br></div>";
            
            
            
            
            echo "<br><br><br><div><p class='text-danger text-center' style='font-size:45px;'><b>MODERATE UNIVERSITIES</b></p><br>";
            
            if($range_index == 7)
                $numbers = range(1, 8);
            else if($range_index == 8)
                $numbers = range(1,9);
            else
                $numbers = range(1,11);
            shuffle($numbers);
            $index = array_slice($numbers, 0, 3);
            sort($index);
            
            $safe_count = 0;
            
            for($i =0;$i<3;$i++)
            {
                $result = mysqli_query($conn,"SELECT * FROM univ_score WHERE UID = '".$index[$i]."'");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);	
                    if($_POST['journal']=="false" OR $_POST['job']=="false")
                        echo "<p class='text-success text-center' style='font-size:32px;'><b>".$row[$range[$range_index]]."</b></p><br>";
                    else
                        echo "<p class='text-success text-center' style='font-size:32px;'><b>".$row[$range[$range_index+1]]."</b></p><br>";
                }
                else
                    die(mysqli_error());	
            }
            echo "<br><br><br></div>";
            
            
            echo "<div class='jumbotron'><br><br><br><p class='text-danger text-center' style='font-size:45px;'><b>AMBITIOUS UNIVERSITIES</b></p><br>";
            if($range_index == 6)
                $numbers = range(1,8);
            else if($range_index == 7)
                $numbers = range(1,9);
            else	
                $numbers = range(1,11);
            shuffle($numbers);
            $index = array_slice($numbers, 0, 3);
            sort($index);
            
            $safe_count = 0;
            
            for($i =0;$i<3;$i++)
            {
                $result = mysqli_query($conn,"SELECT * FROM univ_score WHERE UID = '".$index[$i]."'");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);	
                    if($_POST['journal']=="true" AND $_POST['job']=="true")
                        echo "<p class='text-success text-center' style='font-size:32px;'><b>".$row[$range[$range_index+2]]."</b></p><br>";
                    else
                        echo "<p class='text-success text-center' style='font-size:32px;'><b>".$row[$range[$range_index+1]]."</b></p><br>";
                }
                else
                    die(mysqli_error());	
            }
            echo "<br><br><br></div>";
		}
        ?>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
	</section>
    
    <!-- show profiles of other people with same gre score -->
    <section id="portfolio">
    <div>
    	<br><br><br>
        <p class='text-danger text-center' style='font-size:45px;'><b>PROFILES</b></p>
        <br>
        <p class="text-muted" align="center">Here are the profiles of other students with the same GRE score as yours.</p>
    	<?php 
			$result = mysqli_query($conn,"SELECT * FROM user_info WHERE Gre = '".$_POST['gre']."'");
			$row = mysqli_fetch_assoc($result);
			$count = 1;
			while($row)
                {	
					
                    echo '<div class="container jumboton" style="padding-top:30px;">';
						echo '<table class="table" align="center" width="85%">';
							echo '
								<thead style = "border:none;">
									<th colspan = "3" style = "border:0px;">
										Profile #'.$count.'
									</th>
								</thead>
							
							';
							//echo '<caption align="center"><p align = "center">Profile #'.$count.'</p></caption>';
							$count = $count+1;
							echo '<tr>';
								echo '<th colspan="2">NAME: '.$row['Name'];
								echo '<td>INSTITUTE: '.$row['Institute'];
							echo '</tr>';
							echo '<tr class="success">';
								echo '<td>GPA: '.$row['Gpa'];
								echo '<td>GRE SCORE: '.$row['Gre'];
								echo '<td>TOEFL iBT SCORE: '.$row['Toefl'];
							echo '</tr>';
							echo '<tr>';
								echo '<td>YEARS OF EXPERIENCE: '.$row['Experience'];
								echo '<td>COMPANY NAME: '.$row['Company'];
								echo '<td>TERM: '.$row['Term'];
							echo '</tr>';
							echo '<tr class="success">';
								echo '<td colspan="3"><b align="center">INTERNSHIPS<b><br><b class="text-info" align="center">'.$row['Internship'].'</b>';
							echo '</tr>';
							echo '<tr>';
								echo '<td colspan="3"><b align="center">PUBLICATIONS<b><br><b class="text-info" align="center">'.$row['Publication'].'</b>';
							echo '</tr>';
							echo '<tr class="success">';
								echo '<td colspan="3"><b align="center">PROJECTS<b><br><b class="text-info" align="center">'.$row['Project'].'</b>';
							echo '</tr>';
							echo '<tr>';
								echo '<td colspan="3"><b align="center">LETTER OF RECOMMENDATION<b><br><b class="text-info" align="center">'.$row['LOR'].'</b>';
							echo '</tr>';
							echo '<tr class="success">';
								echo '<td colspan="3"><b align="center">UNIVERSITIES FILLED<b><br><b class="text-info" align="center">'.$row['Univ_filled'].'</b>';
							echo '</tr>';
							echo '<tr>';
								echo '<td colspan="3"><b align="center">UNIVERSITIES ADMITTED<b><br><b class="text-info" align="center">'.$row['Univ_admit'].'</b>';
							echo '</tr>';
						echo '</table>';
					echo '</div>';
					$row = mysqli_fetch_assoc($result);
                }
		?>
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
    
    <!-- Login form javascript -->
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 

</body>

</html>