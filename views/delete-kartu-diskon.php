<?php
require_once __DIR__ . '/../models/kartu_diskon.php';
use models\kartuDiskon;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: list-kartuDiskon.php");
    exit;
}

$kartuDiskon = kartuDiskon::find($id);

if (!$kartuDiskon) {
    header("Location: list-kartuDiskon.php");
    exit;
}

kartuDiskon::delete($id);
header("Location: list-kartuDiskon.php");
exit;
?>
