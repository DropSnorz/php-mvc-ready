<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;



// Server parameters

define('DIR_BASE',      dirname( __FILE__ )  . '/');
define('DIR_CORE',    DIR_BASE . 'src/core/');


// Run mode

$isDevMode = true;


// Database configuration

$db_user = "root";
$db_pass = "";
$db_name = "bd";
$db_path = DIR_BASE . "db/data.sqlite";



// Override current configuration with local properties
if(file_exists("config.local.php")){
  include "config.local.php";
}



//Doctrine ORM Configuration


// Create a simple "default" Doctrine ORM configuration for Annotations
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/core/models" ), $isDevMode);

$connectionParams = array(
    'dbname' => $db_name,
    'user' => $db_user,
    'password' => $db_pass,
    'path' => $db_path,
    'driver' => 'pdo_sqlite',
    'charset'  => 'utf8',
    'driverOptions' => array(
        1002 => 'SET NAMES utf8'
    )
);

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);


// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);



class PersistenseService{

	private static $em;
	
	public static function getEntityManager(){

		return self::$em;
	}

	public static function setEntityManager($em){
		self::$em = $em;
	}


}

PersistenseService::setEntityManager($entityManager);

function getEntityManager(){
	return PersistenseService::getEntityManager();
}

?>
