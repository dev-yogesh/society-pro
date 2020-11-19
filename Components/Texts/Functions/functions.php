<?php
	//MySQL Database Connection
	$con = mysqli_connect("localhost","root","","societypro") or die("Error in Connection: " . mysqli_connect_error());
	
	//Secretary SignIn Functinality
	function secretarySignIn(){
		global $con;
		//If SignIn Button for Secretary is Clicked 
		if(isset($_POST['signin'])){
			$email = mysqli_real_escape_string($con, $_POST['email']); 
			$password = mysqli_real_escape_string($con, $_POST['password']); 
				
			$get_user = "SELECT * From secretary where email = '$email' AND password = '$password'";
			$run_user = mysqli_query($con, $get_user);
			$check_user = mysqli_num_rows($run_user);
			
			//Checking For Correct E-mail and Password
			if($check_user == 1){
				$_SESSION['email'] = $email;
				echo "<script>window.open('homesecretary.php', '_self')</script>";
			}
			else{
				echo "<script>alert('Incorrect E-mail or Password')</script>";
			}
		}
	}
	
	//Secretary SignUp Functinality
	function secretarySignUp(){
		global $con;
		//If SignUp Button for Secretary is Clicked
		if(isset($_POST['signup'])){
			$email = mysqli_real_escape_string($con, $_POST['email']); 
			$firstName = mysqli_real_escape_string($con, $_POST['firstName']); 
			$lastName = mysqli_real_escape_string($con, $_POST['lastName']); 
			$password = mysqli_real_escape_string($con, $_POST['password']); 
			$mobile = mysqli_real_escape_string($con, $_POST['mobile']); 
			$societyName = mysqli_real_escape_string($con, $_POST['societyName']); 
			$societyUID = mysqli_real_escape_string($con, $_POST['societyUID']); 
			$societyAddress = mysqli_real_escape_string($con, $_POST['address']);
				
			$get_email = "SELECT * From secretary where email = '$email'";
			$run_email = mysqli_query($con, $get_email);
			$count = mysqli_num_rows($run_email);
				
			//Checking For E-mail Existance 
			if($count == 1){
				echo "<script>alert('Email is Already Registered, Please Try Another')</script>";
				exit();
			}
			//Checking For Password Length 
			elseif(strlen($password) < 8){
				echo "<script>alert('Password Must be 8 Character Long')</script>";
				exit();
			}
			//Checking For Mobile Number
			elseif(strlen($mobile) != 10){
				echo "<script>alert('Mobile Number Should be of 10 Numbers')</script>";
				exit();
			}
			//Checking for SocietyUID Availibility
			else{
				$get_societyUID = "SELECT * From society where societyUID = '$societyUID'";
				$run_societyUID = mysqli_query($con, $get_societyUID);
				$count = mysqli_num_rows($run_societyUID);
				
				if($count == 1){
					echo "<script>alert('SocietyUID is Already Taken, Please Try Another')</script>";
					exit();
				}
				else{
					
					$insert_secretary = "INSERT INTO secretary(firstName, lastName, email, password, mobile, registrationDate, secretaryImage, societyUID) VALUES('$firstName','$lastName','$email','$password', '$mobile', NOW(), 'default_secretary.png', '$societyUID')";
					$run_secretary = mysqli_query($con, $insert_secretary);
					
					$insert_society = "INSERT INTO society(name, societyUID, address, societyImage) VALUES('$societyName', '$societyUID', '$societyAddress', 'default_society.png')";
					$run_society = mysqli_query($con, $insert_society);

					if(($run_secretary) && ($run_society)){
					$_SESSION['email'] = $email;
					echo "<script>alert('Registration Successful')</script>";
					echo "<script>window.open('homesecretary.php', '_self')</script>";
					}
					else{
						echo "<script>alert('Error in Registration')</script>";
					}
				}
			}
		}
	}
	
	//Member SignIn Functinality
	function memberSignIn(){
		global $con;
		//If SignIn Button for Member is Clicked 
		if(isset($_POST['signin'])){
			$email = mysqli_real_escape_string($con, $_POST['email']); 
			$password = mysqli_real_escape_string($con, $_POST['password']); 
				
			$get_user = "SELECT * From member where email = '$email' AND password = '$password'";
			$run_user = mysqli_query($con, $get_user);
			$check_user = mysqli_num_rows($run_user);
			
			//Checking For Correct E-mail and Password
			if($check_user == 1){
				$_SESSION['email'] = $email;
				echo "<script>window.open('homemember.php', '_self')</script>";
			}
			else{
				echo "<script>alert('Incorrect E-mail or Password')</script>";
			}
		}
	}
	
	//Member SignUp Functinality
	function memberSignUp(){
		global $con;
		//If SignUp Button for Member is Clicked 
		if(isset($_POST['signup'])){
			$email = mysqli_real_escape_string($con, $_POST['email']); 
			$firstName = mysqli_real_escape_string($con, $_POST['firstName']); 
			$lastName = mysqli_real_escape_string($con, $_POST['lastName']); 
			$password = mysqli_real_escape_string($con, $_POST['password']); 
			$mobile = mysqli_real_escape_string($con, $_POST['mobile']); 
			$societyUID = mysqli_real_escape_string($con, $_POST['societyUID']); 
				
			$get_email = "SELECT * From member where email = '$email'";
			$run_email = mysqli_query($con, $get_email);
			$count = mysqli_num_rows($run_email);
				
			//Checking For E-mail Existance 
			if($count == 1){
				echo "<script>alert('Email is Already Registered')</script>";
				exit();
			}
			//Checking For Password Length 
			elseif(strlen($password) < 8){
				echo "<script>alert('Password Must be 8 Character Long')</script>";
				exit();
			}
			//Checking For Mobile Number
			elseif(strlen($mobile) != 10){
				echo "<script>alert('Mobile Number Should be of 10 Numbers')</script>";
				exit();
			}
			//Checking For SocietyUID and Inserting Data Into Tables
			else{
				$get_societyUID = "SELECT * FROM society WHERE societyUID = '$societyUID'";
				$run_societyUID = mysqli_query($con, $get_societyUID);
				$check_societyUID = mysqli_num_rows($run_societyUID);
					
				if($check_societyUID == 1){
					$insert_member = "INSERT INTO member(societyUID, firstName, lastName, email, password, mobile, registrationDate, memberImage) VALUES('$societyUID', '$firstName','$lastName','$email','$password', '$mobile', NOW(), 'default_member.png')";
					
					$run_member = mysqli_query($con, $insert_member);
						
					if($run_member){
						$_SESSION['email'] = $email;
						echo "<script>alert('Registration Successful')</script>";
						echo "<script>window.open('homemember.php', '_self')</script>";
						exit();
					}
					else{
						echo "<script>alert('Error in Registration')</script>";
						exit();
					}
				}
				else{
					echo "<script>alert('Incorrect SocietyUID')</script>";
					exit();
				}
			}
		}
	}
	
	//Getting the Secretary Information to display that to Secretary
	function secretaryInfoForSecretary(){
		global $con;
		$secretary = $_SESSION['email'];
			
		$get_secretary = "SELECT * FROM secretary WHERE email = '$secretary'";
		$run_secretary = mysqli_query($con, $get_secretary);
		$result = mysqli_fetch_array($run_secretary);
			
		$secretaryImage = $result['secretaryImage'];
		$firstName = $result['firstName'];
		$lastName = $result['lastName'];
		$email = $result['email'];
		$password = $result['password'];
		$mobile = $result['mobile'];
		$registrationDate = $result['registrationDate'];
			
		echo "
			<p style='float:left;margin-left:90px;'>
				<table border='1' style='color:blue;font-size:25px;margin:0 auto;margin-top:30px;'>
				<form method='post' action=''>
					<tr>
						<td colspan='2' style='color:white;text-align:center;padding:10px;background-color:#00AFF0;'>Secretary Information</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'><img src='Components/Images/Secretary/$secretaryImage' height='200' weight='200'/></td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>$firstName $lastName</td>
					</tr>
					<tr>
						<td style='padding:5px;'>E-Mail:</td>
						<td style='padding:5px;'>$email</td>
					</tr>
					<tr>
						<td style='padding:5px;'>Password:</td>
						<td style='padding:5px;'>$password</td>
					</tr>
					<tr>
						<td style='padding:5px;'>Mobile:</td>
						<td style='padding:5px;'>+91-$mobile</td>
					</tr>
					<tr>
						<td style='padding:5px;'>Registration Date:</td>
						<td style='padding:5px;'>$registrationDate</td>
					</tr>
				</form>
				</table>
			</p>
			 ";
	}
	
	//Getting the Society Information to display that to Secretary
	function societyInfoForSecretary(){
		global $con;
		$secretary = $_SESSION['email'];
		
		$get_society = "SELECT * FROM society WHERE societyUID = (SELECT societyUID FROM secretary WHERE email = '$secretary')";
		$run_society = mysqli_query($con, $get_society);
		$result = mysqli_fetch_array($run_society);
			
		$societyImage = $result['societyImage'];
		$societyName = $result['name'];
		$societyUID = $result['societyUID'];
		$address = $result['address'];
		
		echo "
			<p style='float:left; margin-left:50px;'>
				<table border='1' style='color:blue;font-size:25px;margin:0 auto;margin-top:45px;'>
				<form method='post'>
					<tr>
						<td style='text-align:center;padding:10px;background-color:#00AFF0;'>
							<a title='Edit Profile' style='color:white;text-decoration:none;' href='editsecretary.php?email=$secretary'>Edit</a>
						</td>
						<td style='text-align:center;padding:10px;background-color:#00AFF0;'>
							<a title='Sign Out' style='color:white;text-decoration:none;' href='signout.php'>SignOut</a>
						</td>
					</tr>
					<tr>
						<td colspan='2' style='color:white;text-align:center;padding:10px;background-color:#00AFF0;'>Society Information</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>
							<img src='Components/Images/Society/$societyImage' height='200' weight='200'/>
						</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>$societyName</td>
					</tr>
					<tr>
						<td style='padding:5px;'>SocietyUID:</td>
						<td style='padding:5px;'>$societyUID</td>
					</tr>
					<tr>
						<td style='padding:5px;'>Society City:</td>
						<td style='padding:5px;'>$address</td>
					</tr>
				</form>
				</table>
			</p>
			 ";
	}
	
		//Getting the Members Information to display that to Secretary
		function memberInfoForSecretary(){
		global $con;
		$secretary = $_SESSION['email'];
		
		$get_member = "SELECT * FROM member WHERE societyUID = (SELECT societyUID FROM secretary WHERE email = '$secretary')"; 
		$run_member = mysqli_query($con, $get_member);
		
				if(mysqli_num_rows($run_member) > 0){
			echo "
				<p>
					<table border='1' style='color:blue;font-size:25px;margin:0 auto;margin-top:570px;margin-bottom:30px;'>
						<tr>
							<td colspan='6' style='color:white;text-align:center;padding:10px;background-color:#00AFF0;'>Society Members Details</td>
						</tr>
						<tr>
							<td style='text-align:center;padding:10px;'>Photo</td>
							<td style='text-align:center;padding:10px;'>First Name</td>
							<td style='text-align:center;padding:10px;'>Last Name</td>
							<td style='text-align:center;padding:10px;'>E-Mail</td>
							<td style='text-align:center;padding:10px;'>Mobile</td>
							<td style='text-align:center;padding:10px;'>Registration Date</td>
						</tr>";
						while($row = mysqli_fetch_assoc($run_member)){
							echo "<tr>";
							echo "<td style='padding:5px;text-align:center;'> <img src='Components/Images/Members/$row[memberImage]' height='50' weight='50'/> </td>";
							echo "<td style='padding:5px;'>" . $row['firstName'] . "</td>";
							echo "<td style='padding:5px;'>" . $row['lastName'] . "</td>";
							echo "<td style='padding:5px;'>" . $row['email'] . "</td>";
							echo "<td style='padding:5px;'>" . $row['mobile'] . "</td>";
							echo "<td style='padding:5px;text-align:center;'>" . $row['registrationDate'] . "</td>";
							echo "</tr>";
						}
				echo "</table>";
				echo "</p>";
		}
		else{
			echo "
					<table border='1' style='color:blue;font-size:25px;margin:0 auto;margin-top:570px;margin-bottom:30px;'>
						<tr>
							<td colspan='6' style='color:white;text-align:center;padding:10px;background-color:#00AFF0;'>Society Members Details</td>
						</tr>
						<tr>
							<td style='text-align:center;padding:10px;'>Photo</td>
							<td style='text-align:center;padding:10px;'>First Name</td>
							<td style='text-align:center;padding:10px;'>Last Name</td>
							<td style='text-align:center;padding:10px;'>E-Mail</td>
							<td style='text-align:center;padding:10px;'>Mobile</td>
							<td style='text-align:center;padding:10px;'>Registration Date</td>
						</tr>
						<tr>
							<td colspan='6' style='padding:5px;'>No Members Have Registered Yet</td>
						</tr>";
				echo "</table>";
		}
	}
	
	//Getting the Member Information to display that to Member
	function memberInfoForMember(){
		global $con;
		$member = $_SESSION['email'];
			
		$get_member = "SELECT * FROM member WHERE email = '$member'";
		$run_member = mysqli_query($con, $get_member);
		$result = mysqli_fetch_array($run_member);
			
		$memberImage = $result['memberImage'];
		$firstName = $result['firstName'];
		$lastName = $result['lastName'];
		$email = $result['email'];
		$password = $result['password'];
		$mobile = $result['mobile'];
		$registrationDate = $result['registrationDate'];
		
			echo "
			<p>
				<table border='1' style='color:blue;font-size:25px;margin-top:30px;float:left;margin-left:100px;'>
				<form method='post' action=''>
					<tr>
						<td colspan='2' style='color:white;text-align:center;padding:10px;background-color:#00AFF0;'>Member Information</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>
							<img src='Components/Images/Members/$memberImage' height='200' weight='200'/>
						</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>$firstName $lastName</td>
					</tr>
					<tr>
						<td style='padding:5px;'>E-Mail:</td>
						<td style='padding:5px;'>$email</td>
					</tr>
					<tr>
						<td style='padding:5px;'>Password:</td>
						<td style='padding:5px;'>$password</td>
					</tr>
					<tr>
						<td style='padding:5px;'>Mobile:</td>
						<td style='padding:5px;'>+91-$mobile</td>
					</tr>
					<tr>
						<td style='padding:5px;'>Registration Date:</td>
						<td style='padding:5px;'>$registrationDate</td>
					</tr>
				</form>
				</table>
			</p>
			 ";
	}
	
	//Getting the Society Information to display that to Member
	function societyInfoForMember(){
		global $con;
		$member = $_SESSION['email'];
		
		$get_society = "SELECT * FROM society WHERE societyUID = (SELECT societyUID FROM member WHERE email = '$member')";
		$run_society = mysqli_query($con, $get_society);
		$result = mysqli_fetch_array($run_society);
			
		$societyImage = $result['societyImage'];
		$societyName = $result['name'];
		$societyUID = $result['societyUID'];
		$address = $result['address'];
		
		echo "
			<p>
				<table border='1' style='color:blue;font-size:25px;margin-top:45px;margin-left:650px;'>
					<tr>
						<td style='text-align:center;padding:10px;background-color:#00AFF0;'>
							<a title='Edit Profile' style='color:white;text-decoration:none;' href='editmember.php?email=$member'>Edit</a>
						</td>
						<td style='text-align:center;padding:10px;background-color:#00AFF0;'>
							<a title='Sign Out' href='signout.php' style='color:white;text-decoration:none;' >SignOut</a>
						</td>
					</tr>
					<tr>
						<td colspan='2' style='color:white;text-align:center;padding:10px;background-color:#00AFF0;'>Society Information</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>
							<img src='Components/Images/Society/$societyImage' height='200' weight='200'/></td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>$societyName</td>
					</tr>
					<tr>
						<td style='padding:5px;'>SocietyUID:</td>
						<td style='padding:5px;'>$societyUID</td>
					</tr>
					<tr>
						<td style='padding:5px;'>Society City:</td>
						<td style='padding:5px;'>$address</td>
					</tr>
				</table>
			<p>
			 ";
	}
	
	//Editing Secretary Functionality
	function editSecretary(){
		global $con;
		$secretary = $_SESSION['email'];
			
		$get_secretary = "SELECT * FROM secretary WHERE email = '$secretary'";
		$run_secretary = mysqli_query($con, $get_secretary);
		$result = mysqli_fetch_array($run_secretary);
			
		$secretaryImage = $result['secretaryImage'];
		$firstName = $result['firstName'];
		$lastName = $result['lastName'];
		$email = $result['email'];
		$password = $result['password'];
		$mobile = $result['mobile'];
		
		$get_society = "SELECT * FROM society WHERE societyUID = (SELECT societyUID FROM secretary WHERE email = '$secretary')";
		$run_society = mysqli_query($con, $get_society);
		$result = mysqli_fetch_array($run_society);
			
		$societyImage = $result['societyImage'];
		$societyName = $result['name'];
		$societyUID = $result['societyUID'];
		$address = $result['address'];
			
		echo "
				<table border='1' style='color:blue;font-size:25px;margin-top:45px;margin:0 auto;margin-top:50px;'>
				<form method='post' action='' enctype='multipart/form-data'>
					<tr>
						<td colspan='2' style='color:white;text-align:center;padding:10px;background-color:#00AFF0;'>Edit Profile</td>
					</tr>
					<tr>
						<td style='text-align:center;padding:10px;'>Secretary Photo</td>
						<td style='text-align:center;padding:10px;'>Society Photo</td>
					</tr>
					<tr>
						<td style='text-align:center;padding:10px;'>
							<img src='Components/Images/Secretary/$secretaryImage' height='100' weight='100'/><br />
							<input type='file' name='secretaryImage' />
						</td>
						<td style='text-align:center;padding:10px;'>
							<img src='Components/Images/Society/$societyImage' height='100' weight='100'/><br />
							<input type='file' name='societyImage' />
						</td>
					</tr>
					<tr>
						<td style='padding:5px;'>First Name:</td>
						<td style='padding:5px;'><input type='text' name='firstName' value='$firstName' required style='padding:5px;width:100%;'/></td>
					</tr>
					<tr>
						<td style='padding:5px;'>Last Name:</td>
						<td style='padding:5px;'><input type='text' name='lastName' value='$lastName' required style='padding:5px;width:100%;'/></td>
					</tr>
					<tr>
						<td style='padding:5px;'>Mobile:</td>
						<td style='padding:5px;'><input type='text' name='mobile' value='$mobile' required style='padding:5px;width:100%;'/></td>
					</tr>
					<tr>
						<td style='padding:5px;'>Society Name:</td>
						<td style='padding:5px;'><input type='text' name='societyName' value='$societyName' required style='padding:5px;width:100%;'/></td>
					</tr>
					<tr>
						<td style='padding:5px;'>Society City:</td>
						<td style='padding:5px;'><input type='text' name='address' value='$address' required style='padding:5px;width:100%;' /></td>
					</tr>
					<tr>
						<td colspan='2' style='padding:5px;text-align:center;'>
							<input type='submit' name='updateSecretary'  value='Update'style='padding:5px;width:100%;background-color:#00AFF0;font-size:25px;color:white;' />
						</td>
					</tr>
					</form>
				</table>
			 ";
	}
	
	//Editing Member Functionality
	function editMember(){
		global $con;
		$member = $_SESSION['email'];
			
		$get_member = "SELECT * FROM member WHERE email = '$member'";
		$run_member = mysqli_query($con, $get_member);
		$result = mysqli_fetch_array($run_member);
			
		$memberImage = $result['memberImage'];
		$firstName = $result['firstName'];
		$lastName = $result['lastName'];
		$email = $result['email'];
		$password = $result['password'];
		$mobile = $result['mobile'];
			
		echo "
				<table border='1' style='color:blue;font-size:25px;margin-top:45px;margin:0 auto;margin-top:50px;'>
				<form method='post' action='' enctype='multipart/form-data'>
					<tr>
						<td colspan='2' style='color:white;text-align:center;padding:10px;background-color:#00AFF0;'>Edit Profile</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>Member Photo</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;'>
							<img src='Components/Images/Members/$memberImage' height='100' weight='100'/><br />
							<input type='file' name='memberImage' />
						</td>
					</tr>
					<tr>
						<td style='padding:5px;'>First Name:</td>
						<td style='padding:5px;'><input type='text' name='firstName' value='$firstName' required style='padding:5px;width:100%;' /></td>
					</tr>
					<tr>
						<td style='padding:5px;'>Last Name:</td>
						<td style='padding:5px;'><input type='text' name='lastName' value='$lastName' required style='padding:5px;width:100%;'/></td>
					</tr>
					<tr>
						<td style='padding:5px;'>Mobile:</td>
						<td style='padding:5px;'><input type='text' name='mobile' value='$mobile' required style='padding:5px;width:100%;'/></td>
					</tr>
					<tr>
						<td colspan='2' style='padding:5px;'>
							<input type='submit' name='updateMember' value='Update' style='padding:5px;width:100%;background-color:#00AFF0;font-size:25px;color:white;'>
						</td>
					</tr>
					</form>
				</table>
			 ";
	}
	
	//Updating Secretary Functinality
	function updateSecretary(){
		global $con;
		$secretary = $_SESSION['email'];
		
		//If Update Button for Secretary is Clicked
		if(isset($_POST['updateSecretary'])){
			$secretaryImage = $_FILES['secretaryImage']['name'];
			$temp_secretaryImage = $_FILES['secretaryImage']['tmp_name'];
			$societyImage = $_FILES['societyImage']['name'];
			$temp_societyImage = $_FILES['societyImage']['tmp_name'];
			$firstName = mysqli_real_escape_string($con, $_POST['firstName']); 
			$lastName = mysqli_real_escape_string($con, $_POST['lastName']); 
			//$email = mysqli_real_escape_string($con, $_POST['email']); 
			//$password = mysqli_real_escape_string($con, $_POST['password']); 
			$mobile = mysqli_real_escape_string($con, $_POST['mobile']); 
			$societyName = mysqli_real_escape_string($con, $_POST['societyName']); 
			//$societyUID = mysqli_real_escape_string($con, $_POST['societyUID']); 
			$societyAddress = mysqli_real_escape_string($con, $_POST['address']);
		
			if(strlen($mobile) != 10){
				echo "<script>alert('Mobile Number Should be of 10 Numbers')</script>";
				exit();
			}
			else{
				if($secretaryImage == ""){
					$secretary_image = "SELECT * FROM secretary WHERE email = '$secretary';";
				
					$run_secretary = mysqli_query($con, $secretary_image);
				
					while($result = mysqli_fetch_array($run_secretary)){
						$secretaryImage = $result['secretaryImage'];
					}			
				}
				else{
					move_uploaded_file($temp_secretaryImage, "Components/Images/Secretary/$secretaryImage");
				}
			
				if($societyImage == ""){
					$society_image = "SELECT * FROM society WHERE societyUID = (SELECT societyUID FROM secretary WHERE email = '$secretary');";
				
					$run_society = mysqli_query($con, $society_image);
				
					while($result = mysqli_fetch_array($run_society)){
						$societyImage = $result['societyImage'];
					}
				}
				else{
					move_uploaded_file($temp_societyImage, "Components/Images/Society/$societyImage");
				}	
				
				$update_secretay = "UPDATE secretary set firstName = '$firstName', lastName = '$lastName', mobile = '$mobile', secretaryImage = '$secretaryImage' where email = '$secretary'";
			
				$update_society = "UPDATE society set name = '$societyName', address = '$societyAddress', societyImage = '$societyImage' WHERE societyUID = (SELECT societyUID FROM secretary WHERE email = '$secretary') ";
					
				$run_secretary = mysqli_query($con, $update_secretay);
			
				$run_society = mysqli_query($con, $update_society);
						
				if(($run_secretary) && ($run_society)){
					echo "<script>window.open('homesecretary.php', '_self')</script>";
				}
				else{
					echo "Error: " . mysqli_error($con);
				}
			}
		}	
	}
	
	//Updating Member Functionality
	function updateMember(){
		global $con;
		$member = $_SESSION['email'];
		
		//If Update Button for Member is Clicked
		if(isset($_POST['updateMember'])){
			
			$memberImage = $_FILES['memberImage']['name'];
			$temp_memberImage = $_FILES['memberImage']['tmp_name'];
			$firstName = mysqli_real_escape_string($con, $_POST['firstName']); 
			$lastName = mysqli_real_escape_string($con, $_POST['lastName']); 
			$mobile = mysqli_real_escape_string($con, $_POST['mobile']); 
			
			if(strlen($mobile) != 10){
				echo "<script>alert('Mobile Number Should be of 10 Numbers')</script>";
				exit();
			}
			else{
				if($memberImage == ""){
					$member_image = "SELECT * From member where email = '$member'";
				
					$run_member = mysqli_query($con, $member_image);
				
					while($result = mysqli_fetch_array($run_member)){
						$memberImage = $result['memberImage'];
					}			
				}
				else{
					move_uploaded_file($temp_memberImage, "Components/Images/Members/$memberImage");
				}	
				
				$update_member = "UPDATE member set firstName = '$firstName', lastName = '$lastName', mobile = '$mobile', memberImage = '$memberImage' where email = '$member'";
					
				$run_member = mysqli_query($con, $update_member);
						
				if($run_member){
					echo "<script>window.open('homemember.php', '_self')</script>";
				}
				else{
					echo "Error: " . mysqli_error($con);
				}
			}					
		}
	}
?>