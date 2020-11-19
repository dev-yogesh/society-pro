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
	<title>Secretary || Home</title>
	<link rel="shortcut icon" href="Components\Images\Logos\favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="Components\Texts\css\homesecretary_styles.css" />
</head>
<body>
	<div id="main_container">
		<p><?php secretaryInfoForSecretary() ?></p>
		<p><?php societyInfoForSecretary() ?></p>
		<p><?php memberInfoForSecretary() ?></p>
	</div>
</body>
</html>
	<?php } ?>