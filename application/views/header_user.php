<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Toko Online">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/img/smile.png'); ?>" type="image/png">

    <!-- Title -->
    <title><?= isset($title) ? $title : 'Toko Online'; ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;900&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- JS Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/all.min.css') ?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Optional: Custom CSS -->
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown button {
            border-radius: 50px;
            color: #28a745;
            padding: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            max-width: 250px;
            /* Sesuaikan nilai max-width sesuai kebutuhan */
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
            /* Buka dropdown ke kiri */
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        header {
            top: 0;
            position: sticky;
            z-index: 0;
        }

        .carousel-item img {
            max-width: 70%;
            /* Mengatur lebar maksimum gambar */
            max-height: 300px;
            /* Mengatur tinggi maksimum gambar */
            margin: auto;
            /* Mengatur margin otomatis untuk memusatkan gambar */
            display: block;
            /* Memastikan gambar ditampilkan sebagai blok */
        }

        .carousel-caption h5 {
            color: #fff;
            /* Warna teks putih untuk caption */
            font-weight: bold;
        }

        .carousel-caption p {
            color: #d4edda;
            /* Warna teks hijau muda untuk caption */
        }

        .btn-primary {
            background-color: #28a745;
            /* Warna hijau */
            border-color: #28a745;
            /* Border hijau */
        }

        .btn-primary:hover {
            background-color: #218838;
            /* Warna hijau lebih gelap saat hover */
            border-color: #1e7e34;
            /* Border lebih gelap saat hover */
        }

        .card {
            border: 1px solid #28a745;
            /* Border hijau pada kartu */
        }

        .card-title {
            color: #155724;
            /* Warna hijau gelap untuk judul barang */
        }

        .alert-danger {
            background-color: #f8d7da;
            /* Latar belakang merah muda untuk pesan error */
            color: #721c24;
            /* Warna teks merah gelap untuk pesan error */
        }

        footer {
            background-color: #28a745;
            /* Warna hijau untuk footer */
            color: white;
            /* Warna teks putih pada footer */
        }

        footer a {
            color: #f8f9fa;
            /* Warna teks putih pada link di footer */
        }

        @media (max-width: 800px) {
            .card {
                width: 100%;
                /* Kartu akan memenuhi lebar layar */
                margin-bottom: 20px;
                /* Jarak antar kartu */
            }

            .card-img-top {
                height: 150px;
                /* Tinggi gambar lebih kecil */
                object-fit: cover;
                /* Gambar tetap proporsional */
            }

            .card-body {
                text-align: center;
                /* Agar konten lebih simetris di layar kecil */
            }

            /* Ubah grid agar kartu tidak terlalu memanjang */
            .row {
                display: flex;
                flex-wrap: wrap;
                /* Agar elemen tetap di grid */
                justify-content: space-between;
            }

            .col-md-3,
            .col-sm-6 {
                flex: 0 0 48%;
                /* Kartu akan lebih besar agar dua kartu bisa tampil bersebelahan */
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <header>
        <!-- Navbar -->
        <header>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="<?= base_url('user') ?>" style="color:#28a745">Toko Online</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('history') ?>">
                                <i class="fas fa-clock"></i> Pesanan <span class="history"></span>
                            </a>
                        </li>

                        </li>
                        <li class="nav-item">
                            <?php
                            $cart = $this->cart->total_items() . ' Items';
                            echo anchor('cart', '<i class="fa fa-shopping-cart"></i> ' . $cart, ['class' => 'nav-link']);
                            ?>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pengguna <!-- Ganti dengan nama pengguna yang diinginkan -->
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo base_url('login/settings'); ?>">Pengaturan Akun</a>
                                <a class="dropdown-item" href="<?= base_url('regAcc/logout'); ?>">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

    </header>
    <main>