<?php
class User extends Model
{
	protected static $table_name = '"user"';

	public static function get_current_user() {
		if ($_SESSION && array_key_exists('email', $_SESSION) && array_key_exists('password', $_SESSION)) {
			return @User::where("email='".$_SESSION["email"]."' AND password='".$_SESSION["password"]."'")->take_one();
		} else {
			return null;
		}
	}

	public static function link_to ($user) {
		return '<a href="user?id='.$user["id"].'" class="link">'.$user["first_name"]." ".$user["last_name"].'</a>';
	}

	public static function to_html ($user) {
		return 
			$user["last_name"]." ".$user["first_name"];
	}
}
?>