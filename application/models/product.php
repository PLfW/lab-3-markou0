<?php
class Product extends Model
{
	protected static $table_name = "product";

	public static function to_html ($product) {
		return '
			<td name="id" class="hidden">'.$product["id"].'</td>
			<td>
				<button name="removeRec" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#removeRec"><span class="glyphicon glyphicon-remove"></span> </button>
			
				<button name="editRec" type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editRec"><span class="glyphicon glyphicon-edit"></span> </button>
			</td>
			<td name="name">'.$product["name"].'</td>
			<td name="description">'.$product["description"].'</td>
			<td name="type">'.ProductType::to_html(ProductType::find($product["product_type_id"])).'</td>
			<td name="location_type">'.LocationType::to_html(LocationType::find(Location::find($product["location_id"])["location_type_id"])).'</td>
			<td name="location">'.Location::to_html(Location::find($product["location_id"])).'</td>
			<td name="inventarisation_code">'.$product["inventarisation_code"].'</td>
			<td name="price">'.$product["price"].'</td>
			<td name="amount">'.$product["amount"].'</td>
			<td name="date_created">'.$product["date_created"].'</td>
			<td name="user">'.User::to_html(User::find($product["user_id"])).'</td>
		';
	}

	public static function parse_form(){
		foreach ($_POST as $key => $value) {
		    if($value==NULL)unset($_POST[$key]);
		}
		// $_POST["product_type_id"]=ProductType::where(["name"=>$_POST["product_type"]])->take_one();
		$_POST["product_type_id"]=ProductType::where("name LIKE '%".$_POST["product_type"]."%'")->take_one()["id"];
		$_POST["location_id"]=Location::where("name LIKE '%".$_POST["location"]."%'")->take_one()["id"];
		unset($_POST["product_type"]);
		unset($_POST["location"]);
	}
}
?>