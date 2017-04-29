<?php
require 'config.php';
session_start();
session_destroy();
header('Location:' . config::$get_access_code_url . http_build_query(config::$params_code));
?>