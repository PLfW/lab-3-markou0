<?php
class LocationType extends Model
{
	protected static $table_name = "location_type";

	public static function to_html ($locationType) {
		return 
			$locationType["name"];
	}
}
?>