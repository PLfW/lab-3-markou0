<section class="container">
	<form id="signup-form" class="thin-form center-block content-block">
		<?php if ($params["edit"]) {
			echo '<h2>Редагування користувача</h2>';
			echo '<input type="hidden" name="id" value="'.$params["user"]["id"].'" id="id">';
		} else {
			echo '<h2>Реєстрація</h2>';
		} ?>
		<hr>
			<input type="text" id="first_name" name="user[first_name]" placeholder="Ім'я" class="form-control input-lg" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="">
			<input type="text" id="last_name" name="user[last_name]" placeholder="Прізвище" class="form-control input-lg" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="">
			<input type="text" id="contact_phone" name="user[contact_phone]" placeholder="Номер телефону" class="form-control input-lg" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="">
			<input type="email" id="email_signup" name="user[email]" placeholder="Електронна Адреса" class="form-control input-lg" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="">
			<input type="password" id="password_signup" name="user[password]" placeholder="Пароль" class="form-control input-lg" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="">
			<?php if (!$params["edit"]) { ?>
			<input type="password" id="password_confirm" placeholder="Підтвердження паролю" class="form-control input-lg" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="">
			<?php } ?>
			<?php if ($params["edit"] && $_SESSION["user"]["permissions"] == "admin") { ?>
				<div class="form-group">
					<label for="type">Права доступу</label>
					<select class="form-control input-lg" id="permissions" name="permissions">
						<option value="account">Користувач</option>
						<option value="moderator">Модератор</option>
						<option value="admin">Адміністратор</option>
					</select>
				</div>
			<?php } ?>
		<div id="signup-submit" class="btn btn-primary btn-block btn-lg">Надіслати</div>
		<section id="errors" class="thin-form center-block"></section>
	</form>
</section>
<?php if ($params["edit"]) {
	echo '<script>edit(\''.str_replace("\"", "\\\"",  json_encode($params["user"])).'\');</script>';
} ?>