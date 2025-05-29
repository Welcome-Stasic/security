<?php
session_start();
require('db.php');
$email = false;
$alert_sub = false;
$alert_db = false;
$alert_email = false;
$alert_empty = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_sub = !empty($_POST['email_sub']) ? $conn->real_escape_string(trim($_POST['email_sub'])) : null;
    if ($email_sub != false) {
        $check_email = $conn->prepare("SELECT * FROM `subscribe_user` WHERE email = ?");
        $check_email->bind_param('s', $email_sub);
        $check_email->execute();
        $result = $check_email->get_result();
        if ($result->num_rows === 0) {
            $set_sub = $conn->prepare("INSERT INTO `subscribe_user` (email) VALUE (?)");
            $set_sub->bind_param('s', $email_sub);
            if ($set_sub->execute()) {
                $alert_sub = true;
            } else {
                $alert_db = true;
            }
        } else {
            $alert_email = true;
        }
    } else {
        $alert_empty = true;
    }
}
