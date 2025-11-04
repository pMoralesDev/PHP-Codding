<?php

$usermane = $_POST['username'];
$password = $_POST['password'];


if (hash('sha256', $password) === $encrypted_password_DB) {
    
} else {
    echo "Invalid username or password.";
}

?>