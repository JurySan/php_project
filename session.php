<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Session	</title>
</head>
<body>

</body>
</html>

<?php
	$_SESSION['favcolor']="yellow";
	$_SESSION['favanimal']="dog";
	print_r($_SESSION);

?>