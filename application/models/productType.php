<?php
class ProductType extends Model
{
	protected static $table_name = "product_type";

	public static function to_html ($productType) {
		return 
			$productType["name"];
	}
}
?>