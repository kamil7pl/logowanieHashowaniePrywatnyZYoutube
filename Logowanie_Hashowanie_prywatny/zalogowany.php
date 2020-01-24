<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>System logowania</title>
</head>

<body>
	
<?php

	echo "<p>Witaj ".$_SESSION['user'].'! <a href="wyloguj.php">Wyloguj się!</a></p>';
	/*Skrypt, który jest wykonany po zalogowaniu.*/
  echo 'Jakis skrypt php';
	/*Koniec skryptu, który jest wykonany po zalogowaniu.*/
?>

</body>
</html>