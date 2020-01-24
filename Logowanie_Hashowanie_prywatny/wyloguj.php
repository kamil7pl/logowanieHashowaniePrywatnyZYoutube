<?php

	session_start();
	
	session_unset();/*Niszczy całą sesję.*/
	
	header('Location: index.php');

?>