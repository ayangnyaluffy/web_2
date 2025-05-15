<?php
require_once __DIR__ . '/../models/pesanan.php';
use models\pesanan;

if(!isset($_GET['id'])) {
    header("Location: list-pesanan.php");
    exit;
}

$user = pesanan::find($_GET['id']);

if(!$user) {
    header("Location: list-pesanan.php");
    exit;
}

pesanan::delete($user['id']);
header("Location: list-pesanan.php");

?>