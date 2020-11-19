<?php
	session_start();
	include("Components/Texts/Connections/connection.php");
	include("Components/Texts/Functions/functions.php");
	
	if(!isset($_SESSION['email'])){
		header("location: index.php");
	}
	else{
?>

<html>
<head>
	<title>Member || Home</title>
	<link rel="shortcut icon" href="Components\Images\Logos\favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="Components\Texts\css\homemember_styles.css" />
</head>
<body>
	<div id="main_container">
		<p><?php memberInfoForMember()?></p>
		<p><?php societyInfoForMember()?></p>
	</div>
</body>
</html>
	<?php } ?>