<?php
class Route {

	static function redirect($url, array $params = null, $statusCode = 303) {
	   $url = 'Location: ' . $url;
	   if ($params && count($params) > 0) {
	   		$url .= '?';
	   		foreach ($params as $key => $value) {
		   		$url .= $key.'='.$value.'&';
		   	}
		   	$url = rtrim($url, '&');
	   }
	   header($url, true, $statusCode);
	   die();
	}

	static function include_models () {
		include "application/core/query.php";
		foreach (glob("application/models/*.php") as $filename) {
		    include $filename;
		}
	}

	static function login_user () {
		session_start();
		$_SESSION["user"] = User::get_current_user();
	}

	static function start() {
		include "application/routes.php";
		
		// Default controller and action
		$controller_name = 'Main';
		$action_name = 'index';
		$url = strtok($_SERVER["REQUEST_URI"],'?');
		if (array_key_exists($url, $routes)) {
			$url = $routes[$url];
		}

		$route = explode('/', $url);
		// Controller name
		if (!empty($route[1])) {	
			$controller_name = $route[1];
		}
		// Action name
		if (!empty($route[2])) {
			$action_name = $route[2];
		}

		$controller_name = $controller_name.'_Controller';
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path)) {
			include $controller_path;
			Route::include_models();
			Route::login_user();
		} else {
			Route::ErrorPage404();
			return;
		}
		
		$controller = new $controller_name;
		$action = $action_name;
		if(method_exists($controller, $action))	{
			$controller->$action();
		} else {
			Route::ErrorPage404();
		}
	
	}
	
	static function ErrorPage404()	{
		include "application/controllers/err404_Controller.php";
		$err = "Err404_Controller";
        $errController = new $err;
        $errController->view->generate('404.php');
    }
}
?>
