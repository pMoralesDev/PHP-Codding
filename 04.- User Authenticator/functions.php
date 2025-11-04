<?php
require_once "db_config.php";

function get_user_permissions($role_id) {
    global $db;

    $query = " SELECT permissions FROM users WHERE username = ?";
}
?>