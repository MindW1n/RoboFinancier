<?php 
	session_start();
	spl_autoload_register(function($classname){ require_once "../../classes/$classname" . "Class.php";});
	require_once("../../connect.php");
	$page_obj = new FinancialWorkPage(); 
	// generating header
	echo $page_obj->get_header();
	try {

		$settings_object = Settings::get_settings_obj($pdo_obj);
	}
	catch(Exception $exception) {

		echo "<h4>" . $exception->getMessage() . "</h4>" . "<br />
		<a href=\"settingsPage.php\"class=\"btn-lg btn-primary btn-block btn\" id=\"btn__register\">Create new settings</a>";
	}
	if(!isset($exception)) {
	?>
	<body>

		<?php  
			// getting username
			echo $page_obj->get_username();
		?>
		<div class="title_Bill">
			<div class="content_Bill">
				<h3>State of an account</h3>
			</div>
		</div>
		<?php
			// generating financial info
			$page_obj->set_new_financialWork_obj($pdo_obj, $_SESSION["email"]);
			echo $page_obj->get_financial_content(); 
		?><br />
		<div class="title_Bill">
			<div class="content_Bill">
				<h3>Account actions:</h3>
			</div>
		</div>
		<?php
			// generating links  
			echo $page_obj->get_buttons(); 
		?>
	</body>
	</html>
	<?php } ?>