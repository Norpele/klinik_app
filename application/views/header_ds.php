<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="<?php echo base_url('assets/img/smile.png'); ?>" type="image/png">
    <title><?php echo isset($title) ? $title : 'Dashboard Admin'; ?></title>

    <!-- Custom fonts for this template-->
    <link href="assets/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
</head>
<style>
    .modal-body label {
    color: black;
}
.head-p,
.p{
    color: black;
    font-size: 16px;
    font-family: 'Roboto', sans-serif;
}

#table2 th, #table2 td {
        text-align: center; 
    }

    /* Breadcrumb Styling */
.breadcrumb {
    background-color: #f8f9fa; /* Warna latar belakang */
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
}

.breadcrumb-item a {
    color: #007bff; /* Warna link */
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline; /* Efek saat link di-hover */
}

.breadcrumb-item.active {
    color: #6c757d; /* Warna breadcrumb aktif */
    font-weight: bold;
}
body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #007bff; /* Background biru */
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            width: 250px;
        }
        .sidebar h2 {
            font-size: 20px;
            font-weight: bold;
            color: #fff;
        }
        .sidebar hr {
            border-color: rgba(255, 255, 255, 0.3);
        }
        .sidebar a {
            color: #d1ecf1;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            font-size: 14px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .sidebar a:hover {
            background-color: #0056b3; /* Warna hover */
            color: white;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card h5 {
            font-size: 18px;
            font-weight: bold;
        }
        
</style>

<body>
    <!-- Page Wrapper -->
    <div class="sidebar">
        <h2 class="text-white">Admin Klinik</h2>
        <hr class="border-secondary">
        <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-user-md"></i> Manajemen Poli</a>
        <a href="#"><i class="fas fa-users"></i> Manajemen Pasien</a>
        <a href="#"><i class="fas fa-calendar-check"></i> Jadwal Klinik</a>
        <a href="#"><i class="fas fa-file-medical"></i> Rekam Medis</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>