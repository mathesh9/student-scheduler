<?php
ob_start(); // Start output buffering

ini_set('date.timezone', 'Asia/Manila');
date_default_timezone_set('Asia/Manila');

// Check if a session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');

$db = new DBConnection;
$conn = $db->conn;

function redirect($url = '')
{
    if (!empty($url)) {
        echo '<script>location.href="' . base_url . $url . '"</script>';
    }
}

function validate_image($file)
{
    if (!empty($file)) {
        $ex = explode("?", $file);
        $file = $ex[0];
        $ts = isset($ex[1]) ? "?" . $ex[1] : '';
        if (is_file(base_app . $file)) {
            return base_url . $file . $ts;
        } else {
            return base_url . 'dist/img/no-image-available.png';
        }
    } else {
        return base_url . 'dist/img/no-image-available.png';
    }
}

function format_num($number = '', $decimal = '')
{
    if (is_numeric($number)) {
        $ex = explode(".", $number);
        $decLen = isset($ex[1]) ? strlen($ex[1]) : 0;
        if (is_numeric($decimal)) {
            return number_format($number, $decimal);
        } else {
            return number_format($number, $decLen);
        }
    } else {
        return "Invalid Input";
    }
}


ob_end_flush(); // End output buffering and flush the buffer
