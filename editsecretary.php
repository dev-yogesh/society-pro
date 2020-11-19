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
	<title>Secretary || Edit</title>
	<link rel="shortcut icon" href="Components\Images\Logos\favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="Components\Texts\css\editsecretary_styles.css" />
</head>
<body>
	<div id="main_container">
		<p><?php editSecretary() ?></p>
		<p><?php updateSecretary() ?></p>
	</div>
</body>
</html>
	<?php } ?>