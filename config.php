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
$db_host = "localhost";



// Override current configuration with local properties
if(file_exists("config.local.php")){
  include "config.local.php";
}



define('BDD_USER', $db_user); // db user
define('BDD_PASS', $db_pass); // db password
define('BDD_NAME', $db_name); // database name
define('BDD_HOST', $db_host); // db server


//Doctrine ORM Configuration


// Create a simple "default" Doctrine ORM configuration for Annotations
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/core/model" ), $isDevMode);

$connectionParams = array(
    'dbname' => BDD_NAME,
    'user' => BDD_USER,
    'password' => BDD_PASS,
    'host' => BDD_HOST,
    'driver' => 'pdo_mysql',
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
