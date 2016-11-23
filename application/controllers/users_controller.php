<?php
class Users_Controller extends Controller {
	
	function index () {	
		$this->user_page();
	}
	
	function user () {
		if (!array_key_exists("id", $this->params)) {
			$this->to404();
		}

		try {
			$user = @User::find($this->params["id"]);
			if (!$user)
				throw new Exception("Невірне ID", 1);
				
			$this->params["user"] = $user;
			$this->view->generate('user.php', 'template.php', $this->params);
		} catch (Exception $e) {
			$this->to404();
		}
	}

	function edit () {
		if ($_SESSION["user"]["permissions"] == 'admin' || $_SESSION["user"]["id"] == $this->params["id"]) {
			$this->params["edit"] = true;
			$this->params["user"] = User::find($this->params["id"]);
			$this->view->generate('signup.php', 'template.php', $this->params);
		} else {
			$this->to404();
		}
		
	}
}
?>
