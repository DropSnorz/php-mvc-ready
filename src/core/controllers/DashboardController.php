<?php

require_once DIR_CORE . "services/AuthentificationService.php";

class DashboardController extends BaseController{

	function getDashboard(){

		AuthentificationService::getInstance()->loginRequired();
		$data = [];
		$content = $this->renderer->render('dashboard', $data);
		$this->response->setContent($content);
	}
}