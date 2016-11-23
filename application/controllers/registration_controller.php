<?php
class Registration_Controller extends Controller {
	
	function index () {	
		$this->register();
	}
	
	function register () {
		$this->view->generate('signup.php', 'template.php');
	}

	function confirm_registration () {
		$res = null;

		if (array_key_exists("id", $this->params)){
			$updated_user = User::find($this->params["id"]);
			if (!isset($updated_user)) {
				die();
				return;
			}
			if ($this->params["permissions"] && $_SESSION["user"]["permissions"] == 'admin' 
				&& $updated_user["id"] != $_SESSION["user"]["id"]) {
				$this->params["user"]["permissions"] = $this->params["permissions"];
			}
			$res = User::update($this->params["user"], array("id"=>$this->params["id"]));

		} else if (!User::exists("email='".$this->params["user"]["email"]."'")) {
			if ($this->params["user"]["contact_phone"][0] != '+') {
				$this->params["user"]["contact_phone"] = '+'.$this->params["user"]["contact_phone"];
			}
			$res = User::insert($this->params["user"]);
		} else {
			echo json_encode(array('status'=>'error', 'error'=>'Користувач з такою електронною адресою вже існує'));
		}

		if (isset($res)) {
			echo json_encode(array('status'=>'success', 'redirect_to'=>'/login'));
		} else {
			echo json_encode(array('status'=>'error', 'error'=>pg_last_error()));
		}
	}
}