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

	function getUserEdit($userId){
		AuthentificationService::getInstance()->loginRequired();

		$user = getEntityManager()->find("User", $userId);

		if($user == null){
			http_response_code(404);
		}
		else{

			$data = ['user' => $user ];
			$content = $this->render('user-edit', $data);
			$this->response->setContent($content);
		}
	}

	function postUserEdit($userId){
		AuthentificationService::getInstance()->loginRequired();

		$password = $this->request->getParameter("password");
		$passwordCheck = $this->request->getParameter("password-check");

		$user = getEntityManager()->find("User", $userId);

		$error = false;

		if($user == null){
			http_response_code(404);

		}
		else{

			if($password != $passwordCheck){

				MessageService::setMessage("error", "Password fields mismatch");
				$data = ['user' => $user ];
				$content = $this->render('user-edit', $data);
				$this->response->setContent($content);
			}
			else{
				$hash = AuthentificationService::getInstance()->generateHash($password);
				$user->setPassword($hash);
				getEntityManager()->flush();

				MessageService::setMessage("success", "User successfully updated");
				$this->response->setHeader("Location", "/admin/users");

			}
		}

	}

	function getUserDelete($userId){
		AuthentificationService::getInstance()->loginRequired();

		$user = getEntityManager()->find('User', $userId);
		$error = false;
		$errorMessage ="";
		if($user == null){
			$error = true;
			$errorMessage = "This user does not exists";
		}
		elseif($user->getUsername() =="admin"){
			$error = true;
			$errorMessage = "You can't remove this user";			
		}

		$data = ['user' => $user,
				'error' => $error,
				'errorMessage' => $errorMessage  ];
		$content = $this->render('user-delete', $data);
		$this->response->setContent($content);
	}

	function postUserDelete($userId){

		AuthentificationService::getInstance()->loginRequired();
		$user = getEntityManager()->find('User', $userId);

		if($user == null || $user->getUsername() == "admin"){
			MessageService::setMessage("error", "Impossible de supprimer l'utilisateur");


		}
		else{
			getEntityManager()->remove($user);
			getEntityManager()->flush();
			MessageService::setMessage("success", "User successfully deleted");

		}

		$this->response->setHeader("Location", "/admin/users");

	}
}