<?php
require_once __DIR__ . '/../models/pembayaran.php';
use models\pembayaran;

if(!isset($_GET['id'])) {
    header("Location: list-pembayaran.php");
    exit;
}

$user = pembayaran::find($_GET['id']);

if(!$user) {
    header("Location: list-pembayaran.php");
    exit;
}

pembayaran::delete($user['id']);
header("Location: list-pembayaran.php");

?>