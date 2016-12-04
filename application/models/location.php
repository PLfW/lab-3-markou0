<?php
class Location extends Model
{
	protected static $table_name = "location";

	public static function to_html ($location) {
		return 
			$location["name"];
	}
}
?>