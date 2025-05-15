<?php
require_once __DIR__ . '/../models/pembayaran.php';
require_once __DIR__ . '/../models/pesanan.php';

use models\Pembayaran;
use models\Pesanan;

if (!isset($_GET['id'])) {
    header('Location: list-transaksi.php');
    exit;
}

$id = $_GET['id'];
$transaksi = Pembayaran::find($id);

if (!$transaksi) {
    echo "Transaksi tidak ditemukan.";
    exit;
}

$pesananList = Pesanan::get();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $id, // jangan lupa id untuk update
        'tanggal' => $_POST['tanggal'],
        'jumlah_bayar' => $_POST['jumlah_bayar'],
        'pesanan_id' => $_POST['pesanan_id'],
    ];

    Pembayaran::update($data);
    header('Location: list-transaksi.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Transaksi - Koperasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="dashboard.php">Edit Koperasi Pegawai</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Menu</div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAnggota" aria-expanded="false" aria-controls="collapseAnggota">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Manajemen Anggota
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAnggota" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="list-anggota.php">Data Anggota</a>
                                <a class="nav-link" href="list-pegawai.php">Data Pegawai</a>
                                <a class="nav-link" href="list-kartuDiskon.php">Kartu Diskon</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="list-produk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                        </a>
                        <a class="nav-link" href="list-pemesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                            Pemesanan
                        </a>
                        <a class="nav-link" href="list-transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                            Transaksi
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Anggia Dwi Hikmah
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Transaksi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="list-transaksi.php">Transaksi</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-edit me-1"></i> Form Edit Transaksi</div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= htmlspecialchars($transaksi['tanggal']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_bayar" class="form-label">Total Bayar</label>
                                    <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="<?= htmlspecialchars($transaksi['jumlah_bayar']) ?>" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pesanan_id" class="form-label">Pesanan</label>
                                    <select class="form-control" id="pesanan_id" name="pesanan_id" required>
                                        <?php foreach ($pesananList as $pesanan): ?>
                                            <option value="<?= $pesanan['id'] ?>" <?= $transaksi['pesanan_id'] == $pesanan['id'] ? 'selected' : '' ?>>
                                                <?= $pesanan['id'] ?> - <?= htmlspecialchars($pesanan['tanggal']) ?> (<?= htmlspecialchars($pesanan['status_bayar']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                <a href="list-transaksi.php" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
