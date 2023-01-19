<?php
include("../connection.php");

session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM jadwal WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
    }
}

if (isset($_POST['insert'])) {
    $kelas = $_POST['kelas'];
    $hari = $_POST['hari'];
    $min_val = $_POST['min'];
    $max_val = $_POST['max'];
    $matkul = $_POST['matkul'];
    $dosen = $_POST['dosen'];
    $ruang = $_POST['ruang'];

    $query = "INSERT INTO jadwal (kelas, hari, min, max, matkul, dosen, ruang) VALUES ('$kelas', '$hari', '$min_val', '$max_val', '$matkul', '$dosen', '$ruang')";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: data_jadwal.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">   

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <!-- Template table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.css"/>
 
    <style>
        .form-25 {
            width: 100%;
        }

        .m-custom {
            width: 100%;
            margin: auto !important;
            padding: 0 450px 0 450px;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="bg-white p-1" style="color:black">WEB 2</div>
                <div class="sidebar-brand-text mx-3">Kel 2</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Lihat Jadwal -->
            <li class="nav-item active">
                <a class="nav-link" href="../dashboard.php">
                    <span>Lihat Jadwal</span></a>
            </li>

            <!-- Nav Item - Tambah Data -->
            <li class="nav-item active">
                <a class="nav-link" href="data_jadwal.php">
                    <span>Data Jadwal</span></a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Nav Item - Settings -->
            <!-- <li class="nav-item active">
                <a class="nav-link" href="#">
                    <span>Settings</span></a>
            </li> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Logout -->
                    <form action="" method="post">
                        <button type="submit" name="logout" class="btn btn-danger logout-btn">Logout</button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-center mb-4" align="center">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Data Jadwal</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row m-custom">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="id" name="id">
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label></br>
                                    <select name="kelas" class="form-select" area-label="Default select example">
                                        <option value="TI-1A" selected>TI-1A</option>
                                        <option value="TI-1B">TI-1B</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="hari">Hari</label></br>
                                    <select name="hari" class="form-select" area-label="Default select example">
                                        <option value="Senin" selected>Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="min_val">Jam awal</label>
                                    <input type="number" class="form-control form-25" value="" name="min" min="1" max="12">
                                </div>
                                <div class="form-group">
                                    <label for="max_val">Jumlah Jam</label>
                                    <input type="number" class="form-control form-25" value="" name="max" min="1" max="12">
                                </div>
                                <div class="form-group">
                                    <label for="matkul">Mata Kuliah</label>
                                    <input type="text" class="form-control form-25" value="" name="matkul">
                                </div>
                                <div class="form-group">
                                    <label for="dosen">Dosen</label>
                                    <input type="text" class="form-control form-25" value="" name="dosen">
                                </div>
                                <div class="form-group">
                                    <label for="ruang">Ruangan</label>
                                    <input type="text" class="form-control form-25" value="" name="ruang">
                                </div>

                                <input type="submit" value="Tambah Data" name="insert" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>