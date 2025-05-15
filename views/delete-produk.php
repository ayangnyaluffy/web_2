<?php
require_once __DIR__ . '/../models/produk.php';
use models\produk;

if(!isset($_GET['id'])) {
    header("Location: list-produk.php");
    exit;
}

$user = produk::find($_GET['id']);

if(!$user) {
    header("Location: list-produk.php");
    exit;
}

produk::delete($user['id']);
header("Location: list-produk.php");

?>