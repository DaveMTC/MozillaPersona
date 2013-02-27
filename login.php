<?php
	session_start();

	require_once('class.mozilla.php');

	$objMozilla = new Mozilla_Persona($_POST['assertion'], 'localhost');

	if($objMozilla->set_http_request()){
		if($objMozilla->get_is_login()) {
			$_SESSION['email'] = $objMozilla->get_email();

			echo json_encode(array("status" => "okay", "action" => 'new'));
		}
	}
?>