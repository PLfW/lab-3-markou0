<?php
class Product extends Model
{
	protected static $table_name = "product";

	public static function to_html ($product) {
		return '
			<td>
				<button name="'.$product["id"].'" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#removeRec"><span class="glyphicon glyphicon-remove"></span> </button>
			
				<button name="'.$product["id"].'" type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editRec"><span class="glyphicon glyphicon-edit"></span> </button>
			</td>
			<td name="name">'.$product["name"].'</td>
			<td name="description">'.$product["description"].'</td>
			<td name="type">'.ProductType::to_html(ProductType::find($product["product_type_id"])).'</td>
			<td name="location">location</td>
			<td name="inventarisation_code">'.$product["inventarisation_code"].'</td>
			<td name="price">'.$product["price"].'</td>
			<td name="amount">'.$product["amount"].'</td>
			<td name="date_created">'.$product["date_created"].'</td>
			<td name="user">username</td>
		';
	}
}
?>