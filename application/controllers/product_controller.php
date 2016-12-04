<?php
class Product_Controller extends Controller
{
	
	function create(){
		Product::parse_form();
		$_POST["user_id"]=1;//gag
		Product::insert($_POST);
		// Route::redirect("/");
	}

	function remove()
	{	
		Product::delete($_POST["id"]);
		// $this->params["popular_products"] = Product::where('true')->limit(6)->take();
		// $this->view->generate('main.php', 'template.php', $this->params);
	}

	function edit()
	{	
		Product::parse_form();
		Product::update($_POST,array("id" => $_POST['id']));
		// Route::redirect("/");
		// $this->params["popular_products"] = Product::where('true')->limit(6)->take();
		// $this->view->generate('main.php', 'template.php', $this->params);
	}
}
?>