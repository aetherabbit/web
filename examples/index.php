<!--https://vk.com/dev/authcode_flow_user-->
<?php
require 'config.php';
session_start();
if (isset($_GET['code']) || (isset($_SESSION['code']))) {
    if (isset($_GET['code']) & !(isset($_SESSION['code']))) {
        $_SESSION['code'] = $_GET['code'];
    }
    header('Location: http://localhost/site/main.php');
}
else{
    header('Location:' . config::$get_access_code_url . http_build_query(config::$params_code));
}
?>
