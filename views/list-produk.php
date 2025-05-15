<?php
require_once __DIR__ . '/../models/produk.php';

use models\produk;

$produkList = produk::get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Data Produk - project01</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../public/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="dashboard.php">Koperasi Pegawai</a>
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
                <h1 class="mt-4">Produk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Produk</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Produk
                    </div>
                    <div class="card-body">
                        <div class="mb-3 text-end">
                            <a href="create-produk.php" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add Produk
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Barang</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Jenis Produk ID</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produkList as $index => $produk): ?>
                                    <tr>
                                        <td><?= $produk['id'] ?></td>
                                        <td><?= $produk['kode'] ?></td>
                                        <td><?= $produk['nama'] ?></td>
                                        <td><?= $produk['deskripsi'] ?></td>
                                        <td>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></td>
                                        <td><?= $produk['stok'] ?></td>
                                        <td><?= $produk['jenis_produk_id'] ?></td>
                                        <td class="text-nowrap">
                                        <div class="d-flex gap-1">
                                            <a href="detail-produk.php?id=<?= $produk['id'] ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="edit-produk.php?id=<?= $produk['id'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="delete-produk.php?id=<?= $produk['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus Produk ini?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
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
                    <div class="text-muted">Copyright &copy; PW2 <?= date('Y') ?></div>
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
