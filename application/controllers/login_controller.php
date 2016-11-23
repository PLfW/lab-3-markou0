<?php
class Login_Controller extends Controller {
	
	function login() {
		$this->params["isLogin"] = true;
		$this->view->generate('login.php', 'template.php', $this->params);
	}

	function index() {
		$this->login();
	}
	
	function confirm_login() {
		$user = User::where("email='".$this->params["email"]."' AND password='".$this->params["password"]."'")->take_one();
		if ($user) {
			$_SESSION["email"] = $this->params["email"];
			$_SESSION["password"] = $this->params["password"];
			echo json_encode(array('status' => 'success', 'redirect_to' => '/'));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}

	function logout () {
		$_SESSION["user"] = null;
		$_SESSION["email"] = null;
		$_SESSION["password"] = null;
		Route::redirect("login");
	}
}