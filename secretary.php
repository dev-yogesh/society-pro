<?php
	session_start();
	include("Components/Texts/Connections/connection.php");
	include("Components/Texts/Functions/functions.php");
?>
<!DOCTYPE html>
	<head>
		<title>Secretary || Let's Start</title>
		<link rel="shortcut icon" href="Components\Images\Logos\favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="Components\Texts\css\formcss\public_styles.css" />
	</head>
	<body>	
		<div id="container">
			<a class="hiddenanchor" id="toregister"></a>
			<a class="hiddenanchor" id="tologin"></a>
				<div id="wrapper">
					<div id="login" class="animate form">
						<form  action="" method="post" autocomplete="on">
							<h1>Sign In</h1> 
                            <p> 
								<label for="username" class="uname" data-icon="u" > Your Email </label>
								<input id="username" name="email" required="required" type="email" placeholder="e.g. mymail@mail.com"/>
                            </p>
                            <p> 
								<label for="password" class="youpasswd" data-icon="p"> Your Password </label>
                                <input id="password" name="password" required="required" type="password" placeholder="e.g. X8df!90EO" /> 
                            </p>
                            <p class="login button"> 
								<input type="submit" name="signin" value="Sign In" /> 
							</p>
                            <p class="change_link">
								Not a member yet ?
								<a href="#toregister" class="to_register">Join us</a>
							</p>
                        </form>
						<?php secretarySignIn() ?>
                    </div>

					<div id="register" class="animate form">
						<form  action="" method="post" autocomplete="on"> 
							<h1> Sign Up </h1> 
                            <p> 
								<label for="usernamesignup" class="uname" data-icon="e">Enter Email</label>
                                <input id="usernamesignup" name="email" required="required" type="email" placeholder="e.g. mymail@mail.com" />
                            </p>
                            <p> 
								<label for="emailsignup" class="youmail" data-icon="u" >Enter First Name</label>
                                <input id="emailsignup" name="firstName" required="required" type="text" placeholder="e.g. FirstName"/> 
                            </p>
							<p> 
								<label for="emailsignup" class="youmail" data-icon="u" >Enter Last Name</label>
                                <input id="emailsignup" name="lastName" required="required" type="text" placeholder="e.g. LastName"/> 
                            </p>
							<p> 
								<label for="passwordsignup" class="youpasswd" data-icon="p">Enter Password</label>
                                <input id="passwordsignup" name="password" required="required" type="password" placeholder="e.g. X8df!90EO"/>
                            </p>
							<p> 
								<label for="passwordsignup" class="youpasswd" data-icon="u">Enter Mobile Number</label>
                                <input id="passwordsignup" name="mobile" required="required" type="number" placeholder="e.g. 1234567890"/>
                            </p>
							<p> 
								<label for="passwordsignup" class="youpasswd" data-icon="u">Enter Society Name</label>
                                <input id="passwordsignup" name="societyName" required="required" type="text" placeholder="e.g. Society Name"/>
                            </p>
							<p> 
								<label for="passwordsignup" class="youpasswd" data-icon="u">Create Society UID</label>
                                <input id="passwordsignup" name="societyUID" required="required" type="text" placeholder="e.g. SocietyNameUID"/>
                            </p>
							<p> 
								<label for="passwordsignup" class="youpasswd" data-icon="u">Enter City</label>
                                <input id="passwordsignup" name="address" required="required" type="text" placeholder="e.g. City"/>
                            </p>
                            <p class="signin button"> 
								<input type="submit" name="signup" value="Sign up"/> 
							</p>
							<p class="change_link">  
								Already a member ?
								<a href="#tologin" class="to_register"> Go and log in </a>
							</p>
                        </form>
						<?php secretarySignUp() ?>
                    </div>
						
                </div>
		</div>  
    </body>
</html>