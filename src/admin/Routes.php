
<?php
require_once DIR_CORE . "controllers/BaseController.php";
require_once DIR_ADMIN . "controllers/DashboardController.php";
require_once DIR_ADMIN . "controllers/UserController.php";


return [

    ['GET', '/dashboard', "DashboardController/getDashboard"],
    ['GET', '/admin/users', "UserController/getUserList"],
    ['GET', '/admin/user/create', "UserController/getUserCreate"],
    ['POST', '/admin/user/create', "UserController/postUserCreate"],
    ['GET', '/admin/user/{id}/delete', "UserController/getUserDelete"],
    ['POST', '/admin/user/{id}/delete', "UserController/postUserDelete"],



];

?>
