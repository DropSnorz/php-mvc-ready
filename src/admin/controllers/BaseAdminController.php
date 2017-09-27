<?php
require_once DIR_CORE . "services/AuthentificationService.php";

use Http\Request;
use Http\Response;


class BaseAdminController extends BaseController{

	protected $request;
	protected $response;
	protected $renderer;

	public function render($template, $data){

		$extra = [
			"current_user"=> AuthentificationService::getInstance()->getCurrentUser()
		];

		$data = array_merge($extra, $data);
		return $this->renderer->render($template, $data);
	}


}