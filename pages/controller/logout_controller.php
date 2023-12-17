<?php

require_once '../../config/db_config.php';
require_once '../../google_config.php';

//Reset OAuth access token
$client->revokeToken();

//Destroy entire session data.
session_destroy();

header("Location: login_controller.php");
exit();

?>
