<?php
 include ( "inc/connection.inc.php" );

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
	$utype_db = "";
	header("Location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = $con->query("SELECT * FROM user WHERE id='$user'");
		$get_user_name = $result->fetch_assoc();
			$uname_db = $get_user_name['fullname'];
			$utype_db = $get_user_name['type'];
}

if (isset($_REQUEST['pid'])) {
	$pstid = mysqli_real_escape_string($con, $_REQUEST['pid']);
	$result3 = $con->query("SELECT * FROM post WHERE id='$pstid'");
		$get_user_pid = mysqli_fetch_assoc($result3);
		$uid_db = $get_user_pid['postby_id'];
		$jobs = $get_user_pid['jobs'];
		$cls = $get_user_pid['class'];
		$medium = $get_user_pid['medium'];
		$salary = $get_user_pid['salary'];
		$location = $get_user_pid['location'];
		$deadline = $get_user_pid['deadline'];
		$posttime = $get_user_pid['post_time'];
	if($user != $uid_db){
		header('location: index.php');
	}else{

	}
}else {
	header('location: index.php');
}

if (isset($_POST['deletepost'])) {
		$pstid = mysqli_real_escape_string($con, $_REQUEST['pid']);
		$result3 = $con->query("SELECT * FROM post WHERE id='$pstid'");
			$get_user_pid = mysqli_fetch_assoc($result3);
			$uid_db = $get_user_pid['postby_id'];
		if($user != $uid_db){
			header('location: index.php');
		}else{
			$result = $con->query("DELETE FROM post WHERE id='$pstid'");
			header('location: profile.php?uid='.$user.'');
		}
	}


//posting
if (isset($_POST['submit'])) {
	try {
		if(empty($_POST['location'])) {
			throw new Exception('Location can not be empty');
			
		}
		if(empty($_POST['class_list'])) {
			throw new Exception('Class can not be empty');
			
		}
		if(empty($_POST['deadline'])) {
			throw new Exception('Deadline can not be empty');
			
		}
		if(empty($_POST['sal_range'])) {
			throw new Exception('Salary range can not be empty');
			
		}
		if(empty($_POST['sub_list'])) {
			throw new Exception('Jobs can not be empty');
			
		}
		if(empty($_POST['medium_list'])) {
			throw new Exception('Medium can not be empty');
			
		}
		
		// Check if email already exists
						$d = date("Y-m-d"); //Year - Month - Day
							//throw new Exception('Email is not valid!');
							$joblist = implode(',', $_POST['job_list']);
							$classlist = implode(',', $_POST['class_list']);
							$mediumlist = implode(',', $_POST['medium_list']);
							$result = mysqli_query($con, "UPDATE post SET job='$joblist',class='$classlist',medium='$mediumlist',salary='$_POST[sal_range]',location='$_POST[location]',deadline='$_POST[deadline]', post_time='$posttime' WHERE id='$pstid'");
						
						//success message
						$success_message = '
						<div class="signupform_content"><h2><font face="bookman">Edit successfull!</font></h2>
						<div class="signupform_text" style="font-size: 18px; text-align: center;"></div></div>';
						
						header("Location: profile.php?uid=".$user."");
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
	
	<!-- date link -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$( function() {
	$( "#datepicker" ).datepicker();
	} );
	</script>
	<!-- date link end -->
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
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2 w3-animate-left" style="width:100px;" id="mySidebar">
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
					echo '<a class="active navlink" href="postform.php">Post</a>';
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
							<a class="navlink" href="profile.php?uid='.$user.'">'.$uname_db.'</a>
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
	<div class="nbody" style="margin: 0px 100px; overflow: hidden;">
		<div class="nfeedleft">
			<div class="postbox">
			<h3>Post Edit Form</h3>
			<?php
				echo '<div class="signup_error_msg">';
					
						if (isset($error_message)) {echo $error_message;}
						
					
				echo'</div>';
				?>
			  	<form action="#" method="post">
			  	<div class="itemrow">
			  			<div style="width: 20%; float: left;">
			  				<label>Jobs: </label>
			  			</div>
			  			<div style="width: 80%; float: left;">
			  				<div class="divp35"><input <?php $job1=strstr($job, "Plumber"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Plumber"><span>Plumber</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "House Cleaner"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="House Cleaner"><span>House Cleaner</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Gardener"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Gardener"><span>Gardener</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Electrician"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Electrician"><span>Electrician</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Refrigerator repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Refrigerator repair"><span>Refrigerator repair</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "AC mechanic"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="AC mechanic"><span>AC mechanic</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Mobile repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Mobile repair"><span>Mobile repair</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Carpenting"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Carpenting"><span>Carpenting</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Wall Painter"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Wall Painter"><span>Wall Painter</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Furniture fixer"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Furniture fixer"><span>Furniture fixer</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Sanitary"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Sanitary"><span>Sanitary</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Tiles-Flooring"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Tiles-Flooring"><span>Tiles-Flooring</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Floor repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Floor repair"><span>Floor repair</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Cobbler"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Cobbler"><span>Cobbler</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Tailor"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Tailor"><span>Tailor</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Massager"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Massager"><span>Massager</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Window repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Window repair"><span>Window repair</span></div>
							<div class="divp35"><input <?php $job1=strstr($job, "Thai-glass repair"); if($job1 != '') echo 'checked'; ?> type="checkbox" name="sub_list[]" value="Thai-glass repair"><span>Thai-glass repair</span></div>
							
			  			</div>
			  		</div>
			  	
				
					<div class="itemrow">
						<div style="width: 20%; float: left;">
							<label>Class: </label>
						</div>
						<div style="width: 80%; float: left;">
							<div class="divp35"><input <?php $class1=strstr($cls, "Amateur"); if($class1 != '') echo 'checked'; ?> type="checkbox" name="class_list[]" value="Amateur"><span>Amateur</span></div>
							<div class="divp35"><input <?php $class1=strstr($cls, "Semi-Expert"); if($class1 != '') echo 'checked'; ?> type="checkbox" name="class_list[]" value="Semi-Expert"><span>Semi-Expert</span></div>
							<div class="divp35"><input <?php $class1=strstr($cls, "Expert"); if($class1 != '') echo 'checked'; ?> type="checkbox" name="class_list[]" value="Expert"><span>Expert</span></div>
							<div class="divp35"><input <?php $class1=strstr($cls, "Professional"); if($class1 != '') echo 'checked'; ?> type="checkbox" name="class_list[]" value="Professional"><span>Professional</span></div>
							
						</div>
					</div>
				  	<div class="itemrow">
				  			<div style="width: 20%; float: left;">
				  				<label>Medium: </label>
				  			</div>
				  			<div style="width: 80%; float: left;">
								<div class="divp35"><input <?php $medium1=strstr($medium, "Home"); if($medium1 != '') echo 'checked'; ?> type="checkbox" name="medium_list[]" value="Plumber"><span>Plumber</span></div>
								<div class="divp35"><input <?php $medium1=strstr($medium, "Office"); if($medium1 != '') echo 'checked'; ?> type="checkbox" name="medium_list[]" value="House Cleaner"><span>House Cleaner</span></div>
								<div class="divp35"><input <?php $medium1=strstr($medium, "Any"); if($medium1 != '') echo 'checked'; ?> type="checkbox" name="medium_list[]" value="Any"><span>Any</span></div>
							</div>
					</div>
					<div class="itemrow">
				  			<div style="width: 20%; float: left;">
				  				<label>Salary Range: </label>
				  			</div>
							<div style="width: 80%; float: left;">
								<select name="sal_range">
									<?php if($f_sal!="") echo '<option value="'.$f_sal.'">'.$f_sal.'</option>';  ?>
								  <option value="None">None</option>
								  <option value="1000-2000">1000-2000</option>
								  <option value="2000-5000">2000-5000</option>
								  <option value="5000-10000">5000-10000</option>
								  <option value="10000-15000">10000-15000</option>
								  <option value="15000-25000">15000-25000</option>
								  <option value="Contract">Contract</option>
								</select>
							</div>
						</div>
				  	<div class="itemrow">
				  			<div style="width: 20%; float: left;">
				  				<label>Location: </label>
				  			</div>
				  			<div style="width: 80%; float: left;">
				  				<?php echo '<input type="text" name="location" value="'.$location.'" placeholder="e.g: Dhanmondi, Mirpur,..">'; ?>
				  			</div>
				  		</div>
					
					<div class="itemrow">
				  			<div style="width: 20%; float: left;">
				  				<label>Deadline: </label>
				  			</div>
				  			<div style="width: 20%; float: left;">
				  				<p><?php echo '<input name="deadline" type="text" id="datepicker" placeholder="e.g: 01/05/2021" value="'.$deadline.'">'; ?></p>
				  			</div>
				  	</div>
				  		<input type="submit" style="float: left;" class="sub_button" name="submit" value="Update"/>
						<input type="submit" class="sub_button" name="deletepost" style="float: right;" value="Delete"/>
				</form></br></br>
			</div>
			</div>
		</div>
		<div class="nfeedright">
			
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
/**/
</body>
</html>