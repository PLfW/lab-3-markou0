<?php $user = $params["user"];
$isOwner = $user["id"] == $_SESSION["user"]["id"];
$canEdit = $_SESSION["user"]["permissions"] == "admin" || $isOwner ?>
<section class="container">
	<section class="col-sm-4">
		<h3><?php echo $user["first_name"]." ".$user["last_name"]."<br>"; ?></h3>
		<section class="content-block">
			<?php echo "<strong>Телефон:</strong> ".$user["contact_phone"]."</br>";
			echo "<strong>E-mail:</strong> ".$user["email"]."</br>";
			echo "<strong>Права доступу:</strong> ".User::type_to_ukr($user["permissions"])."</br>";
			echo "<strong>Дата реєстрації:</strong> ".date("j-n-Y", strtotime($user["created_at"]))."</br>";
			echo "<hr>";
			if ($canEdit) {
				echo '<a href="edit_user?id='.$user["id"].'" class="link"><span class="glyphicon glyphicon-edit"></span> Редагувати</a>';
			} 
			?>
		</section>
	</section>
	<section class="col-sm-8">
		<?php $institutions = Institution::where("account_id=".$user["id"])->take();
		if (count($institutions) > 0) { ?>
			<h3><?php  echo $isOwner ? "Мої Заклади" : "Заклади користувача" ?></h3>
			<div class="row">
				<?php 
					foreach ($institutions as $key => $institution) {
						echo Institution::to_html($institution);
					}
				?>
			</div>
		<?php } else if ($isOwner) { ?>
					<h3>Ви ще не зареєстрували жодного закладу</h3>
					<a href="/new_institution">Додати заклад</a>
		<?php } else 
					echo "<h3>Цей користувач ще не зареєстрував жодного закладу</h3>";
		?>
		
	</section>
</section>
