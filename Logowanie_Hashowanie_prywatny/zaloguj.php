<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
        $haslo = $_POST['haslo'];
		/*htmlentities-encje html*/
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");/*ENT_QUOTES zamienia na encje również apostrofy i cudzysłowia.*/
		/*mysqli_real_escape_string() 
		Funkcja, której trzeba użyć na każdym ciągu znaków otrzymanym od użytkownika używanym w zapytaniu SQL.
		*/
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$iluTakichUzytkownikow = $rezultat->num_rows;
			if($iluTakichUzytkownikow>0)
			{
                $wiersz = $rezultat->fetch_assoc();
                if(password_verify($haslo,$wiersz['pass'])){
				$_SESSION['zalogowany'] = true;
				
                $_SESSION['user'] = $wiersz['user'];
                
				
				unset($_SESSION['blad']);/*Usuwa z sesji zmienną blad*/
				$rezultat->close();
                header('Location: zalogowany.php');
                }
                else {
				
                    $_SESSION['blad'] = '<span style="color:red">Niepoprawny login lub hasło!</span>';
                    header('Location: index.php');
                    
                }
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Niepoprawny login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>