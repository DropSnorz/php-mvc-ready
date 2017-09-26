<?php
require_once DIR_ADMIN . "controllers/BaseAdminController.php";
require_once DIR_CORE . "services/AuthentificationService.php";

class UserController extends BaseAdminController{

	function getUserList(){

		AuthentificationService::getInstance()->loginRequired();

		$em = getEntityManager();
		$users = $em->getRepository("User")->findAll();
		$data = ['userList' => $users ];
		$content = $this->render('users', $data);
		$this->response->setContent($content);
	}

	function getUserCreate(){

		AuthentificationService::getInstance()->loginRequired();
		$data = [];
		$content = $this->render('user-create', $data);
		$this->response->setContent($content);

	}

	function postUserCreate(){
		AuthentificationService::getInstance()->loginRequired();

		$username = $this->request->getParameter("username");
		$password = $this->request->getParameter("password");
		$passwordCheck = $this->request->getParameter("password-check");

		$error = false;
		$errorMessage = "";

		$em = getEntityManager();

		if($password != $passwordCheck){
			$error = true;
			$errorMessage = "Passwords filed mismatch";
		}

		if(!$error){

			$em->getConnection()->beginTransaction();
			$user = getEntityManager()->getRepository('User')
                      ->findOneBy(array('username' => $username));


            if($user == null){

            	$user = new User;
            	$user->setUsername($username);
            	$user->setPassword($password);
            	$em->persist($user);
            	$em->flush();
            	$em->getConnection()->commit();


            }
            else{
            	$error = true;
            	$errorMessage ="Username already exists";

            	$em->getConnection()->rollBack();
            }
		}

		if($error){
			MessageService::setMessage("error", $errorMessage);
			$data = [];
			$content = $this->renderer->render('user-create', $data);
			$this->response->setContent($content);
		}
		else{
			MessageService::setMessage("success", "User successfully created");
			$this->response->setHeader("Location", "/admin/users");

		}

	}
}