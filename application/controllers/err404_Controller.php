<?php
class Err404_Controller extends Controller
{
	function index()
	{	
		$this->view->generate('404.php');
	}
}
?>