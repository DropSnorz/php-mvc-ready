<?php
require_once DIR_CORE . "controllers/BaseController.php";
require_once DIR_CORE . "controllers/DefaultController.php";

return [
    ['GET', '/', "DefaultController/getHome"],
    ['GET', '/index', "DefaultController/getHome"],
    ['GET', '/login', "DefaultController/getLogin"],
    ['POST', '/login', "DefaultController/postLogin"],
    ['GET', '/logout', "DefaultController/getLogout"],

];
