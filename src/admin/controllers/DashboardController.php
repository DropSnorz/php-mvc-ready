<?php
require_once DIR_ADMIN . "controllers/BaseAdminController.php";
require_once DIR_CORE . "services/AuthentificationService.php";

class DashboardController extends BaseAdminController{

	function getDashboard(){

		AuthentificationService::getInstance()->loginRequired();
		$data = [];
		$content = $this->render('dashboard', $data);
		$this->response->setContent($content);
	}
}