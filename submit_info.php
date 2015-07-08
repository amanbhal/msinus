<?php
include_once 'includes/config.php';
?>

                    <?php
						$pattern = "/\n/";
						$name = $_POST['name'];
						$institute = $_POST['institute'];
						$gpa = $_POST['gpa'];
						$email = $_POST['email'];
						$gre = $_POST['gre'];
						$toefl = $_POST['toefl'];
						$experience = $_POST['experience'];
						$company = $_POST['company'];
						$term = $_POST['term'];
						$internship = $_POST['internship'];
						$internship = preg_replace($pattern,"<br>",$internship);
						$project = $_POST['project'];
						$project = preg_replace($pattern,"<br>",$project);
						$publication = $_POST['publication'];
						$publication = preg_replace($pattern,"<br>",$publication);
						$lor = $_POST['lor'];
						$lor = preg_replace($pattern,"<br>",$lor);
						$univ_fill = $_POST['univ_fill'];
						$univ_fill = preg_replace($pattern,"<br>",$univ_fill);
						$univ_admit = $_POST['univ_admit'];
						$univ_admit =  preg_replace($pattern,"<br>",$univ_admit);
						
						
						mysqli_query($conn,"INSERT INTO user_info (Name,Institute,Gpa,Email,Gre,Toefl,Experience, Company, Term, Internship,Project,Publication,LOR,Univ_filled,Univ_admit) VALUES ('$name','$institute','$gpa','$email','$gre','$toefl','$experience', '$company','$term', '$internship','$project','$publication','$lor','$univ_fill','$univ_admit')");
						header("Refresh:1; url=index.php?submit=1");
					?>