
<?php
require_once DIR_CORE . "controllers/DefaultController.php";

return [
    ['GET', '/', "DefaultController/getHome"],
    ['GET', '/index', "DefaultController/getHome"],
];

?>
