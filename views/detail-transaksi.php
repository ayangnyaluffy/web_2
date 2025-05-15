<?php
require_once __DIR__ . '/../models/pembayaran.php';

use models\pembayaran;

$pembayaranList = pembayaran::get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Data Transaksi - project01</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
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
                <h1 class="mt-4">Transaksi</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transaksi</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Transaksi
                    </div>
                    <div class="card-body">
                        <div class="mb-3 text-end">
                            <a href="create-transaksi.php" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add Transaksi
                            </a>
                        </div>
                        <table id="datatableSimple" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Tanggal</th>
                                    <th>Pesanan ID</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pembayaranList as $index => $pembayaran): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $pembayaran['id'] ?></td>
                                        <td>Rp <?= number_format($pembayaran['jumlah_bayar'], 0, ',', '.') ?></td>
                                        <td><?= $pembayaran['tanggal'] ?></td>
                                        <td><?= $pembayaran['pesanan_id'] ?></td>
                                        <td>
                                            <a href="detail-transaksi.php?id=<?= $pembayaran['id'] ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            <a href="edit-transaksi.php?id=<?= $pembayaran['id'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="delete-transaksi.php?id=<?= $pembayaran['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pembayaran ini?');">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">&copy; PW2 <?= date('Y') ?></div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../public/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="../public/js/datatables-simple-demo.js"></script>
</body>
</html>
