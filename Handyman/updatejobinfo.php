<?php
 include ( "inc/connection.inc.php" );

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("Location: index.php");
	$user = "";
	$utype_db = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = $con->query("SELECT * FROM user WHERE id='$user'");
		$get_user_name = $result->fetch_assoc();
			$uname_db = $get_user_name['fullname'];
			$utype_db = $get_user_name['type'];
}

if (isset($_REQUEST['uid'])) {
	$pstid = mysqli_real_escape_string($con, $_REQUEST['uid']);
	$result1 = $con->query("SELECT * FROM handyman WHERE t_id='$user' ORDER BY id DESC");
	$get_handyman_name = $result1->fetch_assoc();
	$hid_db = $get_handyman_name['h_id'];
	$id_db = $get_handyman_name['id'];
	$medium = $get_handyman_name['medium'];
	$cls = $get_handyman_name['class'];
	$jobs = $get_handyman_name['prefer_job'];
	$f_sal = $get_handyman_name['salary'];
	$plocation_db = $get_handyman_name['prefer_location'];

	if($user != $_REQUEST['uid']){
		header('location: index.php');
	}else{

	}
}else {
	header('location: index.php');
}


//posting
if (isset($_POST['updatejobinfo'])) {

	$f_loca = $_POST['location'];
	$f_sal = $_POST['sal_range'];


	try {
				if(($user == $_REQUEST['uid']) && ($utype_db == "handyman"))
				{
					
					//throw new Exception('Email is not valid!');
					$joblist = implode(',', $_POST['job_list']);
					$classlist = implode(',', $_POST['class_list']);
					$mediumlist = implode(',', $_POST['medium_list']);

					//not working!!!!!!!!!!!!
					//$result3 = mysqli_query($con, "UPDATE handyman SET prefer_job='$joblist',class='$classlist',medium='$mediumlist',salary='$f_sal',prefer_location='$f_loca', WHERE t_id='$user'");

					if($result4 = $con->query("INSERT INTO handyman (h_id,prefer_job,class,medium,salary,prefer_location) VALUES ('$user','$joblist','$classlist','$mediumlist',
						'$_POST[sal_range]','$_POST[location]')")){
						$result = $con->query("DELETE FROM handyman WHERE id='$id_db'");
						
					}
				
				//success message
				$success_message = '
				<div class="signupform_content"><h2><font face="bookman">Post successfull!</font></h2>
				<div class="signupform_text" style="font-size: 18px; text-align: center;"></div></div>';

				header("Location: aboutme.php?uid=".$user."");
				}
			}
			catch(Exception $e) {
				$error_message = $e->getMessage();
		}
}


?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/footer.css" rel="stylesheet" type="text/css" media="all" />
	<!-- menu tab link -->
	<link rel="stylesheet" type="text/css" href="css/homemenu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	
</head>
<body class="body1">
<div>
	<div>
		<header class="header">

			<div class="header-cont">

				<?php
					include 'inc/banner.inc.php';
				?>

			</div>
		</header>
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2 w3-animate-left" stylRe="width:100px;" id="mySidebar">
		  <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
		  <a href="index.php" class="w3-bar-item w3-button">Tution</a>
		  <a href="photography.php" class="w3-bar-item w3-button">Photography</a>
		  <a href="#" class="w3-bar-item w3-button">IT</a>
		</div>
		<div class="topnav">
			<a class="navlink" href="cover.php">Home</a>
			<a class="navlink" href="index.php" style="margin: 0px 0px 0px 100px;">Newsfeed</a>
			<a class="navlink" href="#news">Search Handyman</a>
			<?php 
			if($utype_db == "handyman")
				{

				}else {
					echo '<a class="navlink" href="postform.php">Post</a>';
				}

			 ?>
			<a class="navlink" href="#contact">Contact</a>
			<a class="navlink" href="#about">About</a>
			<div style="float: right;" >
				<table>
					<tr>
						<?php
							if($user != ""){
								echo '<td>
							<a class="active navlink" href="profile.php?uid='.$user.'">'.$uname_db.'</a>
						</td>
						<td>
							<a class="navlink" href="logout.php">Logout</a>
						</td>';
							}else{
								echo '<td>
							<a class="navlink" href="login.php">Login</a>
						</td>
						<td>
							<a class="navlink" href="registration.php">Register</a>
						</td>';
							}
						?>
						
					</tr>
				</table>
			</div>
		</div>
	</div>

	<!-- newsfeed -->
	<div style="margin: 20px; overflow: hidden;">
		<div style="width: 1000px; margin: 0 auto;">
		
			<ul>
				<li style="float: left;">
					<div class="settingsleftcontent">
						<ul>
							<li><?php echo '<a href="profile.php?uid='.$user.'" >Post</a>'; ?></li>
							<li><?php echo '<a href="aboutme.php?uid='.$user.'">About</a>'; ?></li>
							<li><?php echo '<a href="settings.php">Settings</a>'; ?></li>
						</ul>
					</div>
				</li>
				<li style="float: right;">
								<form action="" method="POST" class="registration">
								<?php 
									echo '
										<div class="holecontainer">
										<div class="nfbody">
										<div class="p_body">';
													if (isset($error_message)) {
														echo '<div class="signup_error_msg" style="
  color: #A92A2A;">'.$error_message.'</div>';
													}elseif(isset($succs_message)){
														echo '<div class="signup_error_msg" style="
  color: #A92A2A;">'.$succs_message.'</div>';
													}
												echo'
											<h2 style="text-align: center;">Update Tution Informaion</h2>'; ?>
											<div class="itemrow">
									  			<div style="width: 20%; float: left;">
									  				<label>Medium: </label>
									  			</div>
									  			<div style="width: 80%; float: left;">
									  				<div class="divp50"><input <?php $medium1=strstr($medium, "Home"); if($medium1 != '') echo 'checked'; ?> type="checkbox" name="medium_list[]" value="Home"><span>Home</span></div>
													<div class="divp50"><input <?php $medium1=strstr($medium, "Office"); if($medium1 != '') echo 'checked'; ?> type="checkbox" name="medium_list[]" value="Office"><span>Office</span></div>
													<div class="divp50"><input <?php $medium1=strstr($medium, "Any"); if($medium1 != '') echo 'checked'; ?> type="checkbox" name="medium_list[]" value="Any"><span>Any</span></div>
									  		</div>
									  		</div>
											<div class="itemrow">
									  			<div style="width: 20%; float: left;">
									  				<label>Prefer Jobs: </label>
									  			</div>
									  			<div style="width: 80%; float: left;">
									  				<div class="divp50"><input <?php $job1=strstr($job, "Plumber"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Plumber"><span>Plumber</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "House Cleaner"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="House Cleaner"><span>House Cleaner</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Gardener"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Gardener"><span>Gardener</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Electrician"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Exlectrician"><span>Electrician</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Refrigerator repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Refrigerator repair"><span>Refrigerator repair</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "AC mechanic"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="AC mechanic"><span>AC mechanic</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Mobile repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Mobile Repair"><span>Mobile Repair</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Carpenting"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Carpenting"><span>Carpenting</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Wall Painter"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Wall Painter"><span>Wall Painter</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Furniture Fixer"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Furniture Fixer"><span>Furniture Fixer</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Sanitary"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Sanitary"><span>Sanitary</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Tiles-Flooring"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Tiles-Flooring"><span>Tiles-Flooring</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Floor repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Floor repair"><span>Floor repair</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Cobbler"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Cobbler"><span>Cobbler</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Tailor"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Tailor"><span>Tailor</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Massager"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Massager"><span>Massager</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Window repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Window repair"><span>Window repair</span></div>
													<div class="divp50"><input <?php $job1=strstr($job, "Thai glass repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="job_list[]" value="Thai glass repair"><span>Thai glass repair</span></div>
													
									  			</div>
									  		</div>
											<div class="itemrow">
									  			<div style="width: 20%; float: left;">
									  				<label>Prefer Class: </label>
									  			</div>
									  			<div style="width: 80%; float: left;">
									  				<div class="divp50"><input <?php $class1=strstr($cls, "Amateur"); if($class1 != '') echo 'checked'; ?> type="checkbox" name="class_list[]" value="Amateur"><span>Amateur</span></div>
													<div class="divp50"><input <?php $class1=strstr($cls, "Semi-Expert"); if($class1 != '') echo 'checked'; ?> type="checkbox" name="class_list[]" value="Semi-Expert"><span>Semi-Expert</span></div>
													<div class="divp50"><input <?php $class1=strstr($cls, "Expert"); if($class1 != '') echo 'checked'; ?> type="checkbox" name="class_list[]" value="Expert"><span>Expert</span></div>
													<div class="divp50"><input <?php $class1=strstr($cls, "Professional"); if($class1 != '') echo 'checked'; ?> type="checkbox" name="class_list[]" value="Professional"><span>Professional</span></div>
													
									  		<?php	echo '</div>
									  		</div>
											<div class="itemrow">
									  			<div style="width: 20%; float: left;">
									  				<label>Prefer Location: </label>
									  			</div>
									  			<div style="width: 80%; float: left;">
									  				<input type="text" name="location" value="'.$plocation_db.'"/>
									  			</div>
									  		</div>
											<div class="itemrow">
									  			<div style="width: 20%; float: left;">
									  				<label>Salary: </label>
									  			</div>
									  			<div style="width: 80%; float: left;">
									  				<select name="sal_range">';
														if($f_sal!="") echo '<option value="'.$f_sal.'">'.$f_sal.'</option>';
													  echo '<option value="None">None</option>
													  <option value="1000-2000">1000-2000</option>
													  <option value="2000-5000">2000-5000</option>
													  <option value="5000-10000">5000-10000</option>
													  <option value="10000-15000">10000-15000</option>
													  <option value="15000-25000">15000-25000</option>
													</select>
									  			</div>
									  		</div>
									  		<input type="submit" class="sub_button" name="updatejobinfo" value="Update"/><br></div><br>
										</div></div>'
								 ?>
							</form>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- footer -->
	<div>
	<?php
		include 'inc/footer.inc.php';
	?>
	</div>

	




</div>
<!-- homemenu tab script -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
/**/
</body>
</html>