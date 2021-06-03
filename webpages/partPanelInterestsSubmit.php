<?php
require_once('db_functions.php');
require_once('data_functions.php');
require_once('StaffCommonCode.php');
// Start here.  Should be AJAX requests only
if (!$ajax_request_action = $_POST["ajax_request_action"])
	exit();
switch ($ajax_request_action) {
	case "autosave":
		// FIXME This doesn't appear to exist anywhere?
		autosave();
		break;
	default:
		exit();
}
