<?php
session_start();
if (!isset($_SESSION['user_role'])) {
    die(json_encode(["error" => "Unauthorized access. Please log in."]));
}
?>
