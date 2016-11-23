<?php
class Controller {
	
	public $view;
	public $params;

	function __construct() {
		// Gets parameters from URI and POST and stores them in the params array
		$parts = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
		parse_str($parts, $this->params);
		if (count($_POST) > 0) {
			$this->params = array_merge ($this->params, $_POST);
		}
		
		$this->view = new View();
	}
	
	//	Redirects user to page404
	public function to404 () {
		$this->view->generate('404.php');
		die();
	}

}