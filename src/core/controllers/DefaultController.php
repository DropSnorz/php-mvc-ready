<?php

require_once DIR_CORE . "services/AuthentificationService.php";

class DefaultController{

	function getHome(){

		include DIR_CORE . "templates/home.php";
	}

	function getLogin(){
		include DIR_CORE . "templates/login.php";
	}

	function postLogin(){

		//TODO handle missing parameters
		$login = $_POST['username'];
		$password = $_POST['password'];

		if(AuthentificationService::getInstance()->auth($login, $password)){
			echo("Login success");

		}
		else{
		
			include DIR_CORE . "templates/login.php";

		}
	}


	function getLogout(){
		AuthentificationService::getInstance()->logout();
		header("location:/");
	}
}