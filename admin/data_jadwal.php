<?php
include("../connection.php");
// include("../jadwal.php");

// put_to_json();

session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit;
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <!-- Template table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.css"/>
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
                        <h1 class="h3 mb-0 text-gray-800">Tabel Data Jadwal</h1>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-end mb-4" align="center">
                    <div class="d-sm-flex input-group" style="width:50%">
                        <input type="file" class="form-control" name="file" id="fileInput" value="" accept=".xls,.xlsx,.csv" directory>
                        <button class="btn btn-outline-secondary" type="button" name="upload" id="uploadButton" href="upload.php">Upload</button>
                    </div>
                        <a href="tambah.php" class="btn btn-success ml-2">Tambah</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Min</th>
                                    <th scope="col">Max</th>
                                    <th scope="col">Matkul</th>
                                    <th scope="col">Dosen</th>
                                    <th scope="col">Ruang</th>
                                    <th scope="col">Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM jadwal";
                                    $hasil = mysqli_query($con, $query);
                                    
                                    $i = 1;
                                    while($row = mysqli_fetch_array($hasil)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['kelas'] . "</td>";
                                        echo "<td>" . $row['hari'] . "</td>";
                                        echo "<td>" . $row['min'] . "</td>";
                                        echo "<td>" . $row['max'] . "</td>";
                                        echo "<td>" . $row['matkul'] . "</td>";
                                        echo "<td>" . $row['dosen'] . "</td>";
                                        echo "<td>" . $row['ruang'] . "</td>";
                                        echo "<td><a href='edit.php?id=" . $row['id'] . "' class='btn btn-secondary mr-2'>Edit</a><a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger confirmation' >Delete</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
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

    <!-- Alert box saat hapus data -->
    <script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Apa anda yakin ingin menghapus data ini?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

    <!-- AJAX control file -->
    <script>
        $(document).ready(function(){
            $("#uploadButton").click(function(){
                var formData = new FormData();
                formData.append("file", $("#fileInput")[0].files[0]);
                $.ajax({
                    url: "upload.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                        location.reload();
                        $("#fileInput").val("");
                    }
                });
            });
        });

    </script>
</body>

</html>