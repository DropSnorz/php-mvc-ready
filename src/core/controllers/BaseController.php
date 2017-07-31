<?php

use Http\Request;
use Http\Response;


class BaseController{

	protected $request;
	protected $response;
	protected $renderer;

	public function __construct(Request $request, Response $response, Renderer $renderer){

		$this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;

	}
}