<?php
class Product_Controller extends Controller
{
	function remove()
	{	
		echo htmlspecialchars($_POST['productId']);
		// $this->params["popular_products"] = Product::where('true')->limit(6)->take();
		// $this->view->generate('main.php', 'template.php', $this->params);
	}

	function edit()
	{	


		foreach ($_POST as $key => $value) {
		    if($value==NULL)unset($_POST[$key]);
		}
		// $_POST["product_type_id"]=ProductType::where(["name"=>$_POST["product_type"]])->take_one();
		$_POST["product_type_id"]=ProductType::where("name LIKE '%".$_POST["product_type"]."%'")->take_one()["id"];
		unset($_POST["product_type"]);
		Product::update($_POST,array("id" => $_POST['id']));
		// Route::redirect("/");
		// $this->params["popular_products"] = Product::where('true')->limit(6)->take();
		// $this->view->generate('main.php', 'template.php', $this->params);
	}
}
?>