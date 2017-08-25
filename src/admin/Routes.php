
<?php
require_once DIR_CORE . "controllers/BaseController.php";
require_once DIR_ADMIN . "controllers/DashboardController.php";

return [

    ['GET', '/dashboard', "DashboardController/getDashboard"],

];

?>
