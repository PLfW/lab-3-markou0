<?php
class Main_Controller extends Controller
{
	function index()
	{	
		$this->params["popular_products"] = Product::where('true')->limit(6)->take();
		$this->params["product_types"] = ProductType::where('true')->take();
		$this->params["locations"] = Location::where('true')->take();
		$this->view->generate('main.php', 'template.php', $this->params);
	}
}
?>